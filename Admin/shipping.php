<?php
// Assuming you have a database connection already established
$cn = mysqli_connect("localhost", "root", "", "artibidz") or die("Connection failed: " . mysqli_connect_error());

// Fetch data from the shipping table
$query = "SELECT * FROM shipping";
$result = mysqli_query($cn, $query);

?>
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

.update{
    width:5vw;
    height:4vh;
    border-radius:2px;
    margin-left:1vw;

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
            <li class="active">
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
                <h2>Shipping</h2>
                <span class="path">Artibidz > Dashboard > Shipping </span>
            </div>
            <div class="user-info">
                <a href="order_report.php" class="report-list">Report List</a>
            </div>
        </div>

        <div class="body-wrapper">

<div class="table-wrapper">


<table class="fl-table">
    <thead>
    <tr>
        <th>Ship ID</th>
        <th>Ship Status</th>
        <th>Delivery Date</th>
        <th>Order ID</th>
        <th>Update Status</th>
    </tr>
    </thead>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
    <tr>
        <tbody>
        <td><?php echo $row['ship_id']; ?></td>
        <td><?php echo $row['ship_status']; ?></td>
        <td><?php echo $row['delivery_date']; ?></td>
        <td><?php echo $row['order_id']; ?></td>
        <td>
            <form action="update_ship_status.php" method="post">
                <input type="hidden" name="ship_id" value="<?php echo $row['ship_id']; ?>">
                <select name="status">
                    <option value="Pending" <?php if ($row['ship_status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                    <option value="Shipped" <?php if ($row['ship_status'] == 'Shipped') echo 'selected'; ?>>Shipped</option>
                    <option value="Out for delivery" <?php if ($row['ship_status'] == 'Out for delivery') echo 'selected'; ?>>Out for delivery</option>
                    <option value="Delivered" <?php if ($row['ship_status'] == 'Delivered') echo 'selected'; ?>>Delivered</option>
                </select>
                <button type="submit" class="update">Update</button>
            </form>
        </td>
    </tr>
    </tbody>
    <?php endwhile; ?>
</table>
</div>
</body>
</html>

