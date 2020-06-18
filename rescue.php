<?php 
// start session
session_start();

require_once 'inc/functions.inc.php';

$pageTitle = "Rescue"; 

require 'inc/header.inc.php';    

require 'inc/nav.inc.php'; 

// connect to database
require_once 'inc/db_connect.inc.php';

if (!isset($_SESSION['loggedin'])) {
    header('location: home.php?message=You%20Must%20Log%20in%20First!');
}

$sql = "SELECT * FROM post order by post_id DESC";

$result = $db->query($sql);

// display message if any
display_message();

?>

<h1>Rescue</h1>

<div class="container-fluid rescue">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
        <?php display_posts($result); ?>
        </div>
    </div> <!-- end row -->
</div> <!-- end container -->

<!-- load JavaScript -->
<script src="js/script.js"></script>

<?php require 'inc/footer.inc.php'; ?>

