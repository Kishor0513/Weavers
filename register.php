<?php

@include 'config.php';


if (isset($_POST['submit'])) {
   $name = $_POST['name'];
   $name = mysqli_real_escape_string($conn, $name);
   $email = $_POST['email'];
   $email = mysqli_real_escape_string($conn, $email);
   $pass = $_POST['pass'];
   $pass = mysqli_real_escape_string($conn, md5($pass));
   $cpass = $_POST['cpass'];
   $cpass = mysqli_real_escape_string($conn, md5($cpass));
   $currentDateTime = date('Y-m-d H:i:s');

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

   if (mysqli_num_rows($select_users) > 0) {
      $message[] = 'User already exists!';
   } else {
      if ($password != $confirmPassword) {
         $message[] = 'Confirm password not matched!';
      } else {
         mysqli_query($conn, "INSERT INTO `users`(name, email, password,created_at) VALUES('$name', '$email', '$pass', '$currentDateTime')") or die('query failed');
         $message[] = 'Registered successfully!';
         header('location:login.php');
         exit(); 
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

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

      <form action="" method="post" onsubmit="return  validateForm();" novalidate>
         <h3>register user</h3>
         <input type="text" name="name" class="box" placeholder="enter your username" required>
         <input type="email" name="email" class="box" placeholder="enter your email" required>
         <input type="password" name="pass" class="box" placeholder="enter your password" required>
         <input type="password" name="cpass" class="box" placeholder="confirm your password" required>
         <input type="submit" class="btn" name="submit" value="register now">
         <p>already have an account? <a href="login.php">login now</a></p>
      </form>

   </section>
   <script src="js/script.js"></script>
</body>

</html>