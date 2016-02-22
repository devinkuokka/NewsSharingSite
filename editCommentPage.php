<?php
	session_start();
	$user = $_SESSION['username'];
    $story_id = $_SESSION['story_id'];
    
    $commentToEdit_id = $_SESSION['commentToEdit_id'];
    $commentToEdit = $_SESSION['commentToEdit'];
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>EDIT COMMENT</title>
		
		<link rel="stylesheet" type="text/css" href="stylingSheet.css">
        
        <script type = "text/javascript">
            var comment_id = <?php echo $commentToEdit_id ?>;
        </script>
    </head>
	
    <body>
        <div id = "header">
			
		</div>
        
        <div id = "nav">
			<!--logout button-->
			<input id = "logoutButton"
				   class = "button"
				   type = "button"                              
				   value = "Logout"
				   onclick = "window.location = 'logoutScript.php'"
			/> <br> <br>
			
			<!--go back button-->
			<input id = "backButton"
				   class = "button"
				   type = "button"                              
				   value = "Go Back"
				   onclick = "window.location = 'commentPage.php?comment_id='+comment_id"
			/>
		</div>
        
        <div id = "leftSection">
            <form id = "comment" action = "<?php echo htmlentities( $_SERVER['PHP_SELF'] ); ?>" method = "POST">
			<!--box to add text-->
            <textarea id = "commentBox" class = "textinput" name = "comment"
                      cols = 100 rows = 5 autocomplete="off" required autofocus><?php echo $commentToEdit; ?></textarea> <br> 		
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
                                                    where comment_id = '$commentToEdit_id'");
				
				if (!$editComment) {
					echo "Insert Query Prep Failed: %s\n", $mysqli -> error;
					exit;
					
				} else { 
					$editComment -> bind_param ('s', $comment);
					$editComment -> execute();
					$editComment -> close();
				
					header("Location: commentPage.php?comment_id=" . $commentToEdit_id);		//redirects back to comment page
					exit;
				}
			}
			
			if (isset ($_POST['update']) && empty ($_POST['comment'])) {
				printf ("<p id = warning>You cannot sumbit a blank comment.<p>");
				exit;
			}
				
			
		?>
  
   
        </div>
    </body>
</html>