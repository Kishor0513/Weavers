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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>orders</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php @include 'header.php'; ?>

    <section class="heading">
        <h3>Your Orders</h3>
        <p> <a href="home.php">Home</a> / Order </p>
    </section>

    <section class="placed-orders">

        <h1 class="title">placed orders</h1>

        <table class="order-table">
            <?php
            $select_orders = mysqli_query($conn, "SELECT * FROM `orders` ORDER BY id DESC LIMIT 10") or die('query failed');

            if (mysqli_num_rows($select_orders) > 0) {
            ?>
                <thead>
                    <tr>
                        <th>Placed On</th>
                        <th>Name</th>
                        <th>Number</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Payment Method</th>
                        <th>Total Products</th>
                        <th>Total Price</th>
                        <th>Payment Status</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
                    ?>
                        <tr>
                            <td><?php echo $fetch_orders['placed_on']; ?></td>
                            <td><?php echo $fetch_orders['name']; ?></td>
                            <td><?php echo $fetch_orders['number']; ?></td>
                            <td><?php echo $fetch_orders['email']; ?></td>
                            <td><?php echo $fetch_orders['address']; ?></td>
                            <td><?php echo $fetch_orders['method']; ?></td>
                            <td><?php echo $fetch_orders['total_products']; ?></td>
                            <td>$<?php echo $fetch_orders['total_price']; ?>/-</td>
                            <td style="color:<?php echo ($fetch_orders['payment_status'] == 'pending') ? 'tomato' : 'green'; ?>">
                                <?php echo $fetch_orders['payment_status']; ?>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo '<tr><td colspan="9" class="empty">No orders placed yet!</td></tr>';
                }
                ?>
                </tbody>
        </table>

    </section>

    <?php @include 'footer.php'; ?>

    <script src="js/script.js"></script>

</body>

</html>