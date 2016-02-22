<?php
	session_start();
    $comment_id = $_SESSION['comment_id'];
	
?>

<!DOCTYPE html>
<html>
    <body>
		
		<!--logout button-->
        <input id = "<?php echo "editButton".$comment_id; ?>"
               data-commentid = "<?php echo $comment_id; ?>"
               type = "button"
               class= "editButton"
			   value = "Edit"
		/> <br>
		
		<!--new story button-->
		<input id = "<?php echo "deleteButton".$comment_id; ?>"
               data-commentid = "<?php echo $comment_id; ?>"
			   type = "button"
               class= "deleteButton"
			   value = "Delete"
			   
		/>
	</body>
</html>