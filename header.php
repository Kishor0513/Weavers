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

<header class="header">

    <div class="flex">

        <a href="home.php" class="logo">Weavers</a>

        <nav class="navbar">
            <ul>
                <li><a href="home.php">home</a></li>
                <li><a href="product.php">Product</a></li>

                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li>
                    <a href="#">Account</a>
                    <ul>
                        <?php
                        if (isset($_SESSION['user_id'])) {
                            echo '<li><a href="logout.php">Logout</a></li>';
                        } else {
                            echo '<li><a href="login.php">Login</a></li>';
                            echo '<li><a href="register.php">Register</a></li>';
                        }
                        ?>
                    </ul>
                </li>

            </ul>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>
            <div id="user-btn" class="fas fa-user"></div>
            <?php
            $select_wishlist_count = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
            $wishlist_num_rows = mysqli_num_rows($select_wishlist_count);
            ?>
            <a href="wishlist.php"><i class="fas fa-heart"></i><span>(<?php echo $wishlist_num_rows; ?>)</span></a>
            <?php
            $select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
            $cart_num_rows = mysqli_num_rows($select_cart_count);
            ?>
            <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?php echo $cart_num_rows; ?>)</span></a>
        </div>

        
        <?php if (isset($_SESSION['user_id'])) : ?>
            <div class="account-box">
                <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
                <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
                <a href="dashboard.php" class="btn">Dashboard</a>
                <a href="logout.php" class="delete-btn">logout</a>
            </div>
        <?php else : ?>
            
            <div class="account-box">
                <button onclick="showAlert()" class="btn">Dashboard</button>
            </div>
        <?php endif; ?>



    </div>
    <script src="js/script.js"></script>

</header>