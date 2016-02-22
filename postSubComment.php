<?php
    session_start();
	$user = $_SESSION['username'];
	$story_id = $_SESSION['story_id'];	
	
	require "php_database.php"; 
	
    if (!empty ($_POST['comment']) && $_POST['comment'] !== " ") {		
        $comment = $_POST['comment'];	
        
        $addComment = $mysqli -> prepare ("insert into comments (user, story_id, comment)
                                          values ('$user', '$story_id', '$comment')");
        
        if (!$addComment) {
            echo "Insert Query Prep Failed: %s\n", $mysqli -> error;
            exit;
            
        } else { 
            $addComment -> bind_param ('sss', $user, $story_id, $comment);
            $addComment -> execute();
            $addComment -> close();
			
			header("Location: storyPage.php?story_id=".$story_id);		    //redirects to story page
			exit;
		}
    
    }
    
    if (isset ($_POST['submit']) && empty ($_POST['comment'])) {
        header("Location: storyPage.php?story_id=%s",$story_id);		    //redirects to story page
		printf ("<p id = warning>Please enter a comment before submitting.<p>");
        exit;
    }
	
	
    exit;
?>