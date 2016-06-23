<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Prevent the user visiting the logged in page if he/she is already logged in
if(isUserLoggedIn()) { header("Location: books.php"); die(); }

//Forms posted
if(!empty($_POST))
{
	$errors = array();
	$email = trim($_POST["email"]);
	$username = trim($_POST["username"]);
	$firstname = trim($_POST["firstName"]);
	$lastname = trim($_POST["lastName"]);
	$grade = trim($_POST["grade"]);
	$lexile = trim($_POST["lexile"]);
	$displayname = trim($_POST["displayname"]);
	$password = trim($_POST["password"]);
	$confirm_pass = trim($_POST["passwordc"]);
	
	//Google recaptcha
  	require_once('recaptchalib.php');
  	$privatekey = "6Le7dugSAAAAABeaW2v3-H3yTqMuW66Z8C40sm8H";
 	$resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

  	if(!$resp->is_valid) 
  	{
    	$errors[] = lang("CAPTCHA_FAIL");
  	} else 
	{
    // Your code here to handle a successful verification
  	}
 	
	if(minMaxRange(5,25,$username))
	{
		$errors[] = lang("ACCOUNT_USER_CHAR_LIMIT",array(5,25));
	}
	if(!ctype_alnum($username)){
		$errors[] = lang("ACCOUNT_USER_INVALID_CHARACTERS");
	}
	if(minMaxRange(3,25,$displayname))
	{
		$errors[] = lang("ACCOUNT_DISPLAY_CHAR_LIMIT",array(3,25));
	}
	//if(!ctype_alnum($displayname)){
	//	$errors[] = lang("ACCOUNT_DISPLAY_INVALID_CHARACTERS");
	//}
	if(minMaxRange(5,50,$password) && minMaxRange(5,50,$confirm_pass))
	{
		$errors[] = lang("ACCOUNT_PASS_CHAR_LIMIT",array(5,50));
	}
	else if($password != $confirm_pass)
	{
		$errors[] = lang("ACCOUNT_PASS_MISMATCH");
	}
	if(!isValidEmail($email))
	{
		$errors[] = lang("ACCOUNT_INVALID_EMAIL");
	}
	//End data validation
	if(count($errors) == 0)
	{	
		//Construct a user object
		$user = new User($username,$displayname,$password,$email,$firstname,$lastname,$grade,$lexile);
		
		//Checking this flag tells us whether there were any errors such as possible data duplication occured
		if(!$user->status)
		{
			if($user->username_taken) $errors[] = lang("ACCOUNT_USERNAME_IN_USE",array($username));
			if($user->displayname_taken) $errors[] = lang("ACCOUNT_DISPLAYNAME_IN_USE",array($displayname));
			if($user->email_taken) 	  $errors[] = lang("ACCOUNT_EMAIL_IN_USE",array($email));		
		}
		else
		{
			//Attempt to add the user to the database, carry out finishing  tasks like emailing the user (if required)
			if(!$user->userCakeAddUser())
			{
				if($user->mail_failure) $errors[] = lang("MAIL_ERROR");
				if($user->sql_failure)  $errors[] = lang("SQL_ERROR");
			}
		}
	}
	if(count($errors) == 0) {
		header("Location: account-success.php");
	}
}

require_once('template/foundationHeader.php');
echo "
<body>


<div class='row' id='content'>
		<div class='large-12 columns'>
			<h1>Create a Bookfall Account</h1>
		</div>
		<hr>	
	
	
	

<div class='large-12 columns'>";
 
echo resultBlock($errors,$successes);
  		
  		

echo "
<script type='text/javascript'>
 var RecaptchaOptions = {
    theme : 'clean'
 };
 </script>

	<div class='panel ' id='regbox'>
