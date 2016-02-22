<?php
    session_start();
    $user = $_SESSION['username'];
    $story_id = $_SESSION['story_id'];
    
    $vote_type = $_GET['type'];
    $_id = $_GET['book'];
    $id = $_GET['id'];
    
    
    include 'pagehead.php';
    
    $tracker_table = $book.'VoteTrack';
    $username = $_SESSION['username'];
    
    
    if ($_SESSION['username'] == null) {
        printf("<p id = error>You must be logged in to vote!</p>");
        exit;
    }

    include 'php_database.php';
    
    mysql_select_db("a6595899_s", $con);
    
    
    $data_query = "SELECT * FROM $book WHERE id=$id";
    $lesson_data = mysql_query($data_query);
    $lesson_array = mysql_fetch_assoc($lesson_data);
    
    $vote_cop_query = "SELECT * FROM $tracker_table WHERE user='$username' AND id=$id";
    $vote_cop_data = mysql_query($vote_cop_query);
    $vote_cop = mysql_fetch_assoc($vote_cop_data);
    
    if (mysql_num_rows($vote_cop_data) != 0 && $vote_type == 'up' && $vote_cop['has'] == 1) {
        echo 'You have already upvoted this lesson.';
        echo '<br>';
        echo '<a href="lesson.php?book='.$book.'&id='.$id.'">';
        echo 'Return to lesson';
        echo '</a>';
        die();
    } elseif (mysql_num_rows($vote_cop_data) != 0 && $vote_type == 'down' && $vote_cop['has'] == 2) {
        echo 'You have already downvoted this lesson.';
        echo '<br>';
        echo '<a href="lesson.php?book='.$book.'&id='.$id.'">';
        echo 'Return to lesson';
        echo '</a>';
        die();
    }
    
    $vote_count = $lesson_array['votes'];
    if ($vote_type == 'up') {
        $vote_count++;
        $has_type = 1;
    } elseif ($vote_type == 'down') {
        $vote_count--;
        $has_type = 2;
    } else {
        die('Vote type not specified.');
    }
    
    $new_or = mysql_num_rows($vote_cop_data);
    
    if ($new_or == 0) {
        $track_query = "INSERT INTO $tracker_table (user, id, has)
        VALUES ('$username', $id, $has_type)";
    } else {
        $track_query = "UPDATE $tracker_table SET has=$has_type WHERE user='$username' AND id=$id";
    }
    mysql_query($track_query);
    
    
    //actually cast vote..
    $update_query = "UPDATE $book SET votes=$vote_count WHERE id=$id";
    mysql_query($update_query);
    
    echo 'Your vote has been submitted!';
    echo '<br>';
    echo '<a href="lesson.php?book='.$book.'&id='.$id.'">';
    echo 'Return to lesson';
    echo'</a>';


?>