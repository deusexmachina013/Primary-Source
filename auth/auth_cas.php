<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
require_once "auth_abc.php";

class AuthModule extends AuthenticationABC {

    public function __construct() {
      phpCAS::client(CAS_VERSION_2_0, "cas-auth.rpi.edu", 443, "/cas");

      phpCAS::setNoCasServerValidation();
    }

    public function authenticate() {
      #required modules - php-curl, php-dom
      phpCAS::forceAuthentication();
    }

    public function getIdentity() {
      if(phpCAS::isAuthenticated()) {
        return phpCAS::getUser();
      }
      return NULL;
    }

    public function logout() {
      phpCAS::logout();
      //Note: logout redirection is disabled with RPI's CAS system :(
    }
  
}
?>
