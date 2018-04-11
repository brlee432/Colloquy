<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

    <link rel="stylesheet" href="http://twitterclone1-com.stackstaging.com/styles.css">
  </head>
  <body>

  	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  <a class="navbar-brand" href="?page=home"><img src="site-media/social-media-logo.png" id="logo"></a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item">
		        <a class="nav-link" href="?page=timeline">Posts For You<span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="?page=posts">Your Posts</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="?page=publicprofiles">Public Profiles</a>
		      </li>
		    </ul>
		    <div class="form-inline my-2 my-lg-0"> 

		    <?php if ($_SESSION['id']) { ?>

		    	<div id="yourProfileLink"><a href="?page=yourprofile" class="my-2 my-sm-0"> <?php displayCurrentUser(); ?> </a></div>

		    	<a href="?function=logout"><button class="btn btn-outline-success my-2 my-sm-0">Logout</button></a>

		    <?php } else { ?>

		      <button class="btn btn-outline-success my-2 my-sm-0" type="button" data-toggle="modal" data-target="#exampleModal">Log In / Sign Up</button>
		    
		    <?php } ?>
		    
		    </div>
		  </div>
	</nav>