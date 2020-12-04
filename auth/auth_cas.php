<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
require_once "auth_abc.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/db.php";

class AuthModule extends AuthenticationABC {
  
    public function __construct() {
      
      phpCAS::client(CAS_VERSION_2_0, "cas-auth.rpi.edu", 443, "/cas");

      phpCAS::setNoCasServerValidation();
    }

    public function authenticate() {
      #required modules - php-curl, php-dom
      phpCAS::forceAuthentication();
    }

    public function getAuthInfo() {
      if(phpCAS::isAuthenticated()) {
        $user_identity = phpCAS::getUser();
        $dbconn = Database::getDatabase();
        $pstmt = $dbconn->prepare("SELECT users.id, users.rank FROM users INNER JOIN auth_rcs ON users.id = auth_rcs.user_id WHERE rcsid = ?");
        $pstmt->execute(array($user_identity));
        if ($pstmt->rowCount() == 0) { //not registered
          
        }
        return $pstmt->fetch();
      }
      return NULL;
    }

    public function logout() {
      phpCAS::logout();
      //Note: logout redirection is disabled with RPI's CAS system :(
    }
  
}
?>
