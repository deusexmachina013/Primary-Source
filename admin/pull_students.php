<?php
  // Query the student table and get relevant students.
  if(isset($_GET['student-search-dropdown'] && isset($_GET['search-bar'])) {
    // Connect to the database.
    $dbconn = new PDO('mysql:host=localhost;dbname=website', 'root', '');

    // Prepare the request.
    $argumentArray = NULL;
    $request = "SELECT users.first_name, users.last_name, users.class_year, plans.advisor_validated, plans.id FROM `users`, `plans` WHERE ";
    switch($_GET['student-search-dropdown']) {
      // Case: Searched by student name.
      case 'student_name':
        $request = $request . "CONCAT(users.first_name, ' ', users.last_name) = ? OR users.first_name = ? OR users.last_name = ?";
        $argumentArray = Array($_GET['search-bar'],
                               $_GET['search-bar'],
                               $_GET['search-bar']);
      break;
      // Case: Searched by class year.
      case 'class_year':
        $request = $request . "users.class_year = ?";
        $argumentArray = Array($_GET['search-bar']);
      break;
      // Case: Searched by plan status.
      case 'plan_status':
        // Translate the text to status codes.
        switch($_GET['search-bar']) {
          // 0 -- Unsubmitted.
          case "Unsubmitted": $_GET['search-bar'] = 0; break;
          // 1 -- Submitted.
          case "Submitted": $_GET['search-bar'] = 1; break;
          // 2 -- Approved.
          case "Approved": $_GET['search-bar'] = 2; break;
          // 3 -- Unapproved.
          case "Unapproved": $_GET['search-bar'] = 3; break;
        }

        $request = $request . "plans.advisor_validated = ?";
        $argumentArray = Array($_GET['search-bar']);
      break;
    }
    $request = $request . " AND plans.advisor_validated <> 3 AND users.id = plans.user_id ORDER BY users.identity;";

    // Execute the query.
    $query = $dbconn->prepare($request)->execute($argumentArray);

    // Return the results.
    echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));
  }
?>