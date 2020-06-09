<?php
// creates folder for logged-in user if not already in existence
function folder_checker($username) {
    if (!is_dir($username)) {
        mkdir('uploads/' . $username);
    }
}
?>