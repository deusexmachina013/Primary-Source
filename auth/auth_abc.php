<?php
abstract class AuthenticationABC {
    
    abstract public function authenticate();

    abstract public function getAuthInfo();

    abstract public function logout();
}
?>