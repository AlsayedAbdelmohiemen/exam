<?php
include "header.php";
include "navbar.php";
include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){

      $row = mysqli_fetch_assoc($select_users);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin\view\addProduct.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('location:shop.php');

      }

   }else{
      $message[] = 'incorrect email or password!';
   }
}
?>

<div class="card-body px-5 py-5" style="background-color:darkgray;">
  <h3 class="card-title text-left mb-3">Login</h3>
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
      <label>Password *</label>
      <input type="password" name="password" class="form-control p_input" required>
    </div>
    <div class="form-group d-flex align-items-center justify-content-between">
      <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input"> Remember me 
        </label>
      </div>
      <a href="forgetPassword.php" class="forgot-pass">Forgot password</a>
    </div>
    <div class="text-center">
      <button type="submit" name="submit" class="btn btn-primary btn-block enter-btn">Login</button>
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

<?php include "footer.php" ?>


    //table user, product, cart ,, review comment , rating  = session