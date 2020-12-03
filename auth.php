<?php
//require 
include 'auth/auth_internal.php';
// require 'db.php'
Auth::authenticate(); #redirect to login page if fails, should redirect to current page after, returning user id.

if(session_status() != PHP_SESSION_ACTIVE) {
    session_start();
    $user_identity = Auth::getIdentity();
    $_SESSION["user_id"] = $user_id;
    $_SESSION["rank"] = $rank;
}

?>