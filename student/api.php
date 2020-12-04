<?php
function exitOnFail($res, $error="Call to server failed") {
  if(!$res) {
    http_response_code(500);
    echo json_encode(array("error"=>$error));
    die();
  }
}
  require_once $_SERVER['DOCUMENT_ROOT'] . "/db.php";
  $dbconn = Database::getDatabase();
  $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // if (session_status() != PHP_SESSION_ACTIVE || $_SESSION["id"] == NULL) {
  //   die();
  // }
  $TEMP_ID = 2;
  if(isset($_POST["operation"])) {
    
    if($_POST["operation"] == "save") {
      $dbconn->beginTransaction();
      $save_data = $_POST["data"];
      
      $pstmt = $dbconn->prepare("SELECT advisor_status FROM plans WHERE id=? AND user_id=?");
      $stmt_success = $pstmt->execute(array($save_data["id"], $TEMP_ID));
      exitOnFail($stmt_success);
      $advisor_status = $pstmt->fetch()["advisor_status"];
      $pstmt = $dbconn->prepare("UPDATE plans SET name = ?, favorited = ?, notes = ? WHERE id = ? AND user_id = ?");
      $stmt_success = $pstmt->execute(array($save_data["name"], $save_data["favorited"], $save_data["notes"], $save_data["id"], $TEMP_ID));
      exitOnFail($stmt_success);
      $pstmt = $dbconn->prepare("SELECT id FROM plan_semesters WHERE plan_id=? ORDER BY position");
      $stmt_success = $pstmt->execute(array($save_data["id"]));
      exitOnFail($stmt_success);
      $plan_semesters = $pstmt->fetchAll();
      $save_semesters = $save_data["semesters"];
      $i = 1;
      
      while($i <= count($save_semesters)) {
        $save_semester = $save_semesters[$i - 1];
        $semester_id = -1;
        
        if($i > count($plan_semesters)) {
          //new semester
          $pstmt = $dbconn->prepare("INSERT INTO plan_semesters (plan_id, name, position, completed) VALUES (?, ?, ?, ?)");
          $stmt_success = $pstmt->execute(array($save_data["id"], $save_semester["name"], $i, false));
          exitOnFail($stmt_success);
          $pstmt = $dbconn->prepare("SELECT LAST_INSERT_ID() AS id");
          $stmt_success = $pstmt->execute();
          exitOnFail($stmt_success);
          $semester_id = $pstmt->fetch()["id"];
        } else {
          $pstmt = $dbconn->prepare("SELECT id FROM plan_semesters WHERE plan_id = ? AND position = ?");
          
          $stmt_success = $pstmt->execute(array($save_data["id"], $i));
          exitOnFail($stmt_success);
          
          $semester_id = $pstmt->fetch()["id"];
          $pstmt = $dbconn->prepare("UPDATE plan_semesters SET name = ?, position = ?, completed = ? WHERE id = ?");
          $stmt_success = $pstmt->execute(array($save_semester["name"], $i, false, $semester_id));
          exitOnFail($stmt_success);
        }
        exitOnFail($semester_id != -1);
        
        $pstmt = $dbconn->prepare("SELECT id FROM plan_courses WHERE semester_id=? ORDER BY position");
        $stmt_success = $pstmt->execute(array($semester_id));
        exitOnFail($stmt_success);
        $plan_courses = $pstmt->fetchAll();
        $save_courses = $save_semester["courses"];
        $x = 1;
        while($x <= count($save_courses)) {
          $save_course = $save_courses[$x - 1];
          $pstmt = $dbconn->prepare("SELECT course_single_id AS id FROM course_single_catalog WHERE prefix = ? AND number = ?");
          $stmt_success = $pstmt->execute(array($save_course["prefix"], $save_course["number"]));
          exitOnFail($stmt_success);
          $course_id = $pstmt->fetch()["id"];
          if($x > count($plan_courses)) {
            $pstmt = $dbconn->prepare("INSERT INTO plan_courses (semester_id, course_id, position) VALUES (?, ?, ?)");
            $stmt_success = $pstmt->execute(array($semester_id, $course_id, $x));
            exitOnFail($stmt_success);
          } else {
            $pstmt = $dbconn->prepare("INSERT INTO plan_courses (semester_id, course_id, position) VALUES (?, ?, ?)");
            $stmt_success = $pstmt->execute(array($semester_id, $course_id, $x));
            exitOnFail($stmt_success);
          }
          $x++;
        }
        for($x; $x <= count($plan_courses); $x++) {
          $pstmt = $dbconn->prepare("DELETE FROM plan_courses WHERE semester_id = ? AND position = ?");
          $stmt_success = $pstmt->execute(array($semester_id, $x));
        }
        exitOnFail($stmt_success);
        $i++;
      }
      
      for($i; $i <= count($plan_semesters); $i++) {
        $pstmt = $dbconn->prepare("DELETE FROM plan_semesters WHERE plan_id = ? AND position = ?");
        $stmt_success = $pstmt->execute(array($save_data["id"], $i));
        //delete extra semesters, courses link to thoes emesters
      }
      // $dbconn->commit();
      echo("success");
    }

  }
  
  if(isset($_POST["get_course"])) {
    if(isset($_POST["prefix"]) && isset($_POST["number"])) {
      $get_course_stmt = $dbconn->prepare("SELECT courses.name FROM courses INNER JOIN course_single ON courses.id = course_single.course_id WHERE course_single.prefix = ? AND course_single.number = ?;");
      $get_course_stmt->execute(array($_POST["prefix"], intval($_POST["number"])));
      if($get_course_stmt->rowCount() != 0) {
        $res = $get_course_stmt->fetch();
        echo '{"name": "' . $res["name"] . '" }';
      } else {
        echo '{}';
      }
    } else {
      echo "{}";
    }
  } else {
    echo "{}";
  }

?>