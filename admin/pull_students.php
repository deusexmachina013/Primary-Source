<?php
  // Query the student table and get relevant students.
  echo "Proof this Connects.";
  if(isset($_POST['student-search-dropdown']) && isset($_POST['search-bar'])) {
    // Connect to the database.
    $dbconn = new PDO('mysql:host=localhost;dbname=website', 'root', 'password');

    // Prepare the request.
    $argumentArray = NULL;
    $request = "SELECT users.first_name, users.last_name, users.class_year, plans.advisor_validated, plans.id FROM `users`, `plans` WHERE ";
    switch($_POST['student-search-dropdown']) {
      // Case: Searched by student name.
      case 'student_name':
        $request = $request . "CONCAT(users.first_name, ' ', users.last_name) = ? OR users.first_name = ? OR users.last_name = ?";
        $argumentArray = Array($_POST['search-bar'],
                               $_POST['search-bar'],
                               $_POST['search-bar']);
      break;
      // Case: Searched by class year.
      case 'class_year':
        $request = $request . "users.class_year = ?";
        $argumentArray = Array($_POST['search-bar']);
      break;
      // Case: Searched by plan status.
      case 'plan_status':
        // Translate the text to status codes.
        switch($_POST['search-bar']) {
          // 0 -- Unsubmitted.
          case "Unsubmitted": $_POST['search-bar'] = 0; break;
          // 1 -- Submitted.
          case "Submitted": $_POST['search-bar'] = 1; break;
          // 2 -- Approved.
          case "Approved": $_POST['search-bar'] = 2; break;
          // 3 -- Unapproved.
          case "Unapproved": $_POST['search-bar'] = 3; break;
        }

        $request = $request . "plans.advisor_validated = ?";
        $argumentArray = Array($_POST['search-bar']);
      break;
    }
    $request = $request . " AND plans.advisor_validated <> 3 AND users.id = plans.user_id ORDER BY users.identity;";
    echo($request);
    // Execute the query.
    $query = $dbconn->prepare($request);
    $query->execute($argumentArray);

    // Return the results.
    echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));
  }
?>

