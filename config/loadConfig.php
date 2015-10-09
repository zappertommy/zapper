<?php
  session_start();
  
  include('access.php');
  
  include('routes.php');
  
  include('class.php');
  
  
  $Routing  = new Routing($_GET['url']);
  
  $Template = new Template($Routing->getArea(), $Routing->getRoute());
?>
