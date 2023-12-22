<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You </title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php @include 'header.php'; ?>
    <div class="confirmation">
        <div class="fields">

            <h1>Thank You!</h1>
            <p>Payment Done Sucessfully</p>
            <span>Thank you for shopping with us. Your goods will be devlived on your footstep.</span>
            <a href="home.php">
                <button>Take Me to Home</button>
            </a>
        </div>
    </div>

    <?php @include 'footer.php'; ?>

    <script src="js/script.js"></script>
</body>

</html>