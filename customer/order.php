<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .search-bar {
            margin-bottom: 10px;
        }

        .search-bar input[type="text"] {
            width: 300px;
            padding: 10px;
            border: none;
            border-radius: 5px;
        }

        .filters {
            text-align: right;
        }

        .filters label {
            color: #666;
            font-size: 16px;
        }

        .filters select {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .orders {
            padding: 20px;
        }

        .order {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .order h2 {
            margin-top: 0;
        }

        .order .details {
            margin-top: 10px;
            color: #666;
        }

        .order .status {
            font-weight: bold;
            color: #333;
        }
    </style>
</head>

<body>
    <header class="header">
        <h1>My Orders</h1>
    
    </header>

    <section class="orders">
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

        // Fetch user details from the database based on the user_id and user_type
        $sqlUser = "SELECT * FROM user WHERE user_id = $user_id";
        $resultUser = mysqli_query($cn, $sqlUser);

        // Check if the user exists
        if (mysqli_num_rows($resultUser) == 1) {
            $user = mysqli_fetch_assoc($resultUser);

            // Fetch orders along with their details from multiple tables
            $query = "SELECT o.order_id, o.order_date, o.total_amt, od.order_art_qty, s.ship_status, s.delivery_date, a.art_name, MIN(ai.art_image) as art_image
          FROM orders o
          JOIN order_details od ON o.order_id = od.order_id
          JOIN shipping s ON o.order_id = s.order_id
          JOIN art a ON od.art_id = a.art_id
          JOIN art_image ai ON a.art_id = ai.art_id
          WHERE o.order_id IN (SELECT DISTINCT order_id FROM orders)
          GROUP BY o.order_id";


            $result = mysqli_query($cn, $query);

            // Check if there are any orders
            if (mysqli_num_rows($result) > 0) {
                // Loop through each order and display its details
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="order">
                        <h2>Order ID: <?php echo $row['order_id']; ?></h2>
                        <p>Order Date: <?php echo $row['order_date']; ?></p>
                        <p>Total Amount: <?php echo $row['total_amt']; ?></p>
                        <p>Order Art Quantity: <?php echo $row['order_art_qty']; ?></p>
                        <p>Ship Status: <?php echo $row['ship_status']; ?></p>
                        <p>Delivery Date: <?php echo $row['delivery_date']; ?></p>
                        <p>Art Name: <?php echo $row['art_name']; ?></p>
                      <?php  echo "<img src='../artibidz2/{$row['art_image']}' alt='{$row['art_image']}' width='100' height='100' />";
                      ?>
                   </div>
                <?php
                }
            } else {
                // If there are no orders
                echo "<p>No orders found.</p>";
            }
        } else {
            echo "User not found.";
            exit();
        }
        ?>
    </section>

</body>

</html>
