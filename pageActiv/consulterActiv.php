<?php
include '../database.php';
session_start();
$sql = "SELECT 
    a.CODEANIM,
    a.DATEACT,
    a.HRRDVACT,
    a.PRIXACT,
    a.HRDEBUTACT,
    a.HRFINACT,
    a.DATEANNULEACT,
    a.NOMRESP,
    a.PRENOMRESP,
    anim.NOMANIM,
    anim.NBREPLACEANIM,
    COUNT(i.NOINSCRIP) AS inscrits
FROM activite a
JOIN animation anim ON a.CODEANIM = anim.CODEANIM
LEFT JOIN inscription i 
       ON i.CODEANIM = a.CODEANIM 
      AND i.DATEACT = a.DATEACT
GROUP BY a.CODEANIM, a.DATEACT;";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($rows as $row) {

    $annule = !empty($row["DATEANNULEACT"]);

    // On échappe chaque donnée une seule fois, dans des variables
    $nomAnim = htmlspecialchars($row['NOMANIM']);
    $date  = htmlspecialchars($row['DATEACT']);
    $rdv   = htmlspecialchars($row['HRRDVACT']);
    $prix  = htmlspecialchars($row['PRIXACT']);
    $debut = htmlspecialchars($row['HRDEBUTACT']);
    $fin   = htmlspecialchars($row['HRFINACT']);
    $resp  = htmlspecialchars($row['PRENOMRESP'] . ' ' . $row['NOMRESP']);
    $maxPlaces = (int)$row['NBREPLACEANIM'];
    $inscrits  = (int)$row['inscrits'];
    $restantes = $maxPlaces - $inscrits;

    echo "<div class='activite " . ($annule ? "annulee" : "active") . "'>";
    echo "<h3>$nomAnim</h3>";
    echo "<p>Date : $date</p>";
    echo "<p>Heure RDV : $rdv</p>";
    echo "<p>Prix : $prix €</p>";
    echo "<p>Début : $debut</p>";
    echo "<p>Fin : $fin</p>";
    echo "<p>Responsable : $resp</p>";
    echo "<p>Places restantes : $restantes / $maxPlaces</p>";

    $user = $_SESSION['user_id'];
    $checkUser = $pdo->prepare("SELECT NOINSCRIP FROM inscription 
                                WHERE USER = ? AND CODEANIM = ? AND DATEACT = ?");
    $checkUser->execute([$user, $row['CODEANIM'], $row['DATEACT']]);
    $estInscrit = $checkUser->rowCount() > 0;

    if ($annule) {
        echo "<p style='color:red;font-weight:bold;'>Activité annulée</p>";
    } elseif ($_SESSION['fonction'] == "VA") {

        if ($estInscrit) {
            // Bouton de désinscription
            echo "<form method='POST' action='../pageActiv/desinscriptionActiv.php'>";
            echo "<input type='hidden' name='CODEANIM' value='" . $row['CODEANIM'] . "'>";
            echo "<input type='hidden' name='DATEACT' value='" . $row['DATEACT'] . "'>";
            echo "<button type='submit' style='background:red;color:white;'>Se désinscrire</button>";
            echo "</form>";
        } elseif ($restantes > 0) {
            // Bouton d'inscription
            echo "<form method='POST' action='../pageActiv/inscriptionActiv.php'>";
            echo "<input type='hidden' name='CODEANIM' value='" . $row['CODEANIM'] . "'>";
            echo "<input type='hidden' name='DATEACT' value='" . $row['DATEACT'] . "'>";
            echo "<button type='submit'>S'inscrire</button>";
            echo "</form>";
        } else {
            echo "<p style='color:red;font-weight:bold;'>Complet</p>";
        }
    }

    echo "</div>";
}
