<?php
include 'functions.php';
$conn = connectToDatabase();

if (isset($_SESSION['user_id'])) {
	$sql="select profile_pic from user where user_id=$_SESSION[user_id]"; 
	$result = $conn->query($sql);
	$row1=mysqli_fetch_array($result);
}
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
    <title>Artibidz</title>
    <meta charset="UTF-8">
    <meta name="description" content="The Plaza eCommerce Template">
    <meta name="keywords" content="plaza, eCommerce, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="img/artibidz-logo.png" rel="shortcut icon"/>
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/font-awesome.min.css"/>
    <link rel="stylesheet" href="css/owl.carousel.css"/>
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="css/animate.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

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
            margin-top: 8vh;
            padding: 87px 0;
        }

        .order-card .btn-full {
            background:#00425a;
        }

        .row{
            width:85vw;
        }

        .order-card {
            background: #ebebeb;
            padding: 34px 40px;
            border: 2px solid #f4f2f8;
            height: 84vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-left: 0vw;
        }

        .order-details {
            padding: 38px 19px 24px;
            background: #fff;
            width: 35vw;
            height: 60vh;
        }

        .od-warp {
            padding: 0 26px;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            width: 40vw;
            height: 45vh;
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
    .order-details{
        width:60vw;
    }
}
    </style>
</head>
<body>
    <div id="preloder">
        <div class="loader"></div>
    </div>
    
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

    <!-- Other menu items -->
    <li><a href="auction.php">Auction</a></li>
    <li><a href="contact.php">Contact</a></li>
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
                                <input type="text" placeholder="Name *" name="nm" value="<?php echo $row['fname']; $_SESSION['fname']=$row['fname']; ?>" readonly>
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
                                                <td>&#8377;<?php echo $_GET['subtotal']; ?></td>
                                            </tr>
                                            <tr class="cart-subtotal">
                                                <td>Shipping</td>
                                                <td>&#8377;<?php echo $_GET['shipping']; ?></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr class="order-total">
                                                <th>Total</th>
                                                <th>&#8377;<?php echo $_GET['total']; $_SESSION['total']=$_GET['total']; ?></th>
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
						<img src="img/artibidz-logo2.png" class="footer-logo" alt="">
						<p></p>
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
						<h6 class="fw-title">Sitemap</h6>
						<ul>
							<li><a href="auction.php">Auction</a></li>
							<li><a href="cart.php">Cart</a></li>
							<li><a href="contact.php">Contact</a></li>
							
						</ul>
					</div>
				</div>
				
				<div class="col-lg-2 col-md-4 col-sm-6">
					<div class="footer-widget">
						<h6 class="fw-title">Contact</h6>
						<div class="text-box">
							<p>Artibidz</p>
							<p>+91 9316510025</p>
							<p>artibidz@gmail.com</p>
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
