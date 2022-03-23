<?php
require_once('connection.php');
require_once('models/processor.php');
require_once('models/ram.php');
require_once('models/storage.php');
require_once('models/vga.php');

// Setup SQL statement
$sql = "SELECT * FROM products";

try {
  // Query the statement using connection PDO
  $result = $conn->query($sql, PDO::FETCH_ASSOC);

  // Array init
  $products = [];

  // Iterate over query result
  while ($product = $result->fetch()) {

    // Store each data in variables
    $name = $product['name'];
    $price = $product['price'];
    $imageUrl = $product['image_url'];
    $options = json_decode($product['options']); // Use json_decode() to decode JSON string into PHP object

    // Create new objects based on their category value
    switch ($options->category) {
      case 'processor':
        $products[] = new Processor($name, $price, $imageUrl, $options->cores);
        break;
      case 'storage':
        $products[] = new Storage($name, $price, $imageUrl, $options->type);
        break;
      case 'memory':
        $products[] = new RAM($name, $price, $imageUrl, $options->size);
        break;
      case 'vga':
        $products[] = new VGA($name, $price, $imageUrl, $options->size);
        break;
    }
  }
} catch (PDOException $e) {
  die('Error reading data: ' . $e->getMessage());
}
