<?php $pageTitle = "New Post"; 

// start session
session_start();

// connect to database
require_once 'inc/db_connect.inc.php';

require 'inc/header.inc.php';    

require 'inc/nav.inc.php'; 

if (!isset($_SESSION['loggedin'])) {
    header('home.php');
}

if (isset($_POST['Create Post'])) {
    // ------------- Image processing ----------------

    // Define errors in an array
    $upload_errors = array(
        UPLOAD_ERR_OK                 => "No errors.",
        UPLOAD_ERR_INI_SIZE          => "Larger than upload_max_filesize.",
        UPLOAD_ERR_FORM_SIZE         => "Larger than form MAX_FILE_SIZE.",
        UPLOAD_ERR_PARTIAL             => "Partial upload.",
        UPLOAD_ERR_NO_FILE             => "Please select a file to upload",
        UPLOAD_ERR_NO_TMP_DIR         => "No temporary directory.",
        UPLOAD_ERR_CANT_WRITE         => "Can't write to disk.",
        UPLOAD_ERR_EXTENSION         => "File upload stopped by extension."
    );

    // get handle to file we are moving
    $tmp_file = $_FILES['file']['tmp_name'];
    // set target file name
    $target_file = basename($_FILES['file']['name']);
    // set upload folder name
    $uploads = "uploads/";    
    // if file uploaded successfully
    if (move_uploaded_file($tmp_file, $uploads . $target_file)) {
        // diplay success message
        $message = "Image uploaded successfully";
    // otherwise display error message
    } else {
        $error = $_FILES['file']['error'];
        $message = $upload_errors[$error];
    }

    // -------------- database handling ---------------
    // get the post form data
    $title = $db->real_escape_string($_POST['title']);
    $animal_name = $db->real_escape_string($_POST['animal_name']);
    $species = $db->real_escape_string($_POST['species']);
    $breed = $db->real_escape_string($_POST['breed']);
    $description = $db->real_escape_string($_POST['description']);
    $img_src = $target_file;
    $date = date('Y-m-d G:i:s');
    $user_id = $_SESSION['user_id'];
    
    // build sql query
    $sql = "INSERT INTO post (user_id, title, animal_name, species, breed, description, img_src, created_on) 
                VALUES($user_id,'$title','$animal_name','$species','$breed','$description','$img_src','$date')";

    // query database with built sql
    $result = $db->query($sql);

    // if database query fails, display error message
    if (!$result) {
        echo '<div class="reg_div">There was a problem creating your post!</div>';
    // if database query is a success
    } else {
        // display success message and login link
        echo '<div>Post Added!';
        echo '<a href="rescue.php" title="Login Page">Go to Rescue Page</a></div>';
        $_SESSION['registered'] = "Yes";
    }
}

?>

<h1>Create a Post</h1>

<!-- form -->
<form class="col-lg-3 mx-auto" action="new_post.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Title</label>
        <input class="form-control" type="text" id="title" required name="title">
        <br>
        <label for="animal_name">Animal Name</label>
        <input class="form-control" type="text" id="animal_name" required name="animal_name">
        <br>
        <label for="species">Species</label>
        <input class="form-control" type="text" id="species" required name="species">
        <br>
        <label for="breed">Breed</label>
        <input class="form-control" type="text" id="breed" required name="breed">
        <br>
        <label for="description">Description</label>
        <textarea class="form-control" id="last_name" required name="last_name"></textarea>
        <label for="image">Upload an Image</label>
        <br>
        <input type="file" name="file" id="image">
    </div>
    <input class="btn btn-primary" type="submit" value="Create Post">
</form>
<!-- end of form -->

<!-- load JavaScript -->
<script src="js/script.js"></script>

<?php require 'inc/footer.inc.php'; ?>