<!DOCTYPE html>

<html lang="en">
  <head>
    <title>Administrator Homepage</title>

    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">


    <!-- JS, Popper.js, and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <script src="../assets/js/admin_homepage.js"></script>
  </head>

  <body>
    <?php include("admin_navbar.php"); ?>

    <main class="content">
      <h1>Administration</h1>

      <form id="student-lookup" class="student-search center" accept-charset="utf-8" method="POST" name="student-search" role="search" action="pull_students.php">
        <div class="left-partition">
          <select id="student-search-dropdown" class="search-dropdown" name="student-search-dropdown" title="Filter by">
            <option selected="selected" value="student_name">Student Name</option>
            <option value="class_year">Cohort Year</option>
            <option value="plan_status">Status</option>
          </select>
        </div>
        <div class="right-partition">
          <input type="text" id="admin-lookup" class="student-searchbar" placeholder="Look up student plans." name="search-bar">
          <input type="submit" class="student-submit" value="&#128269">
        </div>
        <div class="button-position">
          <button type="button" class="courses-add-button" data-toggle="modal" data-target="#addCourseModal">Add Course</button>
          <button type="button" class="courses-add-requirement" data-toggle="modal" data-target="#addRequirementModal">Add Requirement</button>
        </div>
      </form>

      <div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addStudentModalLabel">Add Course</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="form-student" action="." method="post">
              <div class="form-group">
                <label for="form-course-name" class="col-form-label">Name:</label>
                <input type="text" class="form-control" id="form-course-name" name="form-course-name" required="required" maxlenght=100>
              </div>
              <div class="form-group">
                <label for="form-course-prefix" class="col-form-label">Prefix:</label>
                <input type="text" class="form-control" id="form-course-prefix" name="form-course-prefix" maxlength=4>
              </div>
              <div class="form-group">
                <label for="form-course-number" class="col-form-label">Number:</label>
                <input type="number" class="form-control" id="form-course-number" name="form-course-number" required="required" min=1000 max=10000>
              </div>
              <div class="form-group">
                <label for="form-course-cl" class="col-form-label">Credit-Low:</label>
                <input type="number" class="form-control" id="form-course-cl"name="form-course-cl" required="required" min=0 max=1>
              </div>
              <div class="form-group">
                <label for="form-course-hl" class="col-form-label">Credit-High:</label>
                <input type="number" class="form-control" id="form-course-hl"name="form-course-hl" required="required" min=4 max=6>
              </div>
            </form>
            <div class="form-group">
                <label for="form-course-pre" class="col-form-label">Prerequisites:</label>
                <input type="text" class="form-control" id="form-course-pre" name="form-course-pre" maxlength=1000>
              </div>
            </form>
            <div class="form-group">
                <label for="form-course-co" class="col-form-label">Corequisites:</label>
                <input type="text" class="form-control" id="form-course-co" name="form-course-co" maxlength=1000>
              </div>
            <div class="form-group">
              <label for="form-course-term" class="col-form-label">Terms Offered:</label>
              <input type="text" class="form-control" id="form-course-term" name="form-course-term" required="required" maxlength=100>
            </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" form="form-student" name="add_student" value="Submit">
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="addRequirementModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="form-student" action="." method="post">
              <div class="form-group">
                <label for="form-student-rin" class="col-form-label">Name:</label>
                <input type="number" class="form-control" id="form-student-rin" name="form-student-rin" required="required" min=0 max=999999999>
              </div>
              <div class="form-group">
                <label for="form-student-rcsid" class="col-form-label">Prefix:</label>
                <input type="text" class="form-control" id="form-student-rcsid" name="form-student-rcsid" maxlength=7>
              </div>
              <div class="form-group">
                <label for="form-student-fname" class="col-form-label">Number:</label>
                <input type="text" class="form-control" id="form-student-fname" name="form-student-fname" required="required" maxlength=100>
              </div>
              <div class="form-group">
                <label for="form-student-lname" class="col-form-label">Credit-Low:</label>
                <input type="text" class="form-control" id="form-student-lname"name="form-student-lname" required="required" maxlength=100>
              </div>
              <div class="form-group">
                <label for="form-student-alias" class="col-form-label">Credit-High:</label>
                <input type="text" class="form-control" id="form-student-alias" name="form-student-alias" required="required" maxlength=100>
              </div>
            </form>
            <div class="form-group">
                <label for="form-student-alias" class="col-form-label">:</label>
                <input type="text" class="form-control" id="form-student-alias" name="form-student-alias" required="required" maxlength=100>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" form="form-student" name="add_student" value="Submit">
          </div>
        </div>
      </div>
    </div>

      <table class="table table-sm table-fixed center" id="plan-table">
        <!-- Table Heading -->
        <div class="col-sm col-semester">
          <thead class="thead-light">
            <tr>
              <th scope="col" class="col-5">Student</th>
              <th scope="col" class="col-3">Cohort Year</th>
              <th scope="col" class="col-4">Status</th>
            </tr>
          </thead>
        </div>
        <!-- Table Body -->
        <tbody>
          <!-- <tr scope="row">
            <td class="col-5">Jacob Dyer</td>
            <td class="col-3">2023</td>
            <td class="col-4">Reviewable</td>
          </tr>
          <tr scope="row">
            <td class="col-5">Joyce Fang</td>
            <td class="col-3">2023</td>
            <td class="col-4">Approved</td>
          </tr>
          <tr scope="row">
            <td class="col-5">Bobby Tables</td>
            <td class="col-3">2024</td>
            <td class="col-4">None</td>
          </tr>
          <tr scope="row">
            <td class="col-5">Jacob Dyer</td>
            <td class="col-3">2023</td>
            <td class="col-4">Reviewable</td>
          </tr>
          <tr scope="row">
            <td class="col-5">Joyce Fang</td>
            <td class="col-3">2023</td>
            <td class="col-4">Approved</td>
          </tr>
          <tr scope="row">
            <td class="col-5">Bobby Tables</td>
            <td class="col-3">2024</td>
            <td class="col-4">None</td>
          </tr>
          <tr scope="row">
            <td class="col-5">Jacob Dyer</td>
            <td class="col-3">2023</td>
            <td class="col-4">Reviewable</td>
          </tr>
          <tr scope="row">
            <td class="col-5">Joyce Fang</td>
            <td class="col-3">2023</td>
            <td class="col-4">Approved</td>
          </tr>
          <tr scope="row">
            <td class="col-5">Bobby Tables</td>
            <td class="col-3">2024</td>
            <td class="col-4">None</td>
          </tr>
          <tr scope="row">
            <td class="col-5">Jacob Dyer</td>
            <td class="col-3">2023</td>
            <td class="col-4">Reviewable</td>
          </tr>
          <tr scope="row">
            <td class="col-5">Joyce Fang</td>
            <td class="col-3">2023</td>
            <td class="col-4">Approved</td>
          </tr>
          <tr scope="row">
            <td class="col-5">Bobby Tables</td>
            <td class="col-3">2024</td>
            <td class="col-4">None</td>
          </tr> -->
        </tbody>
      </table>
    </main>
  </body>
</html>