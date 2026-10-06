<?php
include '../database.php';

// Requête avec jointure pour récupérer le nom du type
$sql = "SELECT a.CODEANIM, a.NOMANIM, a.DATECREATIONANIM, a.DATEVALIDITEANIM,
               a.DUREEANIM, a.LIMITEAGE, a.TARIFANIM, a.NBREPLACEANIM,
               a.DESCRIPTANIM, a.COMMENTANIM, a.DIFFICULTEANIM,
               t.NOMTYPEANIM
        FROM animation a
        JOIN type_anim t ON a.CODETYPEANIM = t.CODETYPEANIM";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$animations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Liste des animations</h2>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Code</th>
        <th>Nom</th>
        <th>Type</th>
        <th>Date création</th>
        <th>Date validité</th>
        <th>Durée</th>
        <th>Âge limite</th>
        <th>Tarif (€)</th>
        <th>Places</th>
        <th>Difficulté</th>
        <th>Description</th>
        <th>Commentaire</th>
    </tr>

    <?php foreach ($animations as $anim): ?>
        <tr>
            <td><?= $anim['CODEANIM'] ?></td>
            <td><?= $anim['NOMANIM'] ?></td>
            <td><?= $anim['NOMTYPEANIM'] ?></td>
            <td><?= $anim['DATECREATIONANIM'] ?></td>
            <td><?= $anim['DATEVALIDITEANIM'] ?></td>
            <td><?= $anim['DUREEANIM'] ?> min</td>
            <td><?= $anim['LIMITEAGE'] ?> ans</td>
            <td><?= $anim['TARIFANIM'] ?></td>
            <td><?= $anim['NBREPLACEANIM'] ?></td>
            <td><?= $anim['DIFFICULTEANIM'] ?></td>
            <td><?= $anim['DESCRIPTANIM'] ?></td>
            <td><?= $anim['COMMENTANIM'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
