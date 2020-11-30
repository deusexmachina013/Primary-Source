<?php 
$username = "root";
$password = "root";
try {
  $dbconn = new PDO('mysql:host=localhost;dbname=website', $username, $password);
}
catch(PDOException $e) {
  echo "Connection failed";
}

// $clickedConc = 
// $concentration = $dbconn->query("SELECT * from `template` WHERE `template`.name=$clickedConc")

// $arts = array[]
?>

<!DOCTYPE html>

<html lang="en">
  <head>
    <title>Student Catalog</title>

    <!-- CSS ONLY -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/style.css">
    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </head>

  <body>
    <!--NAVIGATION BAR (implemented with Bootstrap) -->
    <?php include('student_navbar.php'); ?>

    <section class="content">
      <!-- Catalog -->
      <h1>Catalog</h1>
      <!-- concentrationn List -->
      <div class="container">
        <h2>ITWS Concentrations</h2>
        <!-- ROWS -->
        <?php
          // Iterate through concentrations table and echo name with link to template
          // foreach ($concentrations as $row) {
          //   echo "<div><a class= 'concentration' href= '" . $row['link'] . '.php' . "'> " . $row['name'] . " </a></div>";
          // }
        ?>
        <!-- arts.php -->
        <div><a class= "concentration" href= ""> Arts </a></div>

        <!-- civil-structural-engineer.php -->
        <div><a class= "concentration" href= ""> Civil/Structural Engineer </a></div>
        <div><a class= "concentration" href= ""> Cognitive Science </a></div>
        <div><a class= "concentration" href= "catalog/communication.php"> Communication </a></div>
        <div><a class= "concentration" href= ""> Computer Hardware </a></div>
        <div><a class= "concentration" href= ""> Computer Networking </a></div>
        <div><a class= "concentration" href= ""> Data Science </a></div>
        <div><a class= "concentration" href= ""> Economics </a></div>
        <div><a class= "concentration" href= ""> Entrepreneurship </a></div>
        <div><a class= "concentration" href= ""> Finance </a></div>
        <div><a class= "concentration" href= ""> Information Security </a></div>
        <div><a class= "concentration" href= ""> Machine & Computational Learning </a></div>
        <div><a class= "concentration" href= ""> Management Information Systems </a></div>
        <div><a class= "concentration" href= ""> Mechanical/Aeronautical Engineering </a></div>
        <div><a class= "concentration" href= ""> Medicine </a></div>
        <div><a class= "concentration" href= ""> Pre-Law </a></div>
        <div><a class= "concentration" href= ""> Psychology </a></div>
        <div><a class= "concentration" href= ""> Science & Technology Studies </a></div>
        <div><a class= "concentration" href= ""> Science Informatics </a></div>
        <div><a class= "concentration" href= ""> Special Interest </a></div>
        <div><a class= "concentration" href= ""> Web Technology </a></div>
        <!-- NOTE: Can be automated via a good mix of JS/PHP and MySQL Tabling and Querying. -->
        <!--       - This page, like others, will be stripped and auto-generated. -->
      </div>
  </section>
  </body>
</html>