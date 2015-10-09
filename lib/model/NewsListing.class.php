<?php

class NewsListing extends Forms
{
  public function __construct()
  {
    $this->initialize('news_listing');
  }
  
  public function retrieveNewsListing()
  {
    $this->setData();
    
    return $this->retrieve();
  }
  
  public function setId($var)
  {
    $this->setField('news_listing__id', $var);
  }
  
  public function getId()
  {
    return $this->getField('news_listing__id');
  }
  
  public function setCategoryId($var)
  {
    $this->setField('news_listing__category_id', $var);
  }
  
  public function getCategoryId()
  {
    return $this->getField('news_listing__category_id');
  }
  
  public function setUserId($var)
  {
    $this->setField('news_listing__user_id', $var);
  }
  
  public function getUserId()
  {
    return $this->getField('news_listing__user_id');
  }
  
  public function setTitle($var)
  {
    $this->setField('news_listing__title', $var);
  }
  
  public function getTitle()
  {
    return $this->getField('news_listing__title');
  }
  
  public function setContent($var)
  {
    $this->setField('news_listing__content', $var);
  }
  
  public function getContent()
  {
    return $this->getField('news_listing__content');
  }
  
  public function setStatusTypeId($var)
  {
    $this->setField('news_listing__status_type_id', $var);
  }
  
  public function getStatusTypeId()
  {
    return $this->getField('news_listing__status_type_id');
  }
  
  public function setPublishDate($var)
  {
    $this->setField('news_listing__publish_date', $var);
  }
  
  public function getPublishDate()
  {
    return $this->getField('news_listing__publish_date');
  }
  
  public function setSlug($var)
  {
    $this->setField('news_listing__slug', $var);
  }
  
  public function getSlug()
  {
    return $this->getField('news_listing__slug');
  }
  
  public function setCreatedDate($var)
  {
    $this->setField('news_listing__date', $var);
  }
  
  public function getCreatedDate()
  {
    return $this->getField('news_listing__date');
  }
  
  public function setUpdatedDate($var)
  {
    $this->setField('news_listing__date', $var);
  }
  
  public function getUpdatedDate()
  {
    return $this->getField('news_listing__date');
  }
}
?>