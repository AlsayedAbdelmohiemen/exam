<?php
include "../view/header.php";
include "../view/sidebar.php";
include "../view/navbar.php";
include "../view/config.php";

if (isset($_POST['addProduct'])) {
  $category = mysqli_real_escape_string($conn, $_POST['cat']);
  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $description = mysqli_real_escape_string($conn, $_POST['desc']);
  $price = mysqli_real_escape_string($conn, $_POST['price']);
  $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);

  $image_name = $_FILES['img']['name'];
  $image_tmp_name = $_FILES['img']['tmp_name'];
  $image_folder = 'upload' . $image_name;

  if (move_uploaded_file($image_tmp_name, $image_folder)) {

    $insert_query = "INSERT INTO `products` (category, name, description, price, quantity, image) 
                        VALUES ('$category', '$title', '$description', '$price', '$quantity', '$image_name')";
    $insert_result = mysqli_query($conn, $insert_query);

    if ($insert_result) {
      $message = 'Product added successfully!';
    } else {
      $message = 'Failed to add product. Please try again.';
    }
  } else {
    $message = 'Failed to upload image. Please try again.';
  }
}

?>

<div class="container-fluid page-body-wrapper full-page-wrapper">
  <div class="row w-100 m-0">
    <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
      <div class="card col-lg-4 mx-auto">

        <div class="card-body px-5 py-5">
          <h3 class="card-title text-left mb-3">Add Product</h3>
          <form method="POST" action="addProduct.php" enctype="multipart/form-data">
            <div class="form-group">
              <label>Category</label>
              <input type="text" name="cat" class="form-control p_input">
            </div>
            <div class="form-group">
              <label>Title</label>
              <input type="text" name="title" class="form-control p_input">
            </div>
            <div class="form-group">
              <label>Description</label>
              <input type="text" name="desc" class="form-control p_input">
            </div>
            <div class="form-group">
              <label>Price</label>
              <input type="number" name="price" class="form-control p_input">
            </div>
            <div class="form-group">
              <label>Quantity</label>
              <input type="number" name="quantity" class="form-control p_input">
            </div>
            <div class="form-group">
              <label>Image</label>
              <input type="file" name="img" class="form-control p_input">
            </div>
            <div class="text-center">
              <button type="submit" name="addProduct" class="btn btn-primary btn-block enter-btn">Add</button>
            </div>

          </form>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
  </div>
  <!-- row ends -->
</div>
<!-- page-body-wrapper ends -->
</div>

<?php
include "../view/footer.php";
?>