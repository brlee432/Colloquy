<nav class="nav nav-pills tabList nav-fill"> 
	  <a class="nav-item nav-link posts-pill" href="javascript:;"><strong>Posts</strong></a>
	  <a class="nav-item nav-link people-pill" href="javascript:;"><strong>Make Post</strong></a>
	</nav>

<div class="container-fluid">

    <div class="row">
	  <div id="yPost-1" class="col-8"><h1 class="page-header">Posts You've Made</h1>

	  	<ul class="list-group posts">

	 	 <?php displayTweets('yourposts'); ?>

	  	</ul>

	  </div>

	  <div id="yPost-2" class="col-4">
	  	

	  	<p> <?php displaySearch(); ?> </p>

	  	<hr>

	  	<p> <?php displayTweetBox(); ?> </p>

	  </div>
	 
	</div>

</div>