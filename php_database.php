<?php

    $mysqli = new mysqli("localhost", "php_user", "php_pass", "mod3_newsWebsite");
	
    if ($mysqli -> connect_errno) {
		echo "Connection Failed: %s\n", $mysqli->connect_error;
		exit;
	}
                    
?>