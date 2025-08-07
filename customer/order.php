<!DOCTYPE html>
<?php
session_start();
$cn = mysqli_connect("localhost", "root", "", "artibidz") or die("Check connection");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Assuming user_id is set in the session
$user_id = $_SESSION['user_id'];

// Fetch user details from the database based on the user_id
$sqlUser = "SELECT * FROM user WHERE user_id = $user_id";
$resultUser = mysqli_query($cn, $sqlUser);

// Check if the user exists
if (mysqli_num_rows($resultUser) == 1) {
    // Fetch orders along with their details from multiple tables
    $query = "SELECT 
    o.order_id, 
    o.order_date, 
    o.total_amt, 
    (SELECT GROUP_CONCAT(od.order_art_qty) FROM order_details od WHERE od.order_id = o.order_id) as order_art_qty,
    (SELECT GROUP_CONCAT(a.art_name) FROM art a WHERE a.art_id IN (SELECT od.art_id FROM order_details od WHERE od.order_id = o.order_id)) as art_name,
    (SELECT GROUP_CONCAT(ai.art_image) FROM art_image ai WHERE ai.art_id IN (SELECT od.art_id FROM order_details od WHERE od.order_id = o.order_id)) as art_image,
    (SELECT GROUP_CONCAT(s.ship_status) FROM shipping s WHERE s.order_id = o.order_id) as ship_status,
    (SELECT GROUP_CONCAT(s.delivery_date) FROM shipping s WHERE s.order_id = o.order_id) as delivery_date,
    (SELECT GROUP_CONCAT(od.art_id) FROM order_details od WHERE od.order_id = o.order_id) as art_id
FROM 
    orders o
WHERE 
    o.order_id IN (SELECT DISTINCT order_id FROM orders WHERE user_id = $user_id)";

    // Check if from-date and to-date are set
    if (isset($_POST['from-date']) && isset($_POST['to-date'])) {
        $fromDate = $_POST['from-date'];
        $toDate = $_POST['to-date'];
        $query .= " AND o.order_date BETWEEN '$fromDate' AND '$toDate'";
    }

    $result = mysqli_query($cn, $query);?>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artibidz</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styletable.css">
    <link href="img/artibidz-logo.png" rel="shortcut icon"/>
    <style>
    .logo img{
        margin-top:2vh;
    }
    .body-wrapper{
        flex-direction:column;
    }
    button{
        background:none;

    }
    button:hover{
        cursor:pointer;
    }
    body{
        height:100vh;
    }
    .filter-wrapper {
        text-align: center;
        padding:2vh 2vw;
        background:#324960;
        width:100%;
        color:#fff;
    }
    .filter-wrapper label, .filter-wrapper input, .filter-wrapper button {
        margin: 1vh 1vw;
    }

    .desc {
        text-align:center;
        width: 5vw;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 10vw; 
        cursor: pointer; 
    }

    button{
        background:#fff;
        border:1px solid white;
        height:3.5vh;
        width:6vw;
        border-radius:2px;
        color:black;        
    }
    </style>
</head>
<body>
    <div class="main-content">
        <div class="body-wrapper">
            <div class="filter-wrapper">
                <form method="post">
                    <label for="from-date">From Date:</label>
                    <input type="date" id="from-date" name="from-date">
                    <label for="to-date">To Date:</label>
                    <input type="date" id="to-date" name="to-date">
                    <button type="submit" id="apply-filter">Apply</button>
                </form>
            </div>
            <div class="table-wrapper">
                <table class="fl-table">
                    <h2>My Orders</h2>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Order Date</th>
                            <th>Total Amount</th>
                            <th>Order Art Quantity</th>
                            <th>Ship Status</th>
                            <th>Delivery Date</th>
                            <th>Art Name</th>
                            <th>Art Image</th>
                            <th>Generate Invoice</th>
                            <th>Leave Feedback</th>
                            <th>Track Order</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php    // Check if there are any orders
    if (mysqli_num_rows($result) > 0) {
        // Loop through each order and display its details
        while ($row = mysqli_fetch_assoc($result)) {
            
            ?>
                <tr>
                    <td class="desc"><?php echo $row['order_id']; ?></td>
                    <td class="desc"><?php echo $row['order_date']; ?></td>
                    <td class="desc"><?php echo $row['total_amt']; ?></td>
                    <td class="desc"><?php echo $row['order_art_qty']; ?></td>
                    <td class="desc"><?php echo $row['ship_status']; ?></td>
                    <td class="desc"><?php echo $row['delivery_date']; $_SESSION['date']= $row['delivery_date'];?></td>
                    <td class="desc"><?php echo $row['art_name']; ?></td>
                    <td class="desc"><?php
                    $imagePaths = explode(",", $row['art_image']);
                    foreach ($imagePaths as $imagePath) {
                        echo "<img src='../{$imagePath}' alt='Art Image' width='100' height='100' />";
                    }?></td>
                
                    <td><?php echo '<a href="generate_report.php?order_id=' . $row['order_id'] . '">Generate Invoice</a>';?></td>    
                
                    <td class="desc"><?php $art_ids = explode(",", $row['art_id']);
                    foreach ($art_ids as $art_id) {
                        echo '<a href="feedback.php?art_id=' . $art_id . '">Leave Feedback</a>';
                    }?></td>

                    <td><?php echo '<a href="track_order1.php?order_id=' . $row['order_id'] . '">Track Order</a>'; ?></td>
                </tr>
            <?php
        }
    } else {
        // If there are no orders
        echo "<tr><td colspan='10'><h2>No orders found.</h2></td></tr>";
        echo "<div class='col-lg-5 col-md-5'>
        <a href='index.php' class='site-btn btn-continue'>Continue Shopping</a>
    </div>";
    }
} else {
    echo "<tr><td colspan='10'><h2>User not found.</h2></td></tr>";
    exit();
}
?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
