<?php
include 'functions.php';
$conn = connectToDatabase();
session_start();
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>Artibidz - eCommerce Template</title>
	<meta charset="UTF-8">
	<meta name="description" content="The Plaza eCommerce Template">
	<meta name="keywords" content="plaza, eCommerce, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

	<!-- Favicon -->   
	<link href="img/favicon.ico" rel="shortcut icon"/>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.css"/>
	<link rel="stylesheet" href="css/style.css"/>
	<link rel="stylesheet" href="css/animate.css"/>


	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<style>
		.header-section{
			background:#00000070;
			padding-bottom:3vh;
		}
		.dd{
	display: inline-block;
	font-size: 14px;
	text-transform: uppercase;
	font-weight: 600;
	color: #fff;
	/* padding: 8px 5px 0; */
	margin-left: 50px;
	background:transparent;
	border: 0;
	position: relative;
	bottom: 9.5px;
}

.dropdown-menu{
	flex-direction: column;
	background: #00000070;
	width: 2vw;
	height: 15vh;
	border: 0
}

.dropdown-item{
	margin: 0;
	padding: 0;
	width: 0;
}

a.dropdown-item.dda{
	margin: 0;
	height: 2vh;
	width: 7vw;
}

li.ddi{
	height: 4vh;
	width: 10vw;
}

.dropdown-item:focus, .dropdown-item:hover {
	color:rgba(255, 255, 255, 0.803);
	background: none;
}

</style>

</head>
<body>

	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>
	
	<!-- Header section -->
	<header class="header-section">
		<div class="container-fluid">
			<!-- logo -->
			<div class="site-logo">
				<!-- <img src="img/artibidz-logo.png" alt="logo"> -->
			</div>
			<!-- responsive -->
			<div class="nav-switch">
				<i class="fa fa-bars"></i>
			</div>
			<div class="header-right">
				<a href="cart.php" class="card-bag"><img src="img/icons/bag.png" alt=""><span>2</span></a>
				<a href="#" class="search" onclick="performSearch()"><img src="img/icons/search.png" alt=""></a>
				<input type="search" name="search" id="search" placeholder="Search..." style="width:6vw;">
			</div>
			<!-- site menu -->
			<!-- site menu -->
<ul class="main-menu">
    <li><a href="index.php">Home</a></li>
    
    <!-- Add the following code for the Category dropdown -->
	<!-- Modify the HTML to display the categories and subcategories -->
	


    <!-- End of Category dropdown -->

    <!-- Other menu items -->
    <li><a href="#">Auction</a></li>
    <li><a href="#">Blog</a></li>
    <li><a href="contact.php">Contact</a></li>
</ul>

		</div>
	</header>
	<!-- Header section end -->



	

