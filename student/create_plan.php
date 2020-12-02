<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . "/db.php";
  $dbconn = Database::getDatabase();
  // need to determine which plan the user clicked on
  
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $selected_plan=$id;
  }
  
  // $selected_plan = ; //hardcoded lol
  $plan_details_stmt = $dbconn->prepare("SELECT * FROM plans WHERE id = ?;");
  $plan_details_stmt->execute(array($selected_plan));
  
  $plan_details = $plan_details_stmt->fetch(); // Plan Notes: ""This is my 4-year plan..."

  $plan_semesters_stmt = $dbconn->prepare("SELECT * FROM plan_semesters WHERE plan_id = ?;");
  $plan_semesters_stmt->execute(array($selected_plan));
  
  $plan_semesters = $plan_semesters_stmt->fetchAll(); // all semesters - year and id 

  $semester_list = array();
  foreach($plan_semesters as $semester) {
    $semester_list[] = $semester['id']; // tells you the position of each semester
  }

  // $in  = str_repeat('?,', count($arr) - 1) . '?'; // alternative option if you want to do prepared statement
  $plan_courses_stmt = $dbconn->prepare("SELECT plan_courses.semester_id, plan_courses.course_id, plan_courses.position, courses.name, course_single_catalog.prefix, course_single_catalog.number FROM plan_courses INNER JOIN courses ON plan_courses.course_id = courses.id INNER JOIN course_single_catalog ON plan_courses.course_id = course_single_catalog.course_single_id WHERE plan_courses.semester_id IN (" . implode(", ", $semester_list) . ") ORDER BY plan_courses.semester_id, plan_courses.position;");
  $plan_courses_stmt->execute();
  $plan_courses = $plan_courses_stmt->fetchAll();
  
  
?>
<!DOCTYPE html>

