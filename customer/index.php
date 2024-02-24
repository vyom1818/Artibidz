<?php
include 'functions.php';
$conn = connectToDatabase();
addToCart($conn);
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<style>
		.header-section{
			background:#00000070;
			padding-bottom:3vh;
		}

		.site-logo img{
			height: 7vh;
			width: 4vw;
			position: relative;
			left: 74px;
			bottom: 6px;
		}

		.hs-item .hs-content h2 span {
			color: #414141;
			font-size: xxx-large;
			position: relative;
			left: 19px;
			bottom: 21px;
			border-bottom: 4px solid #414141;
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

		/* .dropdown-menu {
  			display: none;
		} */

		.dd{
			display:block;
			margin-top:10px;
			margin-left:10px;
		}

		.header-section ul li:hover .dropdown-menu {
  			display: block;
  			position: absolute;
			/* margin-left:30vw; */
			left: 0;
  			/* top: 100%;*/
  			background-color: var(--color-black);
		}

		.header-section ul li:hover .dropdown-menu ul {
  			display: block;
  			margin: 10px;
		}

		.header-section ul li:hover .dropdown-menu ul li {
			width: 150px;
			padding: 10px;
		}

		.dropdown-menu-1 {
			display: none;
		}

		.dropdown-menu ul li:hover .dropdown-menu-1 {
			display: block;
			position: absolute;
			left: 150px;
			top: 0;
			background-color: var(--color-black);
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
				<img src="img/artibidz-logo.png" alt="logo">
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
	<li class="dd"><a href="#">Categories <i class="fa-solid fa-angle-down"></i></a>
            <div class="dropdown-menu">
                <ul>
                  <li><a class="dd" href="#">Paintings</a>
				  <div class="dropdown-menu-1">
                      <ul>
                      <li><a href="fetch_arts.php?subcategory=<?php echo urlencode('Oil Painting'); ?>" id="Oil Painting">Oil Painting</a></li>

                        <li><a href="#" id="Acrylic painting">Acrylic painting</a></li>
                        <li><a href="#" id="Spray Painting">Spray Painting</a></li>
                        <li><a href="#" id="Glass Painting">Glass Painting</a></li>
                        <li><a href="#" id="Panel Painting">Panel Painting</a></li>
                        <li><a href="#" id="Nature Painting">Nature Painting</a></li>
                        <li><a href="#" id="Abstract Art">Abstract Art</a></li>
                        <li><a href="#" id="Mandala Art">Mandala Art</a></li>
                      </ul>
                  </div>
				  </li>
                  <li><a class="dd" href="#">Sculpture</a>
				  <div class="dropdown-menu-1">
                      <ul>
                        <li><a href="#" id="figurine">Figurine</a></li>
                        <li><a href="#" id="Art Objects">Art Objects</a></li>
                        <li><a href="#" id="Vessels">Vessels</a></li>
                        <li><a href="#">3D Sculpture</a></li>
                      </ul>
                  </div>
				  </li>
                  <li><a class="dd" href="#">Calligraphy</a>
                    <div class="dropdown-menu-1">
                      <ul>
                        <li><a href="#">Arabic Calligraphy</a></li>
                        <li><a href="#">Brush Calligraphy</a></li>
                        <li><a href="#">Sanskrit Calligraphy</a></li>
                      </ul>
                    </div>
                  </li>
                  <li><a class="dd" href="#">Resin Art</a>
				  <div class="dropdown-menu-1">
                      <ul>
                        <li><a href="#">Resin Wall Art</a></li>
                        <li><a href="#">Resin Clock</a></li>
                        <li><a href="#">Resin Jewellery</a></li>
                      </ul>
                    </div>
				  </li>
                  <li><a class="dd" href="#">Sketching</a>
				   <div class="dropdown-menu-1">
                      <ul>
                        <li><a href="#">Potrait Sketching</a></li>
                      </ul>
                    </div>
				  </li>
                  <li><a class="dd" href="#">Fine Art Ceramics</a>
				    <div class="dropdown-menu-1">
                      <ul>
                        <li><a href="#">Wooden Pots</a></li>
                        <li><a href="#">Jasperware</a></li>
                      </ul>
                    </div>
				  </li>
                </ul>
              </div>
    </li>


    <!-- End of Category dropdown -->

    <!-- Other menu items -->
    <li><a href="#">Auction</a></li>
    <li><a href="#">Blog</a></li>
    <li><a href="contact.php">Contact</a></li>
</ul>

		</div>
	</header>
	<!-- Header section end -->


	<!-- Hero section -->
	<section class="hero-section set-bg" data-setbg="img/bg4.jpg">
		<div class="hero-slider owl-carousel">
			<div class="hs-item">
				<div class="hs-left"></div>
				<div class="hs-right">
					<div class="hs-content">
						<div class="price">from &#8377;19.90</div>
						<h2><span>2018</span> <br>summer collection</h2>
						<a href="" class="site-btn">Shop NOW!</a>
					</div>
				</div>
			</div>
			<div class="hs-item">
				<div class="hs-left"></div>
				<div class="hs-right">
					<div class="hs-content">
						<div class="price">from $19.90</div>
						<h2><span>2018</span> <br>summer collection</h2>
						<a href="" class="site-btn">Shop NOW!</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Hero section end -->

<!-- Product section -->
<section class="product-section spad">
    <div class="container">
        <?php
// Initialize $page variable
$page = 1;

// Handle search
list($result, $totalPages) = handleSearch($conn, 20);

// Set $page variable if it exists
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

if ($result->num_rows > 0): ?>
            <div class="row" id="product-filter">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="mix col-lg-3 col-md-6 best">
                        <div class="product-item">
						<figure>
        				   <img src="../<?php echo $row['art_image']; ?>" alt="" style="height:200px; object-fit:'cover'">
         				 	 <div class="pi-meta">
	     				  		<div class="pi-m-left">
						 		<?php echo "<td><a class='anchor' href='quick_view.php?art_id=$row[art_id]'>" ?>
       					 			<img src="img/icons/eye.png" alt="Quick View">
 	     				  			<p>quick view</p>
   						 			</a>
								</div>
								<div class="pi-m-right">
            						<img src="img/icons/heart.png" alt="">
            						<p>save</p>
        						</div>
    						</div>
						</figure>
                        <div class="product-info">
                            <h6><?php echo $row['art_name']; ?></h6>
                                <p>&#8377;<?php echo $row['art_amt']; ?></p>
                                  <!-- Add to Cart Form -->
								  <form method="post" action="index.php">
                                    <input type="hidden" name="art_id" value="<?php echo $row['art_id']; ?>">
                                    <button type="submit" name="add_to_cart" class="site-btn btn-line">ADD TO CART</button>

                                </form>
                                <!-- End Add to Cart Form -->
                            </div>
                        </div>
                    </div>
                <?php endwhile;?>
            </div>
            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
                <div class="pagination">
                    <?php if ($page > 1): ?>
                        <a href="?page=<?php echo ($page - 1); ?>&search=<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" class="prev">Previous</a>
                    <?php endif;?>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?page=<?php echo $i; ?>&search=<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" class="<?php echo ($page == $i) ? 'active' : ''; ?>"><?php echo $i; ?></a>
                    <?php endfor;?>
                    <?php if ($page < $totalPages): ?>
                        <a href="?page=<?php echo ($page + 1); ?>&search=<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" class="next">Next</a>
                    <?php endif;?>
                </div>
            <?php endif;?>
        <?php else: ?>
            <p>No results found.</p>
        <?php endif;?>
    </div>
</section>


<!-- Product section end -->



<!-- Footer top section -->
	<section class="footer-top-section home-footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-8 col-sm-12">
					<div class="footer-widget about-widget">
						<img src="img/artibidz-logo.png" class="footer-logo" alt="">
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
							<li><a href="">Track Orders</a></li>
							<li><a href="order_return.php">Returns</a></li>
							<li><a href="#">Jobs</a></li>
							<li><a href="track_delivery.php">Shipping</a></li>
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