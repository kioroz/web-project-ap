<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>menu</title>
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
}else if ($_SESSION['fonction'] == "VA") {
    echo "<p>Bonjour, " . $_SESSION['prenom'] . " " . $_SESSION['nom'] . " (Vacancier)</p>";
    
}else{
    header("Location: index.html");
    exit;
}


   ?>
   <div id="nav">
    
   <li id="sub-menu">
<?php
 if($_SESSION['fonction'] == "EC") {
    echo "<li>";
    echo '<a href="activite/activite.php"> activités</a>';
    echo "</li>";
    echo "<li>";
    echo '<a href="/animation.php">Ajouter une animation</a>';
    echo "</li>";
 }else if($_SESSION['fonction'] == "VA") {
    echo "<li>";
    echo '<a href="activite/activite.php">Activités</a>';
    echo "</li>";
    echo "<li>";
    echo '<a href="/animation.php">Voir les animations</a>';
    echo "</li>";
}


 
 
 

?>
    <a href="logout.php">déconnexion</a>

    </li>
   </div>
</body>
</html>