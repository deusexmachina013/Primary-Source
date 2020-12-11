<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/auth/auth.php";

if (session_status() == PHP_SESSION_ACTIVE) {
    session_destroy();
}
Auth::logout();
?>