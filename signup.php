<?php
include "header.php";
include "navbar.php";
include 'config.php';

if (isset($_POST['submit'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $user_type = $_POST['user_type'];

  $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

  if (mysqli_num_rows($select_users) > 0) {
    $message[] = 'User already exists!';
  } else {
    mysqli_query($conn, "INSERT INTO `users`(name,email, password, phone, address, user_type) VALUES('$username', '$email', '$pass', '$phone', '$address', '$user_type')") or die('query failed');
    $message[] = 'Registered successfully!';
    header('location:login.php');
  }
}
?>

<body>
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
</body>

<div class="card-body px-5 py-5" style="background-color:darkgray;">
  <h3 class="card-title text-left mb-3">Register</h3>
  <form action="" method="post">
    <div class="form-group">
      <label>Username</label>
      <input type="text" name="username" class="form-control p_input" required>
    </div>
    <div class="form-group">
      <label>Email</label>
      <input type="email" name="email" class="form-control p_input" required>
    </div>
    <div class="form-group">
      <label>Password</label>
      <input type="password" name="password" class="form-control p_input" required>
    </div>
    <div class="form-group">
      <label>Phone</label>
      <input type="text" name="phone" class="form-control p_input" required>
    </div>
    <div class="form-group">
      <label>Address</label>
      <input type="text" name="address" class="form-control p_input" required>
    </div>
    <br>
    <div class="form-group">
      <label>User Type</label>
      <select name="user_type" class="box" required>
        <option value="user">user</option>
        <option value="admin">admin</option>
      </select>
    </div>
    <div class="form-group d-flex align-items-center justify-content-between">
      <div class="form-check"></div>
    </div>
    <div class="text-center">
      <button type="submit" name="submit" class="btn btn-primary btn-block enter-btn">Signup</button>
    </div>
    <div class="d-flex">
      <button class="btn btn-facebook col me-2">
        <i class="mdi mdi-facebook"></i> Facebook 
      </button>
      <button class="btn btn-google col">
        <i class="mdi mdi-google-plus"></i> Google plus 
      </button>
    </div>
    <p class="sign-up text-center">Already have an Account?<a href="login.php"> Login</a></p>
    <p class="terms">By creating an account you are accepting our<a href="#"> Terms & Conditions</a></p>
  </form>
</div>
