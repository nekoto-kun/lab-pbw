<?php
require_once('models/processor.php');
require_once('models/ram.php');
require_once('models/storage.php');
require_once('models/vga.php');

$cpu = new Processor('Intel', 9600000, 'https://c1.neweggimages.com/ProductImageCompressAll1280/19-118-341-06.jpg', 8);
$ssd = new Storage('Samsung', 5200000, 'https://pemmz.com/pub/media/catalog/product/cache/bd3f5a515fc184d023496aa6e56fb6f6/_/_/__57_2.jpg', 'SSD');
$ram = new RAM('Corsair', 6200000, 'https://media.ldlc.com/r374/ld/products/00/05/90/05/LD0005900503_1_0005912824_0005923045.jpg', '8 GB');
$vga = new VGA('Nvidia', 20500000, 'https://cf.shopee.co.id/file/a36de0fd3091931e6f6488f31b35240a', '4 GB');

$products = array($cpu, $ssd, $ram, $vga);
