<?php // Filename: delete-post.php

// start session
session_start();

require_once "inc/db_connect.inc.php";

// check to see if id is in the query string
if(isset($_GET['post_id'])){
    // echo "it worked";
    // build SQL for delete
    $sql = "DELETE FROM post WHERE post_id={$_GET['post_id']} LIMIT 1";
    // perform query
    $result = $db->query($sql); 
    // if one row was affected then redirect browser back to rescue.php
    if($db->affected_rows == 1){
        header('location: rescue.php?message=I%20 successfully%20deleted%20that%20post%20for%20you.');
    } else {
        echo '<h1>Please do not play with our site!</h1>';
    }
}
?>