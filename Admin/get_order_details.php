<?php
$cn = mysqli_connect("localhost", "root", "", "artibidz") or die("Check connection");

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    $sql = "
    SELECT
        art.art_name,
        order_details.order_art_qty
    FROM
        order_details
    JOIN art ON order_details.art_id = art.art_id
    WHERE order_details.order_id = $order_id
    ";

    $result = mysqli_query($cn, $sql);
    if ($result) {
        $orderDetails = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $orderDetails[] = $row;
        }
        echo json_encode(['success' => true, 'data' => $orderDetails]);
    } else {
        echo json_encode(['success' => false, 'error' => mysqli_error($cn)]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Order ID not provided.']);
}

mysqli_close($cn);
?>
