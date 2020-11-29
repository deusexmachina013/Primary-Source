<!DOCTYPE html>

<html lang="en">
  <head>
    <title>Administrator Homepage</title>>

    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- JS, Popper.js, and jQuery -->
    <script src="../assets/js/admin_homepage.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </head>

  <body>
    <?php include("admin_navbar.php"); ?>

    <main class="content">
      <h1>Your Students' Plans</h1>

      <div class="search-bar">
        <input type="text" class="admin-loopup" placeholder="Search for student plans..." id="admin-lookup" onkeyup="filterStudentPlans()">
      </div>
      <table class="center" id="plan-table">

      <form class="student-search center" accept-charset="utf-8" method="GET" name="student-search" role="search">
        <div class="left-partition">
          <select id="student-search-dropdown" class="search-dropdown" title="Filter by">
            <option selected="selected" value="student-column">Student Name</option>
            <option value="student-column">Class Year</option>
            <option value="student-column">Status</option>
            <option value="student-column">Submission Date</option>
          </select>
        </div>
        <div class="right-partition">
          <input type="text" class="student-searchbar" placeholder="Look up student plans." id="admin-lookup">
          <input type="submit" class="student-submit" value="&#128269">
        </div>
      </form>

      <table class="table table-bordered table-striped table-hover center" id="plan-table">

        <!-- Table Heading -->
        <div class = "col-sm col-semester">
        <thead class="thead-light">
          <tr>
            <th scope="col">Student</th>
            <th scope="col">Class Year</th>
            <th scope="col">Status</th>
            <th scope="col">Submission Date</th>
          </tr>
        </thead>
        </div>
        <!-- Table Body -->
        <tbody>
          <tr scope="row">
            <td>Jacob Dyer</td>
            <td>2023</td>
            <td>Reviewable</td>
            <td>10/4/2020</td>
          </tr>
          <tr scope="row">
            <td>Joyce Fang</td>
            <td>2023</td>
            <td>Approved</td>
            <td>10/4/2020</td>
          </tr>
          <tr scope="row">
            <td>Bobby Tables</td>
            <td>2024</td>
            <td>None</td>
            <td>N/A</td>
          </tr>
        </tbody>
      </table>
    </main>
  </body>
</html>