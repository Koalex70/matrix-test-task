<?php

/**
 * CONFIGURATION TO DB
 */
class DB{
    const USER = 'root';
    const PASS = '123';
    const HOST = 'localhost';
    const NAME = 'matrix';

    public static function connectToDB()
    {
        $user = self::USER;
        $pass = self::PASS;
        $host = self::HOST;
        $name = self::NAME;

        try {
            $dbh = new PDO("mysql:dbname=$name;host=$host", $user, $pass);
            return $dbh;
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }

        return false;
    }
}
