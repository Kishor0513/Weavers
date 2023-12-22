<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
};

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
    header('location:cart.php');
}

if (isset($_GET['delete_all'])) {
    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    header('location:cart.php');
};

if (isset($_POST['update_quantity'])) {
    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];
    mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
    $message[] = 'cart quantity updated!';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shopping cart</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php @include 'header.php'; ?>

    <section class="heading">
        <h3>shopping cart</h3>
        <p> <a href="home.php">home</a> / cart </p>
    </section>


    <section class="shopping-cart">

        <h1 class="title">Products Added</h1>

        <section class="shopping-cart">

            <h1 class="title">Products Added</h1>

            <?php
            $grand_total = 0;
            $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
            if (mysqli_num_rows($select_cart) > 0) {
            ?>
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Sub-total</th>
                            <th colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                            $sub_total = $fetch_cart['price'] * $fetch_cart['quantity'];
                        ?>
                            <tr>
                                <td>
                                    <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="" class="image">
                                </td>
                                <td><?php echo $fetch_cart['name']; ?></td>
                                <td>$<?php echo $fetch_cart['price']; ?>/-</td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" value="<?php echo $fetch_cart['id']; ?>" name="cart_id">
                                        <input type="number" min="1" value="<?php echo $fetch_cart['quantity']; ?>" name="cart_quantity" class="qty">
                                        <input type="submit" value="Update" class="option-btn" name="update_quantity">
                                    </form>
                                </td>
                                <td>$<?php echo $sub_total; ?>/-</td>
                                <td>
                                    <a href="view_page.php?pid=<?php echo $fetch_cart['pid']; ?>" class="fas fa-eye"></a>
                                </td>
                                <td>
                                    <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('Delete this from cart?');">
                                    </a>
                                </td>
                            </tr>
                        <?php
                            $grand_total += $sub_total;
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            } else {
                echo '<p class="empty">Your cart is empty</p>';
            }
            ?>

            <div class="more-btn">
                <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 0) ? '' : 'disabled' ?>" onclick="return confirm('Delete all from cart?');">Delete all</a>
            </div>

            <div class="cart-total">
                <p>Grand total: <span>$<?php echo $grand_total; ?>/-</span></p>
                <a href="product.php" class="option-btn">Continue Shopping</a>
                <a href="checkout.php" class="btn <?php echo ($grand_total > 0) ? '' : 'disabled' ?>">Proceed to Checkout</a>
            </div>
        </section>




        <?php @include 'footer.php'; ?>

        <script src="js/script.js"></script>

</body>

</html>