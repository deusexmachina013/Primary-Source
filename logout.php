<?php
include 'auth/auth_internal.php';
if (session_status() == PHP_SESSION_ACTIVE) {
    session_destroy();
}
Auth::logout();
?>