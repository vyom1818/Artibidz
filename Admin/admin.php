<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "artibidz") or die("Check connection");
if(isset($_SESSION['user_id']))
{
    $isadmin="select * from user where user_id= $_SESSION[user_id]";
    $res=mysqli_query($conn,$isadmin);
    $admin=mysqli_fetch_array($res);
    if($admin['user_type']=="admin")
    {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<link href="artibidz-logo.png" rel="shortcut icon"/>
    
    <link rel="stylesheet" href="styleadmin.css">
    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById("mySidebar");
            sidebar.style.width = (sidebar.style.width === "20%") ? "110px" : "20%";
        }
        </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

    <style>

        .main-content{
            background:#f9f9f9;
        }

        .scrollbox{
            overflow: auto;
            padding-right: 10px;
            /* visibility: hidden; */
            height: 67vh;
        }
        
        ::-webkit-scrollbar{
            width: 8px;
        }
        
        ::-webkit-scrollbar-thumb{
            background: #e6e6e6;
            border-radius: 10px;
        }

        .sidebar{
            display: flex;
            flex-direction: column;
            padding: 20px 20px 0 20px;
        }
        
        .body-wrapper{
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
        }

        .logo img{
            margin-top:2vh;
        }
        
        .diagram{
            margin:10vh auto;
            height:40vh
        }
        
        
        #chartContainer {
            margin-top: 20px;
        }
        
        .display-data{
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            height:50vh;
            width:80vw;
            background:#fff;
        }

        .display-data .row1,
        .display-data .row2{
            display:flex;
            justify-content:center;
            align-items:center;
            width:75vw;
            height:20vh;
            box-sizing:border-box;
            margin:2vh 2vw;
        }

        .display-data .row1 .record-wrapper,
        .display-data .row2 .record-wrapper{
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            width:20vw;
            height:15vh;
            background:#64c5b1;
            margin:0 1vw;
            border-radius:5px;
            color:white;
        }

        .display-data .row1 .record-wrapper p,
        .display-data .row2 .record-wrapper p{
            padding:7px;
        }

        .chart-container-diagram canvas{
            background:#fff;
        }

        .chart-container{
            background:white;
            text-align:left;
            height:50vh;
            width:80vw;
        }

        .chart-container h3{
            padding:2vh 1vw;
        }

        #userParticipationChart{
            z-index:1000;
            height:40vh;
        }

        .container{
            max-width: 80vw;
            margin: 0 auto;
            padding: 20px;
            background:#fff;
            margin:5vh auto;
            width:80vw;
        } 

    </style>


</head>
<body>
    <div class="sidebar" id="mySidebar">

        <header>
            <div class="logo">
                <img src="artibidz-logo.png" alt="">
            </div>
            <div class="bar" onclick="toggleSidebar()">
                <i class="fa-sharp fa-solid fa-bars fa-xl"></i>
            </div>
        </header>

        <div class="scrollbox">
            <div class="scrollbox-inner">
                <ul class="menu">
                    <li class="active">
                        <a href="admin.php">
                            <i class="fa-solid fa-house"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="art_show.php">
                            <i class="fa-brands fa-slack"></i>
                            <span>Artifacts</span>
                        </a>
                    </li>
                    <li>
                        <a href="show_bid.php">
                            <i class="fa-solid fa-gavel"></i>
                            <span>Auction</span>
                        </a>
                    </li>
                    <li>
                        <a href="view_order.php">
                            <i class="fa-solid fa-file-pen"></i>
                            <span>Orders</span>
                        </a>
                    </li>
                    <!-- <li>
                        <a href="order_return.php">
                            <i class="fa-solid fa-rotate-left"></i>
                            <span>Order Return</span>
                        </a>
                    </li> -->
                    <li>
                        <a href="city.php">
                            <i class="fa-solid fa-city"></i>
                            <span>City</span>
                        </a>
                    </li>
                    <li>
                        <a href="state.php">
                            <i class="fa-solid fa-location-dot"></i>
                            <span>State</span>
                        </a>
                    </li>
                    <li>
                        <a href="category.php">
                            <i class="fa-solid fa-table-list"></i>
                            <span>Category</span>
                        </a>
                    </li>
                    <li>
                        <a href="sub_category.php">
                            <i class="fa-solid fa-list"></i>
                            <span>Sub-Category</span>
                        </a>
                    </li>
                    <li>
                        <a href="payment.php">
                            <i class="fa-regular fa-credit-card"></i>
                            <span>Payment</span>
                        </a>
                    </li>
                    <li>
                        <a href="shipping.php">
                            <i class="fa-solid fa-truck"></i>
                            <span>Shipping</span>
                        </a>
                    </li>
                    <li>
                        <a href="feedback.php">
                            <i class="fa-regular fa-comment"></i>
                            <span>Feedback</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <footer>
            <ul class="menu">
                <li>
                    <a href="logout.php">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </footer>
    </div>

    <div class="main-content">
        
        <div class="header-wrapper">
            <div class="header-title">
                <h2>Dashboard</h2>
                <span class="path">Artibidz > Dashboard</span>
            </div>
            <div class="user-info">
                <a href="order_report.php" class="report-list">Report List</a>
            </div>
        </div>

        <div class="body-wrapper">

