<?php
	session_start();
	$user = $_SESSION['username'];
	$story_id = $_SESSION['story_id'];	
?>

<html>
        <form id = "comment" action = "postComment.php" method = "POST">
			<label for = "comment">Comment</label> <br>
            <textarea id = "comment" name = "comment" cols = 100 rows = 5/> </textarea> <br> 		<!--box to add text-->
			<br>
			<input id = "submit" name = "submit" type = "submit" value = "Submit"/>				<!--submit button-->

		</form>
</html>