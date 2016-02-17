<?php

    $mysqli = new mysqli("localhost", "reg_user", "reg_pass", "mod3_newsWebsite");
	
    if ($mysqli -> connect_errno) {
		echo "Connection Failed: %s\n", $mysqli->connect_error;
		exit;
	}
                    
?>