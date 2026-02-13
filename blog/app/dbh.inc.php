<?php
    $host = 'localhost';
    $dbname = 'blog';
    $dbusername = 'root';
    $password = '';

    $dsn = "mysql:host=$host;dbname=$dbname";

    try {
         $pdo = new PDO($dsn, $dbusername, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e){
        exit("Connection failed" . $e->getMessage());
    }


?>