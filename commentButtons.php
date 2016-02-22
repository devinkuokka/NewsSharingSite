<?php
	session_start();
    $comment_id = $_SESSION['comment_id'];
	
?>

<script type = "text/javascript">
    var comment_id = "<?php echo $comment_id ?>";
</script>

<!DOCTYPE html>
<html>
    <body>
		
		<!--logout button-->
		<input id = "editButton"
               name = "<?php echo 'editPage.php?comment_id=',$comment_id; ?>"
			   type = "button"                              
			   value = "Edit"
			   onclick = "window.location = 'editCommentRedirect.php'"
		/> <br>
		
		<!--new story button-->
		<input id = "deleteButton"
			   type = "button"                              
			   value = "Delete"
			   onclick = "window.location = 'deleteCommentScript.php?comment_id='+comment_id;"
		/>
	</body>
</html>