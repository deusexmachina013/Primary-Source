<?php
include 'auth/auth_internal.php';

$user_id = Auth::authenticate(); #redirect to login page if fails, should redirect to current page after, returning user id.

if(session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

if(!isset($_SESSION["user_id"])) {
    $_SESSION["user_id"] = $user_id;
}

if($_REQUEST["logout"] || $_SESSION["user_id"] != $user_id) {
    Auth::logout();
}

if($_GET["type"] === "student") {
  header("Location: student/home.php");
} else if ($_GET["type"] === "admin") {
  header("Location: admin/home.php");
} else {
  echo "Wrong location";
}

?>