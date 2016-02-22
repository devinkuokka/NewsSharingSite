<?php
	session_start();
	$story_id = $_SESSION['story_id'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>NEW STORY</title>
		
		<link rel="stylesheet" type="text/css" href="stylingSheet.css">
    </head>
	
    <body>
		<div id = "header">
			<p id = "pageTitle">
				Add Your Story! <br>
			<p>
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
			<form id = "storyText" action = "<?php echo htmlentities( $_SERVER['PHP_SELF'] ); ?>" method = "POST">
				<!--box to enter title-->
				<label for = "title">Title</label> <br>
				<input id = "titleBox" class = "textinput" type = "text" name = "title" placeholder = "Enter title here..."
					   maxlength = "255" autocomplete = "off" required autofocus> <br>	
				<br>
				
				<!--box to add text-->
				<label for = "text">Text <i>(optional)</i> </label> <br>
				<textarea id = "textBox" class = "textinput" name = "text" placeholder = "Add text here..."
						   autocomplete = "off"></textarea> <br> 		
				<br>
				
				<!--box to to add link-->
				<label for = "link">Link <i>(optional)</i> </label> <br>
				<textarea id = "linkBox" class = "textinput" name = "link" placeholder = "Add a link here..."
						  cols = 500 rows = 2 autocomplete = "off"></textarea> <br> 	  			 
				<br>
				
				<!--submit button-->
				<input id = "submit" class = "button" name = "submit" type = "submit" value = "Submit">						
	
			</form>
			
			<?php
				require "php_database.php";
				$user = $_SESSION['username'];
				$text = "";
				$link = "";
				
                $isBlank = preg_replace('/\s+/', '', $_POST['title']);
                
				//checks the story has a title
				if (!empty ($_POST['title']) && strlen($isBlank) > 0) {		
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
		</div>
		 
		 <div id = "footer">
			<i>Copyright</i> &copy; Carolyn Dean Wolf & Devin Kuokka
		</div>
    </body>
</html>