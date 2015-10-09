<?php

abstract class Control
{
  var $area_location;
  var $url;
  var $module;
  var $control;
  var $file_location;
  
  public function __construct($area, $route = array('url', 'module', 'control'))
  {
    $this->initialize($area, $route);
  }
  
  public function initialize($area, $route)
  {
    $this->setAreaLocation($area);
    
    $this->setUrl($route['url']);
    
    $this->setModule($route['module']);
    
    $this->setControl($route['control']);
    
    $this->setFileLocation($this->getAreaLocation().$this->getModule().'/');
  }
  
  public function setAreaLocation($var)
  {
    $this->area = 'area/'.$var.'/';
  }
  
  public function getAreaLocation()
  {
    return $this->area;
  }
  
  public function setUrl($var)
  {
    $this->url = $var;
  }
  
  public function getUrl()
  {
    return $this->url;
  }
  
  public function setModule($var)
  {
    $this->module = $var;
  }
  
  public function getModule()
  {
    return $this->module;
  }
  
  public function setControl($var)
  {
    $this->control = $var;
  }
  
  public function getControl()
  {
    return $this->control;
  }
  
  public function setFileLocation($var)
  {
    $this->file_location = $var;
  }
  
  public function getFileLocation()
  {
    return $this->file_location;
  }
  
  public function getController()
  {
    include($this->getFileLocation().'code/Controller.class.php');
    
    $Controller = new Controller();
    
    $action = $this->getControl();
    
    $funcControl = false;
    
    if (is_callable(array($Controller, $action)))
    {
      $funcControl = $Controller->$action();
    }
    
    return $Controller;
  }
}
?>