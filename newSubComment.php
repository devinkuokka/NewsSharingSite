<?php
	session_start();
	$user = $_SESSION['username'];
	$story_id = $_SESSION['story_id'];
?>

<html>
        <form id = "subComment" action = "postSubComment.php" method = "POST">
			<!--box to add text-->
            <br>
            <label for = "subComment">Sub-Comment</label> <br>
            <textarea id = "subComment" class = "textinput" name = "subComment" placeholder = "Enter sub-comment here..."
                      cols = 100 rows = 5 autocomplete="off" required autofocus></textarea> <br> 		
			<br>
            
            <!--submit button-->
			<input id = "submit" class = "button" name = "submit" type = "submit" value = "Submit">	<br>
            <br>

		</form>
</html>