<form name='newUser' class='custom' id='newUser' action='".$_SERVER['PHP_SELF']."' method='post' data-abide>

			<h3>Create An Account</h3>
			<fieldset>
		<div class='row'>	
			<div class='large-5 small-12 columns'>
				<label>First Name:*</label>
				<input type='text' name='firstName' required/>
				<small class='error'>Please give us your first name.</small>
			</div>
			<div class='large-5 small-12 columns'>
				<label>Last Name:*</label>
				<input type='text' name='lastName' required/>
				<small class='error'>Please give us your last name.</small>
			</div>
			<div class='large-2 small-6 columns'>
				<label>Grade:*</label>
				<select name ='grade' class='expand'>
					<option  value=''>Choose your grade in school</option>
					<option  value='6'>6th</option>
					<option  value='7'>7th</option>
					<option  value='8'>8th</option>
					<option  value='9'>9th</option>
					<option  value='10'>10th</option>
					<option  value='11'>11th</option>
					<option  value='12'>12th</option>
				</select>	
				<small class='error'>Please enter your grade in school</small>
			</div>
		</div>	
			</fieldset>
			<fieldset>
		<div class='row'>	
			<div class='large-6 large-centered small-12 columns'>
				<span data-tooltip data-options: class='has-tip tip-top' title='Lexile is a measure of your reading level. Check with your teacher about your personal Lexile level.'><label>My personal Lexile Measure is...</label></span>
				<input type='number' name='lexile'/>
			</div>
			<div class='large-2 large-centered small-2 columns'>
			<h3>OR</h3>
			
			</div>
			 
			<div class='large-6 large-centered small-12 columns'>
			<label for='grade'>I don't know my personal Lexile measure...</label>
				<select name ='lexile' class='expand'>
					<option  value=''>Choose an answer that describes you</option>
					<option  value='685'>Books at school are hard</option>
					<option  value='1045'>Books at school seem just right</option>
					<option  value='1275'>Books at school seem a little easy</option>
					<option  value='1450'>Books at school seem way too easy</option>
				
				</select>
			
			
			</div>
			
		</div>
			
			
			
			
			</fieldset>
			<fieldset>
		<div class='row'>	
			<div class='large-6 columns'>
				<label>User Name:*</label>
				<p>(Enter a username that is between 5 and 20 characters)</p>
				<input type='text' name='username' required/>
				<small class='error'>A username is required</small>
			</div>
			<div class='large-6 columns'>
				<label>Display Name:*</label>
				<p>(The name that will be displayed when you visit the site)</p>
				<input type='text' name='displayname' required/>
				<small class='error'>Please enter a display name</small>
			</div>
		</div>	
			</fieldset>	
			<fieldset>
		<div class='row'>
			<div class='large-8 columns'>
				<label>Password:*</label>
				<p>(Passwords are case sensitive, must be between 6-15 characters, and must contain a number and at least one uppercase and lowercase letter.)</p>
				<input type='password' name='password' required/ required>
				<small class='error'>Password is case sensitive, between 6-12 characters, and must contain a number and at least one uppercase and lowercase letter</small>
			</div>
		</div>
		<div class='row'>	
			<div class='large-8 columns'>
				<label>Confirm:*</label>
				<p>(Retype your password)</p>
				<input type='password' name='passwordc' required/><small class='error'>Password is case sensitive, between 6-12 characters, and must contain a number and at least one uppercase and lowercase letter</small>
			</div>
		</div>	
			</fieldset>
			<fieldset>
		<div class='row'>	
			<div class='large-6 columns'>
				<label>Email:*</label>
				<input type='email' name='email' required/>
				<small class='error'>Please enter a valid email</small>
			</div>
			<div class='large-12 columns'><p>";
						require_once('recaptchalib.php');
						$publickey = "6Le7dugSAAAAABndNKr6Ju9WY9UlDxpGImsRh7Sl"; // you got this from the signup page
						echo recaptcha_get_html($publickey);
			echo "</p>
			</div>
		</div>	
			</fieldset>
			<div class='large-six columns'>
				<input class='button' type='submit' value='Register'/>
				</div>
			
			<div class='row'>
			</div>
</form>



</div>

</div>


";
include('template/foundationFooter.php');
?>
