<?php
session_start();

// Check if user is logged in
if (isset($_SESSION['user_id']) && isset($_GET['art_id'])) {
    $artId = $_GET['art_id'];

    // Loop through the cart and remove the item with the specified art_id
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['art_id'] == $artId && $item['user_id'] == $_SESSION['user_id']) {
            unset($_SESSION['cart'][$key]);
            echo "Item removed successfully";
            exit;
        }
    }

    echo "Item not found in cart";
} else {
    echo "User not logged in";
}
?>
