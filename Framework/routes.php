<?php
// D�claration de la page d'accueil
$newRoute->initIndexRoute("accueil", "", "homeController.php", "index");

$newRoute->initRoute("about", "", "aboutController.php", "index");


//cette ligne cr�e une route les arguments sont le nom, l'adresse lisible, le chemin vers le contr�leur et l'action
$newRoute->initRoute("realisations", "realisations.html", "realisations.php", "index");

?>