<?php include 'header.php' ?>
<?php include 'navbar.php';
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
    exit;
}

if (isset($_POST['add_to_cart'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];
    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if (mysqli_num_rows($check_cart_numbers) > 0) {
        $message[] = 'Already added to cart!';
    } else {
        mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
        $message[] = 'Product added to cart!';
    }

    header('Location: cart.php');
    exit;
}
?>


<section id="hero">
    <h4>Trade-in-offer</h4>
    <h2>Super value deals</h2>
    <h1>On all products</h1>
    <p>Save more with coupons & up to 70% off!</p>
    <button>Shop Now!</button>
</section>

<!-- End Hero -->

<!-- start Feature -->
<section id="feature" class="section-p1">
    <div class="fe-1">
        <img src="img/features/f1.png" alt="">
        <h6>Free Shipping</h6>
    </div>
    <div class="fe-1">
        <img src="img/features/f2.png" alt="">
        <h6>Online Order</h6>
    </div>
    <div class="fe-1">
        <img src="img/features/f3.png" alt="">
        <h6>Save Money</h6>
    </div>
    <div class="fe-1">
        <img src="img/features/f4.png" alt="">
        <h6>Promotions</h6>
    </div>
    <div class="fe-1">
        <img src="img/features/f5.png" alt="">
        <h6>Happy Sell</h6>
    </div>
    <div class="fe-1">
        <img src="img/features/f6.png" alt="">
        <h6>24/7 Support</h6>
    </div>
</section>
<!-- End Feature -->

<!-- Start New Arrival or productCard Features -->
<section id="product1" class="section-p1">
    <h2>Featured Products</h2>
    <p>Summer Collection New Modern Design</p>
    <div class="pro-container">
        <?php
        
        $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 4") or die('query failed');
        if (mysqli_num_rows($select_products) > 0) {
            while ($row = mysqli_fetch_assoc($select_products)) {
                $image_path = 'admin/upload/' . $row['image'];
        ?>
        <form method="post" class="pro" action="">
            <img src="<?php echo $image_path; ?>" alt="<?php echo $row['name']; ?>" />
            <div class="des">
                <h2><?php echo $row['name']; ?></h2>
                <h5><?php echo $row['description']; ?></h5>
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h4>$<?php echo $row['price']; ?></h4>
                <input type="number" name="product_quantity" min="1" value="1">
                <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $row['image']; ?>">
                <button type="submit" name="add_to_cart" class="cart"><i class="fas fa-shopping-cart"></i></button>
            </div>
        </form>
        <?php
            }
        } else {
            echo '<p>No products available at the moment!</p>';
        }
        ?>
    </div>
</section>
<!-- End New Arrival -->

<!-- Start banner -->
<section id="bannar" class="section-m1">
    <h4>Repair Service</h4>
    <h2>Up to <span>70% Off</span> - All t-Shirts & Accessories</h2>
    <button class="normal">Explore More</button>
</section>
<!-- End banner -->

<!-- Start New Arrival -->
<section id="product1" class="section-p1">
    <h2>New Arrival</h2>
    <p>Summer Collection New Modern Design</p>
    <div class="pro-container">
        <?php
        
        $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 4") or die('query failed');
        if (mysqli_num_rows($select_products) > 0) {
            while ($row = mysqli_fetch_assoc($select_products)) {
                $image_path = 'admin/upload/' . $row['image'];
        ?>
                <form method="post" class="pro" action="">
                    <img src="<?php echo $image_path; ?>" alt="<?php echo $row['name']; ?>" />
                    <div class="des">
                        <h2><?php echo $row['name']; ?></h2>
                        <h5><?php echo $row['description']; ?></h5>
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <h4>$<?php echo $row['price']; ?></h4>
                        <input type="number" name="product_quantity" min="1" value="1">
                        <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $row['image']; ?>">
                        <button type="submit" name="add_to_cart" class="cart"><i class="fas fa-shopping-cart"></i></button>
                    </div>
                </form>
        <?php
            }
        } else {
            echo '<p>No products available at the moment!</p>';
        }
        ?>
    </div>
</section>
<!-- End New Arrival -->

<section id="sm-bannar" class="section-p1">
    <div class="bannar-box">
        <h4>Crazy Deals</h4>
        <h2>Buy 1 Get 1 Free</h2>
        <span>The best classic dress is on sale from Cara</span>
        <button class="white">Learn More</button>
    </div>
    <div class="bannar-box bannar-box2">
        <h4>Spring/Summer</h4>
        <h2>Buy 1 Get 1 Free</h2>
        <span>The best classic dress is on sale from Cara</span>
        <button class="white">Learn More</button>
    </div>
</section>

<section id="bannar3" class="section-p1">
    <div class="bannar-box">
        <h2>SEASONAL SALE</h2>
        <h3>Winter Collection - 50% off</h3>
    </div>
    <div class="bannar-box bannar-box2">
        <h2>SEASONAL SALE</h2>
        <h3>Winter Collection - 50% off</h3>
    </div>
    <div class="bannar-box bannar-box3">
        <h2>SEASONAL SALE</h2>
        <h3>Winter Collection - 50% off</h3>
    </div>
</section>

<section id="newsletter" class="section-p1 section-m1">
    <div class="newstext">
        <h4>Sign Up For Newsletters</h4>
        <p>Get E-mail Updates about our latest shop and <span class="text-warning">Special Offers.</span></p>
    </div>
    <div class="form">
        <input type="text" placeholder="Enter Your E-mail...">
        <button class="normal">Sign Up</button>
    </div>
</section>

<?php include 'footer.php' ?>