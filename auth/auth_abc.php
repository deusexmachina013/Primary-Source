<?php
abstract class AuthenticationABC {
    
    abstract public function authenticate();

    abstract public function getIdentity();

    abstract public function logout();
}
?>