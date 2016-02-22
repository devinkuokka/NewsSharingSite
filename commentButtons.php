<?php
	session_start();
    $comment_id = $_SESSION['comment_id'];
	
?>

<!DOCTYPE html>
<html>
    <body>
		<div id = "commentButtons">
		<!--logout button-->
        <input id = "<?php echo "editButton".$comment_id; ?>"
               data-commentid = "<?php echo $comment_id; ?>"
               type = "button"
               class= "editButton"
			   value = "Edit"
		/> 
		
		<!--new story button-->
		<input id = "<?php echo "deleteButton".$comment_id; ?>"
               data-commentid = "<?php echo $comment_id; ?>"
			   type = "button"
               class= "deleteButton"
			   value = "Delete"
			   
		/>
		</div>
		<br>
		<hr>
	</body>
</html>