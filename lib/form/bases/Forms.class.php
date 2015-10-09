<?php

abstract class Forms extends Table
{
  var $widgets = array();

  public function widgets()
  {
    $cols = $this->getStructure();
    
    foreach ($cols as $col)
    {
      $srt = strpos($col['Type'], '(');
      
      $end = strpos($col['Type'], ')');
      
      if ($srt > 0)
      {
        $length = substr($col['Type'], $srt + 1, $end - ($srt + 1));
        
        $type   = substr($col['Type'], 0, $srt);
      }
      else
      {
        $length = 0;
        
        $type   = $col['Type'];
      }
      
      
      $this->setWidgets(array(
        'label' => $col['Field'], 
        'name'  => $this->getTableName().'__'.$col['Field'],
        'type'  => $type,
        'value' => $this->getField($this->getTableName().'__'.$col['Field']),
        'other' => array()
      ));
    }
  }
  
  public function setWidgets($param = array('label' => '', 'name' => '', 'type' => '', 'value' => '', 'other' => array()))
  {
    if ($param['name'] != '' && $param['type'] != '')
    { 
      $this->widgets[$param['name']] = $this->getHtmlTag(array(
        'label' => $param['label'],
        'name'  => $param['name'],
        'type'  => $param['type'],
        'value' => $param['value'],
        'other' => $param['other']
      ));
    }
  }
  
  public function getWidgets()
  {
    return $this->widgets;
  }
  
  public function postField($name, $value)
  {
    $prefix = explode('__', $name);
    
    
    if ($prefix[0] == $this->getTableName())
    {
      $this->setField($name, $value);
    }
  }


  public function getHtmlTag($param = array('label' => '', 'name' => '', 'type' => '', 'value' => '', 'other' => array()))
  {
    $label = ucwords(str_replace('__', ' ', $param['label']));
    
    $html_tag = '';
    
    $other = '';
    
    foreach ($param['other'] as $key => $val)
    {
      $other .= ' '.$key.'"'.$val.'"';
    }
    
    
    if ($param['type'] == 'int')
    {
      $html_tag = '<label>'.$label.'</label><input type="text" name="'.$param['name'].'" value="'.$param['value'].'"'.$other.' />';
    }
    else if ($param['type'] == 'varchar')
    {
      $html_tag = '<label>'.$label.'</label><input type="text" name="'.$param['name'].'" value="'.$param['value'].'"'.$other.' />';
    }
    else if ($param['type'] == 'password')
    {
      $html_tag = '<label>'.$label.'</label><input type="password" name="'.$param['name'].'" value="'.$param['value'].'"'.$other.' />';
    }
    else if ($param['type'] == 'datetime')
    {
      if ($param['value'])
      {
        $datetime = explode(' ', $param['value']);
      }
      else
      {
        $datetime = explode(' ', date('Y-m-d H:i:s'));
      }
      
      $date = explode('-', $datetime[0]);
      
      $time = explode(':', $datetime[1]);
      
      
      $html_tag = '<label>'.$label.'</label>';
      
      $html_tag .= '<span>';
      
      $html_tag .= '<select name="'.$param['name'].'[month]"'.$other.'>';
      
      for ($i = 1; $i <= 12; $i++)
      {
        $html_tag .= '<option value="'.$i.'"'.(($date[1] == $i) ? 'selected="selected"' : '').'>'.$i.'</option>';
      }
      
      $html_tag .= '</select>';
      
      
      $html_tag .= '&nbsp;/&nbsp;';
      
      
      $html_tag .= '<select name="'.$param['name'].'[day]"'.$other.'>';
      
      for ($i = 1; $i <= 31; $i++)
      {
        $html_tag .= '<option value="'.$i.'"'.(($date[2] == $i) ? 'selected="selected"' : '').'>'.$i.'</option>';
      }
      
      $html_tag .= '</select>';
      
      
      $html_tag .= '&nbsp;/&nbsp;';
      
      
      $html_tag .= '<select name="'.$param['name'].'[year]"'.$other.'>';
      
      for ($i = 2011; $i >= 1900; $i--)
      {
        $html_tag .= '<option value="'.$i.'"'.(($date[0] == $i) ? 'selected="selected"' : '').'>'.$i.'</option>';
      }
      
      $html_tag .= '</select>';
      
      $html_tag .= '</span>';
      
      $html_tag .= '<span>';
      
      $html_tag .= '<select name="'.$param['name'].'[hour]"'.$other.'>';
      
      for ($i = 0; $i <= 24; $i++)
      {
        $hour = ($i < 10) ? '0'.$i : $i;
        
        $html_tag .= '<option value="'.$hour.'"'.(($date[0] == $hour) ? 'selected="selected"' : '').'>'.$hour.'</option>';
      }
      
      $html_tag .= '</select>';
      
      
      $html_tag .= '&nbsp;:&nbsp;';
      
      
      $html_tag .= '<select name="'.$param['name'].'[minute]"'.$other.'>';
      
      for ($i = 0; $i <= 59; $i++)
      {
        $minute = ($i < 10) ? '0'.$i : $i;
        
        $html_tag .= '<option value="'.$minute.'"'.(($date[1] == $minute) ? 'selected="selected"' : '').'>'.$minute.'</option>';
      }
      
      $html_tag .= '</select>';
      
      
      $html_tag .= '&nbsp;:&nbsp;';
      
      
      $html_tag .= '<select name="'.$param['name'].'[seconds]"'.$other.'>';
      
      for ($i = 0; $i <= 59; $i++)
      {
        $seconds = ($i < 10) ? '0'.$i : $i;
        
        $html_tag .= '<option value="'.$seconds.'"'.(($date[2] == $seconds) ? 'selected="selected"' : '').'>'.$seconds.'</option>';
      }
      
      $html_tag .= '</select>';
      
      $html_tag .= '</span>';
    }
    
    return $html_tag;
  }
}
?>