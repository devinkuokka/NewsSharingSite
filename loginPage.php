<?php
	session_start();

	$uploadMsg = "";						
	$_SESSION['uploadMsg'] = $uploadMsg;		//creates session variable that will be the message returned after uploading a file
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>Login</title>
		
		<style>
			body { background-color: #9EDDAC; margin-top: 80px; }
			p { text-align: center; font-family: Helvetica, Arial, sans-serif; } 
		</style>
    </head>
	
    <body>
        <form action = "<?php echo htmlentities( $_SERVER['PHP_SELF'] ); ?>" method = "get">
		<!--self-submitting form so that when incorrect username is entered, returns to same page-->
			
			<p>
				Please enter your username and password.
                <br>
                Username: <input type = "text" name = "username"/> 	<!--box to enter username-->
				Password: <input type = "text" name = "password"/> 	<!--box to enter password-->
                <br>
				<br>
				<input type = "submit" value = "Login"/>			<!--login button-->
			</p>
		</form>
		
		<?php
			if (isset ($_GET['username']) && isset ($_GET['password'])) {		//checks a username & password were entered
                $username = $_GET['username'];			
				$password = $_GET['password'];
                
                $conn = new mysqli("localhost", "php_user", "php_pass", "mod3_newsWebsite");
				if ($mysqli -> connect_errno) {
					printf("Connection Failed: %s\n", $mysqli->connect_error);
					exit;
				}
				
                $isUser = mysql_query ("SELECT username, password FROM login_info
                                       where username = $username and password = $password");
                if ($isUser) {
                    $conn = new mysqli("localhost", $username, $password, "mod3_newsWebsite");
                    if ($mysqli -> connect_errno) {
						printf("Connection Failed: %s\n", $mysqli->connect_error);
						exit;
					}
                } else {
                    die("Invalid Login!");
                }
                
                
                
				
                while (!feof($file)) {							//checks if at end of file
                    $isUser = trim(fgets($file));				//if not, gets next valid username from file (& trims whitespace)
                    
					if ($isUser == $username) {					//compares inputted username to next valid username 
                         $_SESSION['username'] = $username;		//creates and sets the session variable, username
                         header("Location: userFiles.php");		//if inputted username matches, redirects to user's files
                         exit;
                    } else {
                        $lineNum++;								//else increments lineNum to next line in file
                    }
                }
				
				fclose($file);														//closes file
				
				echo "<p> Nice try, sucker!  Please enter a valid username. </p>";	//prints if inputted user name is invalid
            }
		?>	
    </body>
</html>