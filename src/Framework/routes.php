<?php
// D�claration de la page d'accueil
$fmk->initIndexRoute("accueil", "", "homeController.php", "index");
//cette ligne cr�e une route les arguments sont le nom, l'adresse lisible, le chemin vers le contr�leur et l'action
$fmk->initRoute("realisations", "realisations.html", "realisations.php", "index");