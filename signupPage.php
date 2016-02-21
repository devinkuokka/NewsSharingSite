<!-- hash password -->



<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>SIGN UP</title>
		
		<style>
			body { background-color: #9EDDAC; margin-top: 80px; }
			p { text-align: center; font-family: Helvetica, Arial, sans-serif; color: #00516B } 
		</style>
    </head>
	
    <body>
        <form action = "<?php echo htmlentities( $_SERVER['PHP_SELF'] ); ?>" method = "POST">
		<!--self-submitting form so that when incorrect username/password is entered, returns to same page-->
			
			<p>
                Please enter a username and password.<br>
				<br>
				
				<!--box to enter username-->
				<input type = "text" name = "username" placeholder = "Username"
					   maxlength = "20" autocomplete = "off" required autofocus> <br>
				<br>
				
				<!--box to enter password-->
				<input type = "password" name = "password" placeholder = "Password"
					   maxlength = "13" autocomplete = "off" required> 			
                <br>
				
				<!--box to confirm password-->
				<input type = "password" name = "confirmPassword" placeholder = "Confirm Password"
					   maxlength = "13" autocomplete = "off" required> <br>
				<br>
				
				<!--Submit button-->
				<input type = "submit" value = "Submit">								
			</p>
		</form>
		
		<?php
			//check a username, password and confirm password were entered
			if (isset ($_POST['username']) && isset ($_POST['password']) && isset ($_POST['confirmPassword'])) {		
                
				$username = $_POST['username'];			
				$password = $_POST['password'];
				$confirmPassword = $_POST['confirmPassword'];
                
				//check that username is valid
				
				
				//check that password and confirm password match
				if ($password !== $confirmPassword) {
					echo "<p>Passwords do not match. Please try again.</p>";
					exit;
				}
				
				//conect to mod3_newsWebsite as php_user		
				require 'php_database.php';
				
				$isNewUser = $mysqli -> prepare ("select username
												 from login_info
												 where username = '$username'");
				
				if (!$isNewUser) {
					echo "Select Query Prep Failed: %s\n", $mysqli -> error;
					exit;
				}
				
				$isNewUser -> execute();
				$isNewUser -> bind_result($usernameResult);
				$isNewUser -> fetch();
				$isNewUser -> close();

				
				//check that username is unique
				if ($usernameResult !== null) {
					echo "<p>Username is already taken. Please try another.</p>";
					exit;
				} 
				
				$addUser = $mysqli -> prepare ("insert into login_info (username, password)
											   values ('$username', '$password')");
				
				if (!$addUser) {
					echo "Insert Query Prep Failed: %s\n", $mysqli->error;
					exit;
				}
				 
				$addUser -> bind_param ('ss', $username, $password);
				$addUser -> execute();
				$addUser -> close();
			
				$_SESSION['username'] = $username;				//creates and sets the session variable, username
				
				header("Location: newsfeedPage.php");		    //redirects to newsfeed
			}	
		?>	
    </body>
</html>