<?php
// Déclaration de la page d'accueil
$newRoute->initIndexRoute("accueil", "", "homeController.php", "index");

$newRoute->initRoute("about", "", "aboutController.php", "index");


//cette ligne crée une route les arguments sont le nom, l'adresse lisible, le chemin vers le contrôleur et l'action
$newRoute->initRoute("realisations", "realisations.html", "realisations.php", "index");

?>