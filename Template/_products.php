<!-- product -->
<?php

require_once 'C:/xampp/htdocs/tutorial/MOBILE SHOPEE/functions.php';
require_once 'C:/xampp/htdocs/tutorial/MOBILE SHOPEE/database/DBController.php';
require_once 'C:/xampp/htdocs/tutorial/MOBILE SHOPEE/database/Product.php';

use database\DBController;
use database\Product;

$db = new DBController();
$product = new Product($db);

$product_shuffle = $product->getData();

$item_id = isset($_GET['item_id']) ? $_GET['item_id'] : 1;
$local_stores = $product->getLocalStores($item_id); // <-- local store fetch

foreach($product->getData() as $item):
    if($item_id == $item['item_id']):

        // Fetch rating data safely
        $ratingData = $product->getRatings($item_id);
        ?>

        <section id="product" class="py-3">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <img src="<?php echo isset($item['item_image']) ? $item['item_image'] : './assets/products/1.png'; ?>" alt="product" class="img-fluid">
                        <form method="post" action="cart.php">
                            <input type="hidden" name="item_id" value="<?php echo $item_id; ?>">
                            <input type="hidden" name="item_name" value="<?php echo $item['item_name']; ?>">
                            <input type="hidden" name="item_price" value="<?php echo $item['item_price']; ?>">
                            <div class="form-row pt-4 font-size-16 font-baloo">
                                <div class="col">
                                    <button type="submit" name="buy_now" class="btn btn-danger form-control">Proceed to Buy</button>
                                </div>
                                <div class="col">
                                    <button type="submit" name="add_to_cart" class="btn btn-warning form-control">Add to Cart</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6 py-5">
                        <h5 class="font-baloo font-size-20"><?php echo isset($item['item_name']) ? $item['item_name'] : "Unknown"; ?></h5>
                        <small>by <?php echo isset($item['item_brand']) ? $item['item_brand'] : "Unknown"; ?></small>
                        <div class="d-flex">
                            <div class="rating text-warning font-size-12">
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="far fa-star"></i></span>
                            </div>
                            <?php if (!empty($ratingData)): ?>
                                <a href="#" class="px-2 font-rale font-size-14">
                                    <?php echo number_format($ratingData['total_ratings']); ?> ratings |
                                    <?php echo number_format($ratingData['answered_questions']); ?> answered questions
                                </a>
                            <?php endif; ?>
                        </div>
                        <hr class="m-0">

                        <!-- product price -->
                        <table class="my-3">
                            <tr class="font-rale font-size-14">
                                <td>M.R.P:</td>
                                <td><strike>$162.00</strike></td>
                            </tr>
                            <tr class="font-rale font-size-14">
                                <td>Deal Price:</td>
                                <td class="font-size-20 text-danger">$<span><?php echo $item['item_price']; ?></span><small class="text-dark font-size-12">&nbsp;&nbsp;Inclusive of all taxes</small></td>
                            </tr>
                            <tr class="font-rale font-size-14">
                                <td>You Save:</td>
                                <td><span class="font-size-16 text-danger">$152.00</span></td>
                            </tr>
                        </table>

                        <!-- policy -->
                        <div id="policy">
                            <div class="d-flex">
                                <div class="return text-center mr-5">
                                    <div class="font-size-20 my-2 color-second">
                                        <span class="fas fa-retweet border p-3 rounded-pill"></span>
                                    </div>
                                    <a href="#" class="font-rale font-size-12">10 Days <br> Replacement</a>
                                </div>
                                <div class="return text-center mr-5">
                                    <div class="font-size-20 my-2 color-second">
                                        <span class="fas fa-truck  border p-3 rounded-pill"></span>
                                    </div>
                                    <a href="#" class="font-rale font-size-12">Daily Tuition <br>Delivered</a>
                                </div>
                                <div class="return text-center mr-5">
                                    <div class="font-size-20 my-2 color-second">
                                        <span class="fas fa-check-double border p-3 rounded-pill"></span>
                                    </div>
                                    <a href="#" class="font-rale font-size-12">1 Year <br>Warranty</a>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <!-- order details -->
                        <div id="order-details" class="font-rale d-flex flex-column text-dark">
                            <small>Delivery by : Mar 29 - Apr 1</small>
                            <small>Sold by <a href="#">Daily Electronics</a> (4.5 out of 5 | 18,198 ratings)</small>
                            <small><i class="fas fa-map-marker-alt color-primary"></i>&nbsp;&nbsp;Deliver to Customer - 424201</small>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="color my-3">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="font-baloo">Color:</h6>
                                        <div class="p-2 color-yellow-bg rounded-circle"><button class="btn font-size-14"></button></div>
                                        <div class="p-2 color-primary-bg rounded-circle"><button class="btn font-size-14"></button></div>
                                        <div class="p-2 color-second-bg rounded-circle"><button class="btn font-size-14"></button></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="qty d-flex">
                                    <h6 class="font-baloo">Qty</h6>
                                    <div class="px-4 d-flex font-rale">
                                        <button class="qty-up border bg-light" data-id="pro1"><i class="fas fa-angle-up"></i></button>
                                        <input type="text" data-id="pro1" class="qty_input border px-2 w-50 bg-light" disabled value="1" placeholder="1">
                                        <button data-id="pro1" class="qty-down border bg-light"><i class="fas fa-angle-down"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- size -->
                        <div class="size my-3">
                            <h6 class="font-baloo">Size :</h6>
                            <div class="d-flex justify-content-between w-75">
                                <div class="font-rubik border p-2"><button class="btn p-0 font-size-14">4GB RAM</button></div>
                                <div class="font-rubik border p-2"><button class="btn p-0 font-size-14">6GB RAM</button></div>
                                <div class="font-rubik border p-2"><button class="btn p-0 font-size-14">8GB RAM</button></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <h6 class="font-rubik">Product Description</h6>
                        <hr>
                        <p class="font-rale font-size-14">The <strong><?php echo $item['item_name']; ?></strong> is a sleek and powerful smartphone designed for users who demand high performance and style. Featuring a stunning 6.1-inch Quad HD+ Dynamic AMOLED display, it delivers vibrant colors and crystal-clear visuals, making it perfect for streaming, gaming, and browsing. Its triple rear camera system — including wide, ultra-wide, and telephoto lenses — allows you to capture professional-quality photos and videos in any setting...</p>
                    </div>

                    <!-- Local Store Section -->
                    <div class="col-12 mt-4">
                        <h6 class="font-rubik">Available at Local Stores</h6>
                        <hr>
                        <?php if (!empty($local_stores)): ?>
                            <ul class="list-group">
                                <?php foreach ($local_stores as $store): ?>
                                    <li class="list-group-item">
                                        <strong><?php echo $store['store_name']; ?></strong><br>
                                        📍 <?php echo $store['address']; ?>, <?php echo $store['city']; ?><br>
                                        📞 <?php echo $store['phone']; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p class="text-muted">Currently not available in local stores.</p>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </section>
    <?php
    endif;
endforeach;
?>
