<!DOCTYPE html>

<html lang="en">
  <head>
    <title>Student All Plans</title>>

    <!-- CSS ONLY -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </head>

  <body>
    <!--NAVIGATION BAR (implemented with Bootstrap) -->
    <nav class="navbar navbar-custom navbar-expand-lg navbar-light fixed-top">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse collapse w-100 order-3 dual-collapse2" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger active" href="student_home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="student_create_plan.php">Create Plan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="all_plans.php">All Plans</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="student_catalog.php">Catalog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="index.php">Logout</a>
          </li>
        </ul>
      </div>
    </nav>

    <section class="content">
      <!-- All Plans -->
      <h1>All Plans</h1>
      <!-- concentrationn List -->
      <div class="container">
        <!-- ROWS -->
        <div class="row">
          <div class="col-sm col-conc">
            <a class= "concentration" href= "student_home.php"> Main Plan </a>
          </div>
        </div>
        <div class="row">
          <div class="col-sm col-conc">
            <a class= "concentration" href= ""> Test Plan </a>
          </div>
        </div>
        <div class="row">
          <div class="col-sm col-conc">
            <a class= "concentration" href= ""> Pre-Med Plan </a>
          </div>
        </div>
        <div class="row">
          <div class="col-sm col-conc">
            <a class= "concentration" href= ""> MIS Plan </a>
          </div>
        </div>
        <div class="row">
          <div class="col-sm col-conc">
            <a class= "concentration" href= ""> Special Interest Plan </a>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>