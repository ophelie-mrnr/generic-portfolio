<?php
// Déclaration de la page d'accueil
$fmk->initIndexRoute("accueil", "", "homeController.php", "index");
//cette ligne crée une route les arguments sont le nom, l'adresse lisible, le chemin vers le contrôleur et l'action
$fmk->initRoute("realisations", "realisations.html", "realisations.php", "index");