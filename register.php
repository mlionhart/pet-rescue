<?php require_once 'inc/functions.inc.php';

$pageTitle = "Register"; 

// start session
session_start();

// connect to database
require_once 'inc/db_connect.inc.php';

require 'inc/header.inc.php';    

require 'inc/nav.inc.php'; 

// if submit button was pressed
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // assign info from database to variables
    $email = $db->real_escape_string($_POST['email']);
    $username = $db->real_escape_string($_POST['username']);
    $first_name = $db->real_escape_string($_POST['first_name']);
    $last_name = $db->real_escape_string($_POST['last_name']);
    $password = hash('sha512', $db->real_escape_string($_POST['password']));

    // build sql query
    $sql = "INSERT INTO user (username,email,first_name,last_name,password) 
                VALUES('$username','$email','$first_name','$last_name','$password')";

    // query database with built sql
    $result = $db->query($sql);

    // if database query fails, display error message
    if (!$result) {
        echo '<div class="reg_div">There was a problem registering your account</div>';
    // if database query is a success
    } else {
        // create a new directory for the user for images to be stored
        // folder_checker($username);
        // display success message and login link
        echo '<div>You are now ready to go!';
        echo '<a href="login.php" title="Login Page">Login</a></div>';
        // $_SESSION['registered'] = "Yes";
    }
}

?>

<h1>Register</h1>

<!-- form -->
<form class="col-lg-3 mx-auto register" action="register.php" method="POST">
    <div class="form-group">
        <label for="email">Email</label>
        <input class="form-control" type="email" id="email" required name="email">
        <br>
        <label for="username">Username</label>
        <input class="form-control" type="text" id="username" required name="username">
        <br>
        <label for="password">Password</label>
        <input class="form-control" type="password" id="password" required name="password">
        <br>
        <label for="first_name">First Name</label>
        <input class="form-control" type="text" id="first_name" required name="first_name">
        <br>
        <label for="last_name">Last Name</label>
        <input class="form-control" type="text" id="last_name" required name="last_name">
    </div>
    <input class="btn btn-primary" type="submit" value="Register">
</form>
<!-- end of form -->

<!-- load JavaScript -->
<script src="js/script.js"></script>

<?php require 'inc/footer.inc.php'; ?>

