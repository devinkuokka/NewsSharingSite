<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>Login</title>
		<link rel="stylesheet" type="text/css" href="stylingSheet.css">
    </head>
	
    <body>
		<div id = "header">
			<h1> Betterit (Reddit 2.0)</h1>
		</div>
		
		<div id = "imageSection">
			<form>	
				<!--login button-->
				<input id = "loginButton"
					   class = "button"
					   type = "button"
					   value = "Login"
					   onclick = "window.location = 'loginPage.php'"
				/> <br> <br>	
			   
				<!--sign up button-->
				<input id = "signupButton"
					   class = "button"
					   type = "button"                              
					   value = "Sign Up"
					   onclick = "window.location = 'signupPage.php'"
				/> <br> <br>
				
				<!--continue as guest button-->
				<input id = "guestButton"
					   class = "button"
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