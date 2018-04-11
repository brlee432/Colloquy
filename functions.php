<?php

	session_start();

	//database keys here

	 if (mysqli_connect_errno()) {

      print_r(mysqli_connect_error());
      exit();

    } 

    if($_GET['function'] == "logout") {

    	session_unset();

    }


    function time_since($since) {
        $chunks = array(
            array(60 * 60 * 24 * 365 , 'year'),
            array(60 * 60 * 24 * 30 , 'month'),
            array(60 * 60 * 24 * 7, 'week'),
            array(60 * 60 * 24 , 'day'),
            array(60 * 60 , 'hour'),
            array(60 , 'min'),
            array(1 , 'sec')
        );

        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];
            if (($count = floor($since / $seconds)) != 0) {
                break;
            }
        }

        $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
        return $print;
    }

    function displayTweets($type) {

    	global $link;

    	if ($type == 'public') {

    		$whereClause = "";

    	} else if ($type == 'isFollowing') {

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

        } else if ($type == 'yourposts') {

              $whereClause .= "WHERE userid = ".mysqli_real_escape_string($link, $_SESSION['id']);

        } else if ($type == 'search') {

             echo '<p class="page-header">Showing results for "'.mysqli_real_escape_string($link, $_GET['q']).'": </p>';

              $whereClause .= "WHERE tweet LIKE '%".mysqli_real_escape_string($link, $_GET['q'])."%'";

        } else if (is_numeric($type)) {

            $userQuery = "SELECT * FROM `users` WHERE `id` = ".mysqli_real_escape_string($link, $type)." LIMIT 1";
            $userQueryResult = mysqli_query($link, $userQuery);
            $user = mysqli_fetch_assoc($userQueryResult);

            echo "<h2 class='page-header'>".mysqli_real_escape_string($link, $user['firstname'])."'s Posts</h2>";

            $whereClause .= "WHERE userid = ".mysqli_real_escape_string($link, $type);

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

    function displaySearch() {

        echo '<form class="form-inline">
                <div class="form-group">
                    <input type="hidden" name="page" value="search">
                    <input type="text" name="q" class="form-control" id="search" placeholder="Search...">
                </div>
                <button type="submit"  class="btn btn-success">Search Posts</button>
             </form>';


    }

    function displayTweetBox() {

        if ($_SESSION['id'] > 0) {

            echo '<div id="postSuccess" class="alert alert-success">Your post has been made successfully!</div>
                <div id="postFailure" class="alert alert-danger"></div>
                <div>
                    <div class="form-group">
                       <textarea class="form-control" id="postContent"></textarea>
                    </div>
                    <button id="postButton" class="btn btn-success">Make Post</button>
                </div>';

        }


    }

    function displayUsers() {

        global $link;

        $query = "SELECT * FROM users LIMIT 20";

        $result = mysqli_query($link, $query);

       if(mysqli_num_rows($result) == 0)  {

            echo "<p>Sorry, there doesn't seem to be any record of that. Try searching with a <strong>first OR last name</strong>.</p>";

        } else if (mysqli_num_rows($result) != 0) {


               while ($row = mysqli_fetch_assoc($result)) {

                   $userQuery = "SELECT * FROM `users` WHERE `id` = ".mysqli_real_escape_string($link, $row['id'])." LIMIT 1";
                   $userQueryResult = mysqli_query($link, $userQuery);   

                     while ($user = mysqli_fetch_assoc($userQueryResult)) {

                          $profilePicQuery = "SELECT * FROM `userImages` WHERE `userid` = '".mysqli_real_escape_string($link, $row['id'])."' AND `profilepic` = '1'";
                          $profilePicQueryResult = mysqli_query($link, $profilePicQuery);
                          $profilePic = mysqli_fetch_assoc($profilePicQueryResult);

                                if ($user['id'] == $_SESSION['id'] && !$profilePic) {

                                  echo '<li class="list-group-item chatUser"><a href="?page=publicprofiles&userid='.$user['id'].'"><img src="uploads/default.jpg" alt="Uploaded Picture" class="followPic listPic rounded"><strong>'.$user['firstname'].' '.$user['lastname'].'</strong> (You)</a></li>';

                                } else if ($user['id'] == $_SESSION['id'] && $profilePic) {

                                  echo '<li class="list-group-item chatUser"><a href="?page=publicprofiles&userid='.$user['id'].'"><img src="uploads/'.$profilePic['image'].'" alt="Uploaded Picture" class="followPic listPic rounded"><strong>'.$user['firstname'].' '.$user['lastname'].'</strong></a> (You)</li>';  

                                } else if ($user && !$profilePic) {
                                                                  
                                  echo '<li class="list-group-item chatUser"><a href="?page=publicprofiles&userid='.$user['id'].'"><img src="uploads/default.jpg" alt="Uploaded Picture" class="followPic listPic rounded"><strong>'.$user['firstname'].' '.$user['lastname'].'</strong></a><button class="directChatBtn btn nonProfileChat btn-outline-success" data-userId="'.$user['id'].'" type="button" data-toggle="collapse" data-target="#directChatCollapse">Chat</button></li>';

                                } else {
                                
                                  echo '<li class="list-group-item chatUser"><a href="?page=publicprofiles&userid='.$user['id'].'"><img src="uploads/'.$profilePic['image'].'" alt="Uploaded Picture" class="followPic listPic rounded"><strong>'.$user['firstname'].' '.$user['lastname'].'</strong></a><button class="directChatBtn nonProfileChat btn btn-outline-success" data-userId="'.$user['id'].'" type="button" data-toggle="collapse" data-target="#directChatCollapse">Chat</button></li>';

                                }         
          
                      }   
                  
              }          

        }

    }

    

    function displayCurrentUser() {

        global $link;

         $userQuery = "SELECT * FROM `users` WHERE `id` = ".mysqli_real_escape_string($link, $_SESSION['id'])." LIMIT 1";
         $userQueryResult = mysqli_query($link, $userQuery);
         $user = mysqli_fetch_assoc($userQueryResult);

         echo "<span>Howdy, ".$user['firstname']."?</span>";


    }


    function displayProfile($type) {


    	global $link;

        if ($type == 'yourprofile') {

        	$userQuery = "SELECT * FROM `users` WHERE `id` = ".mysqli_real_escape_string($link, $_SESSION['id'])." LIMIT 1";
            $userQueryResult = mysqli_query($link, $userQuery);
            $user = mysqli_fetch_assoc($userQueryResult);

        } else {

           $userQuery = "SELECT * FROM `users` WHERE `id` = ".mysqli_real_escape_string($link, $_GET['userid'])." LIMIT 1";
           $userQueryResult = mysqli_query($link, $userQuery);
           $user = mysqli_fetch_assoc($userQueryResult);

        }
        
         $profilePicQuery = "SELECT * FROM `userImages` WHERE `userid` = '".mysqli_real_escape_string($link, $user['id'])."' AND `profilepic` = '1' ";
         $profilePicQueryResult = mysqli_query($link, $profilePicQuery);
         $profilePic = mysqli_fetch_assoc($profilePicQueryResult);

                if ($_SESSION['id'] == $user['id']) {

                    echo "<h1 class='page-header'>".mysqli_real_escape_string($link, $user['firstname'])." ".mysqli_real_escape_string($link, $user['lastname'])."'s Profile</h1>";

                    if ($profilePic['image'] != "") {

                        echo '<div class="card-deck">
                            <div class="card" style="width: 20rem;">
                              <img class="card-img-top" src="uploads/'.mysqli_real_escape_string($link, $profilePic['image']).'" alt="Card image cap">
                              <div class="card-body">
                                <h4 class="card-title">About '.mysqli_real_escape_string($link, $user['firstname']).'</h4>
                                <p class="card-text">'.mysqli_real_escape_string($link, $user['bio']).'</p>
                                <a href="javascript:;" class="showUploadForm" data-toggle="modal" data-target="#updateProfileModal">Update Profile</a>
                              </div>
                            </div>
                            </div>';

                    } else {

                         echo '<div class="card-deck">
                         <div class="card" style="width: 20rem;">
                          <img class="card-img-top" src="uploads/default.jpg" alt="Card image cap">
                          <div class="card-body">
                            <h4 class="card-title">About '.mysqli_real_escape_string($link, $user['firstname']).'</h4>
                            <p class="card-text">'.mysqli_real_escape_string($link, $user['bio']).'</p>
                            <a href="javascript:;" class="showUploadForm" data-toggle="modal" data-target="#updateProfileModal">Update Profile</a>
                          </div>
                        </div>
                        </div>';


                    }

                } else {

                    echo "<h1 class='page-header'>".mysqli_real_escape_string($link, $user['firstname'])." ".mysqli_real_escape_string($link, $user['lastname'])."'s Profile</h1>";

                    if ($profilePic['image'] != "") {

                        echo '<div class="card-deck">
                            <div class="card" style="width: 20rem;">
                                <img class="card-img-top" src="uploads/'.mysqli_real_escape_string($link, $profilePic['image']).'" alt="Card image cap">
                                 <div class="card-body">
                                   <h4 class="card-title">About '.mysqli_real_escape_string($link, $user['firstname']).'</h4>
                                   <p class="card-text">'.mysqli_real_escape_string($link, $user['bio']).'</p>
                                   <p><button class="directChatBtn btn btn-outline-success" data-userId="'.$user['id'].'" type="button" data-toggle="collapse" data-target="#directChatCollapse">Chat</button></p>
                                   <p><button class="toggleFollow btn btn-success" data-userId="'.$user['id'].'">';
                    } else {

                         echo ' <div class="card-deck">
                             <div class="card" style="width: 20rem;">
                                <img class="card-img-top" src="uploads/default.jpg" alt="Card image cap">
                                 <div class="card-body">
                                   <h4 class="card-title">About '.mysqli_real_escape_string($link, $user['firstname']).'</h4>
                                   <p class="card-text">'.mysqli_real_escape_string($link, $user['bio']).'</p>
                                   <p><button class="directChatBtn btn btn-outline-success" data-userId="'.$user['id'].'" type="button" data-toggle="collapse" data-target="#directChatCollapse">Chat</button></p>
                                   <p> <button class="toggleFollow btn btn-success" data-userId="'.$user['id'].'">';

                    }

                    $isFollowingQuery = "SELECT * FROM isFollowing WHERE follower = '".mysqli_real_escape_string($link, $_SESSION['id'])."' AND isFollowing = ".mysqli_real_escape_string($link, $user['id'])." LIMIT 1";
                    $isFollowingQueryResult = mysqli_query($link, $isFollowingQuery);

                        if (mysqli_num_rows($isFollowingQueryResult) > 0) {

                            echo "Unfollow";

                        } else {

                            echo "Follow";

                        }
   

                    echo "  </button>
                           </p>
                          </div>
                        </div>
                        </div>";


                }
     

    }

    function displayUploadedPics($number) {

        global $link;

      
        if ($number == 'limited') { 

            $limitClause = "LIMIT 8";

        } else {

            $limitClause = "";

        }

        $userQuery = "SELECT * FROM `users` WHERE `id` = ".mysqli_real_escape_string($link, $_SESSION['id'])." LIMIT 1";
        $userQueryResult = mysqli_query($link, $userQuery);
        $user = mysqli_fetch_assoc($userQueryResult);

        $imageQuery = "SELECT * FROM `userImages` WHERE `userid` = '".mysqli_real_escape_string($link, $user['id'])."' ORDER BY `datetime` DESC ".$limitClause."";
        $imageQueryResult = mysqli_query($link, $imageQuery);

         
        

        while ($image = mysqli_fetch_assoc($imageQueryResult)) {

            echo '<img src="uploads/'.$image['image'].'" data-imageId="'.$image['id'].'" alt="Uploaded Picture" class="uploadedPic rounded"></a>';

        }

    }


    function displayFollowing($type) {

        global $link;

        if ($type == 'yourprofile') {

            $isFollowingQuery = "SELECT * FROM isFollowing WHERE follower = '".mysqli_real_escape_string($link, $_SESSION['id'])."' LIMIT 6";
            $isFollowingQueryResult = mysqli_query($link, $isFollowingQuery);

        } else {

           $isFollowingQuery = "SELECT * FROM isFollowing WHERE follower = '".mysqli_real_escape_string($link, $_GET['userid'])."' LIMIT 6";
           $isFollowingQueryResult = mysqli_query($link, $isFollowingQuery);

        }

        if(mysqli_num_rows($isFollowingQueryResult) == 0)  {

          if ($_GET['userid']) {

             $query= "SELECT * FROM `users` WHERE `id` = ".mysqli_real_escape_string($link, $_GET['userid'])." LIMIT 1";
             $queryResult = mysqli_query($link, $query);
             $name = mysqli_fetch_assoc($queryResult);

            echo "<p>It doesn't look like ".$name['firstname']." follows anyone.</p>";

          } else {

            echo "<p>It doesn't look like you're following anyone.</p>";

          }

        } else if (mysqli_num_rows($isFollowingQueryResult) != 0) {

               while ($row = mysqli_fetch_assoc($isFollowingQueryResult)) {

                   $userQuery = "SELECT * FROM `users` WHERE `id` = ".mysqli_real_escape_string($link, $row['isFollowing'])." LIMIT 1";
                   $userQueryResult = mysqli_query($link, $userQuery);   

                     while ($user = mysqli_fetch_assoc($userQueryResult)) {

                          $profilePicQuery = "SELECT * FROM `userImages` WHERE `userid` = '".mysqli_real_escape_string($link, $row['isFollowing'])."' AND `profilepic` = '1'";
                          $profilePicQueryResult = mysqli_query($link, $profilePicQuery);
                          $profilePic = mysqli_fetch_assoc($profilePicQueryResult);

                                 if($user && !$profilePic) {
                                
                                  echo '<a href="?page=publicprofiles&userid='.$user['id'].'"><img src="uploads/default.jpg" alt="Uploaded Picture" class="followPic rounded"></a>';

                                } else {


                                  echo '<a href="?page=publicprofiles&userid='.$profilePic['userid'].'"><img src="uploads/'.$profilePic['image'].'" alt="Uploaded Picture" class="followPic rounded"></a>';

                                }         
          
                      }   
                  
              }          

        }

    }

    function displayAllFollowing($type) {

        global $link;

        if ($type == 'yourprofile') {

            $isFollowingQuery = "SELECT * FROM isFollowing WHERE follower = '".mysqli_real_escape_string($link, $_SESSION['id'])."'";
            $isFollowingQueryResult = mysqli_query($link, $isFollowingQuery);

        } else {

           $isFollowingQuery = "SELECT * FROM isFollowing WHERE follower = '".mysqli_real_escape_string($link, $_GET['userid'])."'";
           $isFollowingQueryResult = mysqli_query($link, $isFollowingQuery);

        }

        if(mysqli_num_rows($isFollowingQueryResult) == 0)  {

             if ($_GET['userid']) {

             $query= "SELECT * FROM `users` WHERE `id` = ".mysqli_real_escape_string($link, $_GET['userid'])." LIMIT 1";
             $queryResult = mysqli_query($link, $query);
             $name = mysqli_fetch_assoc($queryResult);

            echo "<p>It doesn't look like ".$name['firstname']." follows anyone.</p>";

          } else {

            echo "<p>It doesn't look like you're following anyone.</p>";

          }

        } else if (mysqli_num_rows($isFollowingQueryResult) != 0) {

               while ($row = mysqli_fetch_assoc($isFollowingQueryResult)) {

                   $userQuery = "SELECT * FROM `users` WHERE `id` = ".mysqli_real_escape_string($link, $row['isFollowing'])." LIMIT 1";
                   $userQueryResult = mysqli_query($link, $userQuery);   

                     while ($user = mysqli_fetch_assoc($userQueryResult)) {

                          $profilePicQuery = "SELECT * FROM `userImages` WHERE `userid` = '".mysqli_real_escape_string($link, $row['isFollowing'])."' AND `profilepic` = '1'";
                          $profilePicQueryResult = mysqli_query($link, $profilePicQuery);
                          $profilePic = mysqli_fetch_assoc($profilePicQueryResult);

                                 if($user && !$profilePic) {
                                                                  
                                  echo '<li class="list-group-item"><a href="?page=publicprofiles&userid='.$user['id'].'"><img src="uploads/default.jpg" alt="Uploaded Picture" class="followPic listPic rounded"><strong>'.$user['firstname'].' '.$user['lastname'].'</strong></a><button class="directChatBtn nonProfileChat btn btn-outline-success" data-userId="'.$user['id'].'" type="button" data-toggle="collapse" data-target="#directChatCollapse">Chat</button></li>';

                                } else {
                                
                                  echo '<li class="list-group-item"><a href="?page=publicprofiles&userid='.$user['id'].'"><img src="uploads/'.$profilePic['image'].'" alt="Uploaded Picture" class="followPic listPic rounded"><strong>'.$user['firstname'].' '.$user['lastname'].'</strong></a><button class="directChatBtn nonProfileChat btn btn-outline-success" data-userId="'.$user['id'].'" type="button" data-toggle="collapse" data-target="#directChatCollapse">Chat</button></li>';

                                }         
          
                      }   
                  
              }          

        }

    }

    

    function displayFollowers($type) {

      global $link;

        if ($type == 'yourprofile') {

            $followerQuery = "SELECT * FROM isFollowing WHERE isFollowing = '".mysqli_real_escape_string($link, $_SESSION['id'])."' LIMIT 6";
            $followerQueryResult = mysqli_query($link, $followerQuery);

        } else {

           $followerQuery = "SELECT * FROM isFollowing WHERE isFollowing = '".mysqli_real_escape_string($link, $_GET['userid'])."' LIMIT 6";
           $followerQueryResult = mysqli_query($link, $followerQuery);

        }

        if(mysqli_num_rows($followerQueryResult) == 0)  {

             if ($_GET['userid']) {

             $query= "SELECT * FROM `users` WHERE `id` = ".mysqli_real_escape_string($link, $_GET['userid'])." LIMIT 1";
             $queryResult = mysqli_query($link, $query);
             $name = mysqli_fetch_assoc($queryResult);

            echo "<p>It doesn't look like anyone follows ".$name['firstname'].".</p>";

          } else {

            echo "<p>It doesn't look like anyone follows you.</p>";

          }

        } else if (mysqli_num_rows($followerQueryResult) != 0) {

              while ($row = mysqli_fetch_assoc($followerQueryResult)) {

                   $userQuery = "SELECT * FROM `users` WHERE `id` = ".mysqli_real_escape_string($link, $row['follower'])." LIMIT 1";
                   $userQueryResult = mysqli_query($link, $userQuery);   

                   while ($user = mysqli_fetch_assoc($userQueryResult)) {

                        $profilePicQuery = "SELECT * FROM `userImages` WHERE `userid` = '".mysqli_real_escape_string($link, $row['follower'])."' AND `profilepic` = '1'";
                        $profilePicQueryResult = mysqli_query($link, $profilePicQuery);
                        $profilePic = mysqli_fetch_assoc($profilePicQueryResult);

                               if($user && !$profilePic) {
                              
                                echo '<a href="?page=publicprofiles&userid='.$user['id'].'"><img src="uploads/default.jpg" alt="Uploaded Picture" class="followPic rounded"></a>';

                              } else {


                                echo '<a href="?page=publicprofiles&userid='.$profilePic['userid'].'"><img src="uploads/'.$profilePic['image'].'" alt="Uploaded Picture" class="followPic rounded"></a>';

                              }
         
                    }

              }    

        }

    }



    function displayAllFollowers($type) {

        global $link;

        if ($type == 'yourprofile') {

            $followerQuery = "SELECT * FROM isFollowing WHERE isFollowing = '".mysqli_real_escape_string($link, $_SESSION['id'])."'";
            $followerQueryResult = mysqli_query($link, $followerQuery);

        } else {

           $followerQuery = "SELECT * FROM isFollowing WHERE isFollowing = '".mysqli_real_escape_string($link, $_GET['userid'])."'";
           $followerQueryResult = mysqli_query($link, $followerQuery);

        }

        if(mysqli_num_rows($followerQueryResult) == 0)  {

             if ($_GET['userid']) {

             $query= "SELECT * FROM `users` WHERE `id` = ".mysqli_real_escape_string($link, $_GET['userid'])." LIMIT 1";
             $queryResult = mysqli_query($link, $query);
             $name = mysqli_fetch_assoc($queryResult);

            echo "<p>It doesn't look like anyone follows ".$name['firstname'].".</p>";

          } else {

            echo "<p>It doesn't look like anyone follows you.</p>";

          }

        } else if (mysqli_num_rows($followerQueryResult) != 0) {

               while ($row = mysqli_fetch_assoc($followerQueryResult)) {

                   $userQuery = "SELECT * FROM `users` WHERE `id` = ".mysqli_real_escape_string($link, $row['follower'])." LIMIT 1";
                   $userQueryResult = mysqli_query($link, $userQuery);   

                     while ($user = mysqli_fetch_assoc($userQueryResult)) {

                          $profilePicQuery = "SELECT * FROM `userImages` WHERE `userid` = '".mysqli_real_escape_string($link, $row['follower'])."' AND `profilepic` = '1'";
                          $profilePicQueryResult = mysqli_query($link, $profilePicQuery);
                          $profilePic = mysqli_fetch_assoc($profilePicQueryResult);

                                 if($user && !$profilePic) {
                                                                  
                                  echo '<li class="list-group-item"><a href="?page=publicprofiles&userid='.$user['id'].'"><img src="uploads/default.jpg" alt="Uploaded Picture" class="followPic listPic rounded"><strong>'.$user['firstname'].' '.$user['lastname'].'</strong></a><button class="directChatBtn nonProfileChat btn btn-outline-success" data-userId="'.$user['id'].'" type="button" data-toggle="collapse" data-target="#directChatCollapse">Chat</button></li>';

                                } else {
                                
                                  echo '<li class="list-group-item"><a href="?page=publicprofiles&userid='.$user['id'].'"><img src="uploads/'.$profilePic['image'].'" alt="Uploaded Picture" class="followPic listPic rounded"><strong>'.$user['firstname'].' '.$user['lastname'].'</strong></a><button class="directChatBtn nonProfileChat btn btn-outline-success" data-userId="'.$user['id'].'" type="button" data-toggle="collapse" data-target="#directChatCollapse">Chat</button></li>';

                                }         
          
                      }   
                  
              }          

        }

    }



    function countFollowing($type) {

       global $link;

       if ($type == 'yourprofile') {

          $isFollowingQuery = "SELECT * FROM isFollowing WHERE follower = '".mysqli_real_escape_string($link, $_SESSION['id'])."'";
          $isFollowingQueryResult = mysqli_query($link, $isFollowingQuery);
          $count = mysqli_num_rows($isFollowingQueryResult);

            echo '<a href="javascript:;" class="followCount" data-toggle="modal" data-target="#allFollowingModal"> (See All '.$count.')</a>';


       } else {

          $isFollowingQuery = "SELECT * FROM isFollowing WHERE follower = '".mysqli_real_escape_string($link, $_GET['userid'])."'";
          $isFollowingQueryResult = mysqli_query($link, $isFollowingQuery);
          $count = mysqli_num_rows($isFollowingQueryResult);

            echo '<a href="javascript:;" class="followCount" data-toggle="modal" data-target="#allFollowingModal"> (See All '.$count.')</a>';


       }


    }


    function countFollowers($type) {

       global $link;

       if ($type == 'yourprofile') {

          $followerQuery = "SELECT * FROM isFollowing WHERE isFollowing = '".mysqli_real_escape_string($link, $_SESSION['id'])."'";
          $followerQueryResult = mysqli_query($link, $followerQuery);
          $count = mysqli_num_rows($followerQueryResult);

            echo '<a href="javascript:;" class="followCount" data-toggle="modal" data-target="#allFollowersModal"> (See All '.$count.')</a>';
          

       } else {

          $followerQuery = "SELECT * FROM isFollowing WHERE isFollowing = '".mysqli_real_escape_string($link, $_GET['userid'])."'";
          $followerQueryResult = mysqli_query($link, $followerQuery);
          $count = mysqli_num_rows($followerQueryResult);

            echo '<a href="javascript:;" class="followCount" data-toggle="modal" data-target="#allFollowersModal"> (See All '.$count.')</a>';
          
       }


    }


    function displayOtherUser() {

        global $link;

        $userQuery = "SELECT * FROM `users` WHERE `id` = ".mysqli_real_escape_string($link, $_GET['userid'])." LIMIT 1";
        $userQueryResult = mysqli_query($link, $userQuery);
        $user = mysqli_fetch_assoc($userQueryResult);

        echo $user['firstname'];

    }


    function displayLoggedInUsers() {

      

         

    }
    

    function displayChat() {


     echo '<button id="yourChatsBtn" type="button" class="btn btn-outline-success"> Your Chats </button>
           <div class="collapse" id="yourChatsCollapse">
              <div class="card card-body">
                  <div class="list-group-flush chatsRefresh">';
    


       echo  '<div class="list-group-item flex-column align-items-start">
                     
                      <p class="mb-1">It doesn\'t look like you\'ve talked to anyone. Try messaging someone to see the conversation here.</p>
                     
                    </div>';


                    
     echo '</div>
         </div>
      </div>';
   
              
          echo '<div class="collapse" id="directChatCollapse"> 


                  <div class="card card-body" id="chatWindow">
                <div class="name-plate">  <span class="page-header">Chatting with '.$user['firstname'].' '.$user['lastname'].'</span>
                   <button type="button" class="close directChatClose" data-toggle="collapse" data-target="#directChatCollapse" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button> </div><div class="messages">
                  ';

        
            
        

         echo      '</div>
                      <div class="form-group chat-plate">
                      <textarea class="form-control chatContent" placeholder="Send '.$user['firstname'].' a chat..." id="exampleFormControlTextarea1" rows="1"></textarea>
                      <button data-userId="'.$user['id'].'" class="btn sendChatBtn btn-success">Send</button>
                    </div>
                  </div>
                </div>'; 

        

       

    }

    function displayChatQuery() {

      global $link;

       echo '<p class="page-header">Showing results for "'.mysqli_real_escape_string($link, $_GET['c']).'": </p>';

       if (mysqli_real_escape_string($link, $_GET['c']) == "") {


            echo "<p> No results. Please enter a valid search and try again.";

       } else {

       $chatQuery = "SELECT * FROM `users` WHERE (`firstname` LIKE '%".mysqli_real_escape_string($link, $_GET['c'])."%' OR `lastname` LIKE '%".mysqli_real_escape_string($link, $_GET['c'])."%')";
       $chatQueryResult = mysqli_query($link, $chatQuery);

       if(mysqli_num_rows($chatQueryResult) == 0)  {

            echo "<p>Sorry, there doesn't seem to be any record of that. Try searching with a <strong>first OR last name</strong>.</p>";

        } else if (mysqli_num_rows($chatQueryResult) != 0) {


               while ($row = mysqli_fetch_assoc($chatQueryResult)) {

                   $userQuery = "SELECT * FROM `users` WHERE `id` = ".mysqli_real_escape_string($link, $row['id'])." LIMIT 1";
                   $userQueryResult = mysqli_query($link, $userQuery);   

                     while ($user = mysqli_fetch_assoc($userQueryResult)) {

                          $profilePicQuery = "SELECT * FROM `userImages` WHERE `userid` = '".mysqli_real_escape_string($link, $row['id'])."' AND `profilepic` = '1'";
                          $profilePicQueryResult = mysqli_query($link, $profilePicQuery);
                          $profilePic = mysqli_fetch_assoc($profilePicQueryResult);
                                        
                                if ($user['id'] == $_SESSION['id'] && !$profilePic) {

                                  echo '<li class="list-group-item chatUser"><a href="?page=publicprofiles&userid='.$user['id'].'"><img src="uploads/default.jpg" alt="Uploaded Picture" class="followPic listPic rounded"><strong>'.$user['firstname'].' '.$user['lastname'].'</strong> (You)</a></li>';

                                } else if ($user['id'] == $_SESSION['id'] && $profilePic) {

                                  echo '<li class="list-group-item chatUser"><a href="?page=publicprofiles&userid='.$user['id'].'"><img src="uploads/'.$profilePic['image'].'" alt="Uploaded Picture" class="followPic listPic rounded"><strong>'.$user['firstname'].' '.$user['lastname'].'</strong></a> (You)</li>';  

                                } else if ($user && !$profilePic) {
                                                                  
                                  echo '<li class="list-group-item chatUser"><a href="?page=publicprofiles&userid='.$user['id'].'"><img src="uploads/default.jpg" alt="Uploaded Picture" class="followPic listPic rounded"><strong>'.$user['firstname'].' '.$user['lastname'].'</strong></a><button class="directChatBtn btn nonProfileChat btn-outline-success" data-userId="'.$user['id'].'" type="button" data-toggle="collapse" data-target="#directChatCollapse">Chat</button></li>';

                                } else {
                                
                                  echo '<li class="list-group-item chatUser"><a href="?page=publicprofiles&userid='.$user['id'].'"><img src="uploads/'.$profilePic['image'].'" alt="Uploaded Picture" class="followPic listPic rounded"><strong>'.$user['firstname'].' '.$user['lastname'].'</strong></a><button class="directChatBtn nonProfileChat btn btn-outline-success" data-userId="'.$user['id'].'" type="button" data-toggle="collapse" data-target="#directChatCollapse">Chat</button></li>';

                                }       
          
                      }   
                  
              }          

        }

      }

    } 
  

?>