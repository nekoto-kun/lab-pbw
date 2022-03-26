<?php
require_once('connection.php');
require_once('models/processor.php');
require_once('models/ram.php');
require_once('models/storage.php');
require_once('models/vga.php');

function getAllProducts()
{
  // Setup SQL statement
  $sql = "SELECT * FROM products";

  try {
    $conn = createConnection();
    // Query the statement using connection PDO
    $result = $conn->query($sql, PDO::FETCH_ASSOC);

    // Array init
    $products = [];

    // Iterate over query result
    while ($product = $result->fetch()) {

      // Store each data in variables
      $id = $product['id'];
      $name = $product['name'];
      $price = $product['price'];
      $imageUrl = $product['image_url'];
      $options = json_decode($product['options']); // Use json_decode() to decode JSON string into PHP object

      // Create new objects based on their category value
      switch ($options->category) {
        case 'processor':
          $products[] = new Processor($id, $name, $price, $imageUrl, $options->cores);
          break;
        case 'storage':
          $products[] = new Storage($id, $name, $price, $imageUrl, $options->type);
          break;
        case 'memory':
          $products[] = new RAM($id, $name, $price, $imageUrl, $options->size);
          break;
        case 'vga':
          $products[] = new VGA($id, $name, $price, $imageUrl, $options->size);
          break;
      }
    }
    return $products;
  } catch (PDOException $e) {
    die('Error reading data: ' . $e->getMessage());
  }
}

function addNewProduct($payload)
{
  try {
    $conn = createConnection();
    $sql = 'INSERT INTO products (name, price, image_url, options) VALUES (?, ?, ?, ?)';
    $statement = $conn->prepare($sql);

    $options = array(
      'category' => $payload['category']
    );

    switch ($payload['category']) {
      case 'processor':
        $options['cores'] = $payload['cores'];
        break;
      case 'storage':
        $options['type'] = $payload['storageType'];
        break;
      case 'memory':
      case 'vga':
        $options['size'] = $payload['size'];
        break;
    }

    $statement->execute([$payload['name'], $payload['price'], $payload['imageUrl'], json_encode($options)]);
  } catch (PDOException $e) {
    die('Error creating data: ' . $e->getMessage());
  }
}

function getSingleProduct($id)
{
  try {
    $conn = createConnection();
    $sql = "SELECT * FROM products WHERE id = $id";
    $result = $conn->query($sql, PDO::FETCH_ASSOC);
    return $result->fetch();
  } catch (PDOException $e) {
    die('Error reading data: ' . $e->getMessage());
  }
}
