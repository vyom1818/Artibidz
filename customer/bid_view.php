<?php
session_start();

// Establish database connection
$conn = mysqli_connect("localhost", "root", "", "artibidz") or die("Check connection");

if (isset($_SESSION['user_id'])) {
    $sql="select profile_pic from user where user_id=$_SESSION[user_id]"; 
    $result = $conn->query($sql);
    $row1=mysqli_fetch_array($result);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['bid_amt']) && isset($_POST['art_id'])) {
    $bid_amt = $_POST['bid_amt'];
    $art_id = $_POST['art_id'];
    $user_id = $_SESSION['user_id'];

    // Get the current bid amount
    $getCurrentBid = "SELECT bid_amt FROM bid WHERE art_id = $art_id ORDER BY bid_id DESC LIMIT 1";
    $resultCurrentBid = mysqli_query($conn, $getCurrentBid);
    $currentBid = ($resultCurrentBid->num_rows > 0) ? $resultCurrentBid->fetch_assoc()['bid_amt'] : null;

    // Check if the selected bid amount is the same as the current bid amount
    if ($currentBid !== null && $currentBid == $bid_amt) {
        echo "<script>alert('You cannot place the same bid as the current bid.');</script>";
    } else {
        // Proceed with inserting the bid
        // Get art details to use in the bid record
        $getArtDetails = "SELECT art_amt, art_date FROM art WHERE art_id = $art_id";
        $resultArtDetails = mysqli_query($conn, $getArtDetails);
        $artDetails = mysqli_fetch_assoc($resultArtDetails);

        $start_bid_amt = $artDetails['art_amt'];
        $start_bid_date = $artDetails['art_date'];
        $end_bid_date = date('Y-m-d', strtotime($start_bid_date . ' + 7 days'));

        $insertBidQuery = "INSERT INTO bid (art_id, start_bid_amt, start_bid_date, end_bid_date, user_id, bid_amt) 
                            VALUES ('$art_id', '$start_bid_amt', '$start_bid_date', '$end_bid_date', '$user_id', '$bid_amt')";

        if (mysqli_query($conn, $insertBidQuery)) {
            echo "<script>alert('Bid added successfully');</script>";
        } else {
            echo "Error adding bid: " . mysqli_error($conn);
        }
    }
}

