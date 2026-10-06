<?php
include '../database.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $codeanim = $_POST['CODEANIM'];
    $codetype = $_POST['CODETYPEANIM'];
    $nomanim = $_POST['NOMANIM'];
    $datecreation = $_POST['DATECREATIONANIM'];
    $datevalidite = $_POST['DATEVALIDITEANIM'];
    $duree = $_POST['DUREEANIM'];
    $limiteage = $_POST['LIMITEAGE'];
    $tarif = $_POST['TARIFANIM'];
    $nbreplace = $_POST['NBREPLACEANIM'];
    $descript = $_POST['DESCRIPTANIM'];
    $comment = $_POST['COMMENTANIM'];
    $diff = $_POST['DIFFICULTEANIM'];

    $sql = "INSERT INTO animation 
            (CODEANIM, CODETYPEANIM, NOMANIM, DATECREATIONANIM, DATEVALIDITEANIM, 
             DUREEANIM, LIMITEAGE, TARIFANIM, NBREPLACEANIM, 
             DESCRIPTANIM, COMMENTANIM, DIFFICULTEANIM)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([
        $codeanim, $codetype, $nomanim, $datecreation, $datevalidite,
        $duree, $limiteage, $tarif, $nbreplace,
        $descript, $comment, $diff
    ])) {
        $message = "Animation ajoutée avec succès !";
    } else {
        $message = "Erreur lors de l'ajout de l'animation.";
    }
}

$sqlType = "SELECT CODETYPEANIM, NOMTYPEANIM FROM type_anim";
$stmtType = $pdo->prepare($sqlType);
$stmtType->execute();
$types = $stmtType->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Ajouter une animation</h2>

<?php if (!empty($message)): ?>
    <p style="color:green; font-weight:bold;">
        <?= $message ?>
    </p>
<?php endif; ?>

<form method="POST" id="formAnimation">

    <label>Code animation :</label>
    <input type="text" name="CODEANIM" required>

    <label for="CODETYPEANIM">Type d'animation :</label>
    <select name="CODETYPEANIM" id="CODETYPEANIM" required>
        <option value="">-- Sélectionner un type --</option>
        <?php foreach ($types as $t): ?>
            <option value="<?= $t['CODETYPEANIM'] ?>">
                <?= $t['CODETYPEANIM'] ?> - <?= $t['NOMTYPEANIM'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Nom de l'animation :</label>
    <input type="text" name="NOMANIM" required>

    <label>Date de création :</label>
    <input type="date" name="DATECREATIONANIM" required>

    <label>Date de validité :</label>
    <input type="date" name="DATEVALIDITEANIM" required>

    <label>Durée (minutes) :</label>
    <input type="number" name="DUREEANIM" required>

    <label>Limite d'âge :</label>
    <input type="number" name="LIMITEAGE" required>

    <label>Tarif (€) :</label>
    <input type="number" step="0.01" name="TARIFANIM" required>

    <label>Nombre de places :</label>
    <input type="number" name="NBREPLACEANIM" required>

    <label>Description :</label>
    <textarea name="DESCRIPTANIM" required></textarea>

    <label>Commentaire :</label>
    <textarea name="COMMENTANIM"></textarea>

    <label>Difficulté :</label>
    <input type="text" name="DIFFICULTEANIM" required>

    <button type="submit">Ajouter</button>

</form>
