<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Prevent the user visiting the logged in page if he/she is already logged in
if(isUserLoggedIn()) { header("Location: myBooks.php"); die(); }

//Forms posted
if(!empty($_POST))
{
	$errors = array();
	$email = trim($_POST["email"]);
	$password = trim($_POST["password"]);
	
	
	
	//Perform some validation
	//Feel free to edit / change as required
	if($email == "")
	{
		$errors[] = lang("ACCOUNT_SPECIFY_USERNAME");
	}
	if($password == "")
	{
		$errors[] = lang("ACCOUNT_SPECIFY_PASSWORD");
	}

	if(count($errors) == 0)
	{
		//A security note here, never tell the user which credential was incorrect
		if(!emailExists($email))
		{
			$errors[] = lang("ACCOUNT_USER_OR_PASS_INVALID");
		}
		else
		{
			$userdetails = fetchUserDetails(NULL, NULL, NULL, $email);
			//See if the user's account is activated
			if($userdetails["active"]==0)
			{
				$errors[] = lang("ACCOUNT_INACTIVE");
			}
			else
			{
				//Hash the password and use the salt from the database to compare the password.
				$entered_pass = generateHash($password,$userdetails["password"]);
				
				if($entered_pass != $userdetails["password"])
				{
					//Again, we know the password is at fault here, but lets not give away the combination incase of someone bruteforcing
					$errors[] = lang("ACCOUNT_USER_OR_PASS_INVALID");
				}
				else
				{
					//Passwords match! we're good to go'
					
					//Construct a new logged in user object
					//Transfer some db data to the session object
					$loggedInUser = new loggedInUser();
					$loggedInUser->email = $userdetails["email"];
					$loggedInUser->user_id = $userdetails["id"];
					$loggedInUser->hash_pw = $userdetails["password"];
					$loggedInUser->title = $userdetails["title"];
					$loggedInUser->displayname = $userdetails["display_name"];
					$loggedInUser->username = $userdetails["user_name"];
					
					//Update last sign in
					$loggedInUser->updateLastSignIn();
					$_SESSION["userCakeUser"] = $loggedInUser;
					
					//Redirect to user account page
					header("Location: myBooks.php");
					die();
				}
			}
		}
	}
}

require_once("models/header.php");

echo "
<body>

<div id='wrapper'>

<div class='row' id='content'>
<h1>Login to Bookfall</h1>
<hr>
";





echo "
<div class='large-4 columns'>
	<p>You need to have an account to use bookfall.  Don't have an account? <a href='register.php'>Sign up for free!</a>
</div>


<div class='large-8 columns' id='main'>";

echo resultBlock($errors,$successes);

echo "
<div class='panel' id='regbox'>
<form name='login' action='".$_SERVER['PHP_SELF']."' method='post'>

<div class=''>
<p>
<label>Email:</label>
<input type='text' name='email' />
</p>
<p>
<label>Password:</label>
<input type='password' name='password' />
</p>
<p>
<input class='button' type='submit' value='Login' class='submit' /> </p>
<p><a href='forgot-password.php'>Forgot your password?</a></p>

</div>
</form>
</div>
</div>

</div>
<a class='close-reveal-modal'>&#215;</a>
";
require_once('template/foundationFooter.php');

?>