<?php

// Establish database connection


// Count the number of artists
$sqlCountArtists = "SELECT COUNT(*) AS num_artists FROM user WHERE user_type = 'artist'";
$resultCountArtists = mysqli_query($conn, $sqlCountArtists);
$rowCountArtists = mysqli_fetch_assoc($resultCountArtists);
$numArtists = $rowCountArtists['num_artists'];

// Count the number of arts
$sqlCountArts = "SELECT COUNT(*) AS num_arts FROM art";
$resultCountArts = mysqli_query($conn, $sqlCountArts);
$rowCountArts = mysqli_fetch_assoc($resultCountArts);
$numArts = $rowCountArts['num_arts'];

// Function to get the client IP address
function getIPAddress() {
    // Whether IP is from the remote address
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    // Whether IP is from the forwarded address
    elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    // Whether IP is from the remote address
    else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// File to store visitor data
$visitorFile = 'visitor_data.txt';

// Check if the file exists, if not create it
if (!file_exists($visitorFile)) {
    $handle = fopen($visitorFile, 'w');
    fclose($handle);
}

// Read the current visitor data from the file
$currentData = file_get_contents($visitorFile);

// Get the client IP address
$visitorIP = getIPAddress();

// Check if the visitor's IP address is already recorded
if (strpos($currentData, $visitorIP) === false) {
    // Increment the visitor count and append new visitor's IP address
    $currentData .= $visitorIP . "\n";
    
    // Write the updated data back to the file
    file_put_contents($visitorFile, $currentData);
}

// Count the number of users
$sqlCountUsers = "SELECT COUNT(*) AS num_users FROM user";
$resultCountUsers = mysqli_query($conn, $sqlCountUsers);
$rowCountUsers = mysqli_fetch_assoc($resultCountUsers);
$numUsers = $rowCountUsers['num_users'];

// Count the number of customer
$sqlCountUsers = "SELECT COUNT(*) AS num_users FROM user WHERE user_type = 'customer'";
$resultCountUsers = mysqli_query($conn, $sqlCountUsers);
$rowCountUsers = mysqli_fetch_assoc($resultCountUsers);
$numcustomer = $rowCountUsers['num_users'];

// Query to count the total number of orders
$sqlTotalOrders = "SELECT COUNT(*) AS total_orders FROM orders";
$resultTotalOrders = mysqli_query($conn, $sqlTotalOrders);
$rowTotalOrders = mysqli_fetch_assoc($resultTotalOrders);
$totalOrders = $rowTotalOrders['total_orders'];

// Query to count the number of completed orders
$sqlCompletedOrders = "SELECT COUNT(*) AS completed_orders FROM shipping WHERE ship_status = 'Completed'";
$resultCompletedOrders = mysqli_query($conn, $sqlCompletedOrders);
$rowCompletedOrders = mysqli_fetch_assoc($resultCompletedOrders);
$completedOrders = $rowCompletedOrders['completed_orders'];

// Query to count the number of pending orders
$sqlPendingOrders = "SELECT COUNT(*) AS pending_orders FROM shipping WHERE ship_status = 'Pending'";
$resultPendingOrders = mysqli_query($conn, $sqlPendingOrders);
$rowPendingOrders = mysqli_fetch_assoc($resultPendingOrders);
$pendingOrders = $rowPendingOrders['pending_orders'];

// Query to count the number of orders per year
$sqlOrdersPerYear = "SELECT YEAR(order_date) AS year, COUNT(*) AS num_orders 
                     FROM orders 
                     GROUP BY YEAR(order_date) 
                     ORDER BY YEAR(order_date) DESC"; // Order by year in descending order
$resultOrdersPerYear = mysqli_query($conn, $sqlOrdersPerYear);
$ordersPerYear = array();
while ($row = mysqli_fetch_assoc($resultOrdersPerYear)) {
    $ordersPerYear[$row['year']] = $row['num_orders'];
}

// Query to count the number of users participating in auctions
$sqlUsersInAuction = "SELECT COUNT(DISTINCT user_id) AS users_in_auction FROM bid";
$resultUsersInAuction = mysqli_query($conn, $sqlUsersInAuction);
$rowUsersInAuction = mysqli_fetch_assoc($resultUsersInAuction);
$usersInAuction = $rowUsersInAuction['users_in_auction'];

// Query to count the number of users participating in sales
$sqlUsersInSale = "SELECT COUNT(DISTINCT user_id) AS users_in_sale FROM art";
$resultUsersInSale = mysqli_query($conn, $sqlUsersInSale);
$rowUsersInSale = mysqli_fetch_assoc($resultUsersInSale);
$usersInSale = $rowUsersInSale['users_in_sale'];

// Query to retrieve monthly user participation data in auctions
$sqlMonthlyAuctionParticipation = "SELECT MONTH(start_bid_date) AS month, COUNT(DISTINCT user_id) AS users_in_auction 
                                   FROM bid
                                   GROUP BY MONTH(start_bid_date)";

$resultMonthlyAuctionParticipation = mysqli_query($conn, $sqlMonthlyAuctionParticipation);

// Query to retrieve monthly user participation data in sales
$sqlMonthlySaleParticipation = "SELECT MONTH(art_date) AS month, COUNT(DISTINCT user_id) AS users_in_sale 
                                FROM art
                                GROUP BY MONTH(art_date)";

$resultMonthlySaleParticipation = mysqli_query($conn, $sqlMonthlySaleParticipation);

// Query to retrieve yearly user participation data in auctions
$sqlYearlyAuctionParticipation = "SELECT YEAR(start_bid_date) AS year, COUNT(DISTINCT user_id) AS users_in_auction 
                                  FROM bid
                                  GROUP BY YEAR(start_bid_date)";

$resultYearlyAuctionParticipation = mysqli_query($conn, $sqlYearlyAuctionParticipation);

// Query to retrieve yearly user participation data in sales
$sqlYearlySaleParticipation = "SELECT YEAR(art_date) AS year, COUNT(DISTINCT user_id) AS users_in_sale 
                               FROM art
                               GROUP BY YEAR(art_date)";

$resultYearlySaleParticipation = mysqli_query($conn, $sqlYearlySaleParticipation);

?>

    <div class="display-data">
        <div class="row1">

            <div class="record-wrapper">
                <p class="record-title">Total Number of Users</p>
                <p class="record-title"><?php echo $numUsers; ?></p>        
            </div>
            
            <div class="record-wrapper">
                <p class="record-title">Total Number of Customers</p>
                <p class="record-title"><?php echo $numcustomer; ?></p>
            </div>
            
            <div class="record-wrapper">
                <p class="record-title">Total Number of Artists</p>
                <p class="record-title"><?php echo $numArtists; ?></p>
            </div>
            
            <div class="record-wrapper">
                <p class="record-title">Total Number of New Visitors</p>
                <p class="record-title"><?php echo substr_count($currentData, "\n"); ?></p>
            </div>
        </div>
    
        <div class="row2">

            <div class="record-wrapper">
                <p class="record-title">Total Orders</p>
                <p class="record-title"><?php echo $totalOrders; ?></p>
            </div>
            
            <div class="record-wrapper">
                <p class="record-title">Completed Orders</p>
                <p class="record-title"><?php echo $completedOrders; ?></p>
            </div>
            
            <div class="record-wrapper">
                <p class="record-title">Pending Orders</p>
                <p class="record-title"><?php echo $pendingOrders; ?></p>
            </div>
            
            <div class="record-wrapper">
                <p class="record-title">Total Number of Arts</p>
                <p class="record-title"><?php echo $numArts; ?></p>
            </div>
        </div>
    </div> 
    
    <div class="chart-container diagram">
        <!-- <h3>User Participation Statistics</h3> -->
        <canvas style="height: 300px; width: 100%;" id="userParticipationChart"></canvas>
    </div>

    
    <div class="container">
        <h3>Monthly Active Users</h3>
        <canvas id="monthlyChart" style="height: 300px; width: 100%;"></canvas>
    </div>
    
    <div class="container">
        <h3>Yearly Active Users</h3>
        <canvas id="myChart" style="height: 300px; width: 100%;"></canvas>
    </div>

<?php
// Query to count the total number of users participating in auctions
$sqlUsersInAuction = "SELECT COUNT(DISTINCT user_id) AS users_in_auction FROM bid";
$resultUsersInAuction = mysqli_query($conn, $sqlUsersInAuction);
$rowUsersInAuction = mysqli_fetch_assoc($resultUsersInAuction);
$usersInAuction = $rowUsersInAuction['users_in_auction'];

// Query to count the total number of users participating in sales
$sqlUsersInSale = "SELECT COUNT(DISTINCT user_id) AS users_in_sale FROM art";
$resultUsersInSale = mysqli_query($conn, $sqlUsersInSale);
$rowUsersInSale = mysqli_fetch_assoc($resultUsersInSale);
$usersInSale = $rowUsersInSale['users_in_sale'];

// Prepare data for Chart.js
$userParticipationData = [
    'Users in Auction' => $usersInAuction,
    'Users in Sale' => $usersInSale
];

// Encode data into JSON format
$userParticipationJSON = json_encode($userParticipationData);
// $conn->close()
?>

<?php

// Initialize arrays to hold monthly sales and auctions data
$monthlySalesData = [];
$monthlyAuctionsData = [];

// Loop through months 1 to 12
for ($month = 1; $month <= 12; $month++) {
    // Query to fetch monthly active users in sales for the current month
    $sales_query = "
    SELECT COUNT(DISTINCT o.user_id) AS sales_users
    FROM orders o
    JOIN order_details od ON o.order_id = od.order_id
    JOIN art a ON od.art_id = a.art_id
    WHERE a.sale_or_auction = 'sale' AND MONTH(o.order_date) = $month
    ";

    // Query to fetch monthly active users in auctions for the current month
    $auctions_query = "
    SELECT COUNT(DISTINCT o.user_id) AS auction_users
    FROM orders o
    JOIN order_details od ON o.order_id = od.order_id
    JOIN art a ON od.art_id = a.art_id
    WHERE a.sale_or_auction = 'auction' AND MONTH(o.order_date) = $month
    ";

    $sales_result = $conn->query($sales_query);
    $auctions_result = $conn->query($auctions_query);

    // Fetch data for sales
    if ($sales_result && $sales_result->num_rows > 0) {
        $sales_row = $sales_result->fetch_assoc();
        $monthlySalesData[] = ['month' => $month, 'sales_users' => $sales_row['sales_users']];
    } else {
        $monthlySalesData[] = ['month' => $month, 'sales_users' => 0];
    }

    // Fetch data for auctions
    if ($auctions_result && $auctions_result->num_rows > 0) {
        $auctions_row = $auctions_result->fetch_assoc();
        $monthlyAuctionsData[] = ['month' => $month, 'auction_users' => $auctions_row['auction_users']];
    } else {
        $monthlyAuctionsData[] = ['month' => $month, 'auction_users' => 0];
    }
}



// Encode the monthly sales and auctions data into JSON format
"var monthlySalesData = " . json_encode($monthlySalesData) . ";\n";
"var monthlyAuctionsData = " . json_encode($monthlyAuctionsData) . ";\n";
?>

<?php
// Initialize an array to hold the sales data for each year
$sales_data = array();

// Initialize an array to hold the auctions data for each year
$auctions_data = array();

// Loop through years from 2019 to 2024
for ($year = 2019; $year <= 2024; $year++) {
    // Query to fetch yearly active users in sales for the current year
    $sales_query = "
        SELECT COUNT(DISTINCT o.user_id) AS sales_users
        FROM orders o
        JOIN order_details od ON o.order_id = od.order_id
        JOIN art a ON od.art_id = a.art_id
        WHERE a.sale_or_auction = 'sale' AND YEAR(o.order_date) = $year
    ";

    // Query to fetch yearly active users in auctions for the current year
    $auctions_query = "
        SELECT COUNT(DISTINCT o.user_id) AS auction_users
        FROM orders o
        JOIN order_details od ON o.order_id = od.order_id
        JOIN art a ON od.art_id = a.art_id
        WHERE a.sale_or_auction = 'auction' AND YEAR(o.order_date) = $year
    ";

    // Execute the queries
    $sales_result = $conn->query($sales_query);
    $auctions_result = $conn->query($auctions_query);

    // Fetch data for sales
    $sales_row = $sales_result->fetch_assoc();
    $sales_users = isset($sales_row['sales_users']) ? $sales_row['sales_users'] : 0;
    $sales_data[] = array('year' => $year, 'sales_users' => $sales_users);

    // Fetch data for auctions
    $auctions_row = $auctions_result->fetch_assoc();
    $auction_users = isset($auctions_row['auction_users']) ? $auctions_row['auction_users'] : 0;
    $auctions_data[] = array('year' => $year, 'auction_users' => $auction_users);
}

"var salesData = " . json_encode($sales_data) . ";\n";
"var auctionsData = " . json_encode($auctions_data) . ";\n";

?>
        </div>
    </div>

<script>
    // // Get data for the pie chart
    // const userParticipationData = <?php echo $userParticipationJSON; ?>;

    // // Prepare data for Chart.js
    // const labels = Object.keys(userParticipationData);
    // const values = Object.values(userParticipationData);

    // // Get canvas element for the pie chart
    // const ctxUserParticipationChart = document.getElementById('userParticipationChart').getContext('2d');

    // // Create pie chart
    // const userParticipationChart = new Chart(ctxUserParticipationChart, {
    //     type: 'pie',
    //     data: {
    //         labels: labels,
    //         datasets: [{
    //             data: values,
    //             backgroundColor: ['red', '#32857496'] // Colors for each section
    //         }]
    //     },
    //     options: {
    //         responsive: true,
    //         maintainAspectRatio: false
    //     }
    // });
</script>

<script>
    // Get data for the pie chart
    const userParticipationData = <?php echo $userParticipationJSON; ?>;

    // Prepare data for Chart.js
    const labels = Object.keys(userParticipationData);
    const values = Object.values(userParticipationData);

    // Get canvas element for the pie chart
    const ctxUserParticipationChart = document.getElementById('userParticipationChart').getContext('2d');

    // Create pie chart
    const userParticipationChart = new Chart(ctxUserParticipationChart, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                data: values,
                backgroundColor: ['red', '#32857496'] // Colors for each section
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false // Prevents the chart from maintaining aspect ratio
        }
    });
