<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

chdir(__DIR__.'/../src');
  
   include("../Framework/routing.php");
   $newRoute = new Routes();
   include("../Framework/routes.php");
   
  $route = htmlentities($_GET["page"]);
  //var_dump($route);
        
   $mot = explode("/",$route); 
   //var_dump($mot);

   $myControlleur = $mot[0].'Controller';
   //var_dump($myControlleur);
   
   $action = $mot[1];
   //var_dump($action);
   
   include("/Controller/".$myControlleur.".php");
   
   $classe = $myControlleur.'/'.ucfirst($action);
   //var_dump($classe);
   
   if(is_callable($action, false, $callable_name)){
      call_user_func($action);
   }
  
?>