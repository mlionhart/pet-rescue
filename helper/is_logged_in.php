<?php
// is_logged_in.php

// start a session
session_start();
// check if first_name is set
if (isset($_SESSION['first_name'])) {
    // if so, return a JavaScript object {status: "yes"}
    echo json_encode(["status" => 'yes']);
} else {
    // otherwise, return a JavaScript object {status: "no"}
    echo json_encode(["status" => 'no']);
}
