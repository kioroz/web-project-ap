<?php
session_start();
include '../database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.html");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $codeanim = $_POST['CODEANIM'];
    $dateact  = $_POST['DATEACT'];
    $user     = $_SESSION['user_id'];

    // Vérifier que l'utilisateur est inscrit
    $check = $pdo->prepare("SELECT NOINSCRIP FROM inscription 
                            WHERE USER = ? AND CODEANIM = ? AND DATEACT = ?");
    $check->execute([$user, $codeanim, $dateact]);

    if ($check->rowCount() == 0) {
        echo "<p style='color:red;font-weight:bold;'>Vous n'êtes pas inscrit à cette activité.</p>";
        exit;
    }

    // Désinscription
    $delete = $pdo->prepare("DELETE FROM inscription 
                             WHERE USER = ? AND CODEANIM = ? AND DATEACT = ?");
    if ($delete->execute([$user, $codeanim, $dateact])) {
        echo "<p style='color:green;font-weight:bold;'>Vous êtes désinscrit.</p>";
    } else {
        echo "<p style='color:red;font-weight:bold;'>Erreur lors de la désinscription.</p>";
    }
}
?>

<a href='../activite/activite.php'>Retour aux activités</a>
