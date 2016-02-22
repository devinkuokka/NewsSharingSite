<?php
	session_start();
	$user = $_SESSION['username'];
    $story_id = $_SESSION['story_id'];
    $commentToEdit_id = $_SESSION['comment_id'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>EDIT COMMENT</title>
		
		<link rel = "stylesheet" type = "text/css" href = "storyPageStyle.css">
    </head>
	
    <body>
        <!--newsfeed button-->
		<input id = "newsfeedButton"
			   type = "button"                              
			   value = "Newsfeed"
			   onclick = "window.location = 'newsfeedPage.php'"
		/> <br>
        
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
				
                
                printf("<p id = title>%s</p>
                       <p id = text>%s</p>
                       <a id = link href = %s >%s</a> <br> <br>",
                       $title,
                       $text,
                       $link,
                       $link
                );
				
				$showStory -> close();
   
   
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
					
                    //check if comment is comment to edit
                    if ($comment_id == $commentToEdit_id) {
                        $_SESSION['comment_id'] = $comment_id;
                        include "editCommentScript.php";
                        echo "<br><br>";
                    
                    } else {
                        printf(
                            "<p id = comment>%s<br>%s</p>",
                            $comment,
                            $commentAuthor
                        );
                    }
				}
				
				$showComments -> close();
		?>
    </body>
</html>