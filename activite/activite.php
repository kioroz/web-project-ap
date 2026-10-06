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
            if ($role == "EC"): ?>
                <li data-role="gererActiv"> Ajouter une activité</li>
                <li data-role="gererParticipants"> Gérer les participants</li>
            <?php endif; ?>
            <li data-role="consulterActiv">Consulter les activités</li>
            <li><a href="../menu.php">menu </a></li>
            <li><a href="../logout.php">déconnexion</a></li>
        </ul>
    </nav>

    <div id="content"></div>
</body>
<script src="../js/dynActiv.js"></script>
<script src="../js/formAct.js"></script>
</html>