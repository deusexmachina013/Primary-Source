<!DOCTYPE html>

<html lang="en">
  <head>
    <title>Student All Plans</title>

    <!-- CSS ONLY -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </head>

  <body>
    <!--NAVIGATION BAR (implemented with Bootstrap) -->
    <?php include('student_navbar.php'); ?>

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