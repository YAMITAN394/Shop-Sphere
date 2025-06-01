<?php

require_once __DIR__ . '/database/DBController.php';
require_once __DIR__ . '/database/Product.php';
require_once __DIR__ . '/database/Cart.php';

use database\Cart;
use database\DBController;
use database\Product;

$db = new DBController();
$product = new Product($db);
$product_shuffle=$product->getData();
$Cart = new Cart($db);