<html lang="en">
  <head>
    <title>Student Create Plan</title>

    <!-- CSS ONLY -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="/assets/js/student_create_plan.js"></script>
  </head>

  <body>
  
    <!--NAVIGATION BAR (implemented with Bootstrap) -->
    <?php include('student_navbar.php'); ?>

    <section class="plan-header">
      <!-- <input type="text" class="plan-name" placeholder="&starf;PLAN NAME"> -->
      <?php $favorited = $plan_details["favorited"];
        if ($favorited == 0) {
          $string_star = "<span id='star' style='cursor: pointer'><i class='ri-star-s-line'></i></span>";
        }
        else {
          $string_star = "<span id='star' style='cursor: pointer'><i class='ri-star-s-fill'></i></span>";
        }
      ?>
     
      <script>
        $(function() {
          $('span').click(function() {
              $(this).find('[class^="ri-star-s"]').toggleClass('ri-star-s-fill').toggleClass('ri-star-s-line');
          });
        });
      </script>
      
      <ul id="plan-name-star">        
        <li class="plan-name-editable center" contenteditable=true><?php echo $plan_details["name"] ?></li>
        <li><?php echo $string_star ?></li>
      <ul>
      
      <button id="toggle-config-button" class="btn btn-outline-primary">More Details</button>
    </section>
    <!-- TODO: discuss how to make fields editable nicely -->
    <section class="schedule">
      <div class="container">
        <div class="row">
            <div class="col">
              <div id="semester-row" class="row">
                <?php $index = 0;
                  for($i = 0; $i < count($semester_list); $i++) {
                ?>
                <div class="semester-whole col-md-6">
                  <div class="semester">
                    <div class="row semester-title">
                      <?php echo $plan_semesters[$i]["name"] ?>
                    </div> 
                    <?php for($index; $index < count($plan_courses); $index++) {
                            if($plan_courses[$index]["semester_id"] != $i + 1) {
                              break;
                            }
                            ?>
                    <div class="row semester-course">
                      <div class="col-md-1 course-status"><span class="dot dot-green"></span></div>
                      <div class="col-md-5 course-title"><?php echo $plan_courses[$index]["name"] ?></div>
                      <div class="col-md-3 course-code">
                        <span class="course-editable course-prefix" contenteditable=true><?php echo $plan_courses[$index]["prefix"]?></span>-<span class="course-editable course-number" contenteditable=true><?php echo $plan_courses[$index]["number"] ?></span>
                      </div>
                      <div class="col-md-1 course-credits">4</div>
                      <div class="col-md-2 course-trash"><i class="ri-delete-bin-line btn btn-link course-trash-button"></i></div>
                    </div>
                          <?php } ?>
                    <div class="row course-add">
                      <button class="btn btn-secondary add-course-button">Add Course</button>
                      <!-- <button class="btn btn-primary add-course-group-button" href="#" role="button" disabled=true>Add Course Group</button> -->
                    </div>
                  </div>
                </div>
                      <?php }?>
              </div>
            </div>
            
            
            <div id="schedule-config" class="col-md-6">
              <div id="schedule-config-container">
                <ul id="schedule-config-nav" class="nav nav-tabs">
                  <li class="nav-item">
                    <button class="nav-link active" href="#">Catalog</button>
                  </li>
                  <li class="nav-item">
                    <button class="nav-link" href="#">Validation</button>
                  </li>
                  <!-- <li class="nav-item">
                    <button class="nav-link" href="#">Groups</button>
                  </li> -->
                  <li class="nav-item">
                    <button class="nav-link" href="#">Notes</button>
                  </li>
                  <!-- <li class="nav-item">
                    <button class="nav-link" href="#">Settings</button>
                  </li> -->
                </ul>

                <!-- Courses -->
                <div id="plan-config-courses">
                   <div id="accordion">
                    <div class="card">
                      <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                          <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          ITWS Core Requirements</a> <br>
                        </h5>
                      </div>
                      <!-- Show Config drag and drop -->
                      <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <!-- sortable2 -->
                        <div id="sortable2" class="connectedSortable semester">
                          <!-- <div class="ui-state-highlight semester-course">Introduction to ITWS</div>
                          <div class="ui-state-highlight semester-course">Web Systems Development</div>
                          <div class="ui-state-highlight semester-course">Web Science Systems Development</div>
                          <div class="ui-state-highlight semester-course">Managing IT Resources</div>
                          <div class="ui-state-highlight semester-course">Capstone/Senior Thesis</div> -->
                          <div class="row semester-course"> 
                            <div class="col-md-1 course-status"><span class="dot"></span></div>
                            <div class="col-md-5 course-editable course-title  " contenteditable=true>Introduction to ITWS</div>
                            <div class="col-md-3 course-editable course-code" contenteditable=true>ITWS-1200</div>
                            <div class="col-md-1 course-editable course-credits" contenteditable=true>4</div>
                            <div class="col-md-2 course-trash"><i class="ri-delete-bin-line btn btn-link course-trash-button"></i></div>
                            <!-- <div class="col-md-2 course-trash"><button class="btn btn-link course-trash-button">&#x1f5d1;</button></div> -->
                            <!-- <div class="col-md-1 course-config"><button class="btn btn-link course-config-button">&#9881;</button></div> -->
                          </div>
                          <div class="row semester-course"> 
                            <div class="col-md-1 course-status"><span class="dot"></span></div>
                            <div class="col-md-5 course-editable course-title  " contenteditable=true>Web Systems Development</div>
                            <div class="col-md-3 course-editable course-code" contenteditable=true>ITWS-2110</div>
                            <div class="col-md-1 course-editable course-credits" contenteditable=true>4</div>
                            <div class="col-md-2 course-trash"><i class="ri-delete-bin-line btn btn-link course-trash-button"></i></div>
                            <!-- <div class="col-md-2 course-trash"><button class="btn btn-link course-trash-button">&#x1f5d1;</button></div> -->
                            <!-- <div class="col-md-1 course-config"><button class="btn btn-link course-config-button">&#9881;</button></div> -->
                          </div>
                          <div class="row semester-course"> 
                            <div class="col-md-1 course-status"><span class="dot"></span></div>
                            <div class="col-md-5 course-editable course-title  " contenteditable=true>Web Science Systems Development</div>
                            <div class="col-md-3 course-editable course-code" contenteditable=true>ITWS-4500</div>
                            <div class="col-md-1 course-editable course-credits" contenteditable=true>4</div>
                            <div class="col-md-2 course-trash"><i class="ri-delete-bin-line btn btn-link course-trash-button"></i></div>
                            <!-- <div class="col-md-2 course-trash"><button class="btn btn-link course-trash-button">&#x1f5d1;</button></div> -->
                            <!-- <div class="col-md-1 course-config"><button class="btn btn-link course-config-button">&#9881;</button></div> -->
                          </div>
                          <div class="row semester-course"> 
                            <div class="col-md-1 course-status"><span class="dot"></span></div>
                            <div class="col-md-5 course-editable course-title  " contenteditable=true>Managing IT Resources</div>
                            <div class="col-md-3 course-editable course-code" contenteditable=true>ITWS-4310</div>
                            <div class="col-md-1 course-editable course-credits" contenteditable=true>4</div>
                            <div class="col-md-2 course-trash"><i class="ri-delete-bin-line btn btn-link course-trash-button"></i></div>
                            <!-- <div class="col-md-2 course-trash"><button class="btn btn-link course-trash-button">&#x1f5d1;</button></div> -->
                            <!-- <div class="col-md-1 course-config"><button class="btn btn-link course-config-button">&#9881;</button></div> -->
                          </div>
                          <div class="row semester-course"> 
                            <div class="col-md-1 course-status"><span class="dot"></span></div>
                            <div class="col-md-5 course-editable course-title  " contenteditable=true>ITWS Capstone (Professional Track)</div>
                            <div class="col-md-3 course-editable course-code" contenteditable=true>ITWS-4100</div>
                            <div class="col-md-1 course-editable course-credits" contenteditable=true>4</div>
                            <div class="col-md-2 course-trash"><i class="ri-delete-bin-line btn btn-link course-trash-button"></i></div>
                            <!-- <div class="col-md-2 course-trash"><button class="btn btn-link course-trash-button">&#x1f5d1;</button></div> -->
                            <!-- <div class="col-md-1 course-config"><button class="btn btn-link course-config-button">&#9881;</button></div> -->
                          </div>
                          <div class="row semester-course"> 
                            <div class="col-md-1 course-status"><span class="dot"></span></div>
                            <div class="col-md-5 course-editable course-title  " contenteditable=true>Senior Thesis</div>
                            <div class="col-md-3 course-editable course-code" contenteditable=true>ITWS-4500</div>
                            <div class="col-md-1 course-editable course-credits" contenteditable=true>4</div>
                            <div class="col-md-2 course-trash"><i class="ri-delete-bin-line btn btn-link course-trash-button"></i></div>
                            <!-- <div class="col-md-2 course-trash"><button class="btn btn-link course-trash-button">&#x1f5d1;</button></div> -->
                            <!-- <div class="col-md-1 course-config"><button class="btn btn-link course-config-button">&#9881;</button></div> -->
                          </div>
                        </div>
                      </div> 

                    </div>
                    <div class="card">
                      <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                          <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Math/Science Requirements
                          </button>
                        </h5>
                      </div>
                      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                        <div class="row semester-course"> 
                            <div class="col-md-1 course-status"><span class="dot"></span></div>
                            <div class="col-md-5 course-editable course-title  " contenteditable=true>Calculus I</div>
                            <div class="col-md-3 course-editable course-code" contenteditable=true>MATH-1010</div>
                            <div class="col-md-1 course-editable course-credits" contenteditable=true>4</div>
                            <div class="col-md-2 course-trash"><i class="ri-delete-bin-line btn btn-link course-trash-button"></i></div>
                            <!-- <div class="col-md-2 course-trash"><button class="btn btn-link course-trash-button">&#x1f5d1;</button></div> -->
                            <!-- <div class="col-md-1 course-config"><button class="btn btn-link course-config-button">&#9881;</button></div> -->
                          </div>
                          <div class="row semester-course"> 
                            <div class="col-md-1 course-status"><span class="dot"></span></div>
                            <div class="col-md-5 course-editable course-title  " contenteditable=true>Math Elective</div>
                            <div class="col-md-3 course-editable course-code" contenteditable=true>MATH-XXXX</div>
                            <div class="col-md-1 course-editable course-credits" contenteditable=true>4</div>
                            <div class="col-md-2 course-trash"><i class="ri-delete-bin-line btn btn-link course-trash-button"></i></div>
                            <!-- <div class="col-md-2 course-trash"><button class="btn btn-link course-trash-button">&#x1f5d1;</button></div> -->
                            <!-- <div class="col-md-1 course-config"><button class="btn btn-link course-config-button">&#9881;</button></div> -->
                          </div>
                          <div class="row semester-course"> 
                            <div class="col-md-1 course-status"><span class="dot"></span></div>
                            <div class="col-md-5 course-editable course-title  " contenteditable=true>Physical Science Elective</div>
                            <div class="col-md-3 course-editable course-code" contenteditable=true>PHYS-XXXX</div>
                            <div class="col-md-1 course-editable course-credits" contenteditable=true>4</div>
                            <div class="col-md-2 course-trash"><i class="ri-delete-bin-line btn btn-link course-trash-button"></i></div>
                            <!-- <div class="col-md-2 course-trash"><button class="btn btn-link course-trash-button">&#x1f5d1;</button></div> -->
                            <!-- <div class="col-md-1 course-config"><button class="btn btn-link course-config-button">&#9881;</button></div> -->
                          </div>
                          <div class="row semester-course"> 
                            <div class="col-md-1 course-status"><span class="dot"></span></div>
                            <div class="col-md-5 course-editable course-title  " contenteditable=true>Life Science Elective</div>
                            <div class="col-md-3 course-editable course-code" contenteditable=true>BIOL-XXXX</div>
                            <div class="col-md-1 course-editable course-credits" contenteditable=true>4</div>
                            <div class="col-md-2 course-trash"><i class="ri-delete-bin-line btn btn-link course-trash-button"></i></div>
                            <!-- <div class="col-md-2 course-trash"><button class="btn btn-link course-trash-button">&#x1f5d1;</button></div> -->
                            <!-- <div class="col-md-1 course-config"><button class="btn btn-link course-config-button">&#9881;</button></div> -->
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                          <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          Humanities, Arts, and Social Sciences Requirements
                          </button>
                        </h5>
                      </div>

                      <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body">
                        <div class="row semester-course"> 
                            <div class="col-md-1 course-status"><span class="dot"></span></div>
                            <div class="col-md-5 course-editable course-title  " contenteditable=true>IT and Society</div>
                            <div class="col-md-3 course-editable course-code" contenteditable=true>ITWS-1220</div>
                            <div class="col-md-1 course-editable course-credits" contenteditable=true>4</div>
                            <div class="col-md-2 course-trash"><i class="ri-delete-bin-line btn btn-link course-trash-button"></i></div>
                            <!-- <div class="col-md-2 course-trash"><button class="btn btn-link course-trash-button">&#x1f5d1;</button></div> -->
                            <!-- <div class="col-md-1 course-config"><button class="btn btn-link course-config-button">&#9881;</button></div> -->
                          </div>
                          <div class="row semester-course"> 
                            <div class="col-md-1 course-status"><span class="dot"></span></div>
                            <div class="col-md-5 course-editable course-title  " contenteditable=true>Intro to Human Computer Interaction</div>
                            <div class="col-md-3 course-editable course-code" contenteditable=true>ITWS-2210</div>
                            <div class="col-md-1 course-editable course-credits" contenteditable=true>4</div>
                            <div class="col-md-2 course-trash"><i class="ri-delete-bin-line btn btn-link course-trash-button"></i></div>
                            <!-- <div class="col-md-2 course-trash"><button class="btn btn-link course-trash-button">&#x1f5d1;</button></div> -->
                            <!-- <div class="col-md-1 course-config"><button class="btn btn-link course-config-button">&#9881;</button></div> -->
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-header" id="headingFour">
                        <h5 class="mb-0">
                          <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                          Concentration Requirements
                          </button>
                        </h5>
                      </div>

                      <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                        <div class="card-body">
                        <div class="row semester-course"> 
                            <div class="col-md-1 course-status"><span class="dot"></span></div>
                            <div class="col-md-5 course-editable course-title  " contenteditable=true>Concentration Course</div>
                            <div class="col-md-3 course-editable course-code" contenteditable=true>EXPL-XXXX</div>
                            <div class="col-md-1 course-editable course-credits" contenteditable=true>4</div>
                            <div class="col-md-2 course-trash"><i class="ri-delete-bin-line btn btn-link course-trash-button"></i></div>
                            <!-- <div class="col-md-2 course-trash"><button class="btn btn-link course-trash-button">&#x1f5d1;</button></div> -->
                            <!-- <div class="col-md-1 course-config"><button class="btn btn-link course-config-button">&#9881;</button></div> -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Validation -->
                <div id="plan-config-validation">


                  <h5 class="validation-message">It looks like you have not used all of your required courses.</h5>
                  <div class="validation-form">
                    <input type="checkbox" class="validation-form-input" id="itws-requirements">
                    <label class="form-check-label" for="itws-requirements">ITWS Core Requirements</label>
                    <br>
                    <input type="checkbox" class="validation-form-input" id="math-science-requirements" checked>
                    <label class="form-check-label" for="math-science-requirements">Math/Science Requirements</label>
                    <br>
                    <input type="checkbox" class="validation-form-input" id="hass-requirements" checked>
                    <label class="form-check-label" for="hass-requirements">HASS Requirements</label>
                    <br>
                    <input type="checkbox" class="validation-form-input" id="concentration-requirements">
                    <label class="form-check-label" for="concentration-requirements">Concentration Requirements</label>
                  </div>
                </div>

                <!-- Groups
                <div id="plan-config-groups">
                  Groups page
                </div> -->

                <!-- Notes -->
                <div id="plan-config-notes">
                  <textarea class="form-control" id="text-area-notes"><?php echo $plan_details["notes"] ?>
                  </textarea>                  
                </div>

                <!-- Settings
                <div id="plan-config-settings">
                  Settings page
                </div> -->

              </div>
            </div>
        </div>

      </div>
    </section>

  </body>
</html>