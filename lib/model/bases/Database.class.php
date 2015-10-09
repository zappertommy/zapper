<?php

class Database
{
  var $conn;
  
  public function connect()
  {
    $this->conn = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
  
    if ($this->conn)
    {
      mysql_selectdb(DB_NAME) or die(mysql_error());
    }
  }
}
?>