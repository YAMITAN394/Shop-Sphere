<?php
session_start();

require_once 'C:/xampp/htdocs/tutorial/MOBILE SHOPEE/functions.php';
require_once 'C:/xampp/htdocs/tutorial/MOBILE SHOPEE/database/DBController.php';
require_once 'C:/xampp/htdocs/tutorial/MOBILE SHOPEE/database/Product.php';
require_once __DIR__ . '/database/Cart.php';

use database\Cart;
use database\DBController;
use database\Product;

$db = new DBController();
$product = new Product($db);
$Cart = new Cart($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobile Shopee</title>

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- Owl-carousel CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"/>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"/>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- start #header -->
<header id="header">
    <div class="strip d-flex justify-content-between px-4 py-1 bg-light">
        <p class="font-rale font-size-12 text-black-50 m-0">Jordan Calderon 430-985 Eleifend St. Duluth Washington 92611 (427) 930-5255</p>
        <div class="font-rale font-size-14">
            <?php if (isset($_SESSION["user_id"])): ?>
                <span class="px-3 border-right border-left text-dark">
                    Welcome, <?php echo htmlspecialchars($_SESSION["first_name"]); ?>
                </span>
                <a href="logout.php" class="px-3 border-right text-dark">Logout</a>
            <?php else: ?>
                <a href="login.php" class="px-3 border-right border-left text-dark">Login</a>
            <?php endif; ?>
            <a href="#" class="px-3 border-right text-dark">Wishlist (0)</a>
        </div>
    </div>

    <!-- Primary Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark color-second-bg">
        <a class="navbar-brand" href="#">SHOP SPHERE</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav m-auto font-rubik">
                <li class="nav-item active"><a class="nav-link" href="#">On Sale</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Category</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Products <i class="fas fa-chevron-down"></i></a></li>
                <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Category <i class="fas fa-chevron-down"></i></a></li>
                <li class="nav-item"><a class="nav-link" href="#">Coming Soon</a></li>
            </ul>

            <form action="Cart.php" class="font-size-14 font-rale">
                <a href="Cart.php" class="py-2 rounded-pill color-primary-bg">
                    <span class="font-size-16 px-2 text-white"><i class="fas fa-shopping-cart"></i></span>
                    <span class="px-3 py-2 rounded-pill text-dark bg-light">
                        <?php echo $cartCount = count($product->getData('cart')); ?>
                    </span>
                </a>
            </form>
        </div>
    </nav>
    <!-- !Primary Navigation -->
</header>
<!-- !start #header -->
