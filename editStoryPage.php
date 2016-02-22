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
		
		<link rel="stylesheet" type="text/css" href="stylingSheet.css">
        
		<script type = "text/javascript">
            var story_id = <?php echo $story_id ?>;
        </script>
    </head>
	
    <body>
        <div id = "header">
			<p id = "pageTitle">
				Edit Your Story! <br>
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
				   onclick = "window.location = 'storyPage.php?story_id='+story_id"
			/>
		</div>
        
        <div id = "leftSection">
            <form id = "storyText" action = "<?php echo htmlentities( $_SERVER['PHP_SELF'] ); ?>" method = "POST">
                <!--box to edit title-->
                <label for = "title">Title</label> <br>
                <input id = "titleBox" class = "textinput" type = "text" name = "title" value = "<?php echo htmlentities($title); ?>"
                       maxlength = "255" autocomplete = "off" required autofocus> <br>	
                <br>
                
                <!--box to edit/add text-->
                <label for = "text">Text <i>(optional)</i> </label> <br>
                <textarea id = "textBox" class = "textinput" name = "text"
                          cols = 500 rows = 10 autocomplete = "off"><?php echo $text; ?></textarea> <br> 		
                <br>
            
                <!--box to to edit/add link-->
                <label for = "link">Link <i>(optional)</i> </label> <br>
                <textarea id = "linkBox" class = "textinput" name = "link"
                          cols = 500 rows = 2 autocomplete = "off"><?php echo $link; ?></textarea> <br> 	  			 
                <br>
                
                <!--submit button-->
                <input id = "update" class = "button" name = "update" type = "submit" value = "Update">						
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
                    
                        header("Location: storyPage.php?story_id=" . $story_id);		//redirects back to story page
                        exit;
                    }
                }
                
                if (isset ($_POST['update']) && empty ($_POST['title'])) {
                    printf ("<p id = warning>Must have a title to submit your story.<p>");
                    exit;
                }     
            ?>
        </div>
		 
		 <div id = "footer">
			<i>Copyright</i> &copy; Carolyn Dean Wolf & Devin Kuokka
		</div>
    </body>
</html>