<?php


// function for displaying posts
function display_posts($result) {
    while ($row = $result->fetch_assoc()) {
        $imageEncoded = rawurlencode($row['img_src']);
        echo '<div class="card">';
        // only show delete button if current user is the owner of the post
        // if ($_SESSION['user_id'] == $row['user_id']) {
        //     // echo "<div id=\"delete\"><a href=\"edit_post.php?post_id={$row['post_id']}&user_id={$row['user_id']}\" onclick=\"return confirm('Are you sure?');\">Edit</a>" . ' | ' . "<a href=\"delete_post.php?post_id={$row['post_id']}&user_id={$row['user_id']}\" onclick=\"return confirm('Are you sure?');\">Delete</a></div>";            
        // }
        // only show delete button if current user is the owner of the post
        if ($row['user_id'] == $_SESSION['user_id']) {
            // echo "<a id=\"delete\" href=\"delete_post.php?post_id={$row['post_id']}&user_id={$row['user_id']}\" onclick=\"return confirm('Are you sure?');\">Delete Post</a>";
            echo "<div id=\"delete\"><a href=\"edit_post.php?post_id={$row['post_id']}&user_id={$row['user_id']}\">Edit</a>" . ' | ' . "<a href=\"delete_post.php?post_id={$row['post_id']}&user_id={$row['user_id']}\" onclick=\"return confirm('Are you sure?');\">Delete</a></div>";
        }
        echo '<p><strong>Date:  &nbsp;</strong>' . $row['created_on'] . '</p>';
        echo '<p><strong>User:  &nbsp;</strong>' . $row['username'] . '</p>';
        echo '<h2 class="card-title">' . $row['title'] . '</h2>';
        echo "<img class=\"card-img\" src=uploads/{$imageEncoded}>";
        echo '<p><strong>Animal Name:  &nbsp;</strong>' . $row['animal_name'] . '</p>';
        echo '<p><strong>Species:  &nbsp;</strong>' . $row['species'] . '</p>';
        echo '<p><strong>Breed:  &nbsp;</strong>' . $row['breed'] . '</p>';
        echo '<p><strong>Description:  &nbsp;</strong>' . $row['description'] . '</p>';
        echo '<p><strong>Contact Email: &nbsp;</strong>' . '<a href=' . '"mailto:' . $row['email'] . '">' . $row['email'] . '</a></p>';
        echo '</div>';
    }
}

function display_message(){
    // if message in url
    if (isset($_GET['message'])) {
        $message = $_GET['message'];
        echo '<div class="mt-4 alert alert-success col-lg-6 mx-auto text-center" role="alert">';
        echo $message;
        echo '</div>';
    }
}

function display_error_bucket($error_bucket){
    echo '<p>The following errors were detected:</p>';
    echo '<div class="pt-4 alert alert-warning" role="alert">';
        echo '<ul>';
        foreach ($error_bucket as $text){
            echo '<li>' . $text . '</li>';
        }
        echo '</ul>';
    echo '</div>';
    echo '<p>All of these fields are required. Please fill them in.</p>';
}

function echoActiveClass($requestUri)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if ($current_file_name == $requestUri)
        echo 'active';
}
?>