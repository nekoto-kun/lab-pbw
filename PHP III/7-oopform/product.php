<?php
class Product
{
  private $name;
  private $price;
  private $image;
  private $orderCount = 0;

  private static $count = 0;

  public function __construct($name, $price, $image)
  {
    $this->name = $name;
    $this->price = $price;
    $this->image = $image;
    self::$count++;
  }

  public function hello()
  {
    echo 'Nama produk: ' . $this->name;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getImage()
  {
    return $this->image;
  }

  public function getOrderCount()
  {
    return $this->orderCount;
  }

  public function setOrderCount($orderCount)
  {
    $this->orderCount = $orderCount;
  }

  public function getPriceVAT()
  {
    return round($this->price * 1.1, 2);
  }

  public function getTotalPrice()
  {
    return $this->getPriceVAT() * $this->orderCount;
  }

  public function getCount()
  {
    return self::$count;
  }
}
