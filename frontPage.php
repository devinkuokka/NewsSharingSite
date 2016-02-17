<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>Login</title>
		
		<style>
			body { background-color: #9EDDAC; margin-top: 80px; font-family: Helvetica, Arial, sans-serif; }
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
            <input type = "button"
                   value = "Login"
                   style="display: block; margin: 0 auto;"
                   onclick = "window.location = 'loginPage.php'"/>			
           
            <!--sign up button-->
            <input id = "signupButton"
                   type = "button"                              
                   value = "Sign Up"
                   style="display: block; margin: 0 auto;"
                   onclick = "window.location = 'signupPage.php'"/>
			
		</form>
    </body>
</html>