<?php
	session_start();
	$user = $_SESSION['username'];
    $story_id = $_SESSION['story_id'];
    $commentToEdit_id = $_SESSION['commentToEdit_id'];
    
    require "php_database.php"; 

    //delete specific comment
    $deleteComment = $mysqli -> prepare ("delete from comments
                                         where comment_id = '$commentToEdit_id'");
            
    if (!$deleteComment) {
        printf("Select Query Prep Failed: %s\n", $mysqli -> error);
        exit;
    }
        
    $deleteComment -> execute();				
    $deleteComment -> close();
    
    header("Location: storyPage.php?story_id=" . $story_id);		//redirects back to story page
    exit;
        
   
?>