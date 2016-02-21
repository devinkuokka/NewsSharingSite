<!DOCTYPE html>
<html>
    <body>
		<!--logout button-->
		<input id = "editButton"
			   type = "button"                              
			   value = "Edit"
			   onclick = "window.location = <?php echo'editPage.php?comment_id='. $comment_id; ?>"
		/> <br>
		
		<!--new story button-->
		<input id = "deleteButton"
			   type = "button"                              
			   value = "Delete"
			   onclick = "window.location = <?php echo'deleteScript.php?comment_id='. $comment_id; ?>"
		/>
	</body>
</html>