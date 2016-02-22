<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>Login</title>
		<link rel="stylesheet" type="text/css" href="stylingSheet.css">
    </head>
	
    <body>
		<div id = "header">
			<h> Betterit (Reddit 2.0)</h>
		</div>
		
		<div id = "imageSection">
			<form>	
				<!--login button-->
				<input id = "loginButton"
					   type = "button"
					   value = "Login"
					   onclick = "window.location = 'loginPage.php'"
				/> <br>	
			   
				<!--sign up button-->
				<input id = "signupButton"
					   type = "button"                              
					   value = "Sign Up"
					  
					   onclick = "window.location = 'signupPage.php'"
				/> <br><br>
				
				<!--continue as guest button-->
				<input id = "guestButton"
					   type = "button"                              
					   value = "Continue as Guest"
					   
					   onclick = "window.location = 'newsfeedPage.php'"
				/>
			</form>
		</div>
		<div id = "footer">
			<i>Copyright</i> &copy; Carolyn Dean Wolf & Devin Kuokka
		</div>
    </body>
</html>