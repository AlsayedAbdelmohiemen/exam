<?php
include "../view/header.php";
include "../view/sidebar.php";
include "../view/navbar.php";
include '../view/config.php'; 

if (isset($_POST['addCategory'])) {

  $categoryName = mysqli_real_escape_string($conn, $_POST['name']);

  $insert_query = "INSERT INTO `products` (category) VALUES ('$categoryName')";
  $insert_result = mysqli_query($conn, $insert_query);

  if ($insert_result) {
    $message = 'Category added successfully!';
  } else {
    $message = 'Failed to add category. Please try again.';
  }
}
?>

<div class="container-fluid page-body-wrapper full-page-wrapper">
  <div class="row w-100 m-0">
    <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
      <div class="card col-lg-4 mx-auto">
        <div class="card-body px-5 py-5">
          <h3 class="card-title text-left mb-3">Add Category</h3>
          <?php
          if (isset($message)) {
            echo '<div class="alert alert-info text-center">' . $message . '</div>';
          }
          ?>
          <form method="POST" action="">
            <div class="form-group">
              <label>Title</label>
              <input type="text" name="name" class="form-control p_input" required>
            </div>
            <div class="text-center">
              <button type="submit" name="addCategory" class="btn btn-primary btn-block enter-btn">Add</button>
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