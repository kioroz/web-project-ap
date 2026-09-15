<?php
require_once '../database.php';
session_start();

$login = $_POST['email'];
$password = $_POST['password'];

if ($login && $password) {

    $stmt = $pdo->prepare("SELECT USER, MDP, NOMCOMPTE, PRENOMCOMPTE, DATEINSCRIP, DATEFERME, TYPEPROFIL, DATEDEBSEJOUR, DATEFINSEJOUR, DATENAISCOMPTE, ADRMAILCOMPTE, NOTELCOMPTE 
                           FROM compte 
                           WHERE ADRMAILCOMPTE = ?");
    $stmt->execute([$login]);
    $user = $stmt->fetch();

    if ($user && $password === $user['MDP']) {

        $_SESSION['user_id'] = $user['USER'];
        $_SESSION['nom'] = $user['NOMCOMPTE'];
        $_SESSION['fonction'] = $user['TYPEPROFIL'];
        $_SESSION['prenom'] = $user['PRENOMCOMPTE'];

        header("Location: ../menu.php");
        exit;

    } else {
        header("Location: ../index.html?error=login");
        exit;
    }

} else {
    echo "Veuillez remplir tous les champs du formulaire.";
}
