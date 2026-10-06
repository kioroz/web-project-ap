<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>animation</title>
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
            if ($role == 'EC'): ?>
                <li data-role="ajoutAnim">Ajouter une animation</li>
            <?php endif ?>
            <li data-role="conAnim"> Consulter les animations</li>

            <li><a href="../menu.php">menu principal</a></li>
        </ul>
    </nav>
    <div id="content"></div>
</body>


<script src="../js/dynAnim.js"></script>
<script src="../js/formAnim.js"></script>
</html>