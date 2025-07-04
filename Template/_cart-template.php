<?php

require_once 'C:/xampp/htdocs/tutorial/MOBILE SHOPEE/functions.php';
require_once 'C:/xampp/htdocs/tutorial/MOBILE SHOPEE/database/DBController.php';
require_once 'C:/xampp/htdocs/tutorial/MOBILE SHOPEE/database/Product.php';
require_once __DIR__ . '/../database/Cart.php';

use database\Cart;
use database\DBController;
use database\Product;

$db = new DBController();
$product = new Product($db);
$Cart = new Cart($db);

// ✅ Dummy user_id (replace with session later)
$user_id = 1;

$product_shuffle = $product->getData();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete-cart-submit'])) {
        $deletedrecord = $Cart->deleteCart($_POST['item_id'], $_POST['user_id']);
    }

    if (isset($_POST['wishlist-submit'])) {
        $Cart->saveForLater($_POST['item_id']);
    }
}
?>

<section id="cart" class="py-3 mb-5">
    <div class="container-fluid w-75">
        <h5 class="font-baloo font-size-20">Shopping Cart</h5>

        <div class="row">
            <div class="col-sm-9">
                <?php
                foreach ($product->getData('cart') as $item) :
                    $cart = $product->getProduct($item['item_id']);
                    $subTotal[] = array_map(function ($item) use ($user_id, $product) {
                        ?>
                        <div class="row border-top py-3 mt-3">
                            <div class="col-sm-2">
                                <img src="<?php echo isset($item['item_image']) ? $item['item_image'] : "./assets/products/1.png"; ?>" style="height: 120px;" alt="cart1" class="img-fluid">
                            </div>
                            <div class="col-sm-8">
                                <h5 class="font-baloo font-size-20"><?php echo isset($item['item_name']) ? $item['item_name'] : "Unknown"; ?></h5>
                                <small>by <?php echo isset($item['item_brand']) ? $item['item_brand'] : "Brand"; ?></small>

                                <!-- ✅ Dynamic ratings -->
                                <div class="d-flex">
                                    <?php
                                    $ratingData = $product->getRatings($item['item_id']);
                                    $stars = isset($ratingData['stars']) ? (int)$ratingData['stars'] : 0;
                                    $totalRatings = isset($ratingData['total_ratings']) ? (int)$ratingData['total_ratings'] : 0;
                                    ?>
                                    <div class="rating text-warning font-size-12">
                                        <?php for ($i = 0; $i < 5; $i++): ?>
                                            <?php if ($i < $stars): ?>
                                                <span><i class="fas fa-star"></i></span>
                                            <?php else: ?>
                                                <span><i class="far fa-star"></i></span>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </div>
                                    <a href="#" class="px-2 font-rale font-size-14"><?php echo number_format($totalRatings); ?> ratings</a>
                                </div>

                                <div class="qty d-flex pt-2">
                                    <div class="d-flex font-rale w-25">
                                        <button class="qty-up border bg-light" data-id="<?php echo isset($item['item_id']) ? $item['item_id'] : '0'; ?>"><i class="fas fa-angle-up"></i></button>
                                        <input type="text" data-id="<?php echo isset($item['item_id']) ? $item['item_id'] : '0'; ?>" class="qty_input border px-2 w-100 bg-light" disabled value="1" placeholder="1">
                                        <button data-id="<?php echo isset($item['item_id']) ? $item['item_id'] : '0'; ?>" class="qty-down border bg-light"><i class="fas fa-angle-down"></i></button>
                                    </div>

                                    <!-- Delete form -->
                                    <form method="post">
                                        <input type="hidden" name="item_id" value="<?php echo isset($item['item_id']) ? $item['item_id'] : 0; ?>">
                                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                        <button type="submit" name="delete-cart-submit" class="btn font-baloo text-danger px-3 border-right">Delete</button>
                                    </form>

                                    <!-- Save for later -->
                                    <form method="post">
                                        <input type="hidden" name="item_id" value="<?php echo isset($item['item_id']) ? $item['item_id'] : 0; ?>">
                                        <button type="submit" name="wishlist-submit" class="btn font-baloo text-danger">Save for Later</button>
                                    </form>
                                </div>
                            </div>

                            <div class="col-sm-2 text-right">
                                <div class="font-size-20 text-danger font-baloo">
                                    $<span class="product_price" data-id="<?php echo isset($item['item_id']) ? $item['item_id'] : '0'; ?>"><?php echo isset($item['item_price']) ? $item['item_price'] : 0; ?></span>
                                </div>
                            </div>
                        </div>
                        <?php
                        return isset($item['item_price']) ? $item['item_price'] : 0;
                    }, $cart);
                endforeach;
                ?>
            </div>

            <!-- Subtotal Section -->
            <div class="col-sm-3">
                <div class="sub-total border text-center mt-2">
                    <h6 class="font-size-12 font-rale text-success py-3">
                        <i class="fas fa-check"></i> Your order is eligible for FREE Delivery.
                    </h6>
                    <div class="border-top py-4">
                        <h5 class="font-baloo font-size-20">Subtotal (<?php echo count(isset($subTotal) ? $subTotal : array()); ?> item):
                            <span class="text-danger">$<span id="deal-price"><?php echo $Cart->getSum(isset($subTotal) ? $subTotal : array()); ?></span></span>
                        </h5>
                        <button type="submit" class="btn btn-warning mt-3">Proceed to Buy</button>
                    </div>
                </div>
            </div>
            <!-- !Subtotal Section -->
        </div>
    </div>
</section>
