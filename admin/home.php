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
      </form>

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
        </tbody>
      </table>
    </main>
  </body>
</html>