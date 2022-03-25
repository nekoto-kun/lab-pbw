<?php

require_once('data.php');

if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
  addNewProduct($_POST);
  header('Location: index.php');
}
