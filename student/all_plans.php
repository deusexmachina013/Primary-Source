<!DOCTYPE html>

<html lang="en">
  <head>
    <title>Student All Plans</title>

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
      <!-- All Plans -->
      <h1>All Plans</h1>
      <!-- concentrationn List -->
      
      <!-- Button trigger modal -->
      <button id="toggle-create_plan-button" class="btn btn-outline-primary" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalForm">Create Plan</button>
      <div class="container">
        <!-- ROWS -->
        <!-- NOTE: To be kept as an HTML template for displaying plans. -->
        <div class="row">
          <div class="col-sm col-conc">
            <a class= "concentration" href= "home.php"> &#9733 Main Plan</a>
          </div>
        </div>
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
              <!-- <label for="inputMajor">Major</label>
              <input type="text" class="form-control" id="inputMajor" placeholder="Enter Major"> -->
              <label for="major">Choose a major from the list:</label> <br>
              
              <input class="formDropdown" list="majors" name="major" id="major">
              <datalist id="majors">
                <option value="Information Technology and Web Science">
              </datalist>

            </div>
            <div class="form-group">
              <!-- <label for="inputConcentration">Concentration</label> -->
              <!-- <input type="text" class="form-control" id="inputConcentration" placeholder="Enter Concentration"> -->
              <label for="concentration">Choose a concentration from the list:</label> <br>
              
              <input class="formDropdown" list="concentrations" name="concentration" id="concentration">
              <datalist id="concentrations">
                <?php 
                  // foreach ($concentrations as $row) { 
                  // echo "<option value=' . $row['name'] . '>" 
                  // }
                ?>
                <option value="Arts">
                <option value="Civil/Structural Engineer">
                <option value="Cognitive Science">
                <option value="Communication">
                <option value="Computer Hardware">
                <option value="Computer Networking">
                <option value="Data Science">
                <option value="Economcs">
                <option value="Entrepreneurship">
                <option value="Finance">
                <option value="Information Security">
                <option value="Machine & Computational Learning">
                <option value="Management Information Systems">
                <option value="Mechanical/Aeronautical Engineering">
                <option value="Medicine">
                <option value="Pre-Law">
                <option value="Psychology">
                <option value="Science & Technology Studies">
                <option value="Science Informatics">
                <option value="Special Interest">
                <option value="Web Technology">
              </datalist>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <a type="submit" class="btn btn-primary" href="/student/create_plan.php">Create Plan</a>
        </div>
      </div>
    </div>
  </div>

  </body>
</html>