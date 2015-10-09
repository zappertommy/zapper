<?php
  /*
   * Admin
   */
  
  $route = array(
    'url'     => '/admin/error',
    'param'   => '',
    'module'  => 'error',
    'control' => 'error'
  );
  
  $routes_admin['error'] = $route;
  
  
  $route = array(
    'url'     => '/admin/login',
    'param'   => '',
    'module'  => 'user',
    'control' => 'login'
  );
  
  $routes_admin['login'] = $route;
  
  
  $route = array(
    'url'     => '/admin/logout',
    'param'   => '',
    'module'  => 'user',
    'control' => 'logout'
  );
  
  $routes_admin['logout'] = $route;
  
  
  $route = array(
    'url'     => '/admin/news-listing',
    'param'   => 'int',
    'module'  => 'newsListing',
    'control' => 'newsListing'
  );
  
  $routes_admin['news-listing'] = $route;
  
  
  /*
   * Frontend
   */
  $route = array(
    'url'     => '/error',
    'param'   => '',
    'module'  => 'error',
    'control' => 'error'
  );
  
  $routes_frontend['error'] = $route;
  
  
  $route = array(
    'url'     => '/',
    'param'   => '',
    'module'  => 'newsListing',
    'control' => 'homepage'
  );
  
  $routes_frontend['homepage'] = $route;
  
  
  $routes = array(
    'admin'    => $routes_admin,
    'frontend' => $routes_frontend
  );
  
  unset($route, $routes_admin, $routes_frontend);
?>