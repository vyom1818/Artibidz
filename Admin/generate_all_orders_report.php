<?php
require_once('../TCPDF-main/tcpdf.php'); // Include TCPDF library

$cn = mysqli_connect("localhost", "root", "", "artibidz") or die("Check connection");

// Fetch all orders
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
GROUP BY orders.order_id
";
$result = mysqli_query($cn, $sql);

// Extend TCPDF with custom functions
class MYPDF extends TCPDF {

    // Colored table for orders
    public function OrdersTable($header, $data) {
        // Colors, line width, and bold font
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(30, 40, 50, 30, 40, 50); // Column widths
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = 0;
        foreach($data as $row) {
            $this->Cell($w[0], 6, $row['order_id'], 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 6, $row['order_date'], 'LR', 0, 'C', $fill);
            $this->Cell($w[2], 6, $row['art_names'], 'LR', 0, 'C', $fill);
            $this->Cell($w[3], 6, $row['order_art_qtys'], 'LR', 0, 'C', $fill);
            $this->Cell($w[4], 6, $row['total_amt'], 'LR', 0, 'C', $fill);
            $this->Cell($w[5], 6, $row['username'], 'LR', 0, 'C', $fill);
            $this->Ln();
            $fill=!$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}

// Create new PDF document
$pdf = new MYPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Set document information
$pdf->SetCreator('ArtiBidz');
$pdf->SetAuthor('ArtiBidz');
$pdf->SetTitle('All Orders Report');
$pdf->SetSubject('All Orders Report');
$pdf->SetKeywords('Order, Report, ArtiBidz');

// Set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Set font
$pdf->SetFont('helvetica', '', 12);

// Add a page
$pdf->AddPage();

// Column titles
$header = array('Order ID', 'Order Date', 'Art Names', 'Order Art Quantities', 'Total Amount', 'Username');

// Data
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Print colored table for orders
$pdf->OrdersTable($header, $data);

// Close and output PDF document
$pdf->Output('All_Orders_Report.pdf', 'D');

mysqli_close($cn);

?>
