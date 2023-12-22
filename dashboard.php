<?php
@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php @include 'header.php' ?>

    <section class="dashboard">

        <h1 class="title">dashboard</h1>

        <div class="box-container">
            <div class="image">
                <img src="images/user.png" alt="">
                <p>Username : <span><?php echo $_SESSION['user_name']; ?></span></p>
                <p>Email : <span><?php echo $_SESSION['user_email']; ?></span></p>
                <a href="update.php" class="update-btn">Update</a>
                <a href="logout.php" class="logout-btn">logout</a>
            </div>
            <div class="content">
                <div class="box">
                    <?php
                    $select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                    $cart = mysqli_num_rows($select_cart_count);
                    ?>
                    <h3><?php echo $cart; ?></h3>
                    <a href="cart.php">
                        <p>my cart</p>
                    </a>
                </div>
                <div class="box">
                    <?php
                    $select_wishlist_count = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
                    $wishlist = mysqli_num_rows($select_wishlist_count);
                    ?>
                    <h3><?php echo $wishlist; ?></h3>
                    <a href="wishlist.php">
                        <p>my wishlist</p>
                    </a>
                </div>
                <div class="box">
                    <?php
                    $select_order_count = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
                    $order = mysqli_num_rows($select_order_count);
                    ?>
                    <h3><?php echo $order; ?></h3>
                    <a href="orders.php">
                        <p>my orders</p>
                    </a>
                </div>
                <div class="box">
                    <?php
                    $total_pendings = 0;
                    $select_pendings = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id='$user_id' AND payment_status = 'pending'") or die('query failed');
                    while ($fetch_pendings = mysqli_fetch_assoc($select_pendings)) {
                        $total_pendings += $fetch_pendings['total_price'];
                    };
                    ?>
                    <h3>$<?php echo $total_pendings; ?>/-</h3>
                    <a href="#">
                        <p>pending orders</p>
                    </a>
                </div>
                <div class="box">
                    <?php
                    $total_completes = 0;
                    $select_completes = mysqli_query($conn, "SELECT * FROM `orders` WHERE  user_id='$user_id' AND payment_status = 'completed'") or die('query failed');
                    while ($fetch_completes = mysqli_fetch_assoc($select_completes)) {
                        $total_completes += $fetch_completes['total_price'];
                    };
                    ?>
                    <h3>$<?php echo $total_completes; ?>/-</h3>
                    <a href="#">
                        <p>competed orders</p>
                    </a>
                </div>
            </div>
        </div>


    </section>


    <?php @include 'footer.php' ?>

</body>

</html>