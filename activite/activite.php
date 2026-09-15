<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activités</title>
</head>
<body>
    <?php 
    include '../database.php';
    session_start();
    $role = $_SESSION['fonction'];
    ?>
    <nav>
        <ul id="menu">
        <?php 
        if($role == "EC"):?>
        <li data-role = "gererActiv"> Ajouter une activité</li>
        <li data-role="suppActiv">Supprimer une activité</li>
        <li data-role = "gererParticipants"> Gérer les participants</li>
        <?php elseif($role == "VA"):?>
        <li data-role = "inscriptionActiv"> S'inscrire à une activité</li>
        <li data-role = "desinscriptionActiv"> Se désinscrire d'une activité</li>
        <?php endif;?>
    </ul>
    </nav>

    <div id="content"></div>
</body>
</html>