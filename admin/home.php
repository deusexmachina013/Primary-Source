<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . "/auth/auth.php";
  require_once $_SERVER['DOCUMENT_ROOT'] . "/db.php";
  $dbconn = Database::getDatabase();

  $res = $dbconn->query("SELECT users.first_name, users.last_name, users.class_year, plans.id, plans.advisor_status FROM users LEFT JOIN plans ON users.id = plans.user_id WHERE plans.advisor_status > 0")->fetchAll();
?>
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
          <?php foreach($res as $row) { ?>
          <tr data-href="student_plan_admin.php?id=<?php echo $row["id"] ?>" scope="row">
            <td class="col-5"><?php echo $row["first_name"] . " " . $row["last_name"] ?></td>
            <td class="col-3"><?php echo $row["class_year"] ?></td>
            <td class="col-4"><?php if($row["advisor_status"] == 0) {
              echo "Unsubmitted";
            } else if($row["advisor_status"] == 1) {
              echo "Reviewable";
            } else if($row["advisor_status"] == 2) {
              echo "Accepted";
            } else if($row["advisor_status"] == 3) {
              echo "Rejected";
            } ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </main>
  </body>
</html>