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

    <section class="content">
      <!-- MAIN PLAN -->
      <h1>My Plan</h1>
      <!-- YEAR 1 -->
      <div class="container">
        <h2>2019-2020</h2>
        <!-- ROW 1 -->
        <div class="row">
          <div class="col-sm col-semester">
            Fall 2019
          </div>
          <div class="col-sm col-semester">
            Spring 2020
          </div>
        </div>
        <!-- ROW 2 -->
        <div class="row">
          <div class="col-sm">
            Computer Science 1
          </div>
          <div class="col-sm">
            Data Structures
          </div>
        </div>
        <!-- ROW 3 -->
        <div class="row">
          <div class="col-sm">
            Calculus I
          </div>
          <div class="col-sm">
            Calculus II
          </div>
        </div>
        <!-- ROW 4 -->
        <div class="row">
          <div class="col-sm">
           Physics 1
         </div>
         <div class="col-sm">
          Introduction to Biology
        </div>
      </div>
      <!-- ROW 5 -->
      <div class="row">
        <div class="col-sm">
          Introduction to ITWS
        </div>
        <div class="col-sm">
          Introduction to Biology Lab
        </div>
      </div>

      <!-- ROW 6 -->
      <div class="row">
        <div class="col-sm">

        </div>
        <div class="col-sm">
          IT and Society
        </div>

      </div>
    </div>

    <!-- YEAR 2 -->
    <div class="container">
      <h2>2020-2021</h2>
      <!-- ROW 1 -->
      <div class="row">
        <div class="col-sm col-semester">
          Fall 2020
        </div>
        <div class="col-sm col-semester">
          Spring 2021
        </div>
      </div>
      <!-- ROW 2 -->
      <div class="row">
        <div class="col-sm">
          Foundations of Computer Science
        </div>
        <div class="col-sm">
          Introduction to Algorithms
        </div>
      </div>
      <!-- ROW 3 -->
      <div class="row">
        <div class="col-sm">
         Computer Organization
       </div>
       <div class="col-sm">
         Introduction to Human Computer Interaction
       </div>
     </div>
     <!-- ROW 4 -->
     <div class="row">
      <div class="col-sm">
        Web Systems Development
      </div>
      <div class="col-sm">
       Web Science Systems Development
     </div>
   </div>
   <!-- ROW 5 -->
   <div class="row">
    <div class="col-sm">
      Introduction to Logic
    </div>
    <div class="col-sm">
      Statistical Methods
    </div>
  </div>

  <!-- ROW 6 -->
  <div class="row">
    <div class="col-sm">
      Introduction to Cognitive Science
    </div>
    <div class="col-sm">

    </div>

  </div>
  </div>

  <!-- YEAR 3 -->
  <div class="container">
    <h2>2021-2022</h2>
    <!-- ROW 1 -->
    <div class="row">
      <div class="col-sm col-semester">
        Arch Summer 2021
      </div>
      <div class="col-sm col-semester">
        Fall 2021/Spring 2022
      </div>
    </div>
    <!-- ROW 2 -->
    <div class="row">
      <div class="col-sm">
        Operating Systems
      </div>
      <div class="col-sm">
        Programming Languages
      </div>
    </div>
    <!-- ROW 3 -->
    <div class="row">
      <div class="col-sm">
        Linear Algebra
      </div>
      <div class="col-sm">
        Managing IT Resources
      </div>
    </div>
    <!-- ROW 4 -->
    <div class="row">
      <div class="col-sm">
        RCOS
      </div>
      <div class="col-sm">
        Database Systems
      </div>
    </div>
    <!-- ROW 5 -->
    <div class="row">
      <div class="col-sm">
        Earth and Sky
      </div>
      <div class="col-sm">
        Strategic Writing
      </div>
    </div>

    <!-- ROW 6 -->
    <div class="row">
      <div class="col-sm">
        Research Method and Statistics
      </div>
      <div class="col-sm">

      </div>
    </div>
  </div>

  <!-- YEAR 4 -->
  <div class="container">
    <h2>2022-2023</h2>
    <!-- ROW 1 -->
    <div class="row">
      <div class="col-sm col-semester">
        Fall 2022
      </div>
      <div class="col-sm col-semester">
        Spring 2023
      </div>
    </div>
    <!-- ROW 2 -->
    <div class="row">
      <div class="col-sm">
        ITWS Capstone Project
      </div>
      <div class="col-sm">
        Senior Thesis
      </div>
    </div>
    <!-- ROW 3 -->
    <div class="row">
      <div class="col-sm">
        Network Programming
      </div>
      <div class="col-sm">
        Introduction to Linguistics
      </div>
    </div>
    <!-- ROW 4 -->
    <div class="row">
      <div class="col-sm">
        Sensation and Perception
      </div>
      <div class="col-sm">
        Minds and Machines
      </div>
    </div>
    <!-- ROW 5 -->
    <div class="row">
      <div class="col-sm">
        Introduction to Artifical Intelligence
      </div>
      <div class="col-sm">
        Software Design and Documentation
      </div>
    </div>

    <!-- ROW 6 -->
    <div class="row">
      <div class="col-sm">

      </div>
      <div class="col-sm">
       Networking in the Linux Kernal
     </div>

   </div>
  </div>

  </section>
  </body>
</html>