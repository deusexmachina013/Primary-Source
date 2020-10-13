<?php
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

    public static function logout() {
        if(self::$instance == null) {
            self::makeInstance();
        }
        return self::$instance->logout();
    }

}