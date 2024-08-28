<?php
include 'header.php';
include 'navbar.php';
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
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

<section id="pagenation" class="section-p1">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="shop.php" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1 of 2</a></li>
            <li class="page-item">
                <a class="page-link" href="shop.php?" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
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

<?php include 'footer.php'; ?>
