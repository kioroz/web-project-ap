<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <?php
session_start();
// EC = encadran VA = vacancier
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit;
}

if($_SESSION['fonction'] == "EC") {
    echo "<p>Bonjour, " . $_SESSION['prenom'] . " " . $_SESSION['nom'] . " (Encadrant)</p>";
    exit;
}else if ($_SESSION['fonction'] == "VA") {
    echo "<p>Bonjour, " . $_SESSION['prenom'] . " " . $_SESSION['nom'] . " (Vacancier)</p>";
    exit;
}

   ?>
   <div id="nav">
    <li id="sub-menu"></li>
   </div>
</body>
</html>