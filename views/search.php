<nav class="nav nav-pills tabList nav-fill"> 
	  <a class="nav-item nav-link posts-pill" href="javascript:;"><strong>Results</strong></a>
	  <a class="nav-item nav-link people-pill" href="javascript:;"><strong>Search/Make Posts</strong></a>
	</nav>
<div class="container">

    <div class="row">
	  <div id="s-1" class="col-8"><h1 class="page-header">Search Results</h1>

	  	<ul class="list-group posts">

	 	 <?php displayTweets('search'); ?>

	 	</ul>

	  </div>

	  <div id="s-2" class="col-4">
	  	

	  	<p> <?php displaySearch(); ?> </p>

	  	<hr>

	  	<p> <?php displayTweetBox(); ?> </p>

	  	<hr> 

	  </div>
	</div>

</div>