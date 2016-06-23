<?php require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}?>
<!doctype html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en" >
<!--<![endif]-->

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<title>Bookfall: Making Independent Reading Simple</title>
<link rel="stylesheet" href="/stylesheets/app.css">
<script src="/javascripts/vendor/custom.modernizr.js"></script>
<link href="select2.css" rel="stylesheet"/>
<script type="text/javascript" src="//use.typekit.net/iml0ylo.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>    
</head>

<body>

<!--Top bar navigation start-->
<nav class="top-bar">
  <ul class="title-area">
    <!-- Title Area -->
    <li class="name">
      <a href="index.php"><img src="/images/whiteBookmark.png"/></a></h1>
    </li>
    <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
  </ul>
  <section class="top-bar-section"> 
    <!-- Right Nav Section -->
    
    <ul class="right">
<?php if(isUserLoggedIn()) {echo '
    	<li><a href="recordBook.php">Record A Book</a></li>
        <li><a href="myBooks.php">My Books</a></li>
        <li><a href="books.php">Suggested</a></li>';
} 
     if(isUserLoggedIn()) { echo '<li class="has-dropdown"> <a href="">'.$loggedInUser->displayname.'</a>
	  			<ul class="dropdown">
				<li><a href="user_settings.php">Account Settings</a></li>
            	<li class=""><a href="logout.php" class="">Sign-Out</a></li>
				</ul>
			</li>';}
	  else { echo '<li class="has-form"><a href="login.php">Log In</a></li>';
	  }
	  ?>
    </ul>
  </section>
</nav>

<!--Top bar navigation end-->