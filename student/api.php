<?php
function exitOnFail($res, $error="Call to server failed") {
  if(!$res) {
    http_response_code(500);
    echo json_encode(array("status"=>"error", "error"=>$error));
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
          $stmt_success = $pstmt->execute(array($save_data["id"], $save_semester["name"], $i, 0));
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
          $stmt_success = $pstmt->execute(array($save_semester["name"], $i, 0, $semester_id));
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
            $pstmt = $dbconn->prepare("UPDATE plan_courses SET course_id = ? WHERE semester_id = ? AND position = ?");
            $stmt_success = $pstmt->execute(array($course_id, $semester_id, $x));
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
      }
      $dbconn->commit();
      echo json_encode(array("status"=>"success"));
    } else if($_POST["operation"] == "newTemplatePlan") {
      $dbconn->beginTransaction();
      exitOnFail(isset($_POST["data"]) && array_key_exists("templateName", $_POST["data"]) && array_key_exists("planName", $_POST["data"]));
      $template_name = $_POST["data"]["templateName"];
      $plan_name = $_POST["data"]["planName"];
      $pstmt = $dbconn->prepare("SELECT id FROM templates WHERE name = ?");
      $stmt_success = $pstmt->execute(array($template_name));
      exitOnFail($stmt_success && $pstmt->rowCount() == 1);
      $template_id = $pstmt->fetch()["id"];
      $pstmt = $dbconn->prepare("SELECT * FROM template_data WHERE template_id = ? ORDER BY semester_num, position");
      $stmt_success = $pstmt->execute(array($template_id));
      exitOnFail($stmt_success);
      $template_data = $pstmt->fetchAll();

      $pstmt = $dbconn->prepare("INSERT INTO plans (user_id, name, favorited, advisor_status, notes) VALUES (?, ?, ?, ?, ?)");
      $stmt_success = $pstmt->execute(array($TEMP_ID, $plan_name, 0, 0, ""));
      exitOnFail($stmt_success);
      $res = $dbconn->query("SELECT LAST_INSERT_ID()");
      exitOnFail($res);
      $plan_id = $res->fetch()[0];

      $semester_num = 0;
      $semester_id = -1;
      foreach($template_data as $template) {
        if($semester_num != $template["semester_num"]) {
          $semester_num += 1;
          exitOnFail($semester_num == $template["semester_num"]);
          $pstmt = $dbconn->prepare("INSERT INTO plan_semesters (plan_id, name, position, completed) VALUES (?, ?, ?, ?)");
          $stmt_success = $pstmt->execute(array($plan_id, "Semester " . $semester_num, $semester_num, 0));
          exitOnFail($stmt_success);
          $res = $dbconn->query("SELECT LAST_INSERT_ID()");
          exitOnFail($res);
          $semester_id = $res->fetch()[0];
        }
        exitOnFail($semester_id != -1);
        $pstmt = $dbconn->prepare("INSERT INTO plan_courses (semester_id, course_id, position) VALUES (?, ?, ?)");
        $stmt_success = $pstmt->execute(array($semester_id, $template["course_id"], $template["position"]));
        exitOnFail($stmt_success);
      }
      // $dbconn->rollBack();
      $dbconn->commit();
      echo json_encode(array("status"=>"success","id"=>$plan_id));
      
      

      
    } else if($_POST["operation"] == "advisor") {
      $dbconn->beginTransaction();
      exitOnFail(isset($_POST["data"]) && array_key_exists("id", $_POST["data"]));
      $pstmt = $dbconn->prepare("SELECT advisor_status FROM plans WHERE id = ?");
      $stmt_success = $pstmt->execute(array($_POST["data"]["id"]));
      exitOnFail($stmt_success && $pstmt->rowCount() == 1);
      $res = $pstmt->fetch()["advisor_status"];
      exitOnFail($res == 0);
      $pstmt = $dbconn->prepare("UPDATE plans SET advisor_status = 1 WHERE id = ?");
      $stmt_success = $pstmt->execute(array($_POST["data"]["id"]));
      exitOnFail($stmt_success);
      $dbconn->commit();
      echo json_encode(array("status"=>"success"));
    }
    // if(isset($_POST["get_course"])) {
    //   if(isset($_POST["prefix"]) && isset($_POST["number"])) {
    //     $get_course_stmt = $dbconn->prepare("SELECT courses.name FROM courses INNER JOIN course_single ON courses.id = course_single.course_id WHERE course_single.prefix = ? AND course_single.number = ?;");
    //     $get_course_stmt->execute(array($_POST["prefix"], intval($_POST["number"])));
    //     if($get_course_stmt->rowCount() != 0) {
    //       $res = $get_course_stmt->fetch();
    //       echo '{"name": "' . $res["name"] . '" }';
    //     } else {
    //       echo '{}';
    //     }
    //   } else {
    //     echo "{}";
    //   }
    // } else {
    //   echo "{}";
    // }
  }
  
  

?>