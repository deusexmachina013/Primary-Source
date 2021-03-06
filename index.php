<?php
session_start();
?>
<!DOCTYPE html>

<html lang="en">
  <head>
    <title>CourseMap Home Page</title>

    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </head>

  <body>
    <div>
      <img class="img" src="assets/img/logoWhyWait.png" alt="CourseMap Logo">
      <?php
      if(session_status() == PHP_SESSION_ACTIVE && isset($_SESSION["invalid_login"]) && $_SESSION["invalid_login"]) {
      ?>
      <h1>The account you logged in with is not approved for this application.</h1>
      <div class="button-center">
        <button class="button" onclick="window.location.href = 'logout.php'"> Logout </button>
      <div>
      <?php
      } else {
      ?>
      <div class="button-center">
        <button class="button" onclick="window.location.href = 'student/home.php'"> Student Login </button>
        <button class="button" onclick="window.location.href = 'admin/home.php'"> Admin Login </button>
      <div>
      <?php
      }
      ?>
      <img class="img2" src="assets/img/rpi.png" alt="RPI Logo">
    </div>
  </body>
</html>