if (isset($_POST['art_id'])) {
    $art_id = $_POST['art_id'];

    // SQL query to fetch art details
    $sqlArtDetails = "SELECT art.*, 
                     (SELECT fname FROM user WHERE user_id = art.user_id) AS artist_name 
                      FROM art 
                      WHERE art.art_id = $art_id";
    
    // Execute the SQL query
    $resultArtDetails = mysqli_query($conn, $sqlArtDetails);
    
    // Fetch the art details and assign it to $artDetails
    $artDetails = mysqli_fetch_assoc($resultArtDetails);

    // Fetch images related to the art
    $sqlImages = "SELECT * FROM art_image WHERE art_id = $art_id limit 1";
    $resultImages = mysqli_query($conn, $sqlImages);

    // Calculate end bid date (start bid date + 7 days)
    $start_bid_date = new DateTime($artDetails['art_date']);
    $end_bid_date = $start_bid_date->modify('+7 days')->format('Y-m-d');
    $artDetails['end_bid_date'] = $end_bid_date;

    // Check if the bid timer has ended
    $endBidDate = new DateTime($artDetails['end_bid_date']);
    $currentDate = new DateTime();
    if ($currentDate > $endBidDate) {
        // Get the user who placed the highest bid
        $highestBidQuery = "SELECT user_id FROM bid WHERE art_id = {$artDetails['art_id']} ORDER BY bid_amt DESC LIMIT 1";
        $resultHighestBid = mysqli_query($conn, $highestBidQuery);
        $highestBidUserId = ($resultHighestBid->num_rows > 0) ? $resultHighestBid->fetch_assoc()['user_id'] : null;

        if ($highestBidUserId !== null) {
            // Check if the art is not already in the cart of the user
            $checkCartQuery = "SELECT * FROM cart WHERE art_id = {$artDetails['art_id']} AND user_id = $highestBidUserId";
            $resultCheckCart = mysqli_query($conn, $checkCartQuery);
            $getHighestBidderNameQuery = "SELECT fname FROM user WHERE user_id = $highestBidUserId";
            $resultHighestBidderName = mysqli_query($conn, $getHighestBidderNameQuery);
            $highestBidderName = ($resultHighestBidderName->num_rows > 0) ? $resultHighestBidderName->fetch_assoc()['fname'] : null;
            if ($resultCheckCart->num_rows == 0) {
                // Update the art_amt with the highest bid amount
                $updateArtAmtQuery = "UPDATE art SET art_amt = (SELECT bid_amt FROM bid WHERE art_id = {$artDetails['art_id']} ORDER BY bid_amt DESC LIMIT 1) WHERE art_id = {$artDetails['art_id']}";
                if (mysqli_query($conn, $updateArtAmtQuery)) {
                    // Add the art to the cart of the user
                    $addToCartQuery = "INSERT INTO cart (art_id, user_id, cart_art_qty) VALUES ({$artDetails['art_id']}, $highestBidUserId, 1)";
                    if (mysqli_query($conn, $addToCartQuery)) {
                        echo "<script>alert('$highestBidderName won this art!!!');</script>";
                    } else {
                        echo "Error adding to cart: " . mysqli_error($conn);
                    }
                } else {
                    echo "Error updating art_amt: " . mysqli_error($conn);
                }
            } else {
                echo "<script>alert('Art is already in $highestBidderName's cart!!!');</script>";
            }
        } else {
            echo "<script>alert('No bids found for this art.');</script>";
        }
        // Display alert to the user
        echo "<script>alert('Bid for this art is closed.');</script>";
        // Redirect the user to the auction page
        echo "<script>window.location.href = 'auction.php';</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>    
<title>Artibidz</title>
	<meta charset="UTF-8">
	<meta name="description">
	<meta name="keywords">
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

        select{
            height: 7vh;
            width: 15vw;
            text-align: center;
        }

        button {
            height: 7vh;
            width: 7vw;
            background: #00425a;
            color: #fff;
            border: none;
            border-radius: 3px;
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
                <!-- <span>2</span> -->
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


    
 <!-- Your HTML content here -->
 <?php if(isset($artDetails)): ?>
<div class="page-area product-page spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <figure>
                    <?php while($image = mysqli_fetch_assoc($resultImages)): ?>
                    <img src="../<?php echo $image['art_image']; ?>" alt="<?php echo $image['art_image']; ?>" onclick="showFullImage('<?php echo $image['art_image']; ?>')" class="size"/>
                    <?php endwhile; ?>
                </figure>
            </div>
            <div class="col-lg-6">
                <div class="product-content">
                    <h2><?php echo strtoupper($artDetails['art_name']); ?></h2>
                    <div class="pc-meta">
                        <h4 class="price">&#8377;<?php echo $artDetails['art_amt']; ?></h4>
                        <?php
                            $bidCountQuery = "SELECT COUNT(*) AS bid_count FROM bid WHERE art_id = {$artDetails['art_id']}";
                            $bidCountResult = $conn->query($bidCountQuery);
                            $bidCount = ($bidCountResult->num_rows > 0) ? $bidCountResult->fetch_assoc()['bid_count'] : 0;
                        ?>
                    </div>
                    <p><?php echo ucfirst($artDetails['art_desc']); ?></p>
                    <p><?php echo $bidCount; ?> Bids Placed</p>
                    <div id="timer"></div>
                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                        <select name="bid_amt" id="bid_amt">
                            <?php
                            $latestBid = "SELECT bid_amt FROM bid WHERE art_id = {$artDetails['art_id']} ORDER BY bid_id DESC LIMIT 1";
                            $resultLatestBid = $conn->query($latestBid);
                            $latestBidAmt = ($resultLatestBid->num_rows > 0) ? $resultLatestBid->fetch_assoc()['bid_amt'] : $artDetails['art_amt'];

                            echo "<option value='{$latestBidAmt}'>Current Bid: &#8377;{$latestBidAmt}</option>";

                            $increment = ($artDetails['art_amt'] > 20000) ? 2000 : 1000;

                            for ($i = $latestBidAmt + $increment; $i <= 100000; $i += $increment) {
                                echo "<option value='{$i}'>Bid: &#8377;{$i}</option>";
                            }
                            ?>
                        </select>
                        <input type="hidden" name="art_id" value="<?php echo $artDetails['art_id']; ?>">
                        <button type="submit">ADD BID</button>
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
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="tab-1">
                            <center><h4><?php echo strtoupper($artDetails['artist_name']); ?></h4></center>
                        </div>
                        <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="tab-2">
                            <center><h4><?php echo $artDetails['art_date']; ?></h4></center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/mixitup.min.js"></script>
	<script src="js/sly.min.js"></script>
	<script src="js/jquery.nicescroll.min.js"></script>
	<script src="js/main.js"></script>
	<script>
// Set the date we're counting down to
var countDownDate = new Date("<?php echo $artDetails['end_bid_date']; ?>").getTime();

// Update the countdown every 1 second
var x = setInterval(function() {
    // Get the current date and time
    var now = new Date().getTime();

    // Calculate the remaining time
    var distance = countDownDate - now;

    // Calculate days, hours, minutes, and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Display the countdown timer
    document.getElementById("timer").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s";

    // If the countdown is over, display a message
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("timer").innerHTML = "Bid Closed";
    }
}, 1000);
</script>
</body>
</html>
