<?php 
$username = "root";
$password = "root";
try {
  $dbconn = new PDO('mysql:host=localhost;dbname=website', $username, $password);
}
catch(PDOException $e) {
  echo "Connection failed";
}

$conc = $dbconn->query("SELECT * from `template`");


?>

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
        <!-- Bootstrap Accordion (displays concentration requirements) -->

        <div class="accordion" id="accordionExample"> 
        
        <?php
          // Iterate through the template table and echo name of concentration
          foreach ($conc as $row1) {
              echo '<div class="card">
                      <div class="card-header" id="heading' . $row1["id"] . '">
                        <h2 class="mb-0">
                          <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse' . $row1["id"] . '" aria-expanded="false" aria-controls= "collapse' . $row1["id"] . '">'
                            . $row1["name"] . 
                          '</button>
                        </h2>
                      </div>
                      <div id="collapse' . $row1["id"] . '" class="collapse" aria-labelledby="heading' . $row1["id"] . '" data-parent="#accordionExample">
                        <div class="card-body">';
                        
                        $template_data = $dbconn->query("SELECT * from `template_data`");
                        $courses = $dbconn->query("SELECT * from `courses`");
                        $course_group_catalog_data = $dbconn->query("SELECT * from `course_group_catalog_data`");
                        $yes_courses_id = array(); // 2 3 4 5 6 7 8 11

                        foreach ($template_data as $row2) {
                           if ($row1["id"] == $row2["template_id"]) {
                              foreach ($courses as $row3) {
                                if ($row2["course_id"] == $row3["id"]) {
                                  foreach ($course_group_catalog_data as $row4) {
                                    if ($row3["id"] == $row4["course_group_id"]) {
                                      array_push($yes_courses_id, $row4["course_id"]);
                                    }
                                  }
                                }
                              }
                           }
                        }

                        $yes_courses_string = strval("SELECT * from `courses` WHERE");
                        for ($i = 0; $i < sizeof($yes_courses_id); $i++) {
                          $yes_courses_string = $yes_courses_string . strval("`courses`.id=");
                          if ($i == sizeof($yes_courses_id)-1) {
                            $yes_courses_string = $yes_courses_string . strval($yes_courses_id[$i]);
                          }
                          else {
                            $yes_courses_string = $yes_courses_string . strval($yes_courses_id[$i]);
                            $yes_courses_string = $yes_courses_string . " OR ";
                          }
                        }
                        
                        $yes_courses = $dbconn->query($yes_courses_string);
                        
                        $yes_courses_options = array(); // 2 4
                        $course_group_catalog_ids = array(); // 1 2 4
                        
                        // find the intersection of [2 3 4 5 6 7 8 11] and [1 2 4] to get [2 4]
                        $course_group_catalog = $dbconn->query("SELECT * from `course_group_catalog` WHERE `course_group_catalog`.course_id in (" . implode(", ", $yes_courses_id) . ")");
                        
                        foreach ($course_group_catalog as $row5) {
                          echo $row5["course_id"] . "<br>";
                        }

                        foreach ($yes_courses as $row6) {

                          echo $row6["name"] . "<br>";
                        }
                        $yes_courses_string = "";
                  
                    echo '</div>
                      </div>
                    </div>';
            }
          ?>
        </div>
      </div>
  </section>
  </body>
</html>