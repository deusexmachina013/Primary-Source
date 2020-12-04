<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
if (session_status() == PHP_SESSION_ACTIVE) {
    session_destroy();
}
if (phpCAS::isAuthenticated()) {
    phpCAS::logout();
}
?>