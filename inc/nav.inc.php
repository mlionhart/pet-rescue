<!-- Navigation -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
  <div class="container-fluid max-vw-80">
    <!-- site logo (insert logo img) -->
    <a href="home.php" class="navbar-brand"><img id="logo" src="img/logo.jpg" alt="Logo"></a>
    <h2>Pet Rescue</h2>
    <!-- navbar toggler (hamburger) -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- class for collapsible navbar -->
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <!-- ml-auto pushes navigation to the right when expanding window -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item <?= echoActiveClass("home"); ?>">
          <a href="home.php" class="nav-link">Home</a>
        </li>
        <li class="nav-item <?= echoActiveClass("login"); ?>">
          <a href="login.php" class="nav-link" id="login">Login</a>
        </li>
        <!-- <li class="nav-item">
                <a href="register.php" class="nav-link" id="register">Register</a>
            </li> -->
        <li class="nav-item <?= echoActiveClass("rescue"); ?>">
          <a href="rescue.php" class="nav-link">Rescue</a>
        </li>
        <li class="nav-item <?= echoActiveClass("new_post"); ?>">
          <?php
          if (isset($_SESSION['user_id'])) {
            echo '<a href="new_post.php" class="nav-link">Create Post</a>';
          }
          ?>
          <!-- <a href="new_post.php" class="nav-link">Create Post</a> -->
        </li>
        <!-- <li class="nav-item">
                <a href="#" class="nav-link">Contact</a>
            </li> -->
        <li class="nav-item">
          <a href="home.php" class="nav-link" id="logout">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>