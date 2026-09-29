<?php
include '../database.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $codeanim = $_POST['CODEANIM'];
    $etat = $_POST['CODEETATACT'];
    $date = $_POST['DATEACT'];
    $hrrdv = $_POST['HRRDVACT'];
    $prix = $_POST['PRIXACT'];
    $hrdeb = $_POST['HRDEBUTACT'];
    $hrfin = $_POST['HRFINACT'];
    list($nomresp, $prenomresp) = explode("|", $_POST['RESP']);


    $sql = "INSERT INTO activite 
            (CODEANIM, DATEACT, CODEETATACT, HRRDVACT, PRIXACT, HRDEBUTACT, HRFINACT, NOMRESP, PRENOMRESP)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$codeanim, $date, $etat, $hrrdv, $prix, $hrdeb, $hrfin, $nomresp, $prenomresp])) {
        $message = "Activité ajoutée avec succès !";
    } else {
        $message = "Erreur lors de l'ajout de l'activité.";
    }
}




$sqlAnim = "SELECT CODEANIM, NOMANIM FROM animation";
$stmtAnim = $pdo->prepare($sqlAnim);
$stmtAnim->execute();
$animations = $stmtAnim->fetchAll(PDO::FETCH_ASSOC);

$sqlEtat = "SELECT CODEETATACT, NOMETATACT FROM etat_act";
$stmtEtat = $pdo->prepare($sqlEtat);
$stmtEtat->execute();
$etats = $stmtEtat->fetchAll(PDO::FETCH_ASSOC);

$sqlResp = "SELECT NOMCOMPTE, PRENOMCOMPTE FROM compte WHERE TYPEPROFIL = 'EC'";
$stmtResp = $pdo->prepare($sqlResp);
$stmtResp->execute();
$responsables = $stmtResp->fetchAll(PDO::FETCH_ASSOC);

?>
<h2>Ajouter une activité</h2>
<?php if (!empty($message)): ?>
    <p style="color:green; font-weight:bold;">
        <?= $message ?>
    </p>
<?php endif; ?>
<form method="POST" id="formActivite">

    <label for="CODEANIM">Animation :</label>
    <select name="CODEANIM" id="CODEANIM" required>
        <option value="">-- Sélectionner une animation --</option>

        <?php foreach ($animations as $anim): ?>
            <option value="<?= $anim['CODEANIM'] ?>">
                <?= $anim['CODEANIM'] ?> - <?= $anim['NOMANIM'] ?>
            </option>
        <?php endforeach; ?>
    </select>
    <label>Date de l'activité :</label>
    <input type="date" name="DATEACT" required>

    <label for="CODEETATACT">État de l'activité :</label>
    <select name="CODEETATACT" id="CODEETATACT" required>
        <option value="">-- Sélectionner un état --</option>

        <?php foreach ($etats as $etat): ?>
            <option value="<?= $etat['CODEETATACT'] ?>">
                <?= $etat['CODEETATACT'] ?> - <?= $etat['NOMETATACT'] ?>
            </option>
        <?php endforeach; ?>


    </select>

    <label>Heure de rendez-vous :</label>
    <input type="time" name="HRRDVACT" required>


    <label>Prix :</label>
    <input type="number" name="PRIXACT" step="0.01" required>

    <label>Heure de début :</label>
    <input type="time" name="HRDEBUTACT" required>

    <label>Heure de fin :</label>
    <input type="time" name="HRFINACT" required>


    <label>Responsable :</label>
    <select name="RESP" required>
        <option value="">-- Sélectionner un responsable --</option>

        <?php

        foreach ($responsables as $resp) {
            $value = $resp['NOMCOMPTE'] . "|" . $resp['PRENOMCOMPTE'];
            $label = $resp['PRENOMCOMPTE'] . " " . $resp['NOMCOMPTE'];
            echo "<option value='$value'>$label</option>";
        }
        ?>
    </select>
    <button type="submit">Ajouter</button>


</form>
