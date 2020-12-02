<?php
/*
//Code to put to get database instance:
require_once $_SERVER['DOCUMENT_ROOT'] . "/db.php";
$dbconn = Database::getDatabase();
*/

class Database {
    const host = "localhost";
    const database_name = "website";
    const username = "vagrant";
    const password = "vagrant";

    public static function getDatabase() {
        return new PDO('mysql:host=' . self::host . ';dbname=' . self::database_name, self::username, self::password);
    }
}
?>