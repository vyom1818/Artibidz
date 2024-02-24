<?php
    session_start();
	$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "artibidz";

    $conn =mysqli_connect($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $userId = $_SESSION['user_id'];

    $sql = "SELECT u.*, c.city_name, s.state_name
            FROM user u
            JOIN city c ON u.city_id = c.city_id
            JOIN state s ON c.state_id = s.state_id
            WHERE u.user_id = $userId";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "User not found.";
    }
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>The Plaza - eCommerce Template</title>
    <meta charset="UTF-8">
    <meta name="description" content="The Plaza eCommerce Template">
    <meta name="keywords" content="plaza, eCommerce, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="img/favicon.ico" rel="shortcut icon"/>
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/font-awesome.min.css"/>
    <link rel="stylesheet" href="css/owl.carousel.css"/>
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="css/animate.css"/>
</head>
<body>
    <div id="preloder">
        <div class="loader"></div>
    </div>
    
    <header class="header-section header-normal">
        <div class="container-fluid">
            <div class="site-logo">
                <img src="img/logo.png" alt="logo">
            </div>
            <div class="nav-switch">
                <i class="fa fa-bars"></i>
            </div>
            <div class="header-right">
                <a href="cart.html" class="card-bag"><img src="img/icons/bag.png" alt=""><span>2</span></a>
                <a href="#" class="search"><img src="img/icons/search.png" alt=""></a>
            </div>
            <ul class="main-menu">
                <li><a href="index.html">Home</a></li>
                <li><a href="#">Woman</a></li>
                <li><a href="#">Man</a></li>
                <li><a href="#">LookBook</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </div>
    </header>

    <div class="page-info-section page-info">
        <div class="container">
            <div class="site-breadcrumb">
                <a href="index.php">Home</a> /  
                <a href="cart.php">Cart</a> / 
                <span>Checkout</span>
            </div>
            <img src="img/page-info-art.png" alt="" class="page-info-art">
        </div>
    </div>

    <div class="page-area cart-page spad">
        <div class="container">
            <form class="checkout-form" action="payment.php" method="post">
                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="checkout-title">Billing Address</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" placeholder="Name *" name="nm" value="<?php echo $row['fname']; ?>" readonly>
                                <input type="text" placeholder="Address *" name="address" value="<?php echo $row['address']; ?>" readonly>
                                <input type="text" placeholder="Zipcode *" name="pincode" value="<?php echo $row['pincode']; ?>" readonly>
                                <select name="state" readonly>
                                    <option><?php echo $row['state_name']; ?></option>
                                </select>
                                <select name="city" readonly>
                                    <option><?php echo $row['city_name']; ?></option>
                                </select>
                                <input type="text" placeholder="Phone no *" name="no" value="<?php echo $row['contact_no']; ?>" readonly>
                                <input type="email" placeholder="Email Address *" name="email" value="<?php echo $row['email_address']; ?>" readonly>
                                <div class="checkbox-items">
                                    <div class="ci-item">
                                        <input type="checkbox" name="a" id="tandc">
                                        <label for="tandc">Terms and conditions</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="order-card">
                            <div class="order-details">
                                <div class="od-warp">
                                    <h4 class="checkout-title">Your order</h4>
                                    <table class="order-table">
                                        <tbody>
                                            <tr>
                                                <td>SubTotal</td>
                                                <td>&#8377;<?php echo $_SESSION['subtotal']; ?></td>
                                            </tr>
                                            <tr class="cart-subtotal">
                                                <td>Shipping</td>
                                                <td>&#8377;<?php echo $_SESSION['shipping']; ?></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr class="order-total">
                                                <th>Total</th>
                                                <th>&#8377;<?php echo $_SESSION['total']; ?></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                               
                            </div>
                            <button class="site-btn btn-full">Place Order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <section class="footer-top-section home-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-8 col-sm-12">
                    <div class="footer-widget about-widget">
                        <img src="img/logo.png" class="footer-logo" alt="">
                        <p>Donec vitae purus nunc. Morbi faucibus erat sit amet congue mattis. Nullam fringilla faucibus urna, id dapibus erat iaculis ut. Integer ac sem.</p>
                        <div class="cards">
                            <img src="img/cards/5.png" alt="">
                            <img src="img/cards/4.png" alt="">
                            <img src="img/cards/3.png" alt="">
                            <img src="img/cards/2.png" alt="">
                            <img src="img/cards/1.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="footer-widget">
                        <h6 class="fw-title">usefull Links</h6>
                        <ul>
                            <li><a href="#">Partners</a></li>
                            <li><a href="#">Bloggers</a></li>
                            <li><a href="#">Support</a></li>
                            <li><a href="#">Terms of Use</a></li>
                            <li><a href="#">Press</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="footer-widget">
                        <h6 class="fw-title">Sitemap</h6>
                        <ul>
                            <li><a href="#">Partners</a></li>
                            <li><a href="#">Bloggers</a></li>
                            <li><a href="#">Support</a></li>
                            <li><a href="#">Terms of Use</a></li>
                            <li><a href="#">Press</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="footer-widget">
                        <h6 class="fw-title">Shipping & returns</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Track Orders</a></li>
                            <li><a href="#">Returns</a></li>
                            <li><a href="#">Jobs</a></li>
                            <li><a href="#">Shipping</a></li>
                            <li><a href="#">Blog</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="footer-widget">
                        <h6 class="fw-title">Contact</h6>
                        <div class="text-box">
                            <p>Your Company Ltd </p>
                            <p>1481 Creekside Lane  Avila Beach, CA 93424, </p>
                            <p>+53 345 7953 32453</p>
                            <p>office@youremail.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/sly.min.js"></script>
    <script src="js/jquery.nicescroll.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
