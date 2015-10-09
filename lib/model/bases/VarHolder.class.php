<?php

abstract class VarHolder
{
  public function __call($method, $args)
  {
    if(property_exists($this, $method))
    {
      if(is_callable($this->$method))
      {
        return call_user_func_array($this->$method, $args);
      }
    }
  }
  
  public function createFunction()
  {
    foreach (get_object_vars($this) as $name => $value)
    {
      $str = str_replace('__', ' ', $name);
      
      $str = ucwords(strtolower($str));
      
      $str = str_replace(' ', '', $str);
      
      $this->{'get'.$str} = create_function('', 'return "'.html_entity_decode(addslashes($value)).'";');
    }
  }
}
?>
