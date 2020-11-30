<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
require_once "auth_abc.php";

class AuthModule extends AuthenticationABC {

    public function authenticate() {
      #required modules - php-curl, php-dom
      phpCAS::client(CAS_VERSION_2_0, "cas-auth.rpi.edu", 443, "/cas");

      phpCAS::setNoCasServerValidation();

      if(phpCAS::forceAuthentication()) {
        return phpCAS::getUser();
      }
      return NULL;
    }

    public function logout() {
      phpCAS::logout();
      //TODO: get logout working with redirection back to site; if CAS has disabled, maybe look into 
      //https://shib-idp.rpi.edu/idp/profile/SAML2 to see if it is possible to get working
      // phpCAS::logoutWithRedirectService("https://localhost");
    }
  
}
?>
