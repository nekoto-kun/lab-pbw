<?php
require_once('product.php');

class RAM extends Product
{
  private $size;

  public function __construct($name, $price, $image, $size = 'N/A')
  {
    parent::__construct($name, $price, $image);
    $this->size = $size;
  }

  public function getSize()
  {
    return $this->size;
  }

  public function setSize($size)
  {
    $this->size = $size;
  }
}
