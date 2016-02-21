<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>LOGIN</title>
		
		<style>
			body { background-color: #9EDDAC; margin-top: 80px; color: #004055; }
			p { text-align: center; font-family: Helvetica, Arial, sans-serif; }
			#warning { color: #C61E1E; }
		</style>
    </head>
	
    <body>
        <form action = "<?php echo htmlentities( $_SERVER['PHP_SELF'] ); ?>" method = "POST">
		<!--self-submitting form so that when incorrect username is entered, returns to same page-->
			
			<p>
				Please enter your username and password.
                <br>
                <br>
                <label for="password">Username:</label>
                <input type = "text" name = "username"/> 	<!--box to enter username-->
				<br>
                <br>
                <label for="password">Password:</label>
                <input type = "password" name = "password"/> 	<!--box to enter password-->
                <br>
				<br>
				<input type = "submit" value = "Login"/>			<!--login button-->
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
    </body>
</html>