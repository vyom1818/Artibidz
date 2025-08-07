<?php
include 'functions.php';
$conn = connectToDatabase();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $artId = $_POST['art_id'];
    $qty = $_POST['qty'];

    updateCart($artId, $qty);

    // Calculate subtotal
    $userId = $_SESSION['user_id']; // Assuming user_id is stored in session
    $cartItems = getCartItems($userId);

    $subtotal = 0;
    foreach ($cartItems as $cartItem) {
        // Assuming you have a function to get the art_amt based on art_id
        $artAmt = getArtAmt($cartItem['art_id']);
        $subtotal += $artAmt * $cartItem['cart_art_qty'];
    }

    // Calculate shipping
    $shipping = ($subtotal > 1000) ? 0 : 50;

    // Calculate total
    $total = $subtotal + $shipping;

    echo json_encode(array('subtotal' => $subtotal, 'shipping' => $shipping, 'total' => $total));
}
else {
    // Handle other HTTP methods (e.g., GET, PUT, DELETE)
    http_response_code(405); // Method Not Allowed
    echo json_encode(array('error' => 'Method Not Allowed'));
}
?>
