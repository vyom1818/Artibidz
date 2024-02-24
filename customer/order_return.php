<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Orders</title>
  <style>
    /* ... your existing styles ... */
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

      // Fetch orders with only returned products
      $query = "SELECT o.order_id, o.order_date, o.total_amt, od.order_art_qty, s.delivery_date, a.art_name, MIN(ai.art_image) as art_image, r.return_date, r.order_return_desc
          FROM orders o
          JOIN order_details od ON o.order_id = od.order_id
          JOIN shipping s ON o.order_id = s.order_id
          JOIN art a ON od.art_id = a.art_id
          JOIN art_image ai ON a.art_id = ai.art_id
          LEFT JOIN order_return r ON o.order_id = r.order_id
          WHERE r.order_id IS NOT NULL
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
            <p>Art Name: <?php echo $row['art_name']; ?></p>
            <p>Return date <?php echo $row['return_date']; ?></p>
            <p>Return description <?php echo $row['order_return_desc']; ?></p>
            <?php echo "<img src='../{$row['art_image']}' alt='{$row['art_image']}' width='100' height='100' />"; ?>
          </div>
          <?php
        }
      } else {
        // If there are no returned orders
        echo "<p>No returned orders found.</p>";
      }
    } else {
      echo "User not found.";
      exit();
    }
    ?>
  </section>

</body>

</html>