<?php
  /*
   * Load Database Connection and Bases
   */
  include('lib/model/bases/Database.class.php');
  
  include('lib/model/bases/Table.class.php');
  
  include('lib/model/bases/Routing.class.php');
  
  include('lib/model/bases/Control.class.php');
  
  include('lib/model/bases/VarHolder.class.php');
  
  include('lib/model/bases/Template.class.php');
  
  include('lib/form/bases/Forms.class.php');
  
  
  /*
   * Load Model
   */
  include('lib/model/User.class.php');
  include('lib/model/NewsListing.class.php');
  
  
  /*
   * Load Forms
   */
  include('lib/form/UserForm.class.php');  
?>