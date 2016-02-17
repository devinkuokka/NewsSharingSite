<?php

    $conn = new mysqli("localhost", "php_user", "php_pass", "mod3_newsWebsite");
	
    if ($mysqli -> connect_errno) {
		printf("Connection Failed: %s\n", $mysqli->connect_error);
		exit;
	}
                    
?>