<?php
require_once('../TCPDF-main/tcpdf.php'); // Include TCPDF library

// Check if order_id is provided in the URL parameter
if(isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Fetch order details from the database
    $cn=mysqli_connect("localhost","root","","artibidz") or die("Check connection");
    $sql = "
    SELECT
        orders.order_id,
        orders.order_date,
        GROUP_CONCAT(art.art_name SEPARATOR ', ') as art_names,
        GROUP_CONCAT(order_details.order_art_qty SEPARATOR ', ') as order_art_qtys,
        orders.total_amt,
        user.username
    FROM
        orders
    JOIN order_details ON orders.order_id = order_details.order_id
    JOIN art ON order_details.art_id = art.art_id
    JOIN user ON orders.user_id = user.user_id
    WHERE orders.order_id = '$order_id'
    GROUP BY orders.order_id
    ";
    $result = mysqli_query($cn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Create a new TCPDF instance
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator('ArtiBidz');
    $pdf->SetAuthor('ArtiBidz');
    $pdf->SetTitle('Order Report');
    $pdf->SetSubject('Order Report');
    $pdf->SetKeywords('Order, Report, ArtiBidz');

    // Set default header data
    //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

    // Set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // Set font
    $pdf->SetFont('helvetica', '', 12);

    // Add a page
    $pdf->AddPage();

    // Set some content
    $content = "
    <h1>Order Report</h1>
    <table border='1'>
    <tr><th>Order ID</th><td>{$row['order_id']}</td></tr>
    <tr><th>Order Date</th><td>{$row['order_date']}</td></tr>
    <tr><th>Art Names</th><td>{$row['art_names']}</td></tr>
    <tr><th>Order Art Quantities</th><td>{$row['order_art_qtys']}</td></tr>
    <tr><th>Total Amount</th><td>{$row['total_amt']}</td></tr>
    <tr><th>Username</th><td>{$row['username']}</td></tr>
    </table>
    ";

    // Output the HTML content
    $pdf->writeHTML($content, true, false, true, false, '');

    // Close and output PDF document
    $pdf->Output('Order_Report.pdf', 'D');
    
    mysqli_close($cn);
} else {
    // Error handling if order_id is not provided
    echo "Error: Order ID is not provided.";
}
?>
