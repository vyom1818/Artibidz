<?php
require_once('../TCPDF-main/tcpdf.php');
session_start();
// Database connection
$conn = mysqli_connect("localhost", "root", "", "artibidz");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch order_id from the query string
$order_id = $_GET['order_id'];

// Query to fetch order details
$orderQuery = "SELECT o.order_date, o.total_amt, od.art_id, od.order_art_qty, a.art_name, a.art_amt 
               FROM orders o
               JOIN order_details od ON o.order_id = od.order_id
               JOIN art a ON od.art_id = a.art_id
               WHERE o.order_id = '$order_id'";

$result = $conn->query($orderQuery);

// Initialize variables
$orderDetails = [];
$subtotal = 0;
$orderDate = "";
$grandTotal = 0;

// Check if results exist
if ($result->num_rows > 0) {
    // Fetch data
    while ($row = $result->fetch_assoc()) {
        // Capture order_date and total_amt from the first row
        if (empty($orderDate)) {
            $orderDate = $row['order_date'];
            $grandTotal = $row['total_amt'];
        }

        $itemTotal = $row['order_art_qty'] * $row['art_amt'];
        $subtotal += $itemTotal;

        $orderDetails[] = [
            'art_name' => $row['art_name'],
            'art_amt' => $row['art_amt'],
            'order_art_qty' => $row['order_art_qty'],
            'item_total' => $itemTotal
        ];
    }
} else {
    echo "No order found.";
    exit();
}

// Create new PDF document
$pdf = new TCPDF();

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Artibidz');
$pdf->SetTitle('Invoice');

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('dejavusans', '', 12);

// Add invoice header
$html = <<<EOD
<h1 style="text-align: center; background-color:50, 75, 99; padding: 10px;">Invoice</h1>
<div>
    <strong>Order ID:</strong> #{$order_id}<br>
    <strong>Date:</strong> {$orderDate}<br><br><br>
    <strong>Shipping Address:</strong><br>
    John Doe<br>
    123 Street Name<br>
    City, State, 12345
</div>
<br><br>
EOD;

$pdf->writeHTML($html, true, false, true, false, '');

// Add table with order summary
$html = '<table border="1" cellpadding="5">
            <thead>
                <tr>
                    <th><strong>Item Name</strong></th>
                    <th><strong>Price</strong></th>
                    <th><strong>Quantity</strong></th>
                    <th><strong>Total</strong></th>
                </tr>
            </thead>
            <tbody>';

foreach ($orderDetails as $detail) {
    $html .= "<tr>
                <td>{$detail['art_name']}</td>
                <td>₹" . number_format($detail['art_amt'], 2) . "</td>
                <td>{$detail['order_art_qty']}</td>
                <td>₹" . number_format($detail['item_total'], 2) . "</td>
              </tr>";
}

$html .= '</tbody></table>';

$pdf->writeHTML($html, true, false, true, false, '');

// Add totals section
$shippingCharges = ($subtotal > 1000) ? 0.00 : 50.00;
$finalTotal = $subtotal + $shippingCharges;

$formattedSubtotal = number_format($subtotal, 2);
$formattedShippingCharges = number_format($shippingCharges, 2);
$formattedGrandTotal = number_format($grandTotal, 2);


$html = <<<EOD
<br><br>
<div style="text-align: right;">
    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <td style="text-align: right; padding-right: 10px;"><strong>Subtotal:</strong></td>
            <td style="text-align: right;">₹$formattedSubtotal</td>
        </tr>
        <tr>
            <td style="text-align: right; padding-right: 10px;"><strong>Shipping:</strong></td>
            <td style="text-align: right;">₹$formattedShippingCharges</td>
        </tr>
        <tr>
            <td><hr></td>
            <td><hr></td>
        </tr>
        <tr>
            <td style="text-align: right; padding-right: 10px;"><strong>Grand Total:</strong></td>
            <td style="text-align: right;">₹$formattedGrandTotal</td>
        </tr>
    </table>
</div>
EOD;



$pdf->writeHTML($html, true, false, true, false, '');

// Output the PDF
$pdf->Output('invoice.pdf', 'I');

// Close database connection
$conn->close();
?>
