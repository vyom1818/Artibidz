<!DOCTYPE html>

<?php
// session_start();
include 'functions.php';

$conn = connectToDatabase();
if (isset($_SESSION['user_id'])) {
	$sql="select profile_pic from user where user_id=$_SESSION[user_id]"; 
	$result = $conn->query($sql);
	$row1=mysqli_fetch_array($result);

    $userId = $_SESSION['user_id'];
    $cartItems = array();
    $cartQuery = "SELECT 
        cart.*, 
        art.art_name, 
        art.art_amt, 
        (SELECT art_image FROM art_image WHERE art_id = art.art_id LIMIT 1) AS art_image
    FROM 
        cart
    JOIN 
        art ON cart.art_id = art.art_id
    WHERE 
        cart.user_id = $userId";
    $cartResult = $conn->query($cartQuery);

    if ($cartResult->num_rows > 0) {
        while ($row = $cartResult->fetch_assoc()) {
            $totalPrice = getTotalPrice($row['cart_art_qty'], $row['art_amt']);
            $cartItems[] = array(
                'cart_id' => $row['cart_id'],
                'art_id' => $row['art_id'],
                'art_name' => $row['art_name'],
                'art_amt' => $row['art_amt'],
                'cart_art_qty' => $row['cart_art_qty'],
                'total_price' => $totalPrice,
                'art_image' => $row['art_image']
            );
        }
        // Calculate subtotal if cart is not empty
        $subtotal = array_sum(array_column($cartItems, 'total_price'));
    } else {
        // If cart is empty, set subtotal to 0
        $subtotal = 0;
    }

    // Calculate shipping based on subtotal
    $shipping = ($subtotal > 1000 || $subtotal==0) ? 0 : 50;
    $total = $subtotal + $shipping;
    
} else {
    // If user is not logged in, set all values to 0
    $cartItems = array();
    $subtotal = 0;
    $shipping = 0;
    $total = 0;
}
$_SESSION['shipping']=$shipping;
?>


