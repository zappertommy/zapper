<?php

class Controller extends VarHolder
{
  public function login()
  {
    $UserForm = new UserForm($_POST, true);
    
    $form = $UserForm->getWidgets();
    
    if ($_POST)
    {
      $login = $UserForm->login();
      
      if ($login)
      {
        $Routing  = new Routing($_GET['url']);
        
        $Routing->redirect('news-listing');
      }
      else
      {
        $this->message = 'Username and Password incorrect.';
      }
    }
    
    $this->username = $form['user__username'];
    
    $this->password = $form['user__password'];
    
    
    $this->createFunction();
  }
  
  public function logout()
  {
    $User = new User();
    
    $User->setLoginUser();
    
    $Routing  = new Routing($_GET['url']);
        
    $Routing->redirect('login');
  }
}
?>