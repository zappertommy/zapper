<?php

class Template extends Control
{
  var $content_location;
  
  public function __construct($area, $route = array('url', 'module', 'control'))
  {
    parent::initialize($area, $route);
    
    $this->setContentLocation($this->getFileLocation());
  }
  
  public function setContentLocation($var)
  {
    $this->content_location = $var;
  }
  
  public function getContentLocation()
  {
    return $this->content_location;
  }
  
  public function getHeader()
  {
    include($this->getAreaLocation().'templates/header.php');
  }
  
  public function getFooter()
  {
    include($this->getAreaLocation().'templates/footer.php');
  }
  
  public function getTemplate()
  {
    $Controller = $this->getController();
    
    include($this->getContentLocation().'templates/'.$this->getControl().'.php');
  }
}
?>
