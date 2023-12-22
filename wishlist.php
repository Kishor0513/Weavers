<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

if (isset($_POST['add_to_cart'])) {

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if (mysqli_num_rows($check_cart_numbers) > 0) {
        $message[] = 'already added to cart';
    } else {

        $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

        if (mysqli_num_rows($check_wishlist_numbers) > 0) {
            mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
        }

        mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
        $message[] = 'product added to cart';
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `wishlist` WHERE id = '$delete_id'") or die('query failed');
    header('location:wishlist.php');
}

if (isset($_GET['delete_all'])) {
    mysqli_query($conn, "DELETE FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
    header('location:wishlist.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>wishlist</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php @include 'header.php'; ?>

    <section class="heading">
        <h3>your wishlist</h3>
        <p> <a href="home.php">home</a> / wishlist </p>
    </section>




    <section class="wishlist">

        <h1 class="title">Wishlist</h1>

        <?php
        $grand_total = 0;
        $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
        if (mysqli_num_rows($select_wishlist) > 0) {
        ?>
            <table class="wishlist-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th colspan="3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($fetch_wishlist = mysqli_fetch_assoc($select_wishlist)) {
                        $grand_total += $fetch_wishlist['price'];
                    ?>
                        <tr>
                            <td>
                                <img src="uploaded_img/<?php echo $fetch_wishlist['image']; ?>" alt="" class="image">
                            </td>
                            <td><?php echo $fetch_wishlist['name']; ?></td>
                            <td>$<?php echo $fetch_wishlist['price']; ?>/-</td>
                            <td>
                                <form action="" method="POST">
                                    <input type="hidden" name="product_id" value="<?php echo $fetch_wishlist['pid']; ?>">
                                    <input type="hidden" name="product_name" value="<?php echo $fetch_wishlist['name']; ?>">
                                    <input type="hidden" name="product_price" value="<?php echo $fetch_wishlist['price']; ?>">
                                    <input type="hidden" name="product_image" value="<?php echo $fetch_wishlist['image']; ?>">
                                    <input type="submit" value="Add to Cart" name="add_to_cart" class="option-btn">
                                </form>
                            </td>
                            <td>
                                <a href="view_page.php?pid=<?php echo $fetch_wishlist['pid']; ?>" class="fas fa-eye"></a>
                            </td>
                            <td>
                                <a href="wishlist.php?delete=<?php echo $fetch_wishlist['id']; ?>" class="fas fa-times" onclick="return confirm('Delete this from wishlist?');"></a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

            <div class="wishlist-total">
                <p>Grand total: <span>$<?php echo $grand_total; ?>/-</span></p>
                <a href="product.php" class="option-btn">Continue Shopping</a>
                <a href="wishlist.php?delete_all" class="delete-btn <?php echo ($grand_total > 0) ? '' : 'disabled' ?>" onclick="return confirm('Delete all from wishlist?');">Delete all</a>
            </div>
        <?php
        } else {
            echo '<p class="empty">Your wishlist is empty</p>';
        }
        ?>
    </section>




    <?php @include 'footer.php'; ?>

    <script src="js/script.js"></script>

</body>

</html>