<!-- Top Sale -->
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
    if(isset($_POST['top_sale_submit'])){
        $Cart->addToCart($_POST['user_id'],$_POST['item_id']);
    }
}
?>

<section id="top-sale">
    <div class="container py-5">
        <h4 class="font-rubik font-size-20">Top Sale</h4>
        <hr>
        <!-- owl carousel -->
        <div class="owl-carousel owl-theme">
            <?php foreach ($product_shuffle as $item) { ?>
                <div class="item py-2">
                    <div class="product font-rale">
                        <a href="<?php echo sprintf('%s?item_id=%s', 'product.php', $item['item_id']); ?>">
                            <img src="<?php echo isset($item['item_image']) ? $item['item_image'] : './assets/products/1.png'; ?>" alt="product1" class="img-fluid">
                        </a>
                        <div class="text-center">
                            <h6><?php echo isset($item['item_name']) ? $item['item_name'] : 'Unknown'; ?></h6>
                            <div class="rating text-warning font-size-12">
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                                <span class="far fa-star"></span>
                            </div>
                            <div class="price py-2">
                                <span>$<?php echo isset($item['item_price']) ? $item['item_price'] : '0'; ?></span>
                            </div>
<form method="post">
    <input type="hidden" name="item_id" value="<?php echo isset($item['item_id']) ? $item['item_id'] : '1'; ?>">
    <input type="hidden" name="user_id" value="<?php echo 1; ?>">
    <?php
    if(in_array($item['item_id'], $Cart->getCartId($product->getData('cart')))) {
        echo '<button type="submit"  disabled class="btn btn-success font-size-12">In The Cart</button>';

    }
    else {
       echo '<button type="submit" name="top_sale_submit" class="btn btn-warning font-size-12">Add to Cart</button>';
    }

    ?>
</form>


                       </div>
                    </div>
                </div>
            <?php } // closing foreach ?>
        </div>
        <!-- !owl carousel -->
    </div>
</section>
<!-- !Top Sale -->
