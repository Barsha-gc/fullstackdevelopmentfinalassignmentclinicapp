<?php
// $host = "localhost";
// $dbname = "clinic_db";
// $username = "root";
// $password = "";

 $host = "localhost";
$dbname = "np03cs4a240336";
 $username = "np03cs4a240336";
 $password = "09YGkXbymw";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $username,
        $password
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("DB Error: " . $e->getMessage());
}
