<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!-- Blogs -->
<section id="blogs">
    <div class="container py-4">
        <h4 class="font-rubik font-size-20">Latest Blogs</h4>
        <hr>

        <div class="owl-carousel owl-theme">
            <div class="item">
                <div class="card border-0 font-rale mr-5" style="width: 18rem;">
                    <h5 class="card-title font-size-16">Upcoming Mobiles</h5>
                    <img src="./assets/blog/blog1.jpg" alt="cart image" class="card-img-top">
                    <p class="card-text font-size-14 text-black-50 py-1"> New phones now offer smoother screens with better colors, making videos and games look amazing.</p>
                    <a href="#" class="color-second text-left">Go to blog</a>
                </div>
            </div>
            <div class="item">
                <div class="card border-0 font-rale mr-5" style="width: 18rem;">
                    <h5 class="card-title font-size-16">Upcoming Mobiles</h5>
                    <img src="./assets/blog/blog2.jpg" alt="cart image" class="card-img-top">
                    <p class="card-text font-size-14 text-black-50 py-1"> Phone cameras are sharper than ever, letting you take great photos even in low light.</p>
                    <a href="#" class="color-second text-left">Go to blog</a>
                </div>
            </div>
            <div class="item">
                <div class="card border-0 font-rale mr-5" style="width: 18rem;">
                    <h5 class="card-title font-size-16">Upcoming Mobiles</h5>
                    <img src="./assets/blog/blog3.jpg" alt="cart image" class="card-img-top">
                    <p class="card-text font-size-14 text-black-50 py-1">Battery life has improved too, and most phones now charge much faster than before.</p>
                    <a href="#" class="color-second text-left">Go to blog</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- !Blogs -->
