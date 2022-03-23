<?php
// Receive the query data using $_GET, and assign it to the $productName variable
$productName = $_GET['name'];
?>

<!-- Print the $productName variable -->
<h1><?= $productName ?> details page</h1>