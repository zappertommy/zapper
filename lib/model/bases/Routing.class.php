<?php

class Routing
{
  var $area;
  var $routes;
  var $url;
  var $module;
  var $control;
  var $segment;
  var $valid_route;
  
  public function __construct($url)
  {
    global $routes;
    
    $this->setRoutes($routes);
    
    $this->setUrl($url);
    
    $this->setSegment($url);
    
    $segment = $this->getSegment();
    
    $this->setArea($segment[0]);
    
    $this->setValidRoute();
  }
  
  public function setArea($var)
  {
    $this->area = ($var == 'admin') ? 'admin' : 'frontend';
  }
  
  public function getArea()
  {
    return $this->area;
  }
  
  public function setRoutes($var)
  {
    $this->routes = $var;
  }
  
  public function getRoutes()
  {
    return $this->routes;
  }
  
  public function setUrl($var)
  {
    if ($var != '')
    {
      if ($var[0] != '/')
      {
        $var = '/'.$var;
      }
      
      $check_url = strrev($var);
      
      if ($check_url[0] == '/')
      {
        $var = substr($var, 0, strlen($var) - 1);
      }
    }
    else
    {
      $var = '/';
    }
    
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
  
  public function setSegment($var)
  {
    if ($var)
    {
      $segment = explode('/', $var);

      if ($segment[count($segment) - 1] == '')
      {
        unset($segment[count($segment) - 1]);
      }
    }
    else
    {
      $segment = array('');
    }
    
    $this->segment = $segment;
  }
  
  public function getSegment()
  {
    return $this->segment;
  }
  
  public function isAdmin()
  {
    return ($this->getArea() == 'admin') ? true : false;
  }
  
  public function setValidRoute()
  {
    $routes = $this->getRoutes();
    
    if ($this->isAdmin())
    {
      $segment = $this->getSegment();
      
      if (count($segment) == 1 && $segment[0] == 'admin')
      {
        $valid_route = true;
        
        $this->setRoute($routes['admin']['login']);
      }
      else
      {
        $valid_route = false;
        
        foreach ($routes[$this->getArea()] as $route)
        {
          if ($this->getUrl() == $route['url'])
          {
            $this->setRoute($route);

            $valid_route = true;
          }
          else
          {
            unset($route_segment);
            
            $url_len = explode('/', $route['url']);
            
            foreach (explode('/', $route['url']) as $part)
            {
              if ($part != '')
              {
                $route_segment[] = $part;
              }
            }
            
            foreach (explode('/', $route['param']) as $part)
            {
              if ($part != '')
              {
                $route_segment[] = $part;
              }
            }
            
            if (count($segment) <= count($route_segment))
            {
              $check = true;
              
              for ($i = 0; $i < count($segment); $i++)
              {
                if ($check == true && $i < count($url_len) && $segment[$i] != $route_segment[$i])
                {
                  $check = false;
                }
                
                if ($check == true && $segment[$i] != $route_segment[$i])
                {
                  if ($route_segment[$i] == 'int')
                  {
                    $check = preg_match('/\d/', $segment[$i]) ? $check : false;
                  }
                }
              }
              
              if ($check == true)
              {
                $this->setRoute($route);

                $valid_route = true;
              }
            }
          }
        }
        
        if (!in_array($this->getControl(), array('login', 'logout')))
        {
          $User = new User();
        
          $is_logged = $User->isUserLoggin();
          
          if (!$is_logged)
          {
            $this->redirect('login');
          }
        }
        
        if ($valid_route == false)
        {
          $this->setRoute($routes['admin']['error']);
        }
      }
    }
    else
    {
      $valid_route = false;
      
      foreach ($routes['frontend'] as $route)
      {
        if ($this->getUrl() == $route['url'])
        {
          $this->setRoute($route);
          
          $valid_route = true;
        }
      }
      
      if ($valid_route == false)
      {
        $this->setRoute($routes['frontend']['error']);
      }
    }
    
    $this->valid_route = $valid_route;
  }
  
  public function isValidRoute()
  {
    return $this->valid_route ? true : false;
  }
  
  public function setRoute($var)
  {
    if (is_array($var))
    {
      $this->setUrl($var['url']);
      
      $this->setModule($var['module']);
      
      $this->setControl($var['control']);
    }
    else
    {
      $this->setUrl('/error');
    }
  }
  
  public function getRoute()
  {
    return array(
      'url'     => $this->getUrl(),
      'module'  => $this->getModule(),
      'control' => $this->getControl()
    );
  }
  
  public function getRoutingHost()
  {
    return $_SERVER['HTTP_HOST'];
  }
  
  public function redirect($route)
  {
    $routes = $this->getRoutes();
    
    if (array_key_exists($route, $routes[$this->getArea()]))
    {
      $url = $this->getRoutingHost().$routes[$this->getArea()][$route]['url'];
    }
    else
    { 
      $url = $this->getRoutingHost().$routes[$this->getArea()]['error']['url'];
    }
    
    header('Location: http://'.$url);
  }
}
?>
