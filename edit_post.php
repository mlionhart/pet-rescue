<?php 
// start session
session_start();

require_once 'inc/functions.inc.php';

$pageTitle = "New Post"; 


// connect to database
require_once 'inc/db_connect.inc.php';

require 'inc/header.inc.php';    

require 'inc/nav.inc.php'; 

if (!isset($_SESSION['loggedin'])) {
    header('home.php?message=You%20Must%20Log%20In!!');
}

$error_bucket = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {

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
    if (!empty($_POST['post_id'])) {
        $post_id = $_POST['post_id'];       
    }

    if (empty($_POST['title'])) {
        array_push($error_bucket,"<p>A title is required.</p>");
    } else {
        $title = $db->real_escape_string($_POST['title']);        
    }

    if (empty($_POST['species'])) {
        array_push($error_bucket,"<p>A species is required.</p>");
    } else {
        $species = $db->real_escape_string($_POST['species']);        
    }

    if (empty($_POST['breed'])) {
        array_push($error_bucket,"<p>A breed is required.</p>");
    } else {
        $breed = $db->real_escape_string($_POST['breed']);        
    }

    if (empty($_POST['description'])) {
        array_push($error_bucket,"<p>A description is required.</p>");
    } else {
        $description = $db->real_escape_string($_POST['description']);        
    }

    if ($target_file == '') {
        echo "<p>you must upload an image</p>";
    } else {
        $img_src = $target_file;
    }

    $animal_name = $db->real_escape_string($_POST['animal_name']);
    $date = date('Y-m-d G:i:s');
    $user_id = $_SESSION['user_id'];
    // $post_id = $_GET['post_id'];

    if (count($error_bucket) == 0) {
        // build sql query
        $sql = "UPDATE post SET title='$title', animal_name='$animal_name', species='$species', breed='$breed', description='$description', img_src='$img_src' WHERE post_id=$post_id";
    
        // echo $sql;
    
        // query database with built sql
        $result = $db->query($sql);
    
        // if database query fails, display error message
        if (!$result) {
            echo '<div class="reg_div">There was a problem updating your post!</div>';
        // if database query is a success
        } else {
            // display success message and login link
            // echo '<div>Post Added!';
            header('location: rescue.php?message=Post%20Updated!!');
            // echo '<a href="rescue.php?message=Post%20Added!!" title="Rescue">Go to Rescue Page</a></div>';
            $_SESSION['registered'] = "Yes";
        }
    } else {
        // var_dump($error_bucket);
        // display_error_bucket($error_bucket);
    }
    
} else {
    $post_id = $_GET['post_id'];

    $sql = "SELECT * FROM post WHERE post_id=$post_id LIMIT 1";

    $result = $db->query($sql);

    while ($row = $result->fetch_assoc()) {
        $title = $row['title'];
        $animal_name = $row['animal_name'];
        $species = $row['species'];
        $breed = $row['breed'];
        $description = $row['description'];
        $post_id = $row['post_id'];
    }
}

?>

<h1>Edit Post</h1>

<!-- form -->
<form class="col-lg-3 mx-auto" action="edit_post.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Title</label>
        <input class="form-control" type="text" id="title" required name="title" value="<?php echo (isset($title) ? $title: '');?>">
        <br>
        <label for="animal_name">Animal Name</label>
        <input class="form-control" type="text" id="animal_name" required name="animal_name" value="<?php echo (isset($animal_name) ? $animal_name: '');?>">
        <br>
        <label for="species">Species</label>
        <input class="form-control" type="text" id="species" required name="species" value="<?php echo (isset($species) ? $species: '');?>">
        <br>
        <label for="breed">Breed</label>
        <input class="form-control" type="text" id="breed" required name="breed" value="<?php echo (isset($breed) ? $breed: '');?>">
        <br>
        <label for="description">Description</label>
        <textarea class="form-control" id="last_name" required name="description" value="<?php echo (isset($description) ? $description: '');?>"></textarea>
        <br>
        <label for="image">Upload an Image</label>
        <br>
        <input type="file" name="file" id="image">
        <br><br>
        <input type="hidden" name="post_id" value="<?php echo (isset($post_id) ? $post_id : '');?>">
    </div>
    <input class="btn btn-primary new-post" type="submit" value="Update Post">
</form>
<!-- end of form -->

<!-- load JavaScript -->
<script src="js/script.js"></script>

<?php require 'inc/footer.inc.php'; ?>