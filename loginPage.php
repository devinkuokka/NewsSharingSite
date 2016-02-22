<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>LOGIN</title>
		
		<link rel = "stylesheet" type = "text/css" href = "stylingSheet.css">
    </head>
	<div id = "header">
		<h>Welcome Back!</h>
	</div>
	
    <body>
		<div id = "imageSection">
			<form action = "<?php echo htmlentities( $_SERVER['PHP_SELF'] ); ?>" method = "POST">
			<!--self-submitting form so that when incorrect username is entered, returns to same page-->
				
				<p>
					Please enter your username and password. <br>
					<br>
					
					<!--box to enter username-->
					<input type = "text" class = "textinput" name = "username" placeholder = "Username" required autofocus> <br>
					<br>
					
					<!--box to enter password-->
					<input type = "password" class = "textinput" name = "password" placeholder = "Password" required> <br>
					<br>
					
					<!--login button-->
					<input id = "submit" class = "button" type = "submit" value = "Login"> <br>
					<br>
					
					<!--go back button-->
					<input id = "backButton" class = "button" type = "button" value = "Go Back"
						   onclick = "window.location = 'frontPage.php'"/>						
				</p>
			</form>
			
			<?php
				if (isset ($_POST['username']) && isset ($_POST['password'])) {		//checks a username & password were entered
					$username = $_POST['username'];			
					$password = $_POST['password'];
				  
	 
					//conect to mod3_newsWebsite as php_user
					require 'php_database.php';
					
					$isUser = $mysqli -> prepare ("select username, password
												  from login_info
												  where username = '$username' and password = '$password'");
				   
					if (!$isUser) {
						echo "Select Query Prep Failed: %s\n", $mysqli -> error;
						exit;
					}
					
					$isUser -> execute();
					$isUser -> bind_result($usernameResult, $passwordResult);
					$isUser -> fetch();
					$isUser -> close();
					
					//check that username and password are valid 
					if ($usernameResult == null && $passwordResult == null) {
						printf(
							"<p id = 'warning'>
								Invalid Login. Please try again.
						   </p>"
						);
						exit;
					}
		 
					$_SESSION['username'] = $username;				//creates and sets the session variable, username
					
					header("Location: newsfeedPage.php");		    //redirects to newsfeed
					
				}
			?>
		</div>
	
		<div id = "footer">
			<i>Copyright</i> &copy; Carolyn Dean Wolf & Devin Kuokka
		</div>
    </body>
</html>