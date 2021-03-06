<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . "/auth/auth.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/db.php";
$dbconn = Database::getDatabase();

$conc = $dbconn->query("SELECT templates.name from `templates`");

?>

<!DOCTYPE html>

<html lang="en">
  <head>
    <title>Home Page</title>

    <!-- CSS ONLY -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/style.css">    

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

    <script src="/assets/js/student_new_plan.js"></script>
  </head>

  <body>
    <!--NAVIGATION BAR (implemented with Bootstrap) -->
    <?php include('student_navbar.php');?>

    <section class="content">
      
      <!-- All Plans -->
      <h1 class="all-plans-title">Hi!<span style='font-size:45px;'>&#128075;</span> here are your plans:</h1>
      <!-- concentrationn List -->
      
      <!-- Button trigger modal -->
      <button id="toggle-create-plan-button" class="btn btn-secondary float-right" type="button" data-toggle="modal" data-target="#modalForm">Create Plan</button>

      <!-- NOTE: To be kept as an HTML template for displaying plans. -->
      <div class="col-sm plan-name-container">
        <?php
            // find the user first
            $current_user_id = $_SESSION["id"];
            // loop through plans table
            $plans = $dbconn->query("SELECT * from `plans` WHERE `plans`.user_id = $current_user_id ORDER BY favorited DESC")->fetchAll();
            // var_dump($plans);
            
            foreach($plans as $row){
              $current_plan_id = $row["id"];
              $favorited = $row["favorited"];
              if ($favorited == 0) {
                $string_star = "";
              }
              else {
                $string_star = "&#9733";
              }
              
              echo "<a class='all-plans-header btn btn-secondary' href='create_plan.php?id=$current_plan_id' name='$current_plan_id'>" . $row['name'] . " " . $string_star . "</a>";
              $string_star = "";
            }

        ?>
      
      </div>
    </section>

  <!-- Modal -->
  <div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Plan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="inputPlanName">Plan Name</label>
              <input type="text" class="form-control" id="inputPlanName" placeholder="Enter Plan Name">
            </div>
            <div class="form-group">
              <label for="major">Choose a major from the list:</label> <br>
              
              <input class="formDropdown" list="majors" name="major" id="major">
              <datalist id="majors">
                <option value="Information Technology and Web Science">
              </datalist>

            </div>
            <div class="form-group">
              <label for="concentration">Choose a concentration from the list:</label> <br>
              
              <input class="formDropdown" list="concentrations" name="concentration" id="form-template-plan-concentration">
              <datalist id="concentrations">
                <?php 
                  foreach ($conc as $row) { 
                    echo '<option value="' . $row['name'] . '">';
                  }
                ?> 
              </datalist>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="new-plan-button" class="btn btn-primary" >Create Plan</button>
        </div>
      </div>
    </div>
  </div>

