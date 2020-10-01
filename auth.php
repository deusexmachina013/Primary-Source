<?php
require "vendor/autoload.php";

#required modules - php-curl, php-dom
phpCAS::client(CAS_VERSION_2_0, "cas-auth.rpi.edu", 443, "/cas");

#TODO: check if it ok to put certificate in repository
phpCAS::setNoCasServerValidation();

phpCAS::forceAuthentication();

if (isset($_REQUEST['logout'])) {
	phpCAS::logout();
}
?>
<html>
  <head>
    <title>phpCAS simple client</title>
  </head>
  <body>
    <h1>Successfull Authentication!</h1>
    <p>the user's login is <b><?php echo phpCAS::getUser(); ?></b>.</p>
    <p>phpCAS version is <b><?php echo phpCAS::getVersion(); ?></b>.</p>
    <p><a href="?logout=">Logout</a></p>
  </body>
</html>