<html lang="zxx">
<head>
    <title>Artibidz</title>
    <meta charset="UTF-8">
    <meta name="description">
    <meta name="keywords" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Favicon -->   
    <link href="img\artibidz-logo.png" rel="shortcut icon"/>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/font-awesome.min.css"/>
    <link rel="stylesheet" href="css/owl.carousel.css"/>
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="css/animate.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .header-section{
			background:#00425a;
			/* background:#64c5b1; */
			/* background:#b09d81; */
			padding-bottom:3vh;
		}

        .site-logo img{
			height: 8vh;
			width: 6vw;
			position: relative;
			left: 65px;
			bottom: 6px;
		}

        .dd{
			display:block;
			margin-top:10px;
			margin-left:10px;
		}

		.dropdown-menu ul li .dd2{
			margin-left:0;
		}

		.dropdown-menu{
			height:50vh;
		}

		.header-section ul li:hover .dropdown-menu {
  			display: block;
  			position: absolute;
			/* margin-left:30vw; */
			left: 38px;
  			/* top: 100%;*/
  			/* background-color: #64c5b1; */
			  background:#00425a;
		}

		.header-section ul li:hover .dropdown-menu ul {
  			display: block;
  			/* margin: 10px; */
		}

		.header-section ul li:hover .dropdown-menu ul li {
			width: 200px;
			padding: 10px;
			position: relative;
		}

		.dropdown-menu-1 {
			display: none;
			border-radius:2px;
		}

		.dropdown-menu ul li:hover .dropdown-menu-1 {
			display: block;
			position: absolute;
			left: 160px;
			top: 0;
			/* background-color: #64c5b1; */
			background:#00425a;
		}

		.dropdown-menu ul li:hover .dropdown-menu-1 ul li{
			padding-bottom:20px;
		}

		.main-menu{
			margin-right:125px;
		}

		.header-right{
			width: 24vw;
		}

		.header-right .search{
			margin-left:0;
		}

		.header-right .card-bag{
			margin-left:4vw;
			bottom:2px;
		}

		.user-pic{
			height:40px;
    		width: 40px;
    		border-radius: 50%;
    		cursor: pointer;
			margin-left:4vw;
		}
		input[type="search"]{
		    background: transparent;
    		color: white;
    		border:none;
    		outline: none;
   		 	border-bottom: 1px solid white;
    		padding-left:20px;
			padding-bottom:0;
			/* width:12vw; */
    		/* font-family: "Poppins", sans-serif;
    		font-weight: 400;
    		font-style: normal; */
		}

		::placeholder {
    		/* padding-left:20px ; */
    		/* font-family: "Poppins", sans-serif;
    		font-weight: 400;
    		font-style: normal; */
    		color: #fff;
    		font-size:medium;
		}

		.sicon{
    		position: relative;
    		left:35px;
    		bottom: 6px;
    		color: white;
		}

		.sicon:hover{
    		position: relative;
    		left:35px;
    		bottom: 6px;
    		color: white;
    		cursor: pointer;
		}

        .page-info-section.page-info {
            margin-top: 15vh;
            padding: 87px 0;
        }

        .cart-table .quy-input{
            display:flex;
            justify-content:center;
            align-items:center;
            padding:0;
        }

        .cart-table .quy-input input{
            text-align:center;
        }

        .cart-buttons .btn-continue{
            background:#00425a;
        }

        .cart-total-details .btn-full{
            background:#00425a;
        }

        .cart-total-details h4{
            padding:1vh 0;
        }

        .col-lg-4{
            margin:2vh 2vw;
        }

        .offset-lg-2 {
            margin-left: 7vw;
        }  

        .cart-table .total-col {
            text-align: center;
        }

        .remove-item-btn:hover{
            cursor:pointer;
            text-decoration:underline;
        }

        #checkout-link{
            color:white;
        }
        @media only screen and (max-width: 700px) {
    .mobile-menu-icon {
        display: block; /* Display for smaller screens */
    }
	.main-menu{
		display:block;
		display: block;
    margin-top: 0;
    background: #00425a;
	left:0;
	width:100%;
	}
	.main-menu li a{
		color:#fff;
	}
	.hs-content{
		display:block;
	}
	ul li a{
		display:block;
		/* width:10px;
		height:10px; */
	}
	input[type="search"],.sicon
	{
		display:none;
	}
	.header-right{
		width:30vw;
	}
	.site-logo img{
		width:20vw;
		left:0;
	}
	.i-slider{
		width:62vw;
	}
	.slide{
		flex-direction:column;
	}
	.slide li {
		width:40vw;
	}
	figure{
		width:50vw;
	}
	.i-slider .i-item figure img{
		width:50vw;
	}
	.i-slider h5{
		width:51vw;
	}
	.container{
		width:56vw;
	}
	.pagination{
		left:0;
	}
	.hs-item .hs-content h2 span{
		left:0;
	}
	.header-section ul li:hover .dropdown-menu{
		height:76vh;
	}
	.hs-content h2{
		display:none;
	}
	.set-bg{
		height:100vh;
		background-position:center;
		background-size:cover;
	}
    .container{
        width:100%;
    }
    .card-warp {
    width: 315px;
    margin: 0 auto;
    background: #ebebeb;
    padding: 65px 0;
    }
    .cart-total-card{
        margin-right:3vw;
    }
}

