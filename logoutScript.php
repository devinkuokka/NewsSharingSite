<?php
    session_start();
    session_destroy();				            //logs user out
    header("Location: frontPage.php");		    //redirects to front page
?>