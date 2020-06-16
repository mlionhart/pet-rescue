<?php $pageTitle = "Login"; 

// start session
session_start();

// connect to database
require_once 'inc/db_connect.inc.php';

require 'inc/header.inc.php';    

require 'inc/nav.inc.php'; 

// if login button was pressed
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // set db data to variables
    $username = $db->real_escape_string($_POST['username']);
    $password = hash('sha512', $db->real_escape_string($_POST['password']));

    // build sql query
    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
      
    // query database with built sql
    $result = $db->query($sql);

    // if successfully returns one row of data, create session variables, fetch row information and direct browswer to image-gallery.php
    if ($result->num_rows == 1) {

        $_SESSION['loggedin'] = 1;
        
        $row = $result->fetch_assoc();
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['user_id'] = $row['user_id'];

        header('location: rescue.php');
    // otherwise, display error message
    } else {
        echo '<p>Please try again</p>';
    }
}

?>

<h1>Login</h1>

<form class="col-lg-3 mx-auto login" action="login.php" method="POST">
    <br>
    <label for="username">Username</label>
    <br>
    <input class="form-control" type="text" name="username" id="username" placeholder="Username" required>
    <br>
    <label for="password">Password&nbsp;&nbsp;</label>
    <span id="showPassword" onclick="showPassword();">Show Password</span>
    <br>
    <input class="form-control" type="password" name="password" id="password" placeholder="Password" required>
    <br>
    <input class="btn btn-primary" type="submit" value="Login">
</form>
<!-- end of form -->

<!-- load JavaScript -->
<script src="js/script.js"></script>

<?php require 'inc/footer.inc.php'; ?>

