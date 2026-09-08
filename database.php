<?php

// --- Configuration BDD ---
// VÉRIFIEZ : Est-ce la bonne base de données pour cette table 'users'?
$dsn = "mysql:host=localhost;dbname=gacti;charset=utf8"; // J'utilise tp_users comme dans votre code précédent
$dbUser = "root";
$dbPass = "mysql";

// Options PDO recommandées
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

// CONNEXION à la base de Données
try {
    $pdo = new PDO($dsn, $dbUser, $dbPass, $options);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données. (" . $e->getMessage() . ")";
    exit;
}
