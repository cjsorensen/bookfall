<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

if (!securePage($_SERVER['PHP_SELF'])){die();}

//Links for logged in user
if(isUserLoggedIn()) {
	echo "
	
		<div class='large-8 columns'>
			<div class='section-container horizontal-nav' data-section='horizontal-nav'>
				<section>
					<p class='title' data-section-title><a href='#'>User Menu 1</a></p>
						<div class='content' data-section-content>
							<ul class='side-nav'>
								<li class='active'><a href='index.php'>Home</a></li>
								<li><a href='user_settings.php'>User Settings</a></li>
								<li><a href='logout.php'>Logout</a></li>
							</ul>
						</div>
				</section>
			
	";
	
	//Links for permission level 2 (default admin)
	if ($loggedInUser->checkPermission(array(2))){
	echo "
			<section>
				<p class='title' data-section-title><a href='#'>Admin Menu </a></p>
				<div class='content' data-section-content>
					<ul class='side-nav'>
						<li><a href='admin_configuration.php'>Admin Configuration</a></li>
						<li><a href='admin_users.php'>Admin Users</a></li>
						<li><a href='admin_permissions.php'>Admin Permissions</a></li>
						<li><a href='admin_pages.php'>Admin Pages</a></li>
					</ul>
				</div>
			</section>
	
	";
	}
	//containing divs for menu section
	echo "</div>
		</div>";
	
} 
//Links for users not logged in
else {
	echo "
	
	<div class='large-8 columns'>
			<div class='section-container horizontal-nav' data-section='horizontal-nav'>
				<section>
					<p class='title' data-section-title><a href='#'>User Menu 1</a></p>
						<div class='content' data-section-content>
							<ul class='side-nav'>
								<li><a href='index.php'>Home</a></li>
								<li><a href='login.php'>Login</a></li>
								<li><a href='register.php'>Register</a></li>
								<li><a href='forgot-password.php'>Forgot Password</a></li>";
									//if ($emailActivation)
//											{
//											echo "
//											<li><a href='resend-activation.php'>Resend Activation Email</a></li>
//											";
//											}
					echo  "</ul>
						</div>
				</section>
		
	";

	echo "</ul>
		</div>
	";
}

?>
