<!DOCTYPE html>
<?php
require "functions/functions.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simba | The Best Online Shop in Tanzania </title>
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
                <li><a href="#">About Simba</a></li>
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
                    <span style="float: right;
                    font-size: 17px; padding: 5px;line-height: 40px;">
                        Hello guest! <b style="color: purple">
                           Your Shopping Cart - </b>
                        Clothes Picked: <?php total_items(); ?>
                        Total Price: <?php total_price(); ?>
                        <a style="color: purple" href="cart.php">See your Shopping Cart</a>
                    </span>

                </div>
                <div class="products_box">
                    <?php
                    if(isset($_GET['pro_id'])) {
                        $product_id = $_GET['pro_id'];
                        global $con;
                        $get_pro = "select * from products where pro_id='$product_id'";
                        $run_pro = mysqli_query($con, $get_pro);
                        while ($row_pro = mysqli_fetch_array($run_pro)) {
                            $pro_id = $row_pro['pro_id'];
                            $pro_title = $row_pro['pro_title'];
                            $pro_price = $row_pro['pro_price'];
                            $pro_image = $row_pro['pro_image'];
                            $pro_desc = $row_pro['pro_desc'];
                            echo "
                                <div class='single_product'>
                                    <h3>$pro_title</h3>
                                    <img src='admin/product_images/$pro_image' width='400' height='300'>
                                    <p> <b> TSh $pro_price/-  </b> </p>
                                    <p>$pro_desc</p> 
                                    <a href='index.php' style='float: left'>Go Back</a>
                                    <a href='index.php?pro_id=$pro_id'><button style='float: right;'>Add to Cart</button></a>
                                </div>
                        ";
                        }
                    }
                    ?>
                </div>

            </div>
        </div>
        <div id="footer">
            <h2>Copyright &copy; 2019 Simba Inc.</h2>
        </div>
    </div>
</body>
</html>