@media only screen and (max-width: 1450px) {
	.header-right{
		width:50vw;
	}
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
				<img src="img/artibidz-logo2.png" alt="logo">
			</div>
			<!-- responsive -->
			<div class="nav-switch">
				<i class="fa fa-bars"></i>
			</div>
			<div class="header-right">
				<a href="#" class="search" onclick="performSearch()"><img class="sicon" src="img/icons/search.png" alt=""></a>
				<input type="search" name="search" id="search" placeholder="Search..." style="width:8vw;">
				<a href="cart.php" class="card-bag"><img src="img/icons/bag.png" alt=""></a>
					<a href="user_profile.php ">
						<!-- <img class="user-pic" src="../" alt="user-profile"> -->
                        <?php if (isset($_SESSION['user_id']) && $row1 && isset($row1['profile_pic'])): ?>
                        <img class="user-pic" src="../<?php echo $row1['profile_pic']; ?>" alt="user-profile">
                        <?php else: ?>
                        <img class="user-pic" src="../images/836.jpg" alt="user-profile">
                        <?php endif; ?>
                    </a>
			</div>
			<!-- site menu -->
			<!-- site menu -->
    <ul class="main-menu">
    <li><a href="index.php">Home</a></li>
    
    <!-- Add the following code for the Category dropdown -->
	<!-- Add the following code for the Category dropdown -->
	<!-- Modify the HTML to display the categories and subcategories -->
	<li class="dd"><a href="#">Categories <i class="fa-solid fa-angle-down"></i></a>
            <div class="dropdown-menu">
                <ul>
                  <li><a class="dd dd2"  href="fetch_arts1.php?category=<?php echo urlencode('paintings'); ?>">Paintings<i class="fa-solid fa-angle-right" style="margin-left:3.9vw"></i></a>
				  <div class="dropdown-menu-1">
                      <ul>
                      <li><a class="sdd dd2"  href="fetch_arts.php?subcategory=<?php echo urlencode('Oil Painting'); ?>" id="Oil Painting">Oil Painting</a></li>

                        <li><a class="dd2" href="fetch_arts.php?subcategory=<?php echo urlencode('Acrylic painting'); ?>" id="Acrylic painting">Acrylic painting</a></li>
                        <li><a class="dd2" href="fetch_arts.php?subcategory=<?php echo urlencode('Spray Painting'); ?>" id="Spray Painting">Spray Painting</a></li>
                        <li><a class="dd2" href="fetch_arts.php?subcategory=<?php echo urlencode('Glass Painting'); ?>" id="Glass Painting">Glass Painting</a></li>
                        <li><a class="dd2" href="fetch_arts.php?subcategory=<?php echo urlencode('Panel Painting'); ?>" id="Panel Painting">Panel Painting</a></li>
                        <li><a class="dd2" href="fetch_arts.php?subcategory=<?php echo urlencode('Nature Painting'); ?>"id="Nature Painting">Nature Painting</a></li>
                        <li><a class="dd2" href="fetch_arts.php?subcategory=<?php echo urlencode('Abstract Painting'); ?>" id="Abstract Art">Abstract Art</a></li>
                        <li><a class="dd2" href="fetch_arts.php?subcategory=<?php echo urlencode('Mandala Painting'); ?>" id="Mandala Art">Mandala Art</a></li>
                      </ul>
                  </div>
				  </li>
                  <li><a class="dd dd2" href="fetch_arts1.php?category=<?php echo urlencode('Sculpture'); ?>">Sculpture<i class="fa-solid fa-angle-right" style="margin-left:3.4vw"></i></a>
				  <div class="dropdown-menu-1">
                      <ul>
                        <li><a class="dd2" href="fetch_arts.php?subcategory=<?php echo urlencode('Figurine'); ?>">Figurine</a></li>
                        <li><a class="dd2" href="fetch_arts.php?subcategory=<?php echo urlencode('Art Objects'); ?>">Art Objects</a></li>
                        <li><a class="dd2" href="fetch_arts.php?subcategory=<?php echo urlencode('Vessels'); ?>">Vessels</a></li>
                        <li><a class="dd2" href="fetch_arts.php?subcategory=<?php echo urlencode('3D Sculpture' ); ?>">3D Sculpture</a></li>
                      </ul>
                  </div>
				  </li>
                  <li><a class="dd dd2" href="fetch_arts1.php?category=<?php echo urlencode('Calligraphy'); ?>">Calligraphy<i class="fa-solid fa-angle-right" style="margin-left:2.5vw"></i></a>
                    <div class="dropdown-menu-1">
                      <ul>
                        <li><a class="dd2" href="fetch_arts.php?subcategory=<?php echo urlencode('Arabic Calligraphy'); ?>">Arabic Calligraphy</a></li>
                        <li><a class="dd2" href="fetch_arts.php?subcategory=<?php echo urlencode('Brush Calligraphy'); ?>">Brush Calligraphy</a></li>
                        <li><a class="dd2" href="fetch_arts.php?subcategory=<?php echo urlencode('Sanskrit Calligraphy'); ?>">Sanskrit Calligraphy</a></li>
                      </ul>
                    </div>
                  </li>
                  <li><a class="dd dd2" href="fetch_arts1.php?category=<?php echo urlencode('Resin Art'); ?>">Resin Art<i class="fa-solid fa-angle-right" style="margin-left:4.1vw"></i></a>
				  <div class="dropdown-menu-1">
                      <ul>
                        <li><a class="dd2" href="fetch_arts.php?subcategory=<?php echo urlencode('Resin Wall Art'); ?>">Resin Wall Art</a></li>
                        <li><a class="dd2" href="fetch_arts.php?subcategory=<?php echo urlencode('Resin Clock'); ?>">Resin Clock</a></li>
                        <li><a class="dd2" href="fetch_arts.php?subcategory=<?php echo urlencode('Resin Jewellery'); ?>">Resin Jewellery</a></li>
                      </ul>
                    </div>
				  </li>
                  <li><a class="dd dd2" href="fetch_arts1.php?category=<?php echo urlencode('Sketching'); ?>">Sketching<i class="fa-solid fa-angle-right" style="margin-left:3.5vw"></i></a>
				   <div class="dropdown-menu-1">
                      <ul>
                        <li><a class="dd2" href="fetch_arts.php?subcategory=<?php echo urlencode('Potrait Sketching'); ?>" >Potrait Sketching</a></li>
                      </ul>
                    </div>
				  </li>
                  <li><a class="dd dd2" href="fetch_arts1.php?category=<?php echo urlencode('Fine Art Ceramics'); ?>">Fine Art Ceramics<i class="fa-solid fa-angle-right" style="margin-left:0."></i></a>
				    <div class="dropdown-menu-1">
                      <ul>
                        <li><a class="dd2" href="fetch_arts.php?subcategory=<?php echo urlencode('Wooden Pots'); ?>" >Wooden Pots</a></li>
                        <li><a class="dd2" href="fetch_arts.php?subcategory=<?php echo urlencode('Jasperware'); ?>">Jasperware</a></li>
                      </ul>
                    </div>
				  </li>
                </ul>
              </div>
    </li>
	
    <!-- End of Category dropdown -->



    <!-- End of Category dropdown -->

    <!-- Other menu items -->
    <li><a href="auction.php">Auction</a></li>
    <li><a href="contact.php">Contact</a></li>
</ul>

		</div>
    </header>
    <!-- Header section end -->

    	<!-- Page Info -->
	<div class="page-info-section page-info">
		<div class="container">
			<div class="site-breadcrumb">
				<a href="">Home</a> / 
				<span>Cart</span>
			</div>
			<img src="img/page-info-art.png" alt="" class="page-info-art">
		</div>
	</div>
	<!-- Page Info end -->


    <!-- Page -->
    <div class="page-area cart-page">
        <div class="container">
            <div class="cart-table spad">
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
                        <?php foreach ($cartItems as $cartItem): ?>
                            <tr>
                                <td class="product-col">
                                    <img src="../<?php echo $cartItem['art_image']; ?>" alt="">
                                    <div class="pc-title">
                                        <h4><?php echo strtoupper($cartItem['art_name']); ?></h4>
                                        <!-- <a href="#">Edit Product</a> -->
                                    </div>
                                </td>
                                <td class="price-col">₹<?php echo $cartItem['art_amt']; ?></td>
                                <td class="quy-col">
                                    <div class="quy-input">
                                        
                                        <?php
                                        // Check if the art in the cart is in auction
                                        $checkAuctionQuery = "SELECT sale_or_auction FROM art WHERE art_id = {$cartItem['art_id']}";
                                        $resultCheckAuction = mysqli_query($conn, $checkAuctionQuery);

                                        if ($resultCheckAuction) {
                                        $art = mysqli_fetch_assoc($resultCheckAuction);
                                        if ($art['sale_or_auction'] == 'auction') {
                                            echo '<span><button class="btn btn-minus" style="visibility: hidden;"><i class="fa fa-minus"></i></button></span>';
                                        } else {
                                        echo '<span><button class="btn btn-minus"><i class="fa fa-minus"></i></button></span>';
                                        }   
                                        } else {    
                                            echo "Error: " . $checkAuctionQuery . "<br>" . mysqli_error($conn);
                                        }
                                        ?>
                                        <input class="qty" id="art_qty_<?php echo $cartItem['art_id']; ?>" name="qty" type="text" value="<?php echo $cartItem['cart_art_qty']; ?>" min="1" max="<?php echo $cartItem['cart_art_qty']; ?>" data-art-id="<?php echo $cartItem['art_id']; ?>" data-art-qty="<?php echo $cartItem['cart_art_qty']; ?>" data-art-amt="<?php echo $cartItem['art_amt']; ?>" readonly>
                                        <?php
                                        if ($resultCheckAuction) {
                                        if ($art['sale_or_auction'] == 'auction') {
                                                echo '<span><button class="btn btn-plus" style="visibility: hidden;"><i class="fa fa-plus"></i></button></span>';
                                        } else {
                                            echo '<span><button class="btn btn-plus"><i class="fa fa-plus"></i></button></span>';
                                        }   
                                        } else {    
                                            echo "Error: " . $checkAuctionQuery . "<br>" . mysqli_error($conn);
                                        }
                                        ?>
                                    </div>
                                </td>
                                <td class="total-col">₹<span id="total_price_<?php echo $cartItem['art_id']; ?>"><?php echo $cartItem['total_price']; ?></span></td>
                                <td class="action-col">
                                <?php
                                        if ($resultCheckAuction) {
                                        if ($art['sale_or_auction'] == 'auction') { ?>
                                        
                                        <div class="remove-item-btn" onclick="removeItem(<?php echo $cartItem['art_id']; ?>)" style="visibility: hidden;">Remove Item</div>
                                       <?php } else { ?>
                                        <div class="remove-item-btn" onclick="removeItem(<?php echo $cartItem['art_id']; ?>)">Remove Item</div>
                                       <?php }   
                                        } else {    
                                            echo "Error: " . $checkAuctionQuery . "<br>" . mysqli_error($conn);
                                        }
                                        ?>
                                 
                                </td>
                            </tr>   
                        <?php endforeach; ?>    
                    </tbody>
                </table>
            </div>

            <div class="row cart-buttons">
                <div class="col-lg-5 col-md-5">
                    <a href="index.php" class="site-btn btn-continue">Continue Shopping</a>
                </div>

                <div class="col-lg-7 col-md-7 text-lg-right text-left">
                    <div class="site-btn btn-clear" onclick="clearCart()">Clear Cart</div>
                   
                </div>
            </div>

            <div class="card-warp spad">
			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<div class="shipping-info">
							<h4>Shipping method</h4>
                            <br>
							<!-- <h4>----------------------</h4> -->
							<div class="shipping-chooes">
								<div class="sc-item">
									<input type="radio" name="sc" id="one">
									<label for="one">Order Below ₹1000<span>₹50</span></label>
								</div>
								<div class="sc-item">
									<input type="radio" name="sc" id="two">
									<label for="two">Order Above ₹1000<span>Free</span></label>
								</div>
								<div class="sc-item">
									<input type="radio" name="sc" id="three">
									<label for="three">Personal Pickup<span>Free</span></label>
								</div>
							</div>
						</div>
					</div>

            <!-- Display subtotal, shipping, and total -->
            <!-- <div class="row cart-total"> -->
                <!-- <div class="col-lg-4 offset-lg-8"> -->
                <div class="offset-lg-2 col-lg-6">
                    <div class="cart-total-details">
                        <h4>Cart total</h4>
                        <ul class="cart-total-card">
                            <li>Subtotal<span  id="subtotal">₹<?php echo $subtotal; $_SESSION['subtotal']=$subtotal; ?></span></li>
                            <li>Shipping<span  id="shipping">₹<?php echo $shipping; $_SESSION['shipping']=$shipping; ?></span></li>
                            <li class="total">Total<span id="total">₹<?php echo $total; $_SESSION['total']=$total; ?></span></li>
                        </ul>
                        <a id="checkout-link" class="site-btn btn-full" onclick="redirectToCheckout()">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

  

    <!--====== Javascripts & Jquery ======-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/sly.min.js"></script>
    <script src="js/jquery.nicescroll.min.js"></script>
    <script src="js/main.js"></script>
    <!-- <script src="js/search.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    
    <script src="js/cart_qty.js"></script>
    <script>
function updateCartItem(artId, newQty, artAmt) {
    var totalSpan = document.getElementById('total_price_' + artId);
    var total = newQty * artAmt;
    totalSpan.innerText = total;

    var formData = new FormData();
    formData.append('art_id', artId);
    formData.append('qty', newQty);

    fetch('update_cart.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('subtotal').innerText = '₹' + data.subtotal;
        document.getElementById('shipping').innerText = '₹' + data.shipping;
        document.getElementById('total').innerText = '₹' + data.total;
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function removeItem(artId) {
    console.log('Removing item with artId:', artId);

    // Custom SweetAlert confirmation dialog
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to remove this item from your cart?",
        icon: 'warning',
        showCancelButton: true,  // Adds the Cancel button
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, remove it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            console.log('User confirmed removal');
            
            // Use AJAX to remove item from cart
            fetch('remove_item.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'art_id=' + artId
            })
            .then(response => response.json())
            .then(data => {
                console.log('Item removed from cart:', data);
                
                // Remove item from the display
                var rowToRemove = document.querySelector('tr[data-art-id="' + artId + '"]');
                if (rowToRemove) {
                    rowToRemove.remove();
                }

                // Update subtotal, shipping, and total
                document.getElementById('subtotal').innerText = '₹' + data.subtotal;
                document.getElementById('shipping').innerText = '₹' + data.shipping;
                document.getElementById('total').innerText = '₹' + data.total;

                // Refresh the page
                window.location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    });
}


function redirectToCheckout() {
    var subtotal = document.getElementById('subtotal').innerText.replace('₹', '');
    var shipping = document.getElementById('shipping').innerText.replace('₹', '');
    var total = document.getElementById('total').innerText.replace('₹', '');

    var checkoutLink = document.getElementById('checkout-link');
    checkoutLink.href = 'checkout.php?subtotal=' + subtotal + '&shipping=' + shipping + '&total=' + total;
}

function clearCart() {
    fetch('clear_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: ''
    })
    .then(response => response.json())
    .then(data => {
        var tbody = document.querySelector('tbody');
        while (tbody.firstChild) {
            tbody.removeChild(tbody.firstChild);
        }

        // Update subtotal, shipping, and total
        document.getElementById('subtotal').innerText = '₹' + data.subtotal;
        document.getElementById('shipping').innerText = '₹' + data.shipping;
        document.getElementById('total').innerText = '₹' + data.total;
    })
    .catch(error => {
        console.error('Error:', error);
    });
}


    </script>
</body>
</html>