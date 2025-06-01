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
    if(isset($_POST['special_price_submit'])){
        $Cart->addToCart($_POST['user_id'],$_POST['item_id']);
    }
}
$in_cart= $Cart->getCartId($product->getData('cart'));
?>
<?php
$brand = array_map(function($pro) { return $pro['item_brand']; }, $product_shuffle);
$unique = array_unique($brand);
sort($unique);

?>
<section id="special-price">
    <div class="container">
        <h4 class="font-rubik font-size-20">Special Price</h4>
        <div id="filters" class="button-group text-right font-baloo font-size-16">
            <button class="btn is-checked" data-filter="*">All Brand</button>
            <?php
            array_map(function($brand) {
                printf('<button class="btn" data-filter=".%s">%s</button>', $brand, $brand);
            },$unique);
            ?>



        </div>

        <div class="grid">
            <?php
            array_map(function ($item)use($in_cart) {
                ?>
                <div class="grid-item border <?php echo isset($item['item_brand']) ? $item['item_brand'] : ''; ?>">
                    <div class="item py-2" style="width: 200px;">
                        <div class="product font-raleway">
                            <a href="product.php?item_id=<?php echo $item['item_id']; ?>">
                                <img src="<?php echo isset($item['item_image']) ? $item['item_image'] : './assets/products/1.png'; ?>" alt="product image" class="img-fluid">
                            </a>
                            <div class="text-center">
                                <h6><?php echo isset($item['item_name']) ? $item['item_name'] : 'Unknown'; ?></h6>
                                <div class="rating text-warning font-size-12">
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                </div>
                                <div class="price py-2">
                                    <span><?php echo isset($item['item_price']) ? $item['item_price'] : 0; ?></span>
                                </div>
                                <form method="post">
                                    <input type="hidden" name="item_id" value="<?php echo isset($item['item_id']) ? $item['item_id'] : '1'; ?>">
                                    <input type="hidden" name="user_id" value="<?php echo 1; ?>">
                                    <?php
                                    if(in_array($item['item_id'], $in_cart)) {
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
                </div>
                <?php
            }, $product_shuffle);
            ?>
        </div>
    </div>
</section>
