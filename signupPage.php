<!-- hash password -->



<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>SIGN UP</title>
		<link rel = "stylesheet" type = "text/css" href = "stylingSheet.css">
    </head>
	
	<div id = "header">
		<h1>Join Our Fam!</h1>
	</div>
    <body>
		<div id = "imageSection">
			
			<form action = "<?php echo htmlentities( $_SERVER['PHP_SELF'] ); ?>" method = "POST">
			<!--self-submitting form so that when incorrect username/password is entered, returns to same page-->
				
				<p>
					Please enter a username and password.<br>
					<br>
					
					<!--box to enter username-->
					<input type = "text" class = "textinput" name = "username" placeholder = "Username"
						   maxlength = "20" autocomplete = "off" required autofocus> <br>
					<br>
					
					<!--box to enter password-->
					<input type = "password" class = "textinput" name = "password" placeholder = "Password"
						   maxlength = "13" autocomplete = "off" required> <br> 			
					<br>
					
					<!--box to confirm password-->
					<input type = "password" class = "textinput" name = "confirmPassword" placeholder = "Confirm Password"
						   maxlength = "13" autocomplete = "off" required> <br>
					<br>
					
					<!--Submit button-->
					<input id = "submit" class = "button" type = "submit" value = "Submit">	<br>
					<br>
					
					<!--go back button-->
					<input id = "backButton" class = "button" type = "button" value = "Go Back"
						   onclick = "window.location = 'frontPage.php'"/>
				</p>
			</form>
			
			<?php
				//check a username, password and confirm password were entered
				if (isset ($_POST['username']) && isset ($_POST['password']) && isset ($_POST['confirmPassword'])) {		
					
					$username = $_POST['username'];			
					$passwordHash = password_hash($_POST['password'],PASSWORD_DEFAULT);
					$confirmPassword = $_POST['confirmPassword'];
					//check that username is valid
					
					
					//check that password and confirm password match
					if (password_verify('$confirmPassword', $passwordHash)) {
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
												   values ('$username', '$passwordHash')");
					
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
		</div>
		
		<div id = "footer">
			<i>Copyright</i> &copy; Carolyn Dean Wolf & Devin Kuokka
		</div>
    </body>
</html>