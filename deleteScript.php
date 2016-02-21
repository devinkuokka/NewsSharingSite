<?php
	session_start();
	$user = $_SESSION['username'];
    $story_id = $_SESSION['story_id'];

    require "php_database.php"; 

    //delete comments associated with story
    $deleteComments = $mysqli -> prepare ("delete from comments
                                           where story_id = '$story_id'");
				
    if (!$deleteComments) {
        printf("Select Query Prep Failed: %s\n", $mysqli -> error);
        exit;
    }
    
    $deleteComments -> execute();				
    $deleteComments -> close();
    
    
    //delete story
    $deleteStory = $mysqli -> prepare ("delete from stories
                                        where story_id = '$story_id'");
				
    if (!$deleteStory) {
        printf("Select Query Prep Failed: %s\n", $mysqli -> error);
        exit;
    }
    
    $deleteStory -> execute();				
    $deleteStory -> close();
    
    
   
    
    header("Location:newsfeedPage.php");		    //redirects to newsfeed
    exit;  
?>