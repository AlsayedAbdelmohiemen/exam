<?php
include "header.php";
include "navbar.php";
include 'config.php';

if (isset($_POST['submit'])) {
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_password']));
  $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['confirm_password']));


  $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

  if (mysqli_num_rows($select_user) > 0) {
    if ($new_pass == $confirm_pass) {

      mysqli_query($conn, "UPDATE `users` SET password = '$new_pass' WHERE email = '$email'") or die('query failed');
      $message[] = 'Password updated successfully!';
    } else {
      $message[] = 'Passwords do not match!';
    }
  } else {
    $message[] = 'Email does not exist!';
  }
}
?>

<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="row w-100 m-0">
      <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
        <div class="card col-lg-4 mx-auto">
          <div class="card-body px-5 py-5" style="background-color:darkgray;">
            <h3 class="card-title text-left mb-3">Reset Password</h3>
            <?php
            if (isset($message)) {
              foreach ($message as $message) {
                echo '
                                <div class="message">
                                    <span>' . $message . '</span>
                                    <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                                </div>
                                ';
              }
            }
            ?>
            <form action="" method="post">
              <div class="form-group">
                <label>Email *</label>
                <input type="email" name="email" class="form-control p_input" required>
              </div>
              <div class="form-group">
                <label>New Password *</label>
                <input type="password" name="new_password" class="form-control p_input" required>
              </div>
              <div class="form-group">
                <label>Confirm Password *</label>
                <input type="password" name="confirm_password" class="form-control p_input" required>
              </div>
              <div class="form-group d-flex align-items-center justify-content-between">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input"> Remember me
                  </label>
                </div>
                <!-- <a href="forgetPassword.php" class="forgot-pass">Forgot password</a> -->
              </div>
              <div class="text-center">
                <button type="submit" name="submit" class="btn btn-primary btn-block enter-btn">Confirm</button>
              </div>
              <div class="d-flex">
                <button class="btn btn-facebook me-2 col">
                  <i class="mdi mdi-facebook"></i> Facebook
                </button>
                <button class="btn btn-google col">
                  <i class="mdi mdi-google-plus"></i> Google plus
                </button>
              </div>
              <p class="sign-up">Don't have an Account?<a href="signup.php"> Sign Up</a></p>
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

<?php include "footer.php" ?>