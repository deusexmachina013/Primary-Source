<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . "/auth/auth.php";
  require_once $_SERVER['DOCUMENT_ROOT'] . "/db.php";
  $dbconn = Database::getDatabase();
  // need to determine which plan the user clicked on
  
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $selected_plan=$id;
  } else {
    header("Location: /student/home.php");
    die();
  }
  
  $plan_details_stmt = $dbconn->prepare("SELECT * FROM plans WHERE id = ? AND user_id = ?;");
  $plan_details_stmt->execute(array($selected_plan, $_SESSION["id"]));
  
  if($plan_details_stmt->rowCount() == 0) {
    header("Location: /student/home.php");
    die();
  }

  $plan_details = $plan_details_stmt->fetch(); // Plan Notes: ""This is my 4-year plan..."

  $read_only = $plan_details["advisor_status"] > 0;

  $plan_semesters_stmt = $dbconn->prepare("SELECT * FROM plan_semesters WHERE plan_id = ?;");
  $plan_semesters_stmt->execute(array($selected_plan));
  
  $plan_semesters = $plan_semesters_stmt->fetchAll(); // all semesters - year and id 

  $semester_list = array();
  foreach($plan_semesters as $semester) {
    $semester_list[] = $semester['id']; // tells you the position of each semester
  }

  // $in  = str_repeat('?,', count($arr) - 1) . '?'; // alternative option if you want to do prepared statement
  $plan_courses_stmt = $dbconn->prepare("SELECT plan_courses.semester_id, plan_courses.course_id, plan_courses.position, courses.name, course_single_catalog.prefix, course_single_catalog.number, course_single_catalog.credit_low, course_single_catalog.credit_high FROM plan_courses INNER JOIN courses ON plan_courses.course_id = courses.id INNER JOIN course_single_catalog ON plan_courses.course_id = course_single_catalog.course_single_id WHERE plan_courses.semester_id IN (" . implode(", ", $semester_list) . ") ORDER BY plan_courses.semester_id, plan_courses.position;");
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
        <?php if($read_only) { ?><li><span class="locked-icon"><i class="ri-lock-fill"></i></span></li><?php } ?>
      <li class="plan-name-editable center" <?php if(!$read_only) { ?>contenteditable=true<?php } ?>><?php echo $plan_details["name"] ?></li>
        <li><?php echo $string_star ?></li>
      <ul>
      <div id="create-plan-page-buttons">
      <?php if(!$read_only) { ?>
        <button id="save-button" class="btn btn-secondary">Save Changes</button>
        <button id="advisor-button" class="btn btn-secondary">Send to Advisor</button>
      <?php } ?>
        <button id="toggle-config-button" class="btn btn-secondary">More Details</button>
      </div>
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
                  <div class="row semester-title" <?php if(!$read_only) {?>contenteditable=true<?php } ?>>
                      <?php echo $plan_semesters[$i]["name"] ?>
                    </div> 
                    <?php
                    for($index; $index < count($plan_courses); $index++) {
                            if($plan_courses[$index]["semester_id"] != $plan_semesters[$i]["id"]) {
                              break;
                            }
                            ?>
                    <div class="row semester-course">
                      <div class="col-md-1 course-status"><span class="dot dot-green"></span></div>
                      <div class="col-md-5 course-title"><?php echo $plan_courses[$index]["name"] ?></div>
                      <div class="col-md-3 course-code">
                        <span class="course-editable course-prefix"><?php echo $plan_courses[$index]["prefix"]?></span>-<span class="course-editable course-number"><?php echo $plan_courses[$index]["number"] ?></span>
                      </div>
                      <div class="col-md-1 course-credits"><?php echo $plan_courses[$index]["credit_low"] === $plan_courses[$index]["credit_high"] ? $plan_courses[$index]["credit_low"] : $plan_courses[$index]["credit_low"] . "-" . $plan_courses[$index]["credit_high"] ?></div>
                          <div class="col-md-2 course-trash"><?php if(!$read_only) { ?><i class="ri-delete-bin-line btn btn-link course-trash-button"></i><?php } ?></div>
                    </div>
                          <?php } ?>
                    <?php if(!$read_only) { ?>
                    <div class="row course-add">
                      <!-- <button class="btn btn-info add-course-button">Add Course</button> -->
                      <!-- <button class="btn btn-primary add-course-group-button" href="#" role="button" disabled=true>Add Course Group</button> -->
                    
                      <button type="button" class="btn btn-info" id="add-course-button-<?php echo $i ?>" data-toggle="modal" data-target="#addCourseModal">
                        Add Course
                      </button>
                    </div>
                    <?php } ?>
                  </div>
                </div>
                      <?php }?>
              </div>
            </div>
            <?php if(!$read_only) { ?>
            <!-- Add Course Modal -->
            <div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="addCourseModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="addCourseModalLabel">Add Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!-- two options -->
                    <!-- add catalog course -->
                    <nav class="navbar navbar-light bg-light">
                      <form id="add-course-form" class="form-inline">
                        <input name="search-input-course" class="form-control mr-sm-2 search-input-course" type="search" placeholder="Search for Courses" aria-label="Search" style=" width:340px">
                        <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
                      </form>
                      
                    </nav>
                    
                    <!-- STRIPED TABLE -->
                    <table class="table table-striped search-results-table">
                      <tbody class="search-results-body">
             
                      </tbody>
                    </table>

                    <!-- add custom course -->
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>

              
            <div id="schedule-config" class="col-md-6">
              <div id="schedule-config-container">
                <ul id="schedule-config-nav" class="nav nav-tabs">
                  <li class="nav-item">
                    <button class="nav-link" href="#">Notes</button>
                  </li>
                </ul>

              <!-- Notes -->
              <div id="plan-config-notes">
                <textarea class="form-control" id="text-area-notes"><?php echo $plan_details["notes"] ?>
                </textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
