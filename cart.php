<?php
include 'config.php';
include 'header.php';
include 'navbar.php';
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

if (isset($_POST['update_cart'])) {
    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];
    mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
    header('location:cart.php');
}
?>

<section id="page-header" class="about-header">
    <h2>#Cart</h2>
    <p>Let's see what you have.</p>
</section>

<section id="cart" class="section-p1">
    <form action="" method="post">
        <table width="100%">
            <thead>
                <tr>
                    <td>Image</td>
                    <td>Name</td>
                    <td>Desc</td>
                    <td>Quantity</td>
                    <td>Price</td>
                    <td>Subtotal</td>
                    <td>Remove</td>
                    <td>Confirm</td>
                </tr>
            </thead>

            <tbody>
                <?php
                $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                $grand_total = 0;
                if (mysqli_num_rows($cart_query) > 0) {
                    while ($fetch_cart = mysqli_fetch_assoc($cart_query)) {
                        $subtotal = $fetch_cart['price'] * $fetch_cart['quantity'];
                        $grand_total += $subtotal;
                ?>
                        <tr>
                            <td><img src="admin/upload/<?php echo $fetch_cart['image']; ?>" alt="product1"></td>
                            <td><?php echo $fetch_cart['name']; ?></td>
                            <td><?php echo $fetch_cart['description']; ?></td>
                            <td>
                                <input type="hidden" name="cart_id[]" value="<?php echo $fetch_cart['id']; ?>">
                                <input type="number" min="1" name="cart_quantity[]" value="<?php echo $fetch_cart['quantity']; ?>">
                            </td>
                            <td>$<?php echo $fetch_cart['price']; ?></td>
                            <td>$<?php echo $subtotal; ?></td>
                            <td><a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="btn btn-danger" onclick="return confirm('Remove item from cart?');">Remove</a></td>
                            <td><a href="confirmOrder.php" class="btn btn-success">Confirm</a></td>
                        </tr>
                <?php
                    }
                } else {
                    echo '<tr><td colspan="8" class="text-center">No items in your cart</td></tr>';
                }
                ?>
            </tbody>
        </table>

    </form>

</section>

<?php include "footer.php"; ?>