<?php

@include 'config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $name = mysqli_real_escape_string($conn, $name);
    $email = $_POST['email'];
    $email = mysqli_real_escape_string($conn, $email);
    $pass = $_POST['pass'];
    $pass = mysqli_real_escape_string($conn, md5($pass));
    $cpass = $_POST['cpass'];
    $cpass = mysqli_real_escape_string($conn, md5($cpass));


    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

    if (mysqli_num_rows($select_users) > 0) {

        if ($pass != $cpass) {
            $message[] = 'Confirm password not matched!';
        } else {
            $user = mysqli_fetch_assoc($select_users);
            $user_id = $user['id'];

            mysqli_query($conn, "UPDATE `users` SET name='$name', email='$email', password='$pass' WHERE id='$user_id' ") or die('query failed');
            $message[] = 'Updated successfully!';
            // header('location:login.php');
        }
    }
}
?>


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update admin</title>

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

        <form action="" method="post" novalidate onclick="return validateForm();">
            <h3>Update user</h3>
            <input type="text" name="name" class="box" placeholder="enter your new username" required>
            <input type="email" name="email" class="box" placeholder="enter new your email" required>
            <input type="password" name="pass" class="box" placeholder="enter new your password" required>
            <input type="password" name="cpass" class="box" placeholder="confirm your new password" required>
            <input type="submit" class="btn" name="submit" value="update now">
            <!-- <a href="login.php">login now</a></p> -->
        </form>

    </section>

</body>

</html>