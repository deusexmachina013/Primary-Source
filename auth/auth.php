<?php
/*
//Code to put to get auth instance:
require_once $_SERVER['DOCUMENT_ROOT'] . "/auth/auth.php";
*/
/*
//Code to check rank (and kick out to $location if not):
Auth::requireRank($rank);
*/
class Auth {
    const NAME = "auth_cas.php";
    private static $instance = null;
    
    private function __construct() { }

    private static function makeInstance() {
        if (self::$instance == null) {
            #done here in case multiple different AuthModules are wanted in the future
            require_once self::NAME;
            self::$instance = new AuthModule();
        }
    }

    public static function authenticate() {
        if(self::$instance == null) {
            self::makeInstance();
        }
        return self::$instance->authenticate();
    }

    public static function getAuthInfo() {
        if(self::$instance == null) {
            self::makeInstance();
        }
        return self::$instance->getAuthInfo();
    }

    public static function logout() {
        if(self::$instance == null) {
            self::makeInstance();
        }
        return self::$instance->logout();
    }

    public static function requireRank($rank, $redirect="/", $exact=false) {
        if(self::$instance == null) {
            self::makeInstance();
        }
        if(($exact && $_SESSION["rank"] != $rank) || $_SESSION["rank"] < $rank) {
            header("Location: " . $redirect);
            die();
        }
    }
}
Auth::authenticate(); #redirect to login page if fails, should redirect to current page after, returning user id.

if(session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
if(!isset($_SESSION["id"])) {
    $user_data = Auth::getAuthInfo();
    if($user_data !== NULL) {
        $_SESSION["id"] = $user_data["id"];
        $_SESSION["rank"] = $user_data["rank"];
    } else {
        $_SESSION["invalid_login"] = true; //workaround since we can't redirect with RPI logout
        header("Location: /index.php");
        // die();
    }
}
?>