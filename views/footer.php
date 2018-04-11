  <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <footer class="footer">

    	<div class="container">
    	
    		<p>&copy; My Website 2017</p>

    	</div>

    </footer>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="logInModalTitle">Log In</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
		      <form>

		      		<input type="hidden" name="logInActive" id="logInActive" value="1">
		      		<div class="alert alert-warning" id="validationError"></div>
				  <div class="form-group">
				    <label class="form-control-label" for="email">Email</label>
				    <input type="email" class="form-control" id="email" placeholder="Email Address">
				  </div>
				  <div class="form-group signUpName">
				    <label class="form-control-label" for="firstName">First Name</label>
				    <input type="text" class="form-control" id="firstName" placeholder="Anita">
				  </div>
				  <div class="form-group signUpName">
				    <label class="form-control-label" for="lastName">Last Name</label>
				    <input type="text" class="form-control" id="lastName" placeholder="Dick">
				  </div>
				  <div class="form-group">
				    <label class="form-control-label" for="formGroupExampleInput2">Password</label>
				    <input type="password" class="form-control" id="password" placeholder="Password">
				  </div>
				</form>
	      </div>
	      <div class="modal-footer">
	      	<a href="javascript:;" id="toggleSignUp">Sign Up</a>
	        <button type="button" class="btn btn-success" id="logIn-signUp">Log In</button>
	      </div>
	    </div>
	  </div>
	</div>


	<div class="modal fade" id="updateProfileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="profileModalTitle">Update Your Profile</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
		      		<h6> <strong>Update Your Bio </strong><small>(500 characters or less)</small>: </h6>
		      		<div class="form-group">
                       <textarea class="form-control" id="bioContent"></textarea>
                       <button id="updateBioButton" class="btn btn-success">Update Bio</button>
                    </div>
                    <div class="bioUpdateSuccess alert alert-success"></div>
					<div class="bioUpdateFail alert alert-danger"></div>
                   
					<hr>
					<h3 id="modalOr">OR</h3>
					<hr>
					<h6> <strong>Update Your Profile Picture: </strong></h6>
					<br>
					<p><a href="javascript:;" class="displayPreviousUploadsForm">Choose from existing images:</a></p>
					<div class="container existingPics">
						<div class="card-deck">
							<?php displayUploadedPics('limited'); ?>
						</div>
					<br>
					<a href="javascript:;" id="morePicsLink" data-toggle="modal" data-target="#morePicsModal"><small>Click here to see more choices</small></a>
					</div>
					<div class="changeExistingSuccess alert alert-success"></div>
					<div class="changeExistingFailure alert alert-danger">There was a problem making this your profile picture. Please try again later.</div>
					<hr>
					<p><a href="javascript:;" class="displayUploadForm">Upload new image:</a></p>
					<div class="uploadImageForm">
					<form id="uploadimage" action="" method="post" enctype="multipart/form-data">
						<div id="image_preview"><img id="previewing" src="noimage.png" /></div>
						<hr>
						<div id="selectImage">
						<label>Select Your Image</label><br/>
						<input type="file" name="file" id="file" required />
						<input type="submit" value="Update Picture" class="btn btn-success submit">
						</div>
					</form>
	      		 </div>
					<div class="uploadSuccess alert alert-success"></div>
					<div class="uploadFail alert alert-danger"></div>
	      <div class="modal-footer">	
	      </div>       
	    </div>
	  </div>
	</div>
   </div>



	<div class="modal fade" id="morePicsModal" tabindex="-1" role="dialog" aria-labelledby="morePicsModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="morePicsModalTitle">Showing All of Your Uploads:</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">



	      	<?php displayUploadedPics(); ?>


	      </div>

	       <div class="modal-footer">
	      	<div class="changeExistingSuccess alert alert-success"></div>
			<div class="changeExistingFailure alert alert-danger">There was a problem making this your profile picture. Please try again later.</div>    
	      </div>       
	    </div>
	  </div>
	</div>


	<div class="modal fade" id="allFollowingModal" tabindex="-1" role="dialog" aria-labelledby="allFollowingModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="allFollowingModalTitle">Showing Everyone <?php if ($_GET['userid']) { displayOtherUser(); ?> Follows: <?php } else { ?> You Follow: <?php } ?></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	                <div class="input-group">
	               		 <input type="text" class="form-control" id="followingFilter" placeholder="Search Following...">
	               		 <span class="input-group-btn">
	                    	<button  class="btn btn-success">Search</button>
	               		</span>
	                </div>    
	         

	      	<?php if ($_GET['userid']) { ?>

	      		<ul class="list-group" id="followingList">

	       		<?php displayAllFollowing(); ?>

	       		</ul>

	      <?php	} else { ?>

		      <ul class="list-group" id="followingList">

		       <?php displayAllFollowing('yourprofile'); ?>

		  	 </ul>

	      <?php } ?>


	      </div>

	       <div class="modal-footer">
	      	<div class="changeExistingSuccess alert alert-success"></div>
			<div class="changeExistingFailure alert alert-danger">There was a problem making this your profile picture. Please try again later.</div>    
	      </div>       
	    </div>
	  </div>
	</div>


	<div class="modal fade" id="allFollowersModal" tabindex="-1" role="dialog" aria-labelledby="allFollowersModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="allFollowersModalTitle">Showing Everyone Following <?php if ($_GET['userid']) { displayOtherUser(); ?>:<?php } else { ?> You: <?php } ?></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      			<div class="input-group">
	               		 <input type="text" class="form-control" id="followerFilter" placeholder="Search Followers...">
	               		 <span class="input-group-btn">
	                    	<button  class="btn btn-success">Search</button>
	               		</span>
	                </div>  

	      	<?php if ($_GET['userid']) { ?>
	      		<ul class="list-group" id="followerList">

	       		<?php displayAllFollowers(); ?>

	       		</ul>

	      <?php	} else { ?>

		      <ul class="list-group" id="followerList">

		       <?php displayAllFollowers('yourprofile'); ?>

		  	 </ul>

	      <?php } ?>


	      </div>

	       <div class="modal-footer">
	      	<div class="changeExistingSuccess alert alert-success"></div>
			<div class="changeExistingFailure alert alert-danger">There was a problem making this your profile picture. Please try again later.</div>    
	      </div>       
	    </div>
	  </div>
	</div>

	




	<script>
		
		$("#toggleSignUp").click(function (){


			if($("#logInActive").val() == 1) {

				$("#logInActive").val("0");
				$("#logInModalTitle").html("Sign Up");
				$("#logIn-signUp").html("Sign Up");
				$("#toggleSignUp").html("Log In");
				$(".signUpName").show();

			} else {

				$("#logInActive").val("1");
				$("#logInModalTitle").html("Log In");
				$("#logIn-signUp").html("Log In");
				$("#toggleSignUp").html("Sign Up");
				$(".signUpName").hide();

			}


		});

		$("#logIn-signUp").click(function() {


			$.ajax({

				type:"POST",
				url: "actions.php?action=logInSignUp",
				data:"email=" + $("#email").val() + "&firstName=" + $("#firstName").val() + "&lastName=" + $("#lastName").val() + "&password=" + $("#password").val() + "&logInActive=" + $("#logInActive").val(),
				success: function(result) {

					if (result == "1") {

						window.location.assign("http://twitterclone1-com.stackstaging.com/");

					} else {

						$("#validationError").html(result).show();

					}

				}

			});

		});


		$(".toggleFollow").on('click', function () {

			var id = $(this).attr("data-userId");


			$.ajax({

				type:"POST",
				url: "actions.php?action=toggleFollow",
				data:"userId=" + $(this).attr("data-userId"),
				success: function(result) {

					if (result == "0") {

						$("button[data-userId='" + id + "']").html("Follow");

					} else if (result == "1") {

						$("button[data-userId='" + id + "']").html("Unfollow");

					} 
				

				}

			});


		});

		function GetUrlValue(VarSearch){
					    var SearchString = window.location.search.substring(1);
					    var VariableArray = SearchString.split('&');
					    for(var i = 0; i < VariableArray.length; i++){
					        var KeyValuePair = VariableArray[i].split('=');
					        if(KeyValuePair[0] == VarSearch){
					            return KeyValuePair[1];
					        }
					    }
					}


		function posts_ajax () {


					function GetUrlValue(VarSearch){
					    var SearchString = window.location.search.substring(1);
					    var VariableArray = SearchString.split('&');
					    for(var i = 0; i < VariableArray.length; i++){
					        var KeyValuePair = VariableArray[i].split('=');
					        if(KeyValuePair[0] == VarSearch){
					            return KeyValuePair[1];
					        }
					    }
					}
					

						$.ajax({

							type:"POST",
							url: "actions.php?action=refreshPosts",
							data: "type=" + GetUrlValue('page') + "&userid=" + GetUrlValue('userid'),
							success: function(result) {

								$(".posts").html(result);

								$(".toggleFollow").on('click', function () {

									var id = $(this).attr("data-userId");


									$.ajax({

										type:"POST",
										url: "actions.php?action=toggleFollow",
										data:"userId=" + $(this).attr("data-userId"),
										success: function(result) {

											if (result == "0") {

												$("button[data-userId='" + id + "']").html("Follow");

											} else if (result == "1") {

												$("button[data-userId='" + id + "']").html("Unfollow");

											} 

											posts_ajax();
										

										}

									});


								});

								$(".deletePostLink").on('click', function () {


									$.ajax({

										type:"POST",
										url: "actions.php?action=deletePost",
										data:"postId=" + $(this).attr("data-postId"),
										success: function(result) {

												if (result == "1") {

													$("#postDeleteSuccess").show().fadeOut(5000);
													$("#postDeleteFail").hide();
													posts_ajax();						

												} else if (result != "1") {

													$("#postDeleteFail").show().fadeOut(5000);
													$("#postDeleteSuccess").hide();

												}
												

											}

									});

								});


							}

						});


					}

		setInterval(posts_ajax,5000);

		$("#postButton").click(function () {

			$.ajax({

				type:"POST",
				url: "actions.php?action=makePost",
				data:"postContent=" + $("#postContent").val(),
				success: function(result) {
					

					if (result == "1") {

						$("#postSuccess").show().fadeOut(1500);
						$("#postFailure").hide();
						posts_ajax();
									

					} else if (result != "") {

						$("#postFailure").html(result).show().fadeOut(1500);
						$("#postSuccess").hide();

					}

					
				}

			});

		});


		$(".deletePostLink").on('click', function () {


			$.ajax({

				type:"POST",
				url: "actions.php?action=deletePost",
				data:"postId=" + $(this).attr("data-postId"),
				success: function(result) {

						if (result == "1") {

							$("#postDeleteSuccess").show().fadeOut(5000);
							$("#postDeleteFail").hide();
							

						} else if (result != "1") {

							$("#postDeleteFail").show().fadeOut(5000);
							$("#postDeleteSuccess").hide();

							posts_ajax();

						}
						

					}

			});

		});


		$("#updateBioButton").click( function () {
				$.ajax({

						type:"POST",
						url: "actions.php?action=updateBio",
						data:"bioContent=" + $("#bioContent").val(),
						success: function(result) {

							if (result == "1") {

								$(".bioUpdateSuccess").html("Your bio has been updated successfully!").show().fadeOut(5000);
								$(".bioUpdateFail").empty().hide();
								

							} else if (result != "1") {

								$(".bioUpdateFail").html(result).show().fadeOut(5000);
								$(".bioUpdateSuccess").empty().hide();

							}
							

						}

				});

		});


		$(".showUploadForm").click(function () { 

			$(document).ready(function (e) {

				$("#uploadimage").on('submit',(function(e) {

					e.preventDefault();

					$(".uploadSuccess").empty();

						$.ajax({

							url: "actions.php", // Url to which the request is send
							type: "POST",             // Type of request to be send, called as method
							data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
							contentType: false,       // The content type used when sending data to the server.
							cache: false,             // To unable request pages to be cached
							processData:false,        // To send DOMDocument or non processed data file it is set to false
							success: function(data)   // A function to be called if request succeeds
							{

								if (data == "<span id='success'>Image Uploaded Successfully!</span><br/>") {
								
									$(".uploadSuccess").html(data).show().fadeOut(5000);
									$(".uploadFail").hide();

								} else {

									$(".uploadFail").html(data).show().fadeOut(5000);
									$(".uploadSuccess").hide();

								}

							}



						});
						

				}));


// Function to preview image after validation
			$(function() {

				$("#file").change(function() {

					$("#message").empty(); // To remove the previous error message
					var file = this.files[0];
					var imagefile = file.type;
					var match= ["image/jpeg","image/png","image/jpg"];

					if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))) {

						$('#previewing').attr('src','noimage.png');
						$("#message").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
						return false;
					} else {

					var reader = new FileReader();
					reader.onload = imageIsLoaded;
					reader.readAsDataURL(this.files[0]);

					}

				});

			});

			function imageIsLoaded(e) {

				$("#file").css("color","green");
				$('#image_preview').css("display", "block");
				$('#previewing').attr('src', e.target.result);
				$('#previewing').attr('width', '250px');
				$('#previewing').attr('height', '230px');

			};

		});

	});


		$(".displayPreviousUploadsForm").click(function () {


			$(".existingPics").fadeIn(1000);
			$(".uploadImageForm").fadeOut(1000);

		});


		$(".displayUploadForm").click(function () {

			$(".uploadImageForm").fadeIn(1000);
			$(".existingPics").fadeOut(1000);

		});


		$(".uploadedPic").click(function() {

			var picSrc = $(this).attr("data-imageId");

				$.ajax({

					type:"POST",
					url: "actions.php?action=setProfPicToExisting",
					data:"imageId=" + picSrc,
					success: function(result) {

						if (result != "0") {

							$(".changeExistingSuccess").show().html(result + " is now set as your profile picture!").fadeOut(6000);
							$(".changeExistingFailure").hide();



						} else {

							$(".changeExistingFailure").show().fadeOut(5000);
							$(".changeExistingSuccess").hide();

						}

					}
				
				});
		});

		$("#morePicsLink").click(function() {

			
			$("#updateProfileModal").modal('hide');

			$("#updateProfileModal").on('hidden.bs.modal', function (e) {

				$("#morePicsModal").modal('show');

			});
			

		});

		$.extend($.expr[':'], {

		  'containsi': function(elem, i, match, array)

		  {

		    return (elem.textContent || elem.innerText || '').toLowerCase()

		    .indexOf((match[3] || "").toLowerCase()) >= 0;

		  }

		});


		$("#followingFilter").change(function () {		

			
				var value = $("#followingFilter").val();

			     $('#followingList > li:not(:containsi(' + value + '))').hide(); 
				 $('#followingList > li:containsi(' + value + ')').show();
		    
		
		});
		

		$("#followerFilter").change(function () {		

			
				var value = $("#followerFilter").val();

			     $('#followerList > li:not(:containsi(' + value + '))').hide(); 
				 $('#followerList > li:containsi(' + value + ')').show();
		    
		
		});


		

		$(".sendChatBtn").on('click', function () {

			var id = $(this).attr("data-userId");
	
				$.ajax({

					type:"POST",
					url: "actions.php?action=sendChat",
					data:"userId=" + $(this).attr("data-userId") + "&chatContent=" + $(".chatContent").val(),
					success: function(result) {

						
					}

				});  

		}); 

	$("#yourChatsBtn").on('click', function() {

		if ($("#yourChatsCollapse").is(':hidden')) {

			$("#yourChatsCollapse").show();



		} else if ($("#yourChatsCollapse").is(':visible')) {
		
			$("#yourChatsCollapse").hide();
		}


	});


	
	$('.nonProfileChat').on('click', function () {

		id = $(this).attr("data-userId");

		function nonProfileChat_ajax () {


			

				$.ajax({

					type:"POST",
					url: "actions.php?action=openChat",
					data:"userId=" + id,
					cache:false,
					success: function(result) {
															
					$("#chatWindow").html(result);

					var scrolled = false;

					function updateScroll(){

						if(!scrolled){

							var element = document.getElementById("chatWindow");
							element.scrollTop = element.scrollHeight;

						}
					}

					$("#chatWindow").on('scroll', function(){

					 scrolled=true;

					});
																														
					updateScroll();
					setInterval(updateScroll, 1000);

					function chat_ajax() {

						$.ajax({

							type:"POST",
							cache:false,
							url: "actions.php?action=refreshChat",
							data:"userId=" + id,
							success: function(result) {
																														
							$('.messages').html(result);
																				

																				
							}

						});

				}
				chat_ajax();
					 setInterval(chat_ajax,1500);										 
															
					$(".sendChatBtn").on('click', function () {

								$.ajax({

									type:"POST",
									url: "actions.php?action=sendChat",
									data:"userId=" + $(this).attr("data-userId") + "&chatContent=" + $(".chatContent").val(),
									success: function(result) {

									chat_ajax();				
																							

									}

								});  

					}); 
															
				}

			});


			}

	nonProfileChat_ajax();

});


	


		function allChats_ajax() {

								$.ajax({

									type:"POST",
									url: "actions.php?action=refreshYourChats",
									success: function(result) {
																				
									$(".chatsRefresh").html(result);

									$('.openChat').on('click', function () {

										$("#yourChatsCollapse").hide();

									
			
										id = $(this).attr("data-userId");

											

										$.ajax({

														type:"POST",
														url: "actions.php?action=openChat",
														data:"userId=" + id,
														cache:false,
														success: function(result) {
															
															$("#chatWindow").html(result);

															var scrolled = false;

																function updateScroll() {

																	if(!scrolled){

																		var element = document.getElementById("chatWindow");
																		element.scrollTop = element.scrollHeight;

																	}
																}

																$("#chatWindow").on('scroll', function(){

																 scrolled=true;

																});
																														
																updateScroll();
															 	setInterval(updateScroll, 1000);

																function chat_ajax() {

																	$.ajax({

																		type:"POST",
																		cache:false,
																		url: "actions.php?action=refreshChat",
																		data:"userId=" + id,
																		success: function(result) {
																													
																		$('.messages').html(result);
																			

																			
																		}

																	});

															}

															chat_ajax();
															  setInterval(chat_ajax,1500);

															

															 
															
																$(".sendChatBtn").on('click', function () {

																				


																			$.ajax({

																				type:"POST",
																				url: "actions.php?action=sendChat",
																				data:"userId=" + $(this).attr("data-userId") + "&chatContent=" + $(".chatContent").val(),
																				success: function(result) {

																				chat_ajax();				
																							

																				}

																			});  


																}); 
															
														}

													});


											});

									

									}

								});

						}
					allChats_ajax();
					setInterval(allChats_ajax,1000);


				
						if($(window).width() <= 1400) {


							if (GetUrlValue('page') == 'yourprofile') {

								
								if ($(window).width() >= 768 && $(window).width() <= 992) {

									$('.profile-pill,.posts-pill,.people-pill,.chat-pill').show();

									$('.chat-pill').on('click', function() {

										$("#yp-1,#yp-2").fadeOut();
										$("#yp-3,#yp-4").fadeIn();
										$(".chat-pill,.people-pill").addClass('pill-active');
										$(".profile-pill,.posts-pill").removeClass('pill-active');
											
									});

									$('.people-pill,.posts-pill').on('click', function() {

										$("#yp-1,#yp-4").fadeOut();	
										$("#yp-3,#yp-2").fadeIn();
										$(".people-pill,.posts-pill").addClass('pill-active');
										$(".profile-pill,.chat-pill").removeClass('pill-active');
										
									});

									$('.profile-pill').on('click', function() {

										$("#yp-4,#yp-3").fadeOut();
										$("#yp-1,#yp-2").fadeIn();
										$(".profile-pill,.posts-pill").addClass('pill-active');
										$(".people-pill,.chat-pill").removeClass('pill-active');

									});


									$('#yp-1,#yp-2,#yp-3,#yp-4').addClass('col-6').removeClass('col-3');
									$("#yp-1-cont").removeClass('container');
									$("#yp-3,#yp-4").hide();
									$('.profile-pill,.posts-pill').addClass('pill-active');
									
									

								} else if ($(window).width() >= 240 && $(window).width() < 768) {

									$('.profile-pill,.posts-pill,.people-pill,.chat-pill').show();

									$('.chat-pill').on('click', function() {

										$("#yp-1,#yp-2,#yp-3").fadeOut();
										$("#yp-4").fadeIn();
										$(".chat-pill").addClass('pill-active');
										$(".profile-pill,.posts-pill,.people-pill").removeClass('pill-active');
											
									});

									$('.posts-pill').on('click', function() {

										$("#yp-1,#yp-3,#yp-4").fadeOut();	
										$("#yp-2").fadeIn();
										$(".posts-pill").addClass('pill-active');
										$(".people-pill,.profile-pill,.chat-pill").removeClass('pill-active');
										
									});

									$('.people-pill').on('click', function() {

										$("#yp-1,#yp-2,#yp-4").fadeOut();	
										$("#yp-3").fadeIn();
										$(".people-pill").addClass('pill-active');
										$(".posts-pill,.profile-pill,.chat-pill").removeClass('pill-active');

									});

									$('.profile-pill').on('click', function() {

										$("#yp-4,#yp-3,#yp-2").fadeOut();
										$("#yp-1").fadeIn();
										$(".profile-pill").addClass('pill-active');
										$(".people-pill,.chat-pill,.posts-pill").removeClass('pill-active');

									});


									$('#yp-1,#yp-2,#yp-3,#yp-4').addClass('col-12').removeClass('col-3');
									$("#yp-2,#yp-3,#yp-4").hide();
									$('.profile-pill').addClass('pill-active');

								} else if ($(window).width() < 240) {

									$('#yp-1,#yp-2,#yp-3,#yp-4').hide();

									alert("Please come back and visit this website on a larger device. Your display is too small.");

								}


							} else if (GetUrlValue('page') == 'posts') {

								if ($(window).width() < 768) {


									$('.posts-pill,.people-pill').show();
									$('#yPost-1').addClass('col-12').removeClass('col-8');
									$('#yPost-2').hide().addClass('col-12').removeClass('col-4');
									$('.posts-pill').on('click', function () {

										$('#yPost-2').fadeOut();
										$('#yPost-1').fadeIn();

									});

									$('.people-pill').on('click', function () {

										$('#yPost-1').fadeOut();
										$('#yPost-2').fadeIn();

									});


								} else if ($(window).width() < 240) {

									alert("Please come back and visit this website on a larger device. Your display is too small.");

								}

							} else if (GetUrlValue('page') == 'timeline') {

								if ($(window).width() < 768) {


									$('.posts-pill,.people-pill').show();
									$('#tPost-1').addClass('col-12').removeClass('col-8');
									$('#tPost-2').hide().addClass('col-12').removeClass('col-4');
									$('.posts-pill').on('click', function () {

										$('#tPost-2').fadeOut();
										$('#tPost-1').fadeIn();

									});

									$('.people-pill').on('click', function () {

										$('#tPost-1').fadeOut();
										$('#tPost-2').fadeIn();

									});


								} else if ($(window).width() < 240) {

									alert("Please come back and visit this website on a larger device. Your display is too small.");

								}


							} else if (GetUrlValue('page') == 'publicprofiles' && !GetUrlValue('userid')) {

								if ($(window).width() >= 768 && $(window).width() <= 1400) {

									$('.profile-pill').html('<strong>User List</strong>');
									$('.people-pill').html('<strong>Make/Search Posts</strong>');
									$('.profile-pill,.people-pill').show();
									$('#pp-3').hide().addClass('col-6').removeClass('col-3');
									$('#pp-4').addClass('col-6').removeClass('col-3');
									$('.profile-pill').addClass('pill-active');

									$('.profile-pill').on('click', function () {


										$('#pp-all').fadeIn();
										$('#pp-3').fadeOut();
										$('.people-pill').removeClass('pill-active');
										$('.profile-pill').addClass('pill-active');


									});


									$('.people-pill').on('click', function () {


										$('#pp-all').fadeOut();
										$('#pp-3').fadeIn();
										$('.people-pill').addClass('pill-active');
										$('.profile-pill').removeClass('pill-active');


									});



								} else if ($(window).width() >= 240 && $(window).width() < 768) {

									$('.profile-pill').html('<strong>User List</strong>');
									$('.people-pill').html('<strong>Make/Search Posts</strong>');
									$('.profile-pill,.people-pill,.chat-pill').show();
									$('#pp-3,#pp-4').hide().addClass('col-12').removeClass('col-3');
									$('#pp-all').addClass('col-12').removeClass('col-3');
									$('.profile-pill').addClass('pill-active');

									$('.profile-pill').on('click', function () {


										$('#pp-all').fadeIn();
										$('#pp-3,#pp-4').fadeOut();
										$('.people-pill,.chat-pill').removeClass('pill-active');
										$('.profile-pill').addClass('pill-active');


									});


									$('.people-pill').on('click', function () {


										$('#pp-all,#pp-4').fadeOut();
										$('#pp-3').fadeIn();
										$('.people-pill').addClass('pill-active');
										$('.profile-pill,.chat-pill').removeClass('pill-active');


									});


									$('.chat-pill').on('click', function () {


										$('#pp-all,#pp-3').fadeOut();
										$('#pp-4').fadeIn();
										$('.chat-pill').addClass('pill-active');
										$('.profile-pill,.people-pill').removeClass('pill-active');


									});


								} else if ($(window).width() < 240) {

									$('#pp-all,#pp-3,#pp-4').hide();

									alert("Please come back and visit this website on a larger device. Your display is too small.");

								}
								

							} else if (GetUrlValue('page') == 'publicprofiles' && GetUrlValue('userid')) {

								if ($(window).width() >= 768 && $(window).width() <= 992) {

									$('.profile-pill,.posts-pill,.people-pill,.chat-pill').show();

									$('.chat-pill').on('click', function() {

										$("#pp-1,#pp-2").fadeOut();
										$("#pp-3,#pp-4").fadeIn();
										$(".chat-pill,.people-pill").addClass('pill-active');
										$(".profile-pill,.posts-pill").removeClass('pill-active');
											
									});

									$('.people-pill,.posts-pill').on('click', function() {

										$("#pp-1,#pp-4").fadeOut();	
										$("#pp-3,#pp-2").fadeIn();
										$(".people-pill,.posts-pill").addClass('pill-active');
										$(".profile-pill,.chat-pill").removeClass('pill-active');
										
									});

									$('.profile-pill').on('click', function() {

										$("#pp-4,#pp-3").fadeOut();
										$("#pp-1,#pp-2").fadeIn();
										$(".profile-pill,.posts-pill").addClass('pill-active');
										$(".people-pill,.chat-pill").removeClass('pill-active');

									});


									$('#pp-1,#pp-2,#pp-3,#pp-4').addClass('col-6').removeClass('col-3');
									$("#pp-3,#pp-4").hide();
									$('.profile-pill,.posts-pill').addClass('pill-active');
									
									

								} else if ($(window).width() >= 240 && $(window).width() < 768) {

									$('.profile-pill,.posts-pill,.people-pill,.chat-pill').show();

									$('.chat-pill').on('click', function() {

										$("#pp-1,#pp-2,#pp-3").fadeOut();
										$("#pp-4").fadeIn();
										$(".chat-pill").addClass('pill-active');
										$(".profile-pill,.posts-pill,.people-pill").removeClass('pill-active');
											
									});

									$('.posts-pill').on('click', function() {

										$("#pp-1,#pp-3,#pp-4").fadeOut();	
										$("#pp-2").fadeIn();
										$(".posts-pill").addClass('pill-active');
										$(".people-pill,.profile-pill,.chat-pill").removeClass('pill-active');
										
									});

									$('.people-pill').on('click', function() {

										$("#pp-1,#pp-2,#pp-4").fadeOut();	
										$("#pp-3").fadeIn();
										$(".people-pill").addClass('pill-active');
										$(".posts-pill,.profile-pill,.chat-pill").removeClass('pill-active');

									});

									$('.profile-pill').on('click', function() {

										$("#pp-4,#pp-3,#pp-2").fadeOut();
										$("#pp-1").fadeIn();
										$(".profile-pill").addClass('pill-active');
										$(".people-pill,.chat-pill,.posts-pill").removeClass('pill-active');

									});


									$('#pp-1,#pp-2,#pp-3,#pp-4').addClass('col-12').removeClass('col-3');
									$("#pp-2,#pp-3,#pp-4").hide();
									$('.profile-pill').addClass('pill-active');

								} else if ($(window).width() < 240) {

									$('#pp-1,#pp-2,#pp-3,#pp-4').hide();

									alert("Please come back and visit this website on a larger device. Your display is too small.");

								}

							} else if (GetUrlValue('page') == 'search') {

								if ($(window).width() < 768) {

									$('#s-1').addClass('col-12').removeClass('col-8');
									$('#s-2').hide().addClass('col-12').removeClass('col-4');
									$('.posts-pill').show().addClass('pill-active');
									$('.people-pill').show();

									$('.posts-pill').on('click', function () {

										$('#s-2').fadeOut();
										$('#s-1').fadeIn();
										$('.posts-pill').addClass('pill-active');
										$('.people-pill').removeClass('pill-active');

									});

									$('.people-pill').on('click', function () {

										$('#s-1').fadeOut();
										$('#s-2').fadeIn();
										$('.posts-pill').removeClass('pill-active');
										$('.people-pill').addClass('pill-active');

									});

								} else if ($(window).width() < 240) {

									$('#s-1,#s-2').hide();

									alert("Please come back and visit this website on a larger device. Your display is too small.");

								}


							} else if (GetUrlValue('page') == 'chatquery') {

								if ($(window).width() < 1060) {

									$('#c-1').addClass('col-12').removeClass('col-8');
									$('#c-2').hide().addClass('col-12').removeClass('col-4');
									$('.posts-pill').show().addClass('pill-active');
									$('.people-pill').show();

									$('.posts-pill').on('click', function () {

										$('#c-2').fadeOut();
										$('#c-1').fadeIn();
										$('.posts-pill').addClass('pill-active');
										$('.people-pill').removeClass('pill-active');

									});

									$('.people-pill').on('click', function () {

										$('#c-1').fadeOut();
										$('#c-2').fadeIn();
										$('.posts-pill').removeClass('pill-active');
										$('.people-pill').addClass('pill-active');

									});

								} else if ($(window).width() < 240) {

									$('#c-1,#c-2').hide();

									alert("Please come back and visit this website on a larger device. Your display is too small.");

								}


							} else if (GetUrlValue('page') == 'home' || !GetUrlValue('page')) {

								if ($(window).width() < 768) {


									$('.posts-pill,.people-pill').show();
									$('#hPost-1').addClass('col-12').removeClass('col-8');
									$('#hPost-2').hide().addClass('col-12').removeClass('col-4');
									$('.posts-pill').addClass('pill-active');
									$('.posts-pill').on('click', function () {

										$('#hPost-2').fadeOut();
										$('#hPost-1').fadeIn();
										$('.posts-pill').removeClass('pill-active');
										$('.people-pill').addClass('pill-active');

									});

									$('.people-pill').on('click', function () {

										$('#hPost-1').fadeOut();
										$('#hPost-2').fadeIn();
										$('.posts-pill').addClass('pill-active');
										$('.people-pill').removeClass('pill-active');

									});


								} else if ($(window).width() < 240) {

									alert("Please come back and visit this website on a larger device. Your display is too small.");

								}

							}

						} else {

							$('.tablist').hide();

						}

						$(window).resize(function(){
						      console.log($(window).width());
						      if($(window).width() <= 975) {

						      	

						      


						      } else {

						      	$('.tablist').hide();

						      }

						}); 


		



	</script>

  </body>
</html>