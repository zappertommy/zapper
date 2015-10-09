<?php

class Controller extends VarHolder
{
  function newsListing()
  {
    $NewsListing = new NewsListing();
    
    $this->listings = $NewsListing->retrieveNewsListing();
    
    //$this->createFunction();
  }
}
?>