<!DOCTYPE html>

<html lang="en">
  <head>
    <title>Student Homepage</title>

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

    <!-- NOTE: To be used as a template for displaying fully completed plans.  Will have to write a function to query plans and display them in this manner. -->

    <section class="content main-plan">
      <!-- MAIN PLAN -->
      <h1>My Plan</h1>
      <!-- YEAR 1 -->
      <div class="container">
        <h2>2019-2020</h2>
        <!-- SEMESTER YEAR -->
        <div class="row">
          <div class="col-sm col-semester">
            Fall 2019
          </div>
          <div class="col-sm col-semester">
            Spring 2020
          </div>
        </div>
        <!-- Year 1 -->
        <div class="row">
          <!-- Semester 1 -->
          <div class="col-sm">
            <p>Computer Science 1</p>
            <p>Introduction to ITWS</p>
            <p>Physics 1</p>
            <p>Calculus 1</p>
          </div>
          <!-- Semester 2 -->
          <div class="col-sm">
            <p>Data Structure</p>
            <p>Calculus II</p>
            <p>Introduction to Biology</p>
            <p>Introduction to Biology Lab</p>
            <p>IT and Society</p>
          </div>
        </div>
      </div>

      <!-- YEAR 2 -->
      <div class="container">
        <h2>2020-2021</h2>
        <!-- SEMESTER YEAR -->
        <div class="row">
          <div class="col-sm col-semester">
            Fall 2020
          </div>
          <div class="col-sm col-semester">
            Spring 2021
          </div>
        </div>
        
        <div class="row">
          <!-- Semester 3 -->
          <div class="col-sm">
            <p>Foundations of Computer Science </p>
            <p>Computer Organization</p>
            <p>Web Systems Development</p>
            <p>Introduction to Logic</p>
            <p>Introduction to Cognitive Science</p>
          </div>
          <!-- Semester 4 -->
          <div class="col-sm">
            <p>Introduction to Algorithms</p>
            <p>Introduction to HCI</p>
            <p>Web Science Systems Development</p>
            <p>Statistical Methods</p>
          </div>
        </div>
      </div>

      <!-- YEAR 3 -->
      <div class="container">
        <h2>2021-2022</h2>
        <!-- SEMESTER YEAR -->
        <div class="row">
          <div class="col-sm col-semester">
            Fall 2021
          </div>
          <div class="col-sm col-semester">
            Spring 2022
          </div>
        </div>
        
        <div class="row">
          <!-- Semester 5 -->
          <div class="col-sm">
            <p>Operating Systems</p>
            <p>Linear Algebra</p>
            <p>RCOS</p>
            <p>Earth and Sky</p>
            <p>Research Methods and Statistics</p>
          </div>
          <!-- Semester 6 -->
          <div class="col-sm">
            <p>Programming Languages</p>
            <p>Managing IT Resources</p>
            <p>Database Systems</p>
            <p>Strategic Writing</p>
          </div>
        </div>
      </div>
      <!-- YEAR 4 -->
      <div class="container">
        <h2>2022-2023</h2>
        <!-- SEMESTER YEAR -->
        <div class="row">
          <div class="col-sm col-semester">
            Fall 2022
          </div>
          <div class="col-sm col-semester">
            Spring 2023
          </div>
        </div>
        
        <div class="row">
          <!-- Semester 7 -->
          <div class="col-sm">
            <p>ITWS Capstone Project</p>
            <p>Networking Programming</p>
            <p>Sensation and Perception</p>
            <p>Introduction to Artificial Intelligence</p>
          </div>
          <!-- Semester 8 -->
          <div class="col-sm">
            <p>Senior Thesis</p>
            <p>Introduction to Linguistics</p>
            <p>Minds and Machines</p>
            <p>Software Design and Documentation</p>
            <p>Networking in the Linux Kernal</p>
          </div>
        </div>
      </div>

  </section>
  </body>
</html>