<?php
include 'functions.php';

$conn = connectToDatabase();
if (isset($_SESSION['user_id'])) {
	$sql="select profile_pic from user where user_id=$_SESSION[user_id]"; 
	$result = $conn->query($sql);
	$row1=mysqli_fetch_array($result);
}

// Establish database connection
$cn = mysqli_connect("localhost", "root", "", "artibidz") or die("Check connection");

// Check if art_id is provided in the URL
if(isset($_GET['art_id'])) {
    $art_id = $_GET['art_id'];

    // SQL query to fetch art details
    $sqlArtDetails = "SELECT art.*, 
                     (SELECT fname FROM user WHERE user_id = art.user_id) AS artist_name 
                      FROM art 
                      WHERE art.art_id = $art_id";
    
    // Execute the SQL query
    $resultArtDetails = mysqli_query($cn, $sqlArtDetails);
    
    // Fetch the art details and assign it to $artDetails
    $artDetails = mysqli_fetch_assoc($resultArtDetails);
    
    // Fetch images related to the art
    $sqlImages = "SELECT * FROM art_image WHERE art_id = $art_id limit 1";
    $resultImages = mysqli_query($cn, $sqlImages);
}

$sqlFeedback = "SELECT feedback.*, user.username 
                FROM feedback 
                 JOIN user ON feedback.user_id = user.user_id 
                WHERE feedback.art_id = $art_id";
$resultFeedback = mysqli_query($cn, $sqlFeedback);
?>

