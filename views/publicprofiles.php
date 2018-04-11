<nav class="nav nav-pills tabList nav-fill">
	  <a class="nav-item nav-link profile-pill" href="javascript:;"><strong>Profile Card</strong></a>
	  <a class="nav-item nav-link posts-pill" href="javascript:;"><strong>Posts</strong></a>
	  <a class="nav-item nav-link people-pill" href="javascript:;"><strong>Make Post/View People</strong></a>
	  <a class="nav-item nav-link chat-pill" href="javascript:;"><strong>Chat</strong></a>
	</nav>

<div class="container-fluid">


    <div class="row">

     	<?php if ($_GET['userid']) { ?>

     		<div id="pp-1" class="col-3">

     			<div class="container">

     		<?php displayProfile($_GET['userid']); ?>

     			</div>

     		</div>

     	<?php } ?>

	  	<?php if ($_GET['userid']) { ?>

	  	 <div id="pp-2" class="col-3">

	  	 	<ul class="list-group posts">

	  			<?php displayTweets($_GET['userid']); ?>

	  		</ul>

	    <?php } else { ?>

	    <div id="pp-all" class="col-6">

	  	<h1 class="page-header">Active Users</h1>

	  	<ul class="list-group">

		  <?php displayUsers(); ?>

	  	</ul>

	  <?php } ?>

	  </div>


	  <div id="pp-3" class="col-3">
	  	

	  	<p> <?php displaySearch(); ?> </p>

	  	<hr>

	  	<p> <?php displayTweetBox(); ?> </p>

	  	<?php if ($_GET['userid']) { ?>

	  	<hr>

	  	<h6>People <?php displayOtherUser(); ?> Follows <?php countFollowing(); ?>:</h6>

	  	<p> <?php displayFollowing('limited'); ?> </p>

	  	<hr>

	  	<h6>People Following <?php displayOtherUser();  countFollowers(); ?>:</h6>

	  	<p> <?php displayFollowers('limited'); ?> </p>

	  	<hr>

	  	<?php } ?>

	  </div>
	   <div id="pp-4" class="col-3">
	  	<div class="container">
		  	<ul class="list-group">
		  		<h3 class="page-header">Chat</h3>

		  	

		  		<?php displayChat(); ?> 

		  		<div class="collapse" id="directChatCollapse">
                  <h4 class="card-header chat-name"> Direct Chat </h4>
                 
                  <div class="card card-body" id="chatWindow">
                  	

                   <div class="form-group">
                      <textarea class="form-control" id="chatContent" placeholder="Send a chat..." id="exampleFormControlTextarea1" rows="1"></textarea>
                      <button id="sendChatBtn" data-userId="" class="btn btn-primary">Send</button>
                    </div>
                  </div>
                </div>
		  	
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