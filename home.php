<?php require_once 'inc/functions.inc.php';

$pageTitle = "Home"; ?>

<?php require 'inc/header.inc.php'; ?>   

<?php require 'inc/nav.inc.php'; 

display_message();

?>

<!-- Image slider -->
<div id="slides" class="carousel slide" data-ride="carousel">
    <ul class="carousel-indicators">
        <li data-target="#slides" data-slide-to="0" class="active"></li>
        <li data-target="#slides" data-slide-to="1"></li>
        <li data-target="#slides" data-slide-to="2"></li>
    </ul>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="img/background-sad.webp" alt="background 1">
            <div class="carousel-caption">
                <h1 class="display-2">Pet Rescue</h1>
                <h3>The #1 Spot for Animal Rescue</h3>
                <button type="button" class="btn btn-outline-light btn-lg"><a href="register.php">Get Started</a></button>
            </div>
        </div>
        <div class="carousel-item">
            <img src="img/background.jpeg" alt="background 2">
            <div class="carousel-caption">
                <h1 class="display-2">Pet Rescue</h1>
                <h3>The #1 Spot for Animal Rescue</h3>
                <button type="button" class="btn btn-outline-light btn-lg"><a href="register.php">Get Started</a></button>
            </div>
        </div>
        <div class="carousel-item">
            <img src="img/background3.jpg" alt="background 3">
            <div class="carousel-caption">
                <h1 class="display-2">Pet Rescue</h1>
                <h3>The #1 Spot for Animal Rescue</h3>
                <button type="button" class="btn btn-outline-light btn-lg"><a href="register.php">Get Started</a></button>
            </div>
        </div>
    </div>
    <!-- carousel controls -->
    <a class="carousel-control-prev" href="#slides" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#slides" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<!-- Jumbotron -->
<div class="container-fluid">
    <div class="row jumbotron">
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-10">
            <p class="lead">A pet rescue organization allow individuals to adopt homeless and animals as well as create posts for lost and found animals.</p>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-2">
            <a href="register.php"><button type="button" class="btn btn-outline-secondary btn-lg">Get Started</button></a>
        </div>
    </div>
    <!-- <hr class="my-4"> -->
</div>

<!-- load JavaScript -->
<script src="js/script.js"></script>

<?php require 'inc/footer.inc.php'; ?>