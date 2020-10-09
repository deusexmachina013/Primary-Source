<?php
include 'auth_internal.php';

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

?>

<html>
  <head>
    <title>phpCAS simple client</title>
  </head>
  <body>
    <h1>Successfull Authentication!</h1>
    <p>the user's login is <b><?php echo phpCAS::getUser(); ?></b>.</p>
    <p>phpCAS version is <b><?php echo phpCAS::getVersion(); ?></b>.</p>
    <p><a href="?logout=">Logout</a></p>
  </body>
</html>