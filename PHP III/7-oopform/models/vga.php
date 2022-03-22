<?php
require_once('product.php');

class VGA extends Product
{
  private $size;

  public function __construct($name, $price, $image, $size)
  {
    parent::__construct($name, $price, $image);
    $this->$size = $size;
  }

  public function getSize()
  {
    return $this->size;
  }

  public function setSize($size)
  {
    $this->$size = $size;
  }
}
