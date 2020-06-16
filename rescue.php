<?php require_once 'functions.inc.php';

$pageTitle = "Rescue"; 

require 'inc/header.inc.php';    

require 'inc/nav.inc.php'; 

// start session
session_start();

// connect to database
require_once 'inc/db_connect.inc.php';

$sql = "SELECT * FROM post";

$result = $db->query($sql);

?>

<h1>Rescue</h1>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
        <?php display_posts(); ?>
        </div>
    </div> <!-- end row -->
</div> <!-- end container -->

<!-- load JavaScript -->
<script src="js/script.js"></script>

<?php require 'inc/footer.inc.php'; ?>

