<?php

abstract class Table extends Database
{
  var $table_name;
  var $columns;
  var $where;
  var $fields;
  var $field;
  var $num_rows;
  
  public function initialize($table_name)
  {
    $this->connect();
    
    $this->setTableName($table_name);
    
    $this->setColumns($this->getStructure());
    
    foreach ($this->getColumns() as $col)
    {
      $this->setField($this->getTableName().'__'.$col['Field'], '');
    }
  }
  
  public function setTableName($var)
  {
    $this->table_name = $var;
  }
  
  public function getTableName()
  {
    return $this->table_name;
  }
  
  public function setColumns($var)
  {
    $this->columns = $var;
  }
  
  public function getColumns()
  {
    return $this->columns;
  }
  
  public function setField($name, $value)
  {
    $this->field[$name] = $value;
  }

  public function getField($name)
  {
    return $this->field[$name];
  }
  
  public function setFields($param)
  {
    $this->fields[] = $param;
  }

  public function getFields()
  {
    return $this->fields;
  }
  
  public function setNumRows($var)
  {
    $this->num_rows = $var;
  }
  
  public function getNumRows()
  {
    return $this->num_rows;
  }
  
  public function getStructure()
  {
    $result = mysql_query('DESCRIBE `'.$this->getTableName().'`');
    
    $rows = array();
    
    while ($row = mysql_fetch_assoc($result))
    {
      $rows[] = $row;
    }
    
    return $rows;
  }
  
  public function addWhere($column, $value, $condition)
  {
    $this->where .= ($this->where == '') ? " WHERE" : " AND";
    
    $this->where .= " `". $column . "`";
    
    $this->where .= " ".$condition;
    
    if (!in_array($condition, array('IS NULL', 'IS NOT NULL')))
    {
      $this->where .= " '".htmlentities($value)."'";
    }
  }
  
  public function getWhere()
  {
    return $this->where;
  }
  
  public function prefixColumns()
  {
    $columns = "";
    
    foreach ($this->getColumns() as $key => $col)
    {
      $columns .= " `".$col['Field']."` AS `".$this->getTableName()."__".$col['Field']."`";
      
      if (count($this->getColumns()) != ($key + 1))
      {
        $columns .= ",";
      }
    }
    
    return $columns;
  }
  
  public function setData()
  {
    $query = "SELECT".$this->prefixColumns()." FROM ".$this->getTableName();
    
    if ($this->getWhere() != '')
    {
      $query .= $this->getWhere();
    }
    
    $result = mysql_query($query);
    
    $num_rows = mysql_numrows($result);
    
    $this->setNumRows($num_rows);
    
    if ($this->getNumRows() > 0)
    {
      while ($row = mysql_fetch_assoc($result))
      {
        if ($this->getNumRows() == 1)
        {
          foreach ($row as $name => $value)
          {
            $this->setField($name, $value);
          }
        }
        else
        {
          $this->setFields($row);
        }
      }
    }
  }
  
  public function retrieve()
  {
    if ($this->getNumRows() > 0)
    {
      if ($this->getNumRows() == 1)
      {
        $data[] = $this->field;
      }
      else
      {
        $data = $this->getFields();
      }
    }
    else
    {
      $data = false;
    }
    
    return $data;
  }
}
?>