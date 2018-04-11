<?php if (!$_SESSION['id']) { ?>

	<div id="background">
		


	</div>
	<div class="container">

				<div id="welcome-div" class="col-12 align-self-center">

				<h1 id="welcome-banner">Welcome to Colloquy</h1>

				<p id="welcome-span">This is a very early version. Please log in or sign up to explore the site.</p>

				 <button id="welcome-button" class="btn btn-outline-success my-2 my-sm-0" type="button" data-toggle="modal" data-target="#exampleModal">Log In / Sign Up</button>
			</div>
		



	</div>




	<?php } else { ?>

<nav class="nav nav-pills tabList nav-fill"> 
	  <a class="nav-item nav-link posts-pill" href="javascript:;"><strong>Posts</strong></a>
	  <a class="nav-item nav-link people-pill" href="javascript:;"><strong>Make Post</strong></a>
	</nav>  


<div class="container-fluid">

    <div class="row">
	  <div id="hPost-1" class="col-8"><h1 class="page-header">All Recent Posts</h1>

	  	<ul class="list-group posts">

		  <?php displayTweets('public'); ?>

	   </ul>

	  </div>

	  <div id="hPost-2" class="col-4">

	  	<p> <?php displaySearch(); ?> </p>

	  	<hr>

	  	<p> <?php displayTweetBox(); ?> </p>

	 

	  </div>
	</div>

</div>

<?php } ?>