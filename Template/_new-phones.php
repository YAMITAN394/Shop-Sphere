<?php

require_once 'C:/xampp/htdocs/tutorial/MOBILE SHOPEE/functions.php';
require_once 'C:/xampp/htdocs/tutorial/MOBILE SHOPEE/database/DBController.php';
require_once 'C:/xampp/htdocs/tutorial/MOBILE SHOPEE/database/Product.php';
require_once __DIR__ . '/../database/Cart.php';
use database\Cart;
use database\DBController;
use database\Product;

$db = new DBController();


$db = new DBController();

$product = new Product($db);
$Cart = new Cart($db);

$product_shuffle = $product->getData();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['new_phones_submit'])){
        $Cart->addToCart($_POST['user_id'],$_POST['item_id']);
    }
}


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!-- New Phones -->
<section id="new-phones">
    <div class="container">
        <h4 class="font-rubik font-size-20">New Phones</h4>
        <hr>

        <!-- owl carousel -->
        <div class="owl-carousel owl-theme">
            <?php foreach($product_shuffle as $item): ?>
                <div class="item py-2 bg-light">
                    <div class="product font-rale">
                        <a href="<?php echo 'product.php?item_id=' . (isset($item['item_id']) ? $item['item_id'] : ''); ?>">
                            <img src="<?php echo isset($item['item_image']) ? $item['item_image'] : './assets/products/default.png'; ?>" alt="<?php echo isset($item['item_name']) ? $item['item_name'] : 'Product'; ?>" class="img-fluid">
                        </a>
                        <div class="text-center">
                            <h6><?php echo isset($item['item_name']) ? $item['item_name'] : 'Unknown Product'; ?></h6>
                            <div class="rating text-warning font-size-12">
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="far fa-star"></i></span>
                            </div>
                            <div class="price py-2">
                                <span><?php echo isset($item['item_price']) ? '$' . $item['item_price'] : '$0'; ?></span>
                            </div>
                            <form method="post">
                                <input type="hidden" name="item_id" value="<?php echo isset($item['item_id']) ? $item['item_id'] : '1'; ?>">
                                <input type="hidden" name="user_id" value="<?php echo 1; ?>">
                                <button type="submit" name="new_phones_submit" class="btn btn-warning font-size-12">Add to Cart</button>
                            </form>                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- !owl carousel -->
    </div>
</section>
<!-- !New Phones -->
