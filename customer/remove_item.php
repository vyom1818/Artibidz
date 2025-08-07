<?php
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $artId = $_POST['art_id'];

    removeItemFromCart($artId);

    echo json_encode(array('message' => 'Item removed successfully'));
}
?>
