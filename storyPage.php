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
		
		<link rel = "stylesheet" type = "text/css" href = "storyPageStyle.css">
        <script type = "text/javascript">
            document.addEventListener('DOMContentLoaded', function () {
                buttons = document.getElementsByClassName("editButton");
                for (var i = 0; i < buttons.length; i++) {
                    buttons[i].onclick = function() {
                        window.location = "editCommentPage.php?comment_id=" + this.dataset.commentid;
                    }
                }
            })
        </script>

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
            
 
            //checks if user wrote the story, if true gives edit and delete options
            if ($user == $storyAuthor) {
                include "storyButtons.html";
            }
            
            
            
            //FIX ADDING COMMENT!!!!
            if ($user !== null) {
                include "newComment.php";
            }
            
            
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
					printf(
                        "<p id = comment>%s<br>%s</p>",
                        $comment,
                        $commentAuthor
                    );
                    
                    //checks if user wrote the comment, if true gives edit and delete options
                    if ($user == $commentAuthor) {
                        $_SESSION['comment_id'] = $comment_id;
                        include "commentButtons.php";
                        echo "<br><br>";
                    }
                    
				}
				
				$showComments -> close();
		?>
    </body>
</html>