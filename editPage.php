<?php
	session_start();
	$story_id = $_SESSION['story_id'];
	
	
	//conect to mod3_newsWebsite as php_user		
	require 'php_database.php';
	
	$editStory = $mysqli -> prepare ("select title, text, link
									 from stories
									 where story_id = '$story_id'");
	
	if (!$editStory) {
		echo "Select Query Prep Failed: %s\n", $mysqli -> error;
		exit;
	}
	
	$editStory -> execute();
	$editStory -> bind_result($title, $text, $link);
	$editStory -> fetch();
	$editStory -> close();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>EDIT STORY</title>
		
		<link rel="stylesheet" type="text/css" href="newStoryPageStyle.css">
    </head>
	
    <body>
        
        <p id = "pageTitle">
			Edit Story <br>
		<p>
        
        <form id = "storyText" action = "<?php echo htmlentities( $_SERVER['PHP_SELF'] ); ?>" method = "POST">
            <!--box to edit title-->
			<label for = "title">Title</label> <br>
            <input id = "titleBox" type = "text" name = "title" value = "<?php echo htmlentities($title); ?>"
				   maxlength = "255" autocomplete = "off" required autofocus> <br>	
			<br>
            
			<!--box to edit/add text-->
			<label for = "text">Text <i>(optional)</i> </label> <br>
            <textarea id = "textBox" name = "text"
					  cols = 500 rows = 10 autocomplete = "off"><?php echo $text; ?></textarea> <br> 		
			<br>
            
			<!--box to to edit/add link-->
			<label for = "link">Link <i>(optional)</i> </label> <br>
            <textarea id = "linkBox" name = "link"
					  cols = 500 rows = 2 autocomplete = "off"><?php echo $link; ?></textarea> <br> 	  			 
			<br>
            
			<!--submit button-->
			<input id = "submit" name = "submit" type = "submit" value = "Submit">						

		</form>
		
        <?php
            require "php_database.php";
			$user = $_SESSION['username'];
			$text = "";
			$link = "";
			
            //checks the story has a title
			if (!empty ($_POST['title']) && $_POST['title'] !== " ") {		
                $title = $_POST['title'];
				$text = $_POST['text'];	
				$link = $_POST['link'];
				
				$editStory = $mysqli -> prepare ("update stories
												set title = '$title', text = '$text', link = '$link'
												where story_id = '$story_id'");
				
				if (!$editStory) {
					echo "Insert Query Prep Failed: %s\n", $mysqli -> error;
					exit;
					
				} else { 
					$editStory -> bind_param ('sss', $title, $text, $link);
					$editStory -> execute();
					$editStory -> close();
				
					header("Location: storyPage.php?story_id=" . $story_id);		//redirects to newsfeed
					exit;
				}
			}
			
			if (isset ($_POST['submit']) && empty ($_POST['title'])) {
				printf ("<p id = warning>Must have a title to submit your story.<p>");
				exit;
			}
				
			
		?>
        
    </body>
</html>