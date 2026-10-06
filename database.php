<?php


$dsn = "mysql:host=localhost;dbname=gacti;charset=utf8";
$dbUser = "root";
$dbPass = "mysql";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass, $options);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données. (" . $e->getMessage() . ")";
    exit;
}
