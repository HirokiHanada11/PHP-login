<?php
    //FOR LOCAL USE VIA XAMPP
    // define('DB_HOST', 'localhost');
    // define('DB_NAME', 'user');
    // define('DB_USER', 'hiroki');
    // define('DB_PASS', 'password');
    
    //for Tecbase
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'tb230057db');
    define('DB_USER', 'tb-230057');
    define('DB_PASS', 'MHLd82y7cZ');
    function connect()
    {
        $host = DB_HOST;
        $db = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;

        $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
        try{
            $pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
            return $pdo;
        } catch(PDOException $e) {
            echo 'connection failed '.$e->getMessage();
        }
    }

?>