<!doctype html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->

<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Foundation Template</title>

  
  <link rel="stylesheet" href="stylesheets/app.css">
  

  <script src="javascripts/vendor/custom.modernizr.js"></script>

</head>

<body>
<nav class="top-bar">
  <ul class="title-area">
    <!-- Title Area -->
    <li class="name">
      <h1><a href="#">Bookfall </a></h1>
    </li>
    <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
  </ul>
<form>
  <section class="top-bar-section">
    <!-- Left Nav Section -->
    <ul class="right">
      <li class="divider"></li>
   
      <li class="search"><input type="text" name="username" placeholder="username"></li>
      <li class="divider"></li>
     <li class="search"> <input type="password" name="password" placeholder="password"></li>
      <li class="has-form"><input class ="button" type="submit" name="submit" value="Log In"></li>
      
    
    </ul>
</section>
</form>
</nav>
<div class="row">
	
    <div class="large-8 large-centered columns"><h1>Sign up for Bookfall</h1></div>
   
</div>
<form class="custom">
	<fieldset>
	<legend>Create an account</legend>
	<div class="row">
		<div class="large-6 columns">
		<label>First Name</label>
    	<input type="text" placeholder="first name">
        </div>
       <div class="large-6 columns">
    	<label>Last Name</label>
    	<input type="text" placeholder="last name">
    	</div>
	</div>
    
    <div class="row">
    	<div class="large-6 columns">
        <label>Grade</label>
    	<select id="customDropdown" class="small">
        	<option>9th</option>
            <option>10th</option>
            <option>11th</option>
            <option>12th</option>
        </select>  
        </div>
        <div class="large-6 columns">
        <label>Lexile Level</label>
    	<input type="number" placeholder="750">
        </div>
        </div>
    </div>
    <div class="row">
		<div class="large-6 columns">
		<label>Favorite Book</label>
        <input type="text" placeholder="Harry Potter and the Chamber of Secrets">
        </div>
        <div class="large-6 columns">
        <label>Instructor's Email</label>
        <input type="text" placeholder="xxxx@xxxx.xxx">
        </div>
    </div>
	</fieldset>
</form>












<!--Foundation Scripts Here-->
  <script>
  document.write('<script src=' +
  ('__proto__' in {} ? 'javascripts/vendor/zepto' : 'javascripts/vendor/jquery') +
  '.js><\/script>')
  </script>
  
  <script src="javascripts/foundation/foundation.js"></script>
	
	<script src="javascripts/foundation/foundation.abide.js"></script>
	
	<script src="javascripts/foundation/foundation.alerts.js"></script>
	
	<script src="javascripts/foundation/foundation.clearing.js"></script>
	
	<script src="javascripts/foundation/foundation.cookie.js"></script>
	
	<script src="javascripts/foundation/foundation.dropdown.js"></script>
	
	<script src="javascripts/foundation/foundation.forms.js"></script>
	
	<script src="javascripts/foundation/foundation.interchange.js"></script>
	
	<script src="javascripts/foundation/foundation.joyride.js"></script>
	
	<script src="javascripts/foundation/foundation.magellan.js"></script>
	
	<script src="javascripts/foundation/foundation.orbit.js"></script>
	
	<script src="javascripts/foundation/foundation.placeholder.js"></script>
	
	<script src="javascripts/foundation/foundation.reveal.js"></script>
	
	<script src="javascripts/foundation/foundation.section.js"></script>
	
	<script src="javascripts/foundation/foundation.tooltips.js"></script>
	
	<script src="javascripts/foundation/foundation.topbar.js"></script>
	
  
  <script>
    $(document).foundation();
  </script>
</body>
</html>