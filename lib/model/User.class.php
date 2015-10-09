<?php

class User extends Forms
{
  public function __construct()
  {
    $this->initialize('user');
  }
  
  public function login()
  {
    $this->addWhere('username', $this->getUsername(), '=');
    
    $this->addWhere('password', $this->getPassword(), '=');
    
    $this->setData();
    
    if ($this->getId())
    {
      $this->setLoginUser($this->getId());
      
      $login = true;
    }
    else
    {
      $login = false;
    }
    
    return $login;
  }
  
  public function setLoginUser($var = '')
  {
    if ($var)
    {
      $_SESSION['USER_ID'] = $var;
    }
    else
    {
      unset($_SESSION['USER_ID']);
    }
  }
  
  public function isUserLoggin()
  {
    if (array_key_exists('USER_ID', $_SESSION))
    {
      if ($_SESSION['USER_ID'])
      {
        $is_logged = true;
      }
      else 
      {
        $is_logged = false;
      }
    }
    else
    {
      $is_logged = false;
    }
    
    return $is_logged;
  }
  
  public function setId($var)
  {
    $this->setField('user__id', $var);
  }
  
  public function getId()
  {
    return $this->getField('user__id');
  }
  
  public function setUsername($var)
  {
    $this->setField('user__username', $var);
  }
  
  public function getUsername()
  {
    return $this->getField('user__username');
  }
  
  public function setPassword($var)
  {
    if ($var != '')
    {
      $var = sha1($var);
      
      $this->setField('user__password', $var);
    }
  }
  
  public function getPassword()
  {
    return $this->getField('user__password');
  }
  
  public function setConfirmPassword($var)
  {
    if ($var != '')
    {
      $var = sha1($var);

      $this->setField('user__confirm_password', $var);
    }
  }
  
  public function getConfirmPassword()
  {
    return $this->getField('user__confirm_password');
  }
  
  public function setFirstName($var)
  {
    $this->setField('user__first_name', $var);
  }
  
  public function getFirstName()
  {
    return $this->getField('user__first_name');
  }
  
  public function setLastName($var)
  {
    $this->setField('user__last_name', $var);
  }
  
  public function getLastName()
  {
    return $this->getField('user__last_name');
  }
  
  public function setLastLogin($var)
  {
    $this->setField('user__last_login', $var);
  }
  
  public function getLastLogin()
  {
    return $this->getField('user__last_login');
  }
  
  public function setCreatedDate($var)
  {
    $this->setField('user__created_date', $var);
  }
  
  public function getCreatedDate()
  {
    return $this->getField('user__created_date');
  }
  
  public function setUpdatedDate($var)
  {
    $this->setField('user__updated_date', $var);
  }
  
  public function getUpdatedDate()
  {
    return $this->getField('user__updated_date');
  }
}
?>