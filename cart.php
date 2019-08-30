<!DOCTYPE html>
<?php
session_start();
require "functions/functions.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simba | The Best Online Shop in Tanzania</title>
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
                <li><a href="my_account">My Account</a></li>
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
                <?php
                global $con;
                $ip = getIp();
                if(isset($_POST['update_cart'])){
                   for($i =0; $i< sizeof($_POST['product_id']); $i++){
                        $pro_id = $_POST['product_id'][$i];
                        $qty = $_POST['qty'][$i];
                        if($qty > 0) {
                            $update_qty = "update cart set qty='$qty' where p_id='$pro_id' AND ip_add='$ip'";
                            $run_qty = mysqli_query($con, $update_qty);
                        }
                    }
                    if(isset($_POST['remove'])) {
                        foreach ($_POST['remove'] as $remove_id) {
                            $del_pro = "delete from cart where p_id='$remove_id' AND ip_add='$ip'";
                            $run_del = mysqli_query($con, $del_pro);
                        }
                    }
                    header('location: '.$_SERVER['PHP_SELF']);
                }
                if(isset($_POST['continue'])){
                    header('location: index.php');
                }
                ?>
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
                        <a style="color: purple" href="index.php"></a>
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
                    <br>
                    <form action="" method="post" enctype="multipart/form-data">
                        <table align="center" width="700px" bgcolor="rgb(250, 217, 145)">
                            <tr align="center">
                                <th> Remove </th>
                                <th> Product(s) </th>
                                <th> Quantity </th>
                                <th> Unit Price </th>
                                <th> Items Total </th>
                            </tr>
                            <?php
                                $ip = getIp();
                                $total = 0;
                                $sel_price = "select * from cart where ip_add = '$ip'";
                                $run_price = mysqli_query($con,$sel_price);
                                while($cart_row = mysqli_fetch_array($run_price)){
                                    $pro_id = $cart_row['p_id'];
                                    $pro_qty = $cart_row['qty'];
                                    $pro_price = "select * from products where pro_id = '$pro_id'";
                                    $run_pro_price = mysqli_query($con, $pro_price);
                                    while ($pro_row = mysqli_fetch_array($run_pro_price)){
                                        $pro_title = $pro_row['pro_title'];
                                        $pro_image = $pro_row['pro_image'];
                                        $pro_price = $pro_row['pro_price'];
                                        $pro_price_all_items = $pro_price * $pro_qty;
                                        $total += $pro_price_all_items;
                                        ?>
                                        <tr align="center">
                                            <td><input type="checkbox" name="remove[]"
                                                       value="<?php echo $pro_id; ?>"></td>
                                            <td><?php echo $pro_title; ?> <br>
                                                <img src="admin/product_images/<?php echo $pro_image; ?>"
                                                     width="60" height="60">
                                            </td>
                                            <td><input size="2" name="qty[]" value="<?php echo $pro_qty;?>">
                                                <input name="product_id[]" type="hidden" value="<?php echo $pro_id;?>">
                                            </td>
                                            <td><?php echo "TSh " . $pro_price . "/-"; ?></td>
                                            <td><?php echo "TSh " . $pro_price_all_items . "/-"; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                            ?>

                            <tr align="right">
                                <td colspan="4"><b> Total:</b></td>
                                <td><?php echo "TSh ".$total."/-"; ?></td>
                            </tr>
                            <tr align="center">
                                <td colspan="2"><input type="submit" name="update_cart" value="Update your Cart"></td>
                                <td><input type="submit" name="continue" value="Continue Shopping"></td>
                                <td><button>
                                        <a style="text-decoration: none;
                                            color: black;" href="checkout.php">
                                            Checkout</a>
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>

            </div>
        </div>
        <div id="footer">
            <h2> Copyright &copy; 2019 Simba Inc.</h2>
        </div>
    </div>
</body>
</html>