<?php
  include("../src/Framework/routing.php");
  $fmk = new Routes();
  include("../src/Framework/routes.php");
  if (isset($_GET["page"]))
  {
    $route = htmlentities(trim($_GET["page"]));
  }
  else
  {
    $route = "";
  }
  $fmkRoute = $fmk->getControlleur($route);
  if ($fmk->isError404())
  {
      header("HTTP/1.0 404 Not Found");
  }
  $controlleur = '../src/Controller/'.$fmkRoute[0];
  include($controlleur);
  $classe = preg_split('[\.|/]',$fmkRoute[0]);
  $classe = $classe[0].ucfirst($classe[1]);
  $methodVariable = array($classe, $fmkRoute[1]);
  if(is_callable($methodVariable, false, $callable_name)){
      call_user_func($methodVariable);
  }