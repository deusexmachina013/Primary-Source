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
        <!-- Table Heading -->
        <div class = "col-sm col-semester">
        <thead>
          <tr>
            <th class="student-column">Student</th>
            <th class="year-column">Class Year</th>
            <th class="status-column">Status</th>
            <th class="date-column">Submission Date</th>
          </tr>
        </thead>
        </div>
        <!-- Table Body -->
        <tbody>
          <tr>
            <td class="name">Jacob Dyer</td>
            <td class="year">2023</td>
            <td class="status">Reviewable</td>
            <td class="date">10/4/2020</td>
          </tr>
          <tr>
            <td class="name">Joyce Fang</td>
            <td class="year">2023</td>
            <td class="status">Approved</td>
            <td class="date">10/4/2020</td>
          </tr>
          <tr>
            <td class="name">Bobby Tables</td>
            <td class="year">2024</td>
            <td class="status">None</td>
            <td class="date">N/A</td>
          </tr>
        </tbody>
      </table>
    </main>
  </body>
</html>