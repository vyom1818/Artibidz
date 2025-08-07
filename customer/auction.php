<?php
include 'functions.php';
$conn = connectToDatabase();

if (isset($_SESSION['user_id'])) {
	$sql="select profile_pic from user where user_id=$_SESSION[user_id]"; 
	$result = $conn->query($sql);
	$row=mysqli_fetch_array($result);
}
// Number of arts per page
$perPage = 20;

// Get auction arts
list($arts, $totalPages) = getAuctionArts($conn, $perPage);

// Get current page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>Artibidz</title>
	<meta charset="UTF-8">
	<meta name="description" content="The Plaza eCommerce Template">
	<meta name="keywords" content="plaza, eCommerce, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   
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


	<style>

		.header-section{
			background:#00425a;
			/* background:#64c5b1; */
			/* background:#b09d81; */
			padding-bottom:3vh;
		}

		.hero-section{
			background-position:unset;
		}

		.site-logo img{
			height: 8vh;
			width: 6vw;
			position: relative;
			left: 65px;
			bottom: 6px;
		}

		.hs-item .hs-content h2 span {
			color: #000000;
			font-size: xxx-large;
			position: relative;
			left: 19px;
			bottom: 21px;
			border-bottom: 4px solid #000000;
			border-radius: 4px;
		}
		
		.pagination {
    		margin-top: 15px;
    		text-align: center;
			position:relative;
			bottom:25px;
			display:flex;
			justify-content:space-evenly;
			align-items:center;
			width: 50vw;
    		left: 150px;
		}

		.pagination a {
    		color: #333;
    		padding: 8px 16px;
    		text-decoration: none;
    		transition: background-color 0.3s;
			/* border-bottom:2px solid black; */
		}

		.pagination a.active {
    		background-color: #333;
    		color: white;
		}

		.pagination a:hover:not(.active) {
			background-color: #ddd;
		}

		.prev, .next {
    		margin:0 10px;
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

		.site-btn {
			background: #002f41;
			border-radius:2px;
		}

		.site-btn.btn-line:hover {
 		    background: #002f41;
    		border: 2px solid #002f41;
    		color: #fff;
		}


		.section-title h2{
			margin:10vh 0;
		}

		.product-item .pi-meta .pi-m-left {
    		float: none;
		}

		.product-item figure img {
    		height: 38vh;
		}

		.row .mix figure .q-view{
			height:19px;
			width:29px;
		}

		.product-item .p-info .info p{
			margin:0;
		}

		.product-item .p-info .info{
			height:10vh;
			margin-bottom:1vh;
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
	.header-section ul li:hover .dropdown-menu ul li{

	}
	.hs-content h2{
		display:none;
	}
	.set-bg{
		height:100vh;
		background-position:center;
		background-size:cover;
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
						<img class="user-pic" src="../<?php if (!($row['profile_pic']==null)) { echo $row['profile_pic']; } else { echo 'images/836.jpg'; } ?>" alt="user-profile">
						 <!-- <input type="text" value="../<?php  echo $row['profile_pic']; ?>"> -->
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


    <!-- Other menu items -->
    <li><a href="#">Auction</a></li>
    <li><a href="contact.php">Contact</a></li>
</ul>

	</div>
	</header>
	<!-- Header section end -->

	<!-- Product section -->
	<section class="product-section section-title spad">
		<h2 style="color:#141414; margin-bottom:10vh">AUCTION</h2>
    	<div class="container">
        	<?php if (!empty($arts)): ?>
            	<div class="row" id="product-filter">
                	<?php foreach ($arts as $art): ?>
                    	<div class="mix col-lg-3 col-md-6 best">
                        	<div class="product-item">
								<figure>
									<!-- PRODUCT IMAGE PART -->
									<img src="../<?php echo $art['art_image']; ?>" alt="Art Image">
         							
								</figure>
                            	<div class=" p-info">
									<div class="info">
										<h6><?php echo $art['art_name']; ?></h6>
										<p>&#8377;<?php echo $art['art_amt']; ?></p>
									</div>
                                    <form method="post" action="bid_view.php">
                                    	<input type="hidden" name="art_id" value="<?php echo $art['art_id']; ?>">
										<button type="submit" name="add_bid" class="site-btn btn-line">ADD BID</button>
									</form>
                                </div>
                        	</div>
                    	</div>
                	<?php endforeach; ?>
            	</div>
            	<!-- Pagination -->
            	<?php if ($totalPages > 1): ?>
                	<div class="pagination">
                    	<?php if ($page > 1): ?>
                        	<a href="?page=<?php echo ($page - 1); ?>" class="prev"><i class="fa-solid fa-angles-left" style="color: #0000008f;"></i>  Previous</a>
                    	<?php endif; ?>
                    	<?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        	<a href="?page=<?php echo $i; ?>" class="<?php echo ($page == $i) ? 'active' : ''; ?>"><?php echo $i; ?></a>
                    	<?php endfor; ?>
                    	<?php if ($page < $totalPages): ?>
                        	<a href="?page=<?php echo ($page + 1); ?>" class="next">Next    <i class="fa-solid fa-angles-right" style="color: #0000008f;"></i></a>
                    	<?php endif; ?>
                	</div>
            	<?php endif; ?>
        	<?php else: ?>
            	<p>No results found.</p>
        	<?php endif; ?>
    	</div>
	</section>
	<!-- Product section end -->


<!-- Footer top section -->	
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
	<!-- Footer top section end -->	
	
		<!-- Footer section -->
	<footer class="footer-section">
		<div class="container">
			<p class="copyright">
</p>
		</div>
	</footer>
	<!-- Footer section end -->


	<!--====== Javascripts & Jquery ======-->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/mixitup.min.js"></script>
	<script src="js/sly.min.js"></script>
	<script src="js/jquery.nicescroll.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/search.js"></script>

	
<?php
    // Close connection
    $conn->close();
    ?>
</body>
</html>