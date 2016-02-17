<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>NEW STORY</title>
		
		<style>
			body { background-color: #9EDDAC; margin-top: 80px; }
			p { text-align: center; font-family: Helvetica, Arial, sans-serif; } 
		</style>
    </head>
	
    <body>
        
        Submit a new story: <br>
        
        <form action = "newsfeedPage.php" method = "POST">
            <br>
            <label for="title">Title</label> <br>
            <input type = "text" name = "title"/> <br>			<!--box to enter username-->
            <br>
            <label for="text">Text (optional)</label> <br>
            <input type = "text" name = "text"/> <br> 			<!--box to enter password-->
            <br>
            <label for="link">Link (optional)</label> <br>
            <input type = "password" name = "link"/> <br> 	    <!--box to confirm password-->
            <br>
            <input type = "submit" value = "Submit"/>			<!--Submit button-->

		</form>
        
        
        <?php
            require "php_user.php";
            
            
            
        
        
        ?>
        
    </body>
</html>