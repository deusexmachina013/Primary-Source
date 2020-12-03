<?php
  // Query the student table and get relevant students.
  if(isset($_POST['search-input-course'])) {
    // Connect to the database.
    require_once $_SERVER['DOCUMENT_ROOT'] . "/db.php";
    $dbconn = Database::getDatabase();

    // Prepare the request.
    $argumentArray = NULL;
    $request = "SELECT courses.id, courses.name, course_single_catalog.course_single_id, course_single_catalog.prefix, course_single_catalog.number, course_single_catalog.credit_low, course_single_catalog.credit_high FROM `courses`, `course_single_catalog` WHERE course_single_catalog.course_single_id=courses.id AND courses.name LIKE ?";

    $argumentArray = Array("%" . $_POST['search-input-course'] . "%"); // replaces the ?

    $request = $request . "ORDER BY courses.name;";

    // Execute the query.
    $query = $dbconn->prepare($request);
    $query->execute($argumentArray);

    // Return the results.
    echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));
  }
?>

