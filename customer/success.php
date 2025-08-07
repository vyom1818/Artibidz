<?php
session_start();
// Establish database connection
$conn = mysqli_connect("localhost", "root", "", "artibidz") or die("Check connection");

// Retrieve data from session and request
$user_id = $_SESSION['user_id'];
$total = $_SESSION['total'];
$date = date('Y-m-d'); // Get current date
$order_id = $_GET['order_id'];
$payment_id = $_GET['payment_id'];
$paymentMode = "Online";

// Insert order into orders table
$insertOrderQuery = "INSERT INTO orders (order_id, user_id, order_date, total_amt) VALUES ('$order_id', '$user_id', '$date', '$total')";
if ($conn->query($insertOrderQuery) === TRUE) {
    // Retrieve cart data from the database
    $cartQuery = "SELECT * FROM cart WHERE user_id = '$user_id'";
    $cartResult = $conn->query($cartQuery);

    if ($cartResult->num_rows > 0) {
        while ($row = $cartResult->fetch_assoc()) {
            $art_id = $row['art_id'];
            $art_qty = $row['cart_art_qty'];
            // Insert order details into order_details table
            $insertOrderDetailsQuery = "INSERT INTO order_details (order_id, art_id, order_art_qty) VALUES ('$order_id', '$art_id', '$art_qty')";
            $conn->query($insertOrderDetailsQuery);
        }
    }

    // Insert payment record into payment table
    $insertPaymentQuery = "INSERT INTO payment (payment_id, pay_date, mode_pay, order_id) VALUES ('$payment_id', '$date', '$paymentMode', '$order_id')";
    $conn->query($insertPaymentQuery);

    // Calculate the delivery date (5 days from the order date)
    $deliveryDate = date('Y-m-d', strtotime('+5 days'));

    // Initialize the ship status
    $shipStatus = 'Pending'; // Default status is pending

    // Insert record into the shipping table
    $insertShippingQuery = "INSERT INTO shipping (ship_status, delivery_date, order_id) VALUES ('$shipStatus', '$deliveryDate', '$order_id')";
    if ($conn->query($insertShippingQuery) === TRUE) {
        // Clear the cart after order is placed
        $clearCartQuery = "DELETE FROM cart WHERE user_id = '$user_id'";
        $conn->query($clearCartQuery);

        // Redirect to thank you page
        header('Location: thankyou.php');
    } else {
        echo "Error: " . $insertShippingQuery . "<br>" . $conn->error;
    }
} else {
    echo "Error: " . $insertOrderQuery . "<br>" . $conn->error;
}

$conn->close();

?>
