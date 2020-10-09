<?php
abstract class AuthenticationABC {
    
    abstract public function authenticate();

    abstract public function logout();
}
?>