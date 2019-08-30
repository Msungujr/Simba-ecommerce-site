<!DOCTYPE html>
<?php
session_start();
require "functions/functions.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simba | The Best Online Shop in Moshi</title>
    <link rel="stylesheet" type="text/css" href="css/mystyle.css">
</head>
<body>
    <div class="main_wrapper">
        <div class="header_wrapper">
        <a href="index.php"><img id="logo" src="images/simba.jpg"></a>
            <img id="banner" src="images/banner.gif">
        </div>
        <div class="menubar">
            <ul id="menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="daily_deals.php">Daily deals</a></li>
                <li><a href="customer_register.php">Register</a></li>
                <li><a href="my_account.php">My Account</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="">About Simba</a></li>
            </ul>
            <div id="form">
                <form method="get" action="results.php">
                    <input type="text" name="user_query" placeholder="">
                    <input type="submit" name="search" value="Search">
                </form>
            </div>
        </div>
        <div class="content_wrapper">
            <div id="sidebar">
                <div class="sidebar_title">All Categories </div>
                <ul class="cats">
                    <?php getCats(); ?>
                </ul>
                <div class="sidebar_title">Clothing Brands </div>
                <ul class="cats">
                    <?php getBrands(); ?>
                </ul>
            </div>
            <div id="content_area">
                <div class="shopping_cart">
                    <?php cart(); ?>
                    <span style="float: right;
                    font-size: 17px; padding: 5px;line-height: 40px;">
                        <?php
                        if(!isset($_SESSION['customer_email']))
                            echo "Hello guest!";
                        else
                            echo "Hi ".$_SESSION['customer_email'];
                         ?>
                        <b style="color: purple">
                            Your Shopping Cart - </b>
                        Clothes Picked: <?php total_items(); ?>
                        Total Price: <?php total_price(); ?>
                        <a style="color: purple" href="cart.php">See your Shopping Cart</a>

                        <?php
                            if(!isset($_SESSION['customer_email'])){
                                echo "<a style='color: blue;' href='checkout.php'>Login</a>";
                            }
                            else{
                                echo "<a style='color: blue;' href='logout.php'>Logout</a>";
                            }
                        ?>
                    </span>
                </div>
                <div class="products_box">
                    <?php getPro(); ?>
                </div>

            </div>
        </div>
        <div id="footer">
            <h2>Copyright &copy; 2019 Simba Inc. </h2>
           <!--
            <div id="imp"><a href="">Sitemap</a> | <a href="">Feedback</a></div>
       <!-->
        </div>
    </div>
</body>
</html>