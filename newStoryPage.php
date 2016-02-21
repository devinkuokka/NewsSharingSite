<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>NEW STORY</title>
		
		<link rel="stylesheet" type="text/css" href="newStoryPageStyle.css">
    </head>
	
    <body>
        
        <p id = "pageTitle">
			New Story <br>
		<p>
        
        <form id = "storyText" action = "<?php echo htmlentities( $_SERVER['PHP_SELF'] ); ?>" method = "POST">
            <!--box to enter title-->
			<label for = "title">Title</label> <br>
            <input id = "titleBox" type = "text" name = "title"
				   maxlength = "255" autocomplete = "off" required autofocus> <br>	
			<br>
            
			<!--box to add text-->
			<label for = "text">Text <i>(optional)</i> </label> <br>
            <textarea id = "textBox" name = "text"
					  cols = 500 rows = 10 autocomplete = "off"> </textarea> <br> 		
			<br>
            
			<!--box to to add link-->
			<label for = "link">Link <i>(optional)</i> </label> <br>
            <textarea id = "linkBox" name = "link" 
					  cols = 500 rows = 2 autocomplete = "off"> </textarea> <br> 	  			 
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
				
				$addStory = $mysqli -> prepare ("insert into stories (user, title, text, link)
												values ('$user', '$title', '$text', '$link')");
				
				if (!$addStory) {
					echo "Insert Query Prep Failed: %s\n", $mysqli -> error;
					exit;
					
				} else { 
					$addStory -> bind_param ('ssss', $user, $title, $text, $link);
					$addStory -> execute();
					$addStory -> close();
				
					header("Location: newsfeedPage.php");		//redirects to newsfeed
					exit;
				}
			}
			
			if (isset ($_POST['submit']) && empty ($_POST['title'])) {
				printf ("<p id = warning>Please enter a title before submitting your story.<p>");
				exit;
			}
				
			
		?>
        
    </body>
</html>