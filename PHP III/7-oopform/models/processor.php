<?php
require_once('product.php');

class Processor extends Product
{
  private $cores;

  public function __construct($name, $price, $image, $cores)
  {
    parent::__construct($name, $price, $image);
    $this->$cores = $cores;
  }

  public function getCores()
  {
    return $this->cores;
  }

  public function setCores($cores)
  {
    $this->$cores = $cores;
  }
}