<!-- Page -->
<div class="page-area cart-page spad">
    <div class="container">
        <div class="cart-table">
            <table>
                <thead>
                    <tr>
                        <th class="product-th">Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if cart is not empty
                    if (!empty($_SESSION['cart'])) {
                        $subtotal = 0; // Initialize subtotal
                        foreach ($_SESSION['cart'] as $key => $value) {
                            // Skip items that do not belong to the logged-in user
                            if ($value['user_id'] != $_SESSION['user_id']) {
                                continue;
                            }

                            // Fetch art details from the database
                            $artId = $value['art_id'];
                            $sql = "SELECT * FROM art WHERE art_id = $artId";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();

                            // Fetch art image path from art_image table
                            $artImage = '';
                            $imageSql = "SELECT art_image FROM art_image WHERE art_id = $artId LIMIT 1";
                            $imageResult = $conn->query($imageSql);
                            if ($imageResult->num_rows > 0) {
                                $imageRow = $imageResult->fetch_assoc();
                                $artImage = $imageRow['art_image'];
                            }

                            // Calculate total price
                            $totalPrice = $row['art_amt'] * $value['art_qty'];
                            $subtotal += $totalPrice; // Add to subtotal
                            ?>
                            <tr>
                                <td class="product-col">
                                    <img src="../<?php echo $artImage; ?>" alt="">
                                    <div class="pc-title">
                                        <h4><?php echo $row['art_name']; ?></h4>
                                        <a href="#">Edit Product</a>
                                    </div>
                                </td>
                                <td class="price-col">&#8377;<?php echo $row['art_amt']; ?></td>
                                <td class="quy-col">
                                    <div class="quy-input">
                                        <input id="art_qty_<?php echo $value['art_id']; ?>" type="number" value="<?php echo $value['art_qty']; ?>" min="1" max="<?php echo $row['art_qty']; ?>">
                                    </div>
                                </td>
                                <td class="total-col">&#8377;<span id="total_price_<?php echo $value['art_id']; ?>"><?php echo $totalPrice; ?></span></td>
                                <td class="action-col">
                                    <div class="remove-item-btn" onclick="removeItem(<?php echo $value['art_id']; ?>)">❌</div>
                                </td>
                            </tr>
                            <script>
                                function updateCart(artId) {
                                    var qtyInput = document.getElementById('art_qty_' + artId);
                                    var totalSpan = document.getElementById('total_price_' + artId);
                                    var qty = parseInt(qtyInput.value);
                                    var price = <?php echo $row['art_amt']; ?>;
                                    var totalPrice = qty * price;
                                    totalSpan.innerText = totalPrice;
                                }
                            </script>
                        <?php }
                        // Calculate shipping
                        $shipping = ($subtotal > 1000) ? 0 : 50;
                        // Calculate total
                        $total = $subtotal + $shipping;
                        $_SESSION['subtotal']=$subtotal;
                        $_SESSION['shipping']=$shipping;
                        $_SESSION['total']=$total; 
                    } else {
                        $subtotal = 0;
                        $shipping = 0;
                        $total = 0;
                        ?>
                        <tr>
                            <td colspan="5">Cart is empty</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="row cart-buttons">
            <div class="col-lg-5 col-md-5">
                <a href="index.php" class="site-btn btn-continue">Continue shopping</a>
            </div>

            <div class="col-lg-7 col-md-7 text-lg-right text-left">
                <div class="site-btn btn-clear" onclick="clearCart()">Clear cart</div>
                <!-- You can pass the art_id to the updateCart function for the specific item -->
                <div class="site-btn btn-line btn-update" onclick="updateCart(<?php echo $value['art_id']; ?>)">Update Cart</div>
            </div>
        </div>

        <!-- Display subtotal, shipping, and total -->
        <div class="row cart-total">
            <div class="col-lg-4 offset-lg-8">
                <div class="cart-total-details">
                    <h4>Cart total</h4>
                    <ul class="cart-total-card">
                        <li>Subtotal<span>&#8377;<?php echo $subtotal; ?></span></li>
                        <li>Shipping<span>&#8377;<?php echo $shipping; ?></span></li>
                        <li class="total">Total<span>&#8377;<?php echo $total; ?></span></li>
                    </ul>
                     
                    
                    <a class="site-btn btn-full" href="checkout.php">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>


	<!-- Footer top section -->	
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
	<!-- Footer top section end -->	
	<script>
    function clearCart() {
        if (confirm("Are you sure you want to clear your cart?")) {
            // Send an AJAX request to clear_cart.php
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "clear_cart.php", true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    // Reload the page after clearing the cart
                    window.location.reload();
                }
            };
            xhr.send();
        }
    }
	
function removeItem(artId) {
        if (confirm("Are you sure you want to remove this item from your cart?")) {
            // Send an AJAX request to remove the item from the cart
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "remove_item.php?art_id=" + artId, true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    // Reload the page after removing the item
                    window.location.reload();
                }
            };
            xhr.send();
        }
    }

</script>


	


	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/mixitup.min.js"></script>
	<script src="js/sly.min.js"></script>
	<script src="js/jquery.nicescroll.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/search.js"></script>
	<script src="js/category.js"></script>
    </body>
</html>