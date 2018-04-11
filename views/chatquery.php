<nav class="nav nav-pills tabList nav-fill"> 
	  <a class="nav-item nav-link posts-pill" href="javascript:;"><strong>Results</strong></a>
	  <a class="nav-item nav-link people-pill" href="javascript:;"><strong>Chat/Search</strong></a>
	</nav>

<div class="container-fluid">

    <div class="row">
	  <div id="c-1" class="col-8"><h1 class="page-header">Search Results</h1>

	  	<ul class="list-group">

	 	 <?php displayChatQuery(); ?>

	 	</ul>

	  </div>

	 
	    <div id="c-2" class="col-4">
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
		<br>
	  </div>
	</div>

</div>