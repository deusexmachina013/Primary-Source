<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/auth/auth.php";
session_start();
// if (session_status() == PHP_SESSION_ACTIVE) { //Needed if not using phpCAS
//     session_destroy();
// }
Auth::logout();
?>