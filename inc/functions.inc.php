<?php
// creates folder for logged-in user if not already in existence
function folder_checker($username) {
    if (!is_dir($username)) {
        mkdir('uploads/' . $username);
    }
}

// function for displaying posts
function display_posts($result) {
    while ($row = $result->fetch_assoc()) {
        echo '<div>';
        echo '<p>' . $_SESSION['username'] . '</p>';
        echo '<p>Date:' . $row['date'] . '</p>';
        echo '<h2>' . $row['title'] . '</h2>';
        echo '<p><strong>Animal Name:  </strong>' . $row['animal_name'] . '</p>';
        echo '<p><strong>Species:  </strong>' . $row['species'] . '</p>';
        echo '<p><strong>Breed:  </strong>' . $row['breed'] . '</p>';
        echo '<p><strong>Description:  </strong>' . $row['description'] . '</p>';
        echo "<img src=../uploads/\"{$row['img_src']}\">";
        echo '</div>';
    }
}
?>