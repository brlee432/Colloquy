<?php

  include("functions.php");

  include("views/header.php");

  if ($_GET['page'] == 'timeline' && $_SESSION['id']) {

  	include("views/timeline.php");

  } else if ($_GET['page'] == 'posts' && $_SESSION['id']) {

  	include("views/yourposts.php");

  } else if ($_GET['page'] == 'search' && $_SESSION['id']) {

  	include("views/search.php"); 

  }	else if ($_GET['page'] == 'publicprofiles' && $_SESSION['id']) {

  	include("views/publicprofiles.php"); 

  } else if ($_GET['page'] == 'yourprofile' && $_SESSION['id']) {

    include("views/yourprofile.php"); 

  } else if ($_GET['page'] == 'chatquery' && $_SESSION['id']){

    include("views/chatquery.php"); 

  } else {

  	include("views/home.php");

  }

  include ("views/footer.php");

?>