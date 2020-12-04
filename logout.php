<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/auth/auth.php";
// header("Location: /");
// die();
if (session_status() == PHP_SESSION_ACTIVE) {
    session_destroy();
}
Auth::logout();
?>