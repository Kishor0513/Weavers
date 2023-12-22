<?php

@include 'config.php';

session_start();

// $user_id = $_SESSION['user_id'];

// if (!isset($user_id)) {
//     header('location:login.php');
// };
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>about</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php @include 'header.php'; ?>

    <section class="heading">
        <h3>about us</h3>
        <p> <a href="home.php">Home</a> / About </p>
    </section>

    <section class="about">

        <div class="flex">

            <div class="image">
                <img src="images/about1.jpg" alt="">
            </div>

            <div class="content">
                <h3>why choose us?</h3>
                <p>We source only the finest Pashmina wool to create our clothing, ensuring that every piece reflects the exceptional craftsmanship and attention to detail that defines our brand. Our commitment to quality is unwavering, providing you with garments that stand the test of time.</p>
                <a href="product.php" class="btn">shop now</a>
            </div>

        </div>

        <div class="flex">

            <div class="content">
                <h3>what we provide?</h3>
                <p>
                    At Weavers, we take pride in providing a curated selection of premium Pashmina clothing and accessories that embody luxury, craftsmanship, and timeless style</p>
                <a href="contact.php" class="btn">contact us</a>
            </div>

            <div class="image">
                <img src="images/about2.jpg" alt="">
            </div>

        </div>

        <div class="flex">

            <div class="image">
                <img src="images/about3.jpg" alt="">
            </div>

            <div class="content">
                <h3>who we are?</h3>
                <p>We are Weavers, a distinguished and reputable brand specializing in the finest Pashmina clothing and accessories. Our identity is rooted in a commitment to delivering unparalleled quality, timeless elegance, and a seamless shopping experience to our valued customers.</p>
                <a href="#reviews" class="btn">clients reviews</a>
            </div>

        </div>

    </section>

    <section class="reviews" id="reviews">

        <h1 class="title">client's reviews</h1>

        <div class="box-container">

            <div class="box">
                <img src="images/srk.png" alt="">
                <p>My recent acquisition of the Pashmina shawl by Shah Rukh Khan has been a truly regal experience,
                    encapsulating the
                    essence of luxury and refinement. This collaboration with the iconic Bollywood figure has elevated
                    the Pashmina shawl
                    into a statement piece that transcends fashion, offering a glimpse into the world of timeless
                    elegance.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>Shah Rukh Khan</h3>
            </div>

            <div class="box">
                <img src="images/alexa.jpg" alt="">
                <p>I recently had the pleasure of exploring the world of Pashmina clothing, and the experience left an
                    indelible mark on my
                    fashion sensibilities. Pashmina, known for its unparalleled softness and exquisite craftsmanship,
                    proved to be more than
                    just a fabric; it's a luxurious lifestyle.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>Alexa Bliss</h3>
            </div>

            <div class="box">
                <img src="images/rajeshdai.png" alt="">
                <p>Embarking on a journey into the realm of Pashmina clothing has been a revelation in the pursuit of
                    unparalleled luxury.
                    Each piece in this collection is a testament to the opulence and grace that define Pashmina, leaving
                    an indelible mark
                    on my perception of high-quality fashion.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>Rajesh Dai</h3>
            </div>



        </div>

    </section>











    <?php @include 'footer.php'; ?>

    <script src="js/script.js"></script>

</body>

</html>