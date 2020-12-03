<?php
  $dbconn = new PDO('mysql:host=localhost;dbname=website', 'vagrant', 'vagrant');
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