<?php
// Add this at the top of your index.php file, before the <!DOCTYPE html> declaration
// Replace 'your_database_host', 'your_database_username', 'your_database_password', and 'your_database_name' with your actual database credentials

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "artibidz";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle search
if(isset($_GET['search'])){
    $search = $_GET['search'];
    $sql = "SELECT art.art_id, art.art_name, art.art_amt, art_image.art_image
	FROM art
	INNER JOIN sub_category ON art.sub_cat_id = sub_category.sub_cat_id
	INNER JOIN category ON sub_category.cat_id = category.cat_id
	INNER JOIN art_image ON art.art_id = art_image.art_id
	WHERE category.cat_name LIKE '%$search%' 
	   OR sub_category.sub_cat_name LIKE '%$search%'
	   OR art.art_name LIKE '%$search%'
	GROUP BY art.art_id";
    $result = $conn->query($sql);
}
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
	<li>
    <div class="dropdown mt-3">
        <button class="dropdown-toggle dd" type="button" data-bs-toggle="dropdown" id="category-dropdown">
            Category
        </button>
        <ul class="dropdown-menu" aria-labelledby="category-dropdown">
            <?php
            // Fetch categories from the database
            $categoryQuery = "SELECT * FROM category";
            $categoryResult = $conn->query($categoryQuery);

            if ($categoryResult->num_rows > 0) {
                while ($categoryRow = $categoryResult->fetch_assoc()) {
                    $categoryId = $categoryRow['cat_id'];
                    $categoryName = $categoryRow['cat_name'];
                    ?>
                    <li class="ddi">
                        <a class="dropdown-item dda" href="#" onclick="getSubcategories(<?php echo $categoryId; ?>)">
                            <?php echo $categoryName; ?>
                        </a>
                        <!-- Subcategory dropdown -->
                        <ul class="dropdown-menu subcategory-dropdown" id="subcategory-dropdown-<?php echo $categoryId; ?>"></ul>
                    </li>
                <?php }
            } else {
                echo "<li>No categories found</li>";
            }
            ?>
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

	
	<!-- Intro section -->
	<!-- <section class="intro-section spad pb-0">
		<div class="section-title">
			<h2>pemium products</h2>
			<p>We recommend</p>
		</div>
		<div class="intro-slider">
			<ul class="slidee">
				<li>
					<div class="intro-item">
						<figure>
							<img src="img/intro/1.jpg" alt="#">
						</figure>
						<div class="product-info">
							<h5>Pink Sunglasses</h5>
							<p>$319.50</p>
							<a href="#" class="site-btn btn-line">ADD TO CART</a>
						</div>
					</div>
				</li>
				<li>
					<div class="intro-item">
						<figure>
							<img src="img/intro/2.jpg" alt="#">
						</figure>
						<div class="product-info">
							<h5>Black Nighty</h5>
							<p>$319.50</p>
							<a href="#" class="site-btn btn-line">ADD TO CART</a>
						</div>
					</div>
				</li>
				<li>
					<div class="intro-item">
						<figure>
							<img src="img/intro/3.jpg" alt="#">
							<div class="bache">NEW</div>
						</figure>
						<div class="product-info">
							<h5>Yellow Sholder bag</h5>
							<p>$319.50</p>
							<a href="#" class="site-btn btn-line">ADD TO CART</a>
						</div>
					</div>
				</li>
				<li>
					<div class="intro-item">
						<figure>
							<img src="img/intro/4.jpg" alt="#">
						</figure>
						<div class="product-info">
							<h5>Yellow Sunglasses</h5>
							<p>$319.50</p>
							<a href="#" class="site-btn btn-line">ADD TO CART</a>
						</div>
					</div>
				</li>
				<li>
					<div class="intro-item">
						<figure>
							<img src="img/intro/5.jpg" alt="#">
						</figure>
						<div class="product-info">
							<h5>Black Sholder bag</h5>
							<p>$319.50</p>
							<a href="#" class="site-btn btn-line">ADD TO CART</a>
						</div>
					</div>
				</li>
			</ul>
		</div>
		<div class="container">
			<div class="scrollbar">
				<div class="handle">
					<div class="mousearea"></div>
				</div>
			</div>
		</div>
	</section> -->
	<!-- Intro section end -->


	<!-- Featured section -->
	<!-- <div class="featured-section spad">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="featured-item">
						<img src="img/featured/featured-1.jpg" alt="">
						<a href="#" class="site-btn">see more</a>
					</div>
				</div>
				<div class="col-md-6">
					<div class="featured-item mb-0">
						<img src="img/featured/featured-2.jpg" alt="">
						<a href="#" class="site-btn">see more</a>
					</div>
				</div>
			</div>
		</div>
	</div> -->
	<!-- Featured section end -->


<!-- Product section -->
<section class="product-section spad">
    <div class="container">
        <?php if(isset($result) && $result->num_rows > 0): ?>
            <div class="row" id="product-filter">
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="mix col-lg-3 col-md-6 best">
                        <div class="product-item">
                            <figure>
                                <img src="../<?php echo $row['art_image']; ?>" alt="">
                                <div class="pi-meta">
                                    <div class="pi-m-left">
                                        <img src="img/icons/eye.png" alt="">
                                        <p>quick view</p>
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
                                <a href="#" class="site-btn btn-line">ADD TO CART</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p>No results found.</p>
        <?php endif; ?>
    </div>
</section>
<!-- Product section end -->



	<!-- Blog section -->	
	<!-- <section class="blog-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-5">
					<div class="featured-item">
						<img src="img/featured/featured-3.jpg" alt="">
						<a href="#" class="site-btn">see more</a>
					</div>
				</div>
				<div class="col-lg-7">
					<h4 class="bgs-title">from the blog</h4>
					<div class="blog-item">
						<div class="bi-thumb">
							<img src="img/blog-thumb/1.jpg" alt="">
						</div>
						<div class="bi-content">
							<h5>10 tips to dress like a queen</h5>
							<div class="bi-meta">July 02, 2018   |   By maria deloreen</div>
							<a href="#" class="readmore">Read More</a>
						</div>
					</div>
					<div class="blog-item">
						<div class="bi-thumb">
							<img src="img/blog-thumb/2.jpg" alt="">
						</div>
						<div class="bi-content">
							<h5>Fashion Outlet products</h5>
							<div class="bi-meta">July 02, 2018   |   By Jessica Smith</div>
							<a href="#" class="readmore">Read More</a>
						</div>
					</div>
					<div class="blog-item">
						<div class="bi-thumb">
							<img src="img/blog-thumb/3.jpg" alt="">
						</div>
						<div class="bi-content">
							<h5>the little black dress just for you</h5>
							<div class="bi-meta">July 02, 2018   |   By maria deloreen</div>
							<a href="#" class="readmore">Read More</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> -->
	<!-- Blog section end -->	


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

		<!-- Footer section -->
	<footer class="footer-section">
		<div class="container">
			<p class="copyright">
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
<!-- Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> -->
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
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
	<script>
	function getSubcategories(categoryId) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("subcategory-dropdown-" + categoryId).innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "get_subcategories.php?category_id=" + categoryId, true);
        xhttp.send();
    }

</script>
</body>
</html>	