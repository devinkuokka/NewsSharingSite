<?php
    session_start();
	$user = $_SESSION['username'];
	$story_id = $_SESSION['story_id'];
	$commentToEdit_id = $_SESSION['commentToEdit_id'];
	
	require "php_database.php"; 
	
	$isBlank = preg_replace('/\s+/', '', $_POST['subComment']);
	
    if (!empty ($_POST['comment']) && strlen($isBlank) > 0) {	
        $subComment = $_POST['subComment'];	
        
		$subCommentTable = "comments".$commentToEdit_id;
		
		//check if parent comment table exists
		$addSubComment = $mysqli -> prepare ("insert into $subCommentTable (user, subComment_id, subComment)
											 values ('$user', '$commentToEdit_id', '$subComment')");
	
		//if parent comment table doesn't exist, create one
		if (!$addSubComment) {
			$createSubComment = $mysqli -> prepare ("CREATE TABLE 'mod3_newsWebsite`.'$subCommentTable' (
													subComment_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT ,
													user VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
													comment_id MEDIUMINT UNSIGNED NOT NULL ,
													subComment TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
													PRIMARY KEY (`subComment_id`),
													FOREIGN KEY (comment_id) REFERENCES comments (comment_id))
													ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;");
		
			//check if sub-comment table is created
			if (!$creteSubComment) {
				echo "Insert Query Prep Failed: %s\n", $mysqli -> error;
				exit;
			
			} else { 
				$creteSubComment -> execute();
				$creteSubComment -> close();
				
				$addSubComment = $mysqli -> prepare ("insert into $subCommentTable (user, subComment_id, subComment)
													 values ('$user', '$commentToEdit_id', '$subComment')");
				
				if (!$addSubComment) {
					echo "Insert Query Prep Failed: %s\n", $mysqli -> error;
					exit;
				} else { 
					$addSubComment -> bind_param ('sss', $user, $commentToEdit_id, $subComment);
					$addSubComment -> execute();
					$addSubComment -> close();
					
					header("Location: commentPage.php?comment_id=".$commentToEdit_id);		    //redirects to comment page
					exit;
				}
			}
        
        } else { 
            $addSubComment -> bind_param ('sss', $user, $commentToEdit_id, $subComment);
            $addSubComment -> execute();
            $addSubComment -> close();
			
			header("Location: commentPage.php?comment_id=".$commentToEdit_id);		    //redirects to comment page
			exit;
		}
    
    }
    
    if (isset ($_POST['submit']) && empty ($_POST['comment'])) {
        header("Location: commentPage.php?comment_id=".$commentToEdit_id);		    //redirects to comment page
		printf ("<p id = warning>Please enter a sub-comment before submitting.<p>");
        exit;
    }
	
	
    exit;
?>