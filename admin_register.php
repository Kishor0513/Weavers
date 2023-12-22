<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

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

    $select_users = mysqli_query($conn, "SELECT * FROM `admins` WHERE email = '$email'") or die('query failed');

    if (mysqli_num_rows($select_users) > 0) {
        $message[] = 'admin already exist!';
    } else {
        if ($pass != $cpass) {
            $message[] = 'confirm password not matched!';
        } else {
            mysqli_query($conn, "INSERT INTO `admins`(name, email, password,created_at) VALUES('$name', '$email', '$pass', '$currentDateTime')") or die('query failed');
            $message[] = 'registered successfully!';
            header('location:admin_login.php');
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

        <form action="" method="post" onsubmit="return validateForm();" novalidate>
            <h3>register admin</h3>
            <input type="text" name="name" class="box" placeholder="enter your username" required>
            <input type="email" name="email" class="box" placeholder="enter your email" required>
            <input type="password" name="pass" class="box" placeholder="enter your password" required>
            <input type="password" name="cpass" class="box" placeholder="confirm your password" required>
            <input type="submit" class="btn" name="submit" value="register now">
            
        </form>

    </section>

</body>

</html>