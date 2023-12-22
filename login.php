<?php

@include 'config.php';

session_start();


if (isset($_POST['submit'])) {

   $email = $_POST['email'];
   $email = mysqli_real_escape_string($conn, $email);
   $pass = $_POST['pass'];
   $pass = mysqli_real_escape_string($conn, md5($pass));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if (mysqli_num_rows($select_users) > 0) {

      $row = mysqli_fetch_assoc($select_users);

      $_SESSION['user_name'] = $row['name'];
      $_SESSION['user_email'] = $row['email'];
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['user_created_at'] = $row['created_at'];
      header('location: home.php');
   } else {
      $message[] = 'Incorrect email or password!';
   }
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

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



   <section class="form-container">
      <div class="login-logo">
         <img src="./images/logo1.png" alt="">
      </div>
      <form action="" method="post" onsubmit="return validate();" novalidate>
         <h3>login user</h3>
         <input type="email" name="email" class="box" placeholder="enter your email" required>
         <input type="password" name="pass" class="box" placeholder="enter your password" required>
         <input type="submit" class="btn" name="submit" value="login now">
         <p>Don't have an account? <a href="register.php">Register now</a></p>
         <p>Admin? <a href="admin_login.php">Login here</a></p>
      </form>

   </section>
<script src="js/script.js"></script>
</body>

</html>