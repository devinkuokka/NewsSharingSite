<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>Login</title>
		
		<style>
			body { background-color: #9EDDAC; margin-top: 80px; font-family: Helvetica, Arial, sans-serif; color: #004055; }
			p { text-align: center; } 
           
        </style>
    </head>
	
    <body>          
        <form>
			<p>
                Welcome Message...
                Please Login or Sign Up...
            </p>
				
            <!--login button-->
            <input id = "loginButton"
				   type = "button"
                   value = "Login"
                   style = "display: block; margin: 0 auto;"
                   onclick = "window.location = 'loginPage.php'"
			/>		
           
            <!--sign up button-->
            <input id = "signupButton"
                   type = "button"                              
                   value = "Sign Up"
                   style = "display: block; margin: 0 auto;"
                   onclick = "window.location = 'signupPage.php'"
			/> <br>
			
			<!--continue as guest button-->
            <input id = "guestButton"
                   type = "button"                              
                   value = "Continue as Guest"
                   style = "display: block; margin: 0 auto;"
                   onclick = "window.location = 'newsfeedPage.php'"
			/>
			
			
		</form>
    </body>
</html>