</script>


<script>
    // Extracted data from PHP script
    var monthlySalesData = <?php echo json_encode($monthlySalesData); ?>;
    var monthlyAuctionsData = <?php echo json_encode($monthlyAuctionsData); ?>;

    // Extract months and users for sales and auctions
    var months = [];
    var salesUsers = [];
    var auctionUsers = [];

    // Populate arrays with data
    monthlySalesData.forEach(function(item) {
        months.push(item.month);
        salesUsers.push(item.sales_users);
    });

    monthlyAuctionsData.forEach(function(item) {
        auctionUsers.push(item.auction_users);
    });

    // Create a grouped bar chart for monthly active users
    var ctxMonthlySalesAndAuctions = document.getElementById('monthlyChart').getContext('2d');
    var monthlyChart = new Chart(ctxMonthlySalesAndAuctions, {
        type: 'bar',
        data: {
            labels: months, // Use months as labels
            datasets: [{
                label: 'Users in Sales',
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                data: salesUsers
            }, {
                label: 'Users in Auction',
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                data: auctionUsers
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

<script>
    // Extracted data from PHP script
    var salesData = <?php echo json_encode($sales_data); ?>;
    var auctionsData = <?php echo json_encode($auctions_data); ?>;

    // Create arrays to hold the data for each year
    var years = [];
    var salesUsers = [];
    var auctionUsers = [];

    // Loop through the years from 2019 to 2024
    for (var year = 2019; year <= 2024; year++) {
        // Check if there is data available for the current year
        var salesDataForYear = salesData.find(item => item.year == year);
        var auctionsDataForYear = auctionsData.find(item => item.year == year);

        // If data exists for the current year, push it to the respective arrays
        if (salesDataForYear) {
            years.push(year);
            salesUsers.push(salesDataForYear.sales_users);
        } else {
            // If no data exists for the current year, push 0 as placeholder
            years.push(year);
            salesUsers.push(0);
        }

        if (auctionsDataForYear) {
            auctionUsers.push(auctionsDataForYear.auction_users);
        } else {
            auctionUsers.push(0);
        }
    }

    // Create a grouped bar chart
    var ctxSalesAndAuctions = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctxSalesAndAuctions, {
        type: 'bar',
        data: {
            labels: years,
            datasets: [{
                label: 'Users in Sales',
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                data: salesUsers
            }, {
                label: 'Users in Auction',
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                data: auctionUsers
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]  
            }
        }
    });
</script>


</body>
</html>
<?php
    }
    else{
        echo "<script>alert('You Can\'t access this...You are not admin..Please login as a admin!!!')</script>";
        echo "<script>window.location.href = '../Login/login.php';</script>";
    }
}
else{
    echo "<script>alert('You are not logged in...Please login...')</script>";
    echo "<script>window.location.href = '../Login/login.php';</script>";
}
?>