<!DOCTYPE html>
<html lang="en">
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
			color: #414141;
			font-size: xxx-large;
			position: relative;
			left: 19px;
			bottom: 21px;
			border-bottom: 4px solid #414141;
			border-radius: 4px;
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
			height:55vh;
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
		}

		.dropdown-menu ul li:hover .dropdown-menu-1 {
			display: block;
			position: absolute;
			left: 160px;
			top: 0;
			/* background-color: #64c5b1; */
			background:#00425a;
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

		.categories{
			width:100vw;
			height:100vh;
			border:1px solid black;
		}

        .product-page{
            padding-top:30vh;
        }

        figure .size{
            width:100%;
            height:70vh;
        }

        .site-btn.btn-line:hover {
            /* background: #b09d81; */
            background:#00425a;
            border: 2px solid #00425a;
            color: #fff;
		}

		.feedback{
			display:flex;
			flex-direction: column;
			height: 70vh;
		}

		.feedback h2{
			margin : 5vh 0;
		}

		.feedback .feedback-wrapper{
			padding:1vh 1vw;
			background:#dfdfdf;
			border-radius:2px;
			margin:2vh 0;
		}

		.feedback .feedback-statement{
			padding:1vh 0;
			font-size: large;
    		font-weight: bold;
		}

		.feedback .feedback-date{
			font-size: smaller;
		}

		.feedback .feedback-profile{
			height: 20px;
			width : 20px;
			border-radius : 50%;
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
				<a href="user_profile.php">
					<!-- <div class="user-profile"> -->
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
	<!-- Header section end -->


	<!-- Page Info -->
	<!-- <div class="page-info-section page-info">
		<div class="container">
			<div class="site-breadcrumb">
				<a href="">Home</a> / 
				<a href="">Sales</a> / 
				<a href="">Bags</a> / 
				<span><?php echo strtoupper($artDetails['art_name']); ?></span>
			</div>
			<img src="img/page-info-art.png" alt="" class="page-info-art">
		</div>
	</div> -->
	<!-- Page Info end -->

    <?php if(isset($artDetails)): ?>
	<!-- Page -->
	<div class="page-area product-page spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<figure>
						<!-- <img class="product-big-img" src="img/product/1.jpg" alt=""> -->
                        <?php while($image = mysqli_fetch_assoc($resultImages)): ?>
                <img src="../<?php echo $image['art_image']; ?>" alt="<?php echo $image['art_image']; ?>" onclick="showFullImage('<?php echo $image['art_image']; ?>')" class="size"/>
            <?php endwhile; ?>
                    </figure>
					<!-- <div class="product-thumbs">
						<div class="product-thumbs-track">
							<div class="pt" data-imgbigurl="img/product/1.jpg"><img src="img/product/thumb-1.jpg" alt=""></div>
							<div class="pt" data-imgbigurl="img/product/2.jpg"><img src="img/product/thumb-2.jpg" alt=""></div>
							<div class="pt" data-imgbigurl="img/product/3.jpg"><img src="img/product/thumb-3.jpg" alt=""></div>
							<div class="pt" data-imgbigurl="img/product/4.jpg"><img src="img/product/thumb-4.jpg" alt=""></div>
						</div>
					</div> -->
				</div>
				<div class="col-lg-6">
					<div class="product-content">
						<h2><?php echo strtoupper($artDetails['art_name']); ?></h2>
						<div class="pc-meta">
							<h4 class="price">&#8377;<?php echo $artDetails['art_amt']; ?></h4>
							<!-- <div class="review">
								<div class="rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star is-fade"></i>
								</div>
								<span>(2 reviews)</span>
							</div> -->
						</div>
						<p><?php echo ucfirst($artDetails['art_desc']); ?></p>
						<!-- <div class="color-choose">
							<span>Colors:</span>
							<div class="cs-item">
								<input type="radio" name="cs" id="black-color" checked>
								<label class="cs-black" for="black-color"></label>
							</div>
							<div class="cs-item">
								<input type="radio" name="cs" id="blue-color">
								<label class="cs-blue" for="blue-color"></label>
							</div>
							<div class="cs-item">
								<input type="radio" name="cs" id="yollow-color">
								<label class="cs-yollow" for="yollow-color"></label>
							</div>
							<div class="cs-item">
								<input type="radio" name="cs" id="orange-color">
								<label class="cs-orange" for="orange-color"></label>
							</div>
						</div>
						<div class="size-choose">
							<span>Size:</span>
							<div class="sc-item">
								<input type="radio" name="sc" id="l-size" checked>
								<label for="l-size">L</label>
							</div>
							<div class="sc-item">
								<input type="radio" name="sc" id="xl-size">
								<label for="xl-size">XL</label>
							</div>
							<div class="sc-item">
								<input type="radio" name="sc" id="xxl-size">
								<label for="xxl-size">XXL</label>
							</div>
						</div> -->
						<!-- <a href="#" class="site-btn btn-line">ADD TO CART</a> -->
						<form method="post" action="index.php">
                            <input type="hidden" name="art_id" value="<?php echo $artDetails['art_id']; ?>">
                            <button type="submit" name="add_to_cart" class="site-btn btn-line">ADD TO CART</button>
                        </form>
					</div>
				</div>
			</div>
			<div class="product-details">
				<div class="row">
					<div class="col-lg-10 offset-lg-1">
						<ul class="nav" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="1-tab" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">ARTIST NAME</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="2-tab" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="false">ART DATE</a>
							</li>
							<!-- <li class="nav-item">
								<a class="nav-link" id="3-tab" data-toggle="tab" href="#tab-3" role="tab" aria-controls="tab-3" aria-selected="false">Reviews (0)</a>
							</li> -->
						</ul>
						<div class="tab-content">
							<!-- single tab content -->
							<div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="tab-1">
								<center><h4><?php echo strtoupper($artDetails['artist_name']); ?></h4></center>
							</div>
							<div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="tab-2">
								<center><h4><?php echo $artDetails['art_date']; ?></h4></center>
							</div>

							
							<!-- <div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="tab-3">
								
								</div> -->
							</div>
							
							
							
						</div>
					</div>
				</div>	
			<div class="feedback">
					<h2>Reviews </h2>
						<?php
						// Fetching the art ID from the URL parameter
						if(isset($_GET['art_id'])) {
							$art_id = mysqli_real_escape_string($cn, $_GET['art_id']);
						} else {
							echo "Art ID not provided.";
							exit();
						}
						
						// Fetching feedback from the database for the specified art
						$query = "SELECT f.feedback_id, f.feedback, f.feedback_date, u.username, u.profile_pic 
						FROM feedback f
						INNER JOIN user u ON f.user_id = u.user_id
						WHERE f.art_id = '$art_id'";
						$result = mysqli_query($cn, $query);
						?>
						<?php if(mysqli_num_rows($result) > 0): ?>
							<?php while($row = mysqli_fetch_assoc($result)): ?>
								<div class="feedback-wrapper">
									<div class="feedback-user">
										<img class="feedback-profile" src="../<?php echo $row['profile_pic']; ?>" alt="">
										<span><?php echo ucfirst($row['username']); ?></span>
									</div>
									<div class="feedback-statement">
										<?php echo ucwords($row['feedback']); ?>
									</div>
									<div class="feedback-date">
										<?php 
											// Assuming $row is your fetched row from MySQL

											// Using PHP to format the date
											$feedback_date = date("d-m-Y", strtotime($row['feedback_date']));
											echo $feedback_date;
										?>
									</div>
								</div>
								<?php endwhile; ?>
								<?php else: ?>
									<center>
										<p style="margin-top:20vh; font-size:larger;">No Reviews Yet</p>
									</center>
								<?php endif; ?>					
				</div>
	

	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/mixitup.min.js"></script>
	<script src="js/sly.min.js"></script>
	<script src="js/jquery.nicescroll.min.js"></script>
	<script src="js/main.js"></script>

    <?php endif; ?>
</body>
</html>
