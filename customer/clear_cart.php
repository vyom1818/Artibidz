<?php
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    clearCart();

    $subtotal = 0;
    $shipping = 0;
    $total = 0;

    echo json_encode(array('subtotal' => $subtotal, 'shipping' => $shipping, 'total' => $total));
}
?>
