<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styletable.css">
    <link href="artibidz-logo.png" rel="shortcut icon"/>
    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById("mySidebar");
            sidebar.style.width = (sidebar.style.width === "20%") ? "110px" : "20%";
        }
    </script>    
<style>
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

.logo img{
    margin-top:2vh;
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
                <li>
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
            <li class="active">
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
                    <a href="../login/login.php">
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
                <h2>Auction</h2>
                <span class="path">Artibidz > Dashboard > Auction</span>
            </div>
            <div class="user-info">
                <a href="order_report.php" class="report-list">Report List</a>
            </div>
        </div>
    
        <div class="body-wrapper">

            
            
<?php
$conn=mysqli_connect("localhost","root","","artibidz") or die("check connection");
$sql = "SELECT bid.bid_id, art.art_name, bid.start_bid_amt, bid.start_bid_date, bid.end_bid_date, user.username, bid.bid_amt
        FROM bid
        INNER JOIN art ON bid.art_id = art.art_id
        INNER JOIN user ON bid.user_id = user.user_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Display the table header
    echo "<div class='table-wrapper'>
    <table class='fl-table'>
        <thead>
        <tr>
            <th>Bid ID</th>
            <th>Art Name</th>
            <th>Start Bid Amount</th>
            <th>Start Bid Date</th>
            <th>End Bid Date</th>
                <th>User Name</th>
                <th>Bid Amount</th>
        </tr>
        </thead>";
                
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                    <tbody>
                        <td>" . $row["bid_id"] . "</td>
                        <td>" . $row["art_name"] . "</td>
                        <td>" . $row["start_bid_amt"] . "</td>
                        <td>" . $row["start_bid_date"] . "</td>
                        <td>" . $row["end_bid_date"] . "</td>
                        <td>" . $row["username"] . "</td>
                        <td>" . $row["bid_amt"] . "</td>
                    </tr>
                    </tbody>";
            }
            
            // Close the table
            echo "</table>";
            echo "</div>";
        } else {
    echo "0 results";
}

// Close the database connection
$conn->close();
?>

</div>
</div>
</body>
</html>