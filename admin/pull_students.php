<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . "/db.php";
  // Connect to the database.
  $dbconn = Database::getDatabase();
  // Query the student table and get relevant students.
  if(isset($_POST['student-search-dropdown']) && isset($_POST['search-bar'])) {
    // Prepare the request.
    $argumentArray = NULL;
    $request = "SELECT users.first_name, users.last_name, users.class_year, plans.id, plans.advisor_status, plans.favorited FROM `users`, `plans` WHERE ";
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
        $barTerm = $_POST['search-bar'];
        if($barTerm == "0" || $barTerm == "Unsubmitted") $_POST['search-bar'] = 0;
        else if($barTerm == "1" || $barTerm == "Submitted") $_POST['search-bar'] = 1;
        else if($barTerm == "2" || $barTerm == "Approved") $_POST['search-bar'] = 2;
        else if($barTerm == "3" || $barTerm == "Unapproved") $_POST['search-bar'] = 3;

        $request = $request . "plans.advisor_status = ?";
        $argumentArray = Array($_POST['search-bar']);
      break;
    }
    $request = $request . " AND plans.advisor_status <> 3 AND users.id = plans.user_id ORDER BY users.identity;";

    // Execute the query.
    $query = $dbconn->prepare($request);
    $query->execute($argumentArray);

    // Return the results.
    echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));
  }
?>

