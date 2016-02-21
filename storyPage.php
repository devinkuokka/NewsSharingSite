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
		
		<link rel="stylesheet" type="text/css" href="storyPageStyle.css">
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
			
			$showStory = $mysqli -> prepare ("select user, title, text, link
											 from stories
                                             where story_id = '$story_id'");
				
				if (!$showStory) {
					printf("Select Query Prep Failed: %s\n", $mysqli -> error);
					exit;
				}
				
				$showStory -> execute();
				$showStory -> bind_result($author, $title, $text, $link);
				
				
				
				$showStory -> fetch();
				printf(
                    "<p id = title>%s</p>
                    <p id = text>%s</p>
                    <a id = link href = %s >%s</a> <br> <br>",
                    $title,
                    $text,
                    $link,
                    $link
                );
				
				$showStory -> close();
            
 
       
            if ($user == $author) {
                include "editButton.html";
            }
            
            
            
            //FIX ADDING COMMENT!!!!
            if ($user !== null) {
                include "newComment.php";
            }
            
            $showComments = $mysqli -> prepare ("select user, comment
                                                from comments
                                                where story_id = '$story_id'");
				
				if (!$showComments) {
					printf("Select Query Prep Failed: %s\n", $mysqli -> error);
					exit;
				}
				
				$showComments -> execute();
				$showComments -> bind_result($user, $comment);
			
                while ($showComments -> fetch()) {
					printf(
                        "<p id = user>%s</p>
                        <p id = comment>%s</p> <br>",
                        $user,
                        $comment
                    );
				}
				
				$showComments -> close();
		?>
    </body>
</html>