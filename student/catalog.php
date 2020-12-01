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
      
      <div class="container">
        <h2>ITWS Core Requirements</h2>
          <div class="card">
          <div class="card-header border-0" style="padding-left:33px;">
            ITWS-1100 Introduction to Information Technology and Web Science
          </div>
        </div>
        <div class="card">
          <div class="card-header border-0" style="padding-left:33px;">
            ITWS-2110 Web Systems Development
          </div>
        </div>
        <div class="card">
          <div class="card-header border-0" style="padding-left:33px;">
            ITWS-4500 Web Science Systems Development
          </div>
        </div>
        <div class="card">
          <div class="card-header border-0" style="padding-left:33px;">
            ITWS-4310 Managing IT Resources
          </div>
        </div>
        <div class="accordion" id="accordion-senior-elective">
          <div class="card" >
            <div class="card-header" id="heading-senior-elective">
              <h2 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-senior-elective" aria-expanded="false" aria-controls="collapse-senior-elective">
                  ITWS Senior Elective
                </button>
              </h2>
            </div>

            <div id="collapse-senior-elective" class="collapse" aria-labelledby="heading-senior-elective" data-parent="#accordion-senior-elective">
              <div class="card-body">
                ITWS-4100 Information Technology and Web Science Capstone (Professional Track) <br>
                ITWS-4990 Senior Thesis (Research Track – Two Semesters) 
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="container">
        <h2>ITWS Technical Tracks</h2>
          <div class="accordion" id="comp-engineer-track">
            <div class="card" >
              <div class="card-header" id="comp-engineer-track-heading">
                <h2 class="mb-0">
                  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseCETrack" aria-expanded="false" aria-controls="collapseCETrack">
                    Computer Engineer Track
                  </button>
                </h2>
              </div>

              <div id="collapseCETrack" class="collapse" aria-labelledby="comp-engineer-track-heading" data-parent="#comp-engineer-track">
                <div class="card-body">
                  <div class="card" >
                    <div class="card-header border-0" style="padding-left:33px;">
                      ECSE-2610 Computer Components and Operations
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header border-0" style="padding-left:33px;">
                      ENGR-2350 Embedded Control
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header border-0" style="padding-left:33px;">
                      ECSE-2660 Computer Architecture, Networking and Operating Systems
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="accordion" id="comp-science-track">
            <div class="card">
              <div class="card-header" id="comp-science-track-heading">
                <h2 class="mb-0">
                  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseCSTrack" aria-expanded="false" aria-controls="collapseCSTrack">
                    Computer Science Track
                  </button>
                </h2>
              </div>

              <div id="collapseCSTrack" class="collapse" aria-labelledby="comp-science-track-heading" data-parent="#comp-science-track">
                <div class="card-body">
                  <div class="card" >
                    <div class="card-header border-0" style="padding-left:33px;">
                      CSCI-2200 Foundations of Computer Science
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header border-0" style="padding-left:33px;">
                      CSCI-2300 Introduction to Algorithms
                    </div>
                  </div>
                  <div class="card" >
                    <div class="card-header border-0" style="padding-left:33px;">
                      CSCI-2500 Computer Organization
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="accordion" id="info-sys-track">
            <div class="card" >
              <div class="card-header" id="info-sys-track-heading">
                <h2 class="mb-0">
                  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseISTrack" aria-expanded="false" aria-controls="collapseISTrack">
                    Information Systems Track
                  </button>
                </h2>
              </div>

              <div id="collapseISTrack" class="collapse" aria-labelledby="info-sys-track-heading" data-parent="#info-sys-track">
                <div class="card-body">
                  <div class="card">
                    <div class="card-header border-0" style="padding-left:33px;">
                      CSCI-2200 Foundations of Computer Science
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header border-0" style="padding-left:33px;">
                      CSCI-2500 Computer Organization
                    </div>
                  </div>
                  
                  <div class="accordion" id="accordion-infosys-track">
                    <div class="card">
                      <div class="card-header" id="heading-infosys-track">
                        <h2 class="mb-0">
                          <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-infosys-track" aria-expanded="false" aria-controls="collapse-infosys-track">
                            Information Systems Options (Choose One)
                          </button>
                        </h2>
                      </div>

                      <div id="collapse-infosys-track" class="collapse" aria-labelledby="heading-infosys-track" data-parent="#accordion-infosys-track">
                        <div class="card-body">
                          MGMT-2100 Statistical Methods <br>
                          BIOL-4200 Biostatistics <br>
                          CSCI-2300 Introduction to Algorithms <br>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="accordion" id="web-science-track">
            <div class="card">
              <div class="card-header" id="web-science-track-heading">
                <h2 class="mb-0">
                  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseWSTrack" aria-expanded="false" aria-controls="collapseWSTrack">
                    Web Science Track
                  </button>
                </h2>
              </div>

              <div id="collapseWSTrack" class="collapse" aria-labelledby="web-science-track-heading" data-parent="#web-science-track">
                <div class="card-body">
                  <div class="card">
                    <div class="card-header border-0" style="padding-left:33px;">
                      CSCI-2200 Foundations of Computer Science
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header border-0" style="padding-left:33px;">
                      CSCI-2300 Introduction to Algorithms
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header border-0" style="padding-left:33px;">
                      CSCI-2500 Computer Organization
                    </div>
                  </div>
                </div>
              </div>
            </div>       
          </div>
        </div>
      </div>
      <!-- concentration List -->
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

                  // $yes_courses_options = array(); // 2 4
                  $course_group_catalog_ids = array(); // 1 2 4
                  
                  // find the intersection of [2 3 4 5 6 7 8 11] and [1 2 4] to get [2 4]
                  $yes_courses_options = $dbconn->query("SELECT * from `course_group_catalog` WHERE `course_group_catalog`.course_id in (" . implode(", ", $yes_courses_id) . ")");
                  $yes_courses_options_arr = array(); // [2, 4]

                  foreach ($yes_courses_options as $row5) {
                    // echo $row5["course_id"] . "<br>";
                    array_push($yes_courses_options_arr, $row5["course_id"]);
                  }

                  $option_details_ids = $dbconn->query("SELECT * from `course_group_catalog_data` WHERE `course_group_catalog_data`.course_group_id in (" . implode(", ", $yes_courses_options_arr) . ")");
                  
                  $option_details_ids_arr = array(); // 12, 13, 14, 15, 16, 17
                  
                  $dictionary = array_fill_keys($yes_courses_options_arr, array());
                  
                  foreach ($dictionary as $key=>$value) {
                    // echo $key;
                    $my_courses = $dbconn->query("SELECT * from `course_group_catalog_data` WHERE `course_group_catalog_data`.course_group_id=$key");

                    foreach ($my_courses as $row9) {
                      // echo $row9["course_id"] . "<br>";
                      array_push($dictionary[$key], $row9["course_id"]);
                    }
                    // echo "<br>";
                  }
                  // $dictionary contains (2=>array(12, 13, 14), 4=>array(15, 16, 17))
                  
                  foreach ($yes_courses as $row6) {
                    // when it's a course group
                    if (array_key_exists($row6["id"], $dictionary)) {

                    
                      echo '<div class="accordion" id="accordionOptions' . $row6["id"] . '">
                              <div class="card" style="margin: 8px;">
                                <div class="card-header" id="courseHeading' . $row6["id"] . '">
                                  <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#coursesCollapse' . $row6["id"] . '" aria-expanded="false" aria-controls="coursesCollapse' . $row6["id"] . '">'
                                    . $row6["name"] . " (Choose One)" .
                                    '</button>
                                  </h2>
                                </div>
                              <div id="coursesCollapse' . $row6["id"] . '" class="collapse" aria-labelledby="courseHeading' . $row6["id"] . '" data-parent="#accordionOptions' . $row6["id"] . '">
                                <div class="card-body">';
                                                   
                      // if 2 in (2=>array(12, 13, 14), 4=>array(15, 16, 17))
                      // print out all courses 12, 13, 14
                      foreach ($dictionary[$row6["id"]] as $key) {
                        $course_single = $dbconn->query("SELECT * from `course_single` WHERE `course_single`.course_id=$key");
                        
                        foreach ($course_single as $row12) {
                          echo $row12["prefix"] . "-" . $row12["number"] . " ";
                        }

                        $query = $dbconn->query("SELECT * from `courses` WHERE `courses`.id=$key");
                        foreach ($query as $row10) {
                          echo $row10["name"];
                          echo "<br>";
                          
                        }
                      }
                      echo '</div>
                          </div>
                        </div>
                      </div>';

                    }
                    // when it's a single course
                    else {
                      $course_id = $row6['id'];
                      $course_single = $dbconn->query("SELECT * from `course_single` WHERE `course_single`.course_id=$course_id");
                      
                      echo '<div class="card" style="margin: 8px;">
                              <div class="card-header border-0" style="padding-left:33px;">';
                      foreach ($course_single as $row11) {
                        echo $row11["prefix"] . "-" . $row11["number"] . " ";
                      }
                      echo $row6["name"] . "<br>";
                      echo    '</div>
                            </div>';
                    }
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