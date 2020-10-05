<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
require_once "auth_abc.php";

class AuthModule extends AuthenticationABC {

    public function authenticate() {
      #required modules - php-curl, php-dom
      phpCAS::client(CAS_VERSION_2_0, "cas-auth.rpi.edu", 443, "/cas");

      #TODO: check if it ok to put certificate in repository
      phpCAS::setNoCasServerValidation();
      if(phpCAS::forceAuthentication()) {
        return phpCAS::getUser();
      }
      return NULL;
    }

    public function logout() {
      phpCAS::logout();
    }
  
}
?>
