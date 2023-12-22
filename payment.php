<?php
@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
    exit();
}

if (isset($_POST['make_payment'])) {
   
    $temp_order_query = mysqli_query($conn, "SELECT * FROM `temp_orders` WHERE user_id = '$user_id'") or die('query failed');
    $temp_order = mysqli_fetch_assoc($temp_order_query);

    mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '{$temp_order['name']}', '{$temp_order['number']}', '{$temp_order['email']}', '{$_POST['method']}', '{$temp_order['address']}', '{$temp_order['total_products']}', '{$temp_order['total_price']}', '{$temp_order['placed_on']}')") or die('query failed');
    

    mysqli_query($conn, "DELETE FROM `temp_orders` WHERE user_id = '$user_id'") or die('query failed');
    $message[] = 'Order placed Successfully!';

    header('location: order_confirmation.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Option</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php @include 'header.php'; ?>

    <section class="heading">
        <h3>Payment Options</h3>
    </section>

    <section class="payment-options">
    
        <form action="" method="POST">
            <div class="inputBox">
                <span>payment method :</span>
                <select name="method">
                    <option value="cash on delivery">cash on delivery</option>
                    <option value="credit card">credit card</option>
                    <option value="khalti">khalti</option>
                    <option value="esewa">esewa</option>
                    <option value="imepay">imepay</option>
                </select>
            </div>

            <input type="submit" name="make_payment" value="Make Payment" class="btn">
        </form>
    </section>

    <?php @include 'footer.php'; ?>

    <script src="js/script.js"></script>
</body>

</html>