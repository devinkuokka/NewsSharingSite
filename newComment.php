<?php
	session_start();
	$user = $_SESSION['username'];
	$story_id = $_SESSION['story_id'];	
?>

<html>
        <br>
        <form id = "comment" action = "postComment.php" method = "POST">
			<!--box to add text-->
            <label for = "comment">Comment</label> <br>
            <textarea id = "comment" name = "comment" placeholder = "Enter comment here..."
                      cols = 100 rows = 5 autocomplete="off" required autofocus></textarea> <br> 		
			<br>
            
            <!--submit button-->
			<input id = "submit" name = "submit" type = "submit" value = "Submit">				

		</form>
</html>