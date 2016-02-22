<?php
	session_start();
	$user = $_SESSION['username'];
    $pass_story_id = $_GET['story_id'];
    $_SESSION['story_id'] = $pass_story_id;
    $story_id = $_SESSION['story_id'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>STORY</title>
		
		<link rel="stylesheet" type="text/css" href="stylingSheet.css">

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
				   onclick = "window.location = 'newsfeedPage.php'"
			/>
		</div>
        
        <div id = "leftSection">
            <?php
                require "php_database.php";
                
                //displays the selected story (title, text, link, and author)
                $showStory = $mysqli -> prepare ("select user, title, text, link
                                                 from stories
                                                 where story_id = '$story_id'");
                    
                    if (!$showStory) {
                        printf("Select Query Prep Failed: %s\n", $mysqli -> error);
                        exit;
                    }
                    
                    $showStory -> execute();
                    $showStory -> bind_result($storyAuthor, $title, $text, $link);
                    
                    $showStory -> fetch();
                    
                    
                    printf("<span id = title>%s</span>
                           <span id = user>submitted by %s</span> <br> <br>
                           <span id = text>%s</span> <br> <br>
                           <a id = link href = %s >%s</a> <br> <br>",
                           $title, $user, $text, $link, $link);
                    
                    $showStory -> close();
                
     
                //checks if user wrote the story, if true gives edit and delete options
                if ($user == $storyAuthor) {
                    include "storyButtons.html";
                }
                
                
                //if registered user, allows to post comment on story
                if ($user !== null) {
                    include "newComment.php";
                }
                
               echo "<p id = commentHeader>Comments</p>";
                
                //displays all comments on selected story
                $showComments = $mysqli -> prepare ("select comment_id, user, comment
                                                    from comments
                                                    where story_id = '$story_id'");
                    
                    if (!$showComments) {
                        printf("Select Query Prep Failed: %s\n", $mysqli -> error);
                        exit;
                    }
                    
                    $showComments -> execute();
                    $showComments -> bind_result($comment_id, $commentAuthor, $comment);
                
                    while ($showComments -> fetch()) {
                        printf("<a href = 'commentPage.php?comment_id=%s'>%s</a> <span id = 'user'>submitted by %s</span> <br> <br>",
                            $comment_id, $comment, $commentAuthor);
                    }
                    
                    $showComments -> close();
            ?>
            
        </div>
		
		<div id = "footer">
			<i>Copyright</i> &copy; Carolyn Dean Wolf & Devin Kuokka
		</div>
            
    </body>
</html>