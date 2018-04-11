	<nav class="nav nav-pills tabList nav-fill">
	  <a class="nav-item nav-link profile-pill" href="javascript:;"><strong>Profile Card</strong></a>
	  <a class="nav-item nav-link posts-pill" href="javascript:;"><strong>Posts</strong></a>
	  <a class="nav-item nav-link people-pill" href="javascript:;"><strong>Make Post/View People</strong></a>
	  <a class="nav-item nav-link chat-pill" href="javascript:;"><strong>Chat</strong></a>
	</nav>

<div class="container-fluid" id="background">

	<div class="check"></div>

	

    <div class="row">

      <div id="yp-1" class="col-3">
      	<div id="yp-1-cont" class="container">

    	  	<?php displayProfile('yourprofile'); ?>

      	</div>

      </div>
	  <div id="yp-2" class="col-3 refreshable"><h2 class="page-header">Recent Posts</h2>

	  	<ul class="list-group posts">

	  	<?php displayTweets('yourposts'); ?>

	  </ul>

	  </div>

	  <div id="yp-3" class="col-3">

	  	<p> <?php displaySearch(); ?> </p>

	  	<hr>

	  	<p> <?php displayTweetBox(); ?> </p>

	  	<hr>

	  	<h6>People You Follow <?php countFollowing('yourprofile'); ?>:</h6>

	  	<p> <?php displayFollowing('yourprofile'); ?> </p>

	  	<hr>

	  	<h6>People Following You <?php countFollowers('yourprofile'); ?>:</h6>

	  	<p> <?php displayFollowers('yourprofile'); ?> </p>

	  	<hr>

	  </div>
	  <div id="yp-4" class="col-3">
	  	<div class="container">
		  	<ul class="list-group">
		  		<h3 class="page-header">Chat</h3>
		  	 

		  	<?php displayChat(); ?> 

		  	
		   </ul>
		   <hr>
		   <ul class="list-group">
		   	<h4> Looking for someone to talk to? </h4>
		   	<p> Search for their name and start a chat!</p>
		   	<form class="form-inline">
                <div class="form-group chatSearch">
                    <input type="hidden" name="page" value="chatquery">
                    <input type="text" name="c" class="form-control" id="chatSearch" placeholder="Find someone...">
                </div>
                <button type="submit"  class="btn btn-success">Search</button>
             </form>

		   </ul>
		   <hr>
		</div>
	  </div>
	</div>

</div>