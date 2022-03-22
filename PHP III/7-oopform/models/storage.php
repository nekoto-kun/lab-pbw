<?php
require_once('product.php');

class Storage extends Product
{
  private $type;

  public function __construct($name, $price, $image, $type = 'N/A')
  {
    parent::__construct($name, $price, $image);
    $this->type = $type;
  }

  public function getType()
  {
    return $this->type;
  }

  public function setType($type)
  {
    $this->type = $type;
  }
}
