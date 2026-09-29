<?php
session_start();
include '../database.php';

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.html");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $codeanim = $_POST['CODEANIM'];
    $dateact  = $_POST['DATEACT'];
    $user     = $_SESSION['user_id'];

    // Vérifier si déjà inscrit
    $check = $pdo->prepare("SELECT * FROM inscription 
                            WHERE USER = ? AND CODEANIM = ? AND DATEACT = ?");
    $check->execute([$user, $codeanim, $dateact]);

    if ($check->rowCount() > 0) {
        echo "<p style='color:red;font-weight:bold;'>Vous êtes déjà inscrit à cette activité.</p>";
        exit;
    }

    // Vérifier si activité complète
    $checkPlaces = $pdo->prepare("
        SELECT anim.NBREPLACEANIM, COUNT(i.NOINSCRIP) AS inscrits
        FROM animation anim
        LEFT JOIN inscription i ON anim.CODEANIM = i.CODEANIM
        WHERE anim.CODEANIM = ?
        GROUP BY anim.CODEANIM
    ");
    $checkPlaces->execute([$codeanim]);
    $data = $checkPlaces->fetch();

    if ($data && $data['inscrits'] >= $data['NBREPLACEANIM']) {
        echo "<p style='color:red;font-weight:bold;'>Impossible : activité complète.</p>";
        exit;
    }

    // Inscription
    $sql = "INSERT INTO inscription (USER, CODEANIM, DATEACT, DATEINSCRIP)
            VALUES (?, ?, ?, NOW())";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$user, $codeanim, $dateact])) {
        echo "<p style='color:green;font-weight:bold;'>Inscription réussie !</p>";
    } else {
        echo "<p style='color:red;font-weight:bold;'>Erreur lors de l'inscription.</p>";
    }
}
?>

<a href='../activite/activite.php'>Retour aux activités</a>
