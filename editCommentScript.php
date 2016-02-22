<?php
	session_start();
	$user = $_SESSION['username'];
	$story_id = $_SESSION['story_id'];	
?>

<html>
        <br>
        <form id = "comment" method = "POST">
			<!--box to add text-->
            <textarea id = "commentBox" class = "textinput" name = "comment"
                      cols = 100 rows = 5 autocomplete="off" required autofocus><?php echo $comment; ?></textarea> <br> 		
			<br>
            
            <!--submit button-->
			<input id = "update" class = "button" name = "update" type = "submit" value = "Update">				

		</form>
        
        <?php
            require "php_database.php";
			
            //checks that comment has content
            $isBlank = preg_replace('/\s+/', '', $_POST['comment']);
            
			if (!empty ($_POST['comment']) && strlen($isBlank) > 0) {		
				$comment = $_POST['comment'];
                
				$editComment = $mysqli -> prepare ("update comments
                                                    set comment = '$comment'
                                                    where comment_id = '$comment_id'");
				
				if (!$editComment) {
					echo "Insert Query Prep Failed: %s\n", $mysqli -> error;
					exit;
					
				} else { 
					$editComment -> bind_param ('s', $comment);
					$editComment -> execute();
					$editComment -> close();
				
					//header("Location: storyPage.php?story_id=" . $story_id);		//redirects back to story page
					//exit;
				}
			}
			
			if (isset ($_POST['update']) && empty ($_POST['comment'])) {
				printf ("<p id = warning>You cannot sumbit a blank comment.<p>");
				exit;
			}
				
			
		?>
        
</html>