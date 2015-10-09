<?php

class UserForm extends User
{
  public function __construct($data, $request = false)
  {
    $this->initialize('user');
    
    $this->setDataField($data, $request);
    
    $this->widgets();
    
    $this->setup();
  }
  
  public function setup()
  {
    $this->setWidgets(array(
      'label' => 'password',
      'name'  => 'user__password',
      'type'  => 'password',
      'value' => '',
      'other' => array()
    ));
  }
  
  public function setDataField($data, $request)
  {
    if ($request && $data)
    {
      foreach ($data as $name => $value)
      {
        if ($name == 'user__password' || $name == 'user__confirm_password')
        {
          $value = sha1($value);
        }
        
        $this->postField($name, $value);
      }
    }
  }
}
?>