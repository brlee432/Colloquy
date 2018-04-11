<?php

	include("functions.php");

	if ($_GET['action'] == "logInSignUp") {

		$error = "";

		//sign-up validation

		if ($_POST['logInActive'] == "0") {

			if(!$_POST['email']) {

				$error = "Please enter an email address. <br>";

			} else if (!$_POST['password']) {

				$error = "Please enter a password. <br>";

			} else if (!$_POST['firstName']) {

				$error = "Please enter a first name. <br>";

			} else if (is_numeric($_POST['firstName'])) {

				$error = "Please enter a real name. <br>";

			} else if (!$_POST['lastName']) {

				$error = "Please enter a last name. <br>";

			} else if (is_numeric($_POST['lastName'])) {

				$error = "Please enter a real name. <br>";

			} else if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {

				$error ="The email address you entered is not valid. <br>";

			}

			if ($error != "") {

				echo $error; 
				exit();

			}

			//log-in validation

		} else if ($_POST['logInActive'] == "1") {

			if(!$_POST['email']) {

				$error = "Please enter an email address. <br>";

			} else if (!$_POST['password']) {

				$error = "Please enter a password. <br>";

			} else if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {

				$error ="The email address you entered is not valid. <br>";

			}

			if ($error != "") {

				echo $error; 
				exit();

			}


		}

		if ($_POST['logInActive'] == "0") {

			$query = "SELECT * FROM users WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
			$result = mysqli_query($link, $query);
			if (mysqli_num_rows($result) > 0) $error = "That email address is already taken.";
			else {

				$query = "INSERT INTO users (`email`, `firstname`, `lastname`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, $_POST['firstName'])."', '".mysqli_real_escape_string($link, $_POST['lastName'])."', '".mysqli_real_escape_string($link, $_POST['password'])."')";

				if (mysqli_query($link, $query)) {

					$hash= password_hash($_POST['password'], PASSWORD_DEFAULT);

					$query = "UPDATE `users` SET `password` = '$hash' WHERE `id` = ".mysqli_insert_id($link)." LIMIT 1";

					mysqli_query($link, $query);

					$_SESSION['id'] = mysqli_insert_id($link);

					echo "You've been signed up! Switch back to the Log In tab to log in!";

					$defaultPicQuery = "INSERT INTO `userImages` (`image`, `userid`) VALUES  ('default.jpg' , '".$_SESSION['id']."') LIMIT 1";

					mysqli_query($link, $defaultPicQuery);
					

				} else {

					echo "Yikes. Couldn't create user. - Please try again later.";

				}

			}

		} else {

			$query = "SELECT * FROM users WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";

			$result = mysqli_query($link, $query);

			$row = mysqli_fetch_assoc($result);

			if (isset($row)) {

				if (password_verify($_POST['password'], $row['password'])) {

					echo 1;

					$_SESSION['id'] = $row['id'];

				} else {

					$error = "Could not find that email/password combination.";

				}

			}


		}


		if ($error != "") {

			echo $error; 
			exit();

		}
		

	}

	if ($_GET['action'] == 'toggleFollow') {

		$query = "SELECT * FROM isFollowing WHERE follower = '".mysqli_real_escape_string($link, $_SESSION['id'])."' AND isFollowing = ".mysqli_real_escape_string($link, $_POST['userId'])." LIMIT 1";

		$result = mysqli_query($link, $query);

		if (mysqli_num_rows($result) > 0) {

			$row = mysqli_fetch_assoc($result);

			mysqli_query($link, "DELETE FROM isFollowing WHERE id = ".mysqli_real_escape_string($link, $row['id'])." LIMIT 1");

			echo "0";

		} else {

			mysqli_query($link, "INSERT INTO isFollowing  (follower, isFollowing) VALUES (".mysqli_real_escape_string($link, $_SESSION['id'])." , ".mysqli_real_escape_string($link, $_POST['userId']).")");

			echo "1";

		}

	}

	if ($_GET['action'] == 'makePost') {

		if(!$_POST['postContent']) {

			echo "Your post is empty!";

		} else if (strlen($_POST['postContent']) > 500) {

			echo "Your post is too long. 500 characters is the limit.";

		} else {

			mysqli_query($link, "INSERT INTO tweets (`tweet`, `userid`, `datetime`) VALUES ('".mysqli_real_escape_string($link, $_POST['postContent'])."', ".mysqli_real_escape_string($link, $_SESSION['id'])." , NOW())");

			echo "1";

			

		}


	}


	if ($_GET['action'] == 'deletePost') {


			mysqli_query($link, "DELETE FROM tweets WHERE `id` = '".mysqli_real_escape_string($link, $_POST['postId'])."' LIMIT 1");

			echo "1";


	}



	if(isset($_FILES["file"]["type"])) {

		$validextensions = array("jpeg", "jpg", "png");
		$temporary = explode(".", $_FILES["file"]["name"]);
		$file_extension = end($temporary);
		$userQuery = "SELECT * FROM `users` WHERE `id` = ".mysqli_real_escape_string($link, $_SESSION['id'])." LIMIT 1";
        $userQueryResult = mysqli_query($link, $userQuery);
        $user = mysqli_fetch_assoc($userQueryResult);
		

		if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
				) && ($_FILES["file"]["size"] < 1000000)//Approx. 100mb files can be uploaded.
				&& in_array($file_extension, $validextensions)) {

				if ($_FILES["file"]["error"] > 0) {

				echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";

				} else {

					if (file_exists("uploads/" . $_FILES["file"]["name"])) {

						echo $_FILES["file"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";

					} else {

						$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
						$targetPath = "uploads/".$_FILES['file']['name']; // Target path where file is to be stored
						move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file

						mysqli_query($link, "UPDATE `userImages` SET `profilepic` = '0' WHERE `userid` = '".mysqli_real_escape_string($link, $_SESSION['id'])."'");

						mysqli_query($link, "INSERT INTO userImages (`userid`, `datetime`, `image`, `profilepic`) VALUES (".mysqli_real_escape_string($link, $_SESSION['id'])." , NOW() , '".$_FILES['file']['name']."' , '1')");


						echo "<span id='success'>Image Uploaded Successfully!</span><br/>";

					}

				}

		} else {

			echo "<span id='invalid'>***Invalid file Size or Type***<span>";

		}

	}



	if ($_GET['action'] == 'updateBio') {

		if(!$_POST['bioContent']) {

			echo "Your bio is empty! Write something about yourself to make your profile more exciting.";

		} else if (strlen($_POST['bioContent']) > 500) {

			echo "Your bio is too long. 500 characters is the limit.";

		} else {

			mysqli_query($link, "UPDATE `users` SET `bio` = '".mysqli_real_escape_string($link, $_POST['bioContent'])."' WHERE `id` = '".mysqli_real_escape_string($link, $_SESSION['id'])."' LIMIT 1");

			echo "1";

		}


	}


	if ($_GET['action'] == 'setProfPicToExisting') {


		mysqli_query($link, "UPDATE `userImages` SET `profilepic` = '0' WHERE `userid` = '".mysqli_real_escape_string($link, $_SESSION['id'])."' AND `profilepic` = '1' LIMIT 1");

		mysqli_query($link, "UPDATE `userImages` SET `profilepic` = '1' WHERE `id` = '".mysqli_real_escape_string($link, $_POST['imageId'])."' LIMIT 1");

		$profilePicQuery = "SELECT * FROM `userImages` WHERE `userid` = '".mysqli_real_escape_string($link, $_SESSION['id'])."' AND `profilepic` = '1' ";
        $profilePicQueryResult = mysqli_query($link, $profilePicQuery);
        $profilePic = mysqli_fetch_assoc($profilePicQueryResult);

		if ($profilePic['image'] != "") {

			echo $profilePic['image'];

		} else if ($profilePic['image'] == "") {

			echo "0";

		}


	}




	if ($_GET['action'] == 'sendChat') {

		if(!$_POST['chatContent']) {

			echo "You can't send an empty message!";

		} else if (strlen($_POST['chatContent']) > 500) {

			echo "Your message is too long. 500 characters is the limit.";

		} else {

			mysqli_query($link, "INSERT INTO chat (`senderid`, `recipientid`, `message` , `datetime`) VALUES (".mysqli_real_escape_string($link, $_SESSION['id'])." , ".mysqli_real_escape_string($link, $_POST['userId'])." , '".mysqli_real_escape_string($link, $_POST['chatContent'])."' , NOW())");

			echo "1";

			

		}


	}


	if ($_GET['action'] == 'openChat') {

		global $link;


       $userQuery = "SELECT * FROM `users` WHERE `id` = ".mysqli_real_escape_string($link, $_POST['userId'])." LIMIT 1";
       $userQueryResult = mysqli_query($link, $userQuery);
       $user = mysqli_fetch_assoc($userQueryResult);


       echo '
       <div class="name-plate">
       <span class="page-header">Chatting with '.$user['firstname'].' '.$user['lastname'].'</span>
			<button type="button" class="close directChatClose" data-toggle="collapse" data-target="#directChatCollapse" aria-label="Close">
	          <span aria-hidden="true">×</span>
	        </button></div><hr><div class="messages">';
	  



	   echo    '</div><div class="form-group chat-plate">
                      <textarea class="form-control chatContent" placeholder="Send '.$user['firstname'].' a chat..." id="exampleFormControlTextarea1" rows="1"></textarea>
                      <button class="btn sendChatBtn btn-success" data-userId="'.mysqli_real_escape_string($link, $_POST['userId']).'">Send</button>
                    </div>
                  </div>
                </div>'; 

	}



	if ($_GET['action'] == 'refreshChat') {

		$chatQuery = "SELECT * FROM `chat` WHERE (`senderid` = ".mysqli_real_escape_string($link, $_POST['userId'])." AND `recipientid` = ".mysqli_real_escape_string($link, $_SESSION['id']).") OR (`senderid` = ".mysqli_real_escape_string($link, $_SESSION['id'])." AND `recipientid` = ".mysqli_real_escape_string($link, $_POST['userId']).") ORDER BY `datetime` ASC";
       $chatQueryResult = mysqli_query($link, $chatQuery);

       $userQuery = "SELECT * FROM `users` WHERE `id` = ".mysqli_real_escape_string($link, $_POST['userId'])." LIMIT 1";
       $userQueryResult = mysqli_query($link, $userQuery);
       $user = mysqli_fetch_assoc($userQueryResult);


        while ($chat = mysqli_fetch_assoc($chatQueryResult)) {

      	 if ($chat['senderid'] == mysqli_real_escape_string($link, $_SESSION['id'])) {

              echo   '<div class="alert your-chat alert-success"><p>'.$chat['message'].'</p><span class = "your-chat-time">'.time_since(time() - strtotime($chat['datetime'])).' ago</span></div>';

            } else if ($chat['senderid'] == mysqli_real_escape_string($link, $_POST['userId'])) {

               echo   '<div class="alert their-chat alert-secondary"><p>'.$chat['message'].'</p><span class = "their-chat-time">'.time_since(time() - strtotime($chat['datetime'])).' ago</span></div>';

            }
		
	  }

	  unset($_POST['userId']);


	}


	if ($_GET['action'] == 'refreshYourChats') {



			 $allChatsQuery = "SELECT * FROM `chat` WHERE `senderid` = ".mysqli_real_escape_string($link, $_SESSION['id'])." OR `recipientid` = ".mysqli_real_escape_string($link, $_SESSION['id'])." ORDER BY `datetime` ASC";
		     $allChatsQueryResult = mysqli_query($link, $allChatsQuery); 

		      if (mysqli_num_rows($allChatsQueryResult) == 0) {

		       echo  '<div class="list-group-item flex-column align-items-start">
		                     
		                      <p class="mb-1">It doesn\'t look like you\'ve talked to anyone. Try messaging someone to see the conversation here.</p>
		                     
		                    </div>';

		    } else if (mysqli_num_rows($allChatsQueryResult) > 0) {

		      $allChatsArray = array();

		      $senders = array();

		      while ($allChats = mysqli_fetch_assoc($allChatsQueryResult)) {

		        array_push($allChatsArray, $allChats['recipientid']);
		        array_push($senders, $allChats['senderid']);

		      }

		    

		      $unique_recipients = array_unique($allChatsArray);

		     $listed = array();

		      $unique_senders = array_unique($senders);

		     foreach ($unique_recipients as $r) {

		      if ($r != mysqli_real_escape_string($link, $_SESSION['id'])) {
		      
		       $recipientQuery = "SELECT * FROM `users` WHERE `id` = ".$r." LIMIT 1";
		       $recipientQueryResult = mysqli_query($link, $recipientQuery);
		       $recipient = mysqli_fetch_assoc($recipientQueryResult);

		       $lastChatQuery = "SELECT * FROM `chat` WHERE (`senderid` = ".$r." AND `recipientid` = ".mysqli_real_escape_string($link, $_SESSION['id']).") OR (`senderid` = ".mysqli_real_escape_string($link, $_SESSION['id'])." AND `recipientid` = ".$r.") ORDER BY `datetime` DESC LIMIT 1";
		       $lastChatQueryResult = mysqli_query($link, $lastChatQuery);
		       $lastChat = mysqli_fetch_assoc($lastChatQueryResult);

		       echo '<a class="openChat list-group-item list-group-item-action flex-column align-items-start" data-userId="'.$r.'" data-toggle="collapse" data-target="#directChatCollapse">
		          <div class="d-flex w-100 justify-content-between">
		            <h5 class="mb-1">'.$recipient['firstname'].' '.$recipient['lastname'].'</h5>
		             <small>'.time_since(time() - strtotime($lastChat['datetime'])).'</small>
		          </div>

		          <p class="mb-1">'.substr($lastChat['message'], 0, 40).'...</p>
		        </a>';

		   
		     

		        array_push($listed, $r);

		      } else if ($r == mysqli_real_escape_string($link, $_SESSION['id'])) {

		         $senderQuery = "SELECT `senderid` FROM `chat` WHERE `recipientid` = ".$r."";
		         $senderQueryResult = mysqli_query($link, $senderQuery);
		         $sender = mysqli_fetch_assoc($senderQueryResult);

		        foreach ($sender as $z) {
		         array_push($senders, $z);
		        }

		      }


		    }
		    

		    foreach ($unique_senders as $s) {

		      if ($s != mysqli_real_escape_string($link, $_SESSION['id']) && !in_array($s, $listed)) {

		        $whoDatQuery = "SELECT * FROM `users` WHERE `id` = ".$s." LIMIT 1";
		        $whoDatQueryResult = mysqli_query($link, $whoDatQuery);
		        $whoDat = mysqli_fetch_assoc($whoDatQueryResult);

		       $lastChatQuery = "SELECT * FROM `chat` WHERE (`senderid` = ".$s." AND `recipientid` = ".mysqli_real_escape_string($link, $_SESSION['id']).") OR (`senderid` = ".mysqli_real_escape_string($link, $_SESSION['id'])." AND `recipientid` = ".$s.") ORDER BY `datetime` DESC LIMIT 1";
		       $lastChatQueryResult = mysqli_query($link, $lastChatQuery);
		       $lastChat = mysqli_fetch_assoc($lastChatQueryResult);

			        echo '<a class="openChat list-group-item list-group-item-action flex-column align-items-start" data-userId="'.$s.'" data-toggle="collapse" data-target="#directChatCollapse">
			          <div class="d-flex w-100 justify-content-between">
			            <h5 class="mb-1">'.$whoDat['firstname'].' '.$whoDat['lastname'].'</h5>
			             <small>'.time_since(time() - strtotime($lastChat['datetime'])).'</small>
			          </div>

			          <p class="mb-1">'.substr($lastChat['message'], 0, 20).'...</p>
			        </a>';

		 

		      }


		    } 

		     

		 }  

	}


	if ($_GET['action'] == 'refreshPosts') {


		if (mysqli_real_escape_string($link, $_POST['type']) == 'public') {

    		$whereClause = "";

    	} else if (mysqli_real_escape_string($link, $_POST['type']) == 'timeline') {

            $query = "SELECT * FROM isFollowing WHERE follower = ".mysqli_real_escape_string($link, $_SESSION['id']);

            $result = mysqli_query($link, $query);

            $whereClause = "";

            while ($row = mysqli_fetch_assoc($result)) {

                if ($whereClause == "") {

                     $whereClause = "WHERE";

                } else {

                      $whereClause .= " OR";

                }

                 $whereClause .= " userid = ".$row['isFollowing'];



          }

        } else if (mysqli_real_escape_string($link, $_POST['type']) == 'yourprofile') {

              $whereClause .= "WHERE userid = ".mysqli_real_escape_string($link, $_SESSION['id']);


        } else if (mysqli_real_escape_string($link, $_POST['type']) == 'publicprofiles') {

            $userQuery = "SELECT * FROM `users` WHERE `id` = ".mysqli_real_escape_string($link, $_POST['userid'])." LIMIT 1";
            $userQueryResult = mysqli_query($link, $userQuery);
            $user = mysqli_fetch_assoc($userQueryResult);

            echo "<h2 class='page-header'>".mysqli_real_escape_string($link, $user['firstname'])."'s Posts</h2>";

            $whereClause .= "WHERE userid = ".mysqli_real_escape_string($link, $_POST['userid']);

        }

    	$query = "SELECT * FROM tweets ".$whereClause." ORDER BY `datetime` DESC LIMIT 10";

    	$result = mysqli_query($link, $query);

    	if(mysqli_num_rows($result) == 0)  {

    		echo "There are no posts to display.";

    	} else {

            echo "<div class='alert alert-success' id='postDeleteSuccess'>Your post has been deleted!</div>";

            echo "<div class='alert alert-danger' id='postDeleteFail'>Your post could not be deleted. Please try again Later.</div>";

    		while ($row = mysqli_fetch_assoc($result)) {

    			$userQuery = "SELECT * FROM `users` WHERE `id` = ".mysqli_real_escape_string($link, $row['userid'])." LIMIT 1";
    			$userQueryResult = mysqli_query($link, $userQuery);
    			$user = mysqli_fetch_assoc($userQueryResult);

                echo "<li class='tweet list-group-item'><p><a href='?page=publicprofiles&userid=".$user['id']."'><strong>".$user['firstname']." ".$user['lastname']."</strong><span class='handle'> (".$user['email'].") </span></a><span class = 'time'> ".time_since(time() - strtotime($row['datetime']))." ago</span>".":</p>";

    			echo "<p>".$row['tweet']."</p>";

    			if ($_SESSION['id'] != $row['userid']) {

                echo "<p> <button class='toggleFollow btn btn-success' data-userId='".$row['userid']."'>";

            	}

                $isFollowingQuery = "SELECT * FROM isFollowing WHERE follower = '".mysqli_real_escape_string($link, $_SESSION['id'])."' AND isFollowing = ".mysqli_real_escape_string($link, $row['userid'])." LIMIT 1";
                $isFollowingQueryResult = mysqli_query($link, $isFollowingQuery);

                if ($_SESSION['id'] != $row['userid']) {

	                if (mysqli_num_rows($isFollowingQueryResult) > 0) {

	                    echo "Unfollow";

	                } else {

	                    echo "Follow";

	                }

         	   

                echo "</button>";

              }

                if ($_SESSION['id'] == $row['userid']) {

                  echo "<a class='deletePostLink' href='javascript:;' data-postId='".$row['id']."' >Delete Post</a>";

                }

                echo "</p></li>";
    		}

    	}




	}

	


	

?>