<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <style>
        table th{
            background-color:#324960;
            color:#ffffff;
            margin:0;
        }
        
        form{
            display:flex;
            align-items:center;
            justify-content:center;
            background:#324960;
            color:#ffffff;
            height:7vh;
            margin-bottom:3vh;
        }

        input{
            background:#ffffff;
            border:none;
            border-radius:2px;
            height:2.7vh;
            margin:0 5px;
        }

        #download-pdf{
            background:#324960;
            color:#ffffff;
            margin-top:2vh;
            border:1px solid white;
            border-radius:2px;
            height:4vh;
        }
    </style>
</head>
<body>
    

<!-- Add filter form -->
<form method="post" action="">
    <label for="from_date">From:</label>
    <input type="date" id="from_date" name="from_date">
    <label for="to_date">To:</label>
    <input type="date" id="to_date" name="to_date">
    <input type="submit" name="show_orders" value="Show Orders from These Dates">
    <input type="submit" name="clear_search" value="Clear Search">
</form>
<?php
require_once('../TCPDF-main/tcpdf.php'); // Include TCPDF library

$cn = mysqli_connect("localhost", "root", "", "artibidz") or die("Check connection");

// Check if the filter form is submitted
if (isset($_POST['show_orders'])) {
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];

    // Add date filter to the SQL query
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
    WHERE orders.order_date BETWEEN '$from_date' AND '$to_date'
    GROUP BY orders.order_id
    ";
} else {
    // Default query without date filter
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
}

$result = mysqli_query($cn, $sql);
if ($result) {
    echo "<div class='table-wrapper'>
    <table id='order-table' class='fl-table'>
    <thead>
    <tr>
      <th width='10%'>Order ID</th>
      <th width='15%'>Order Date</th>
      <th width='40%'>Art Names</th>
      <th width='15%'>Order Art Quantities</th>
      <th width='15%'>Total Amount</th>
      <th width='15%'>Username</th>
    </tr>
  </thead>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
        <tbody>
                <td>{$row['order_id']}</td>
                <td>{$row['order_date']}</td>
                <td>{$row['art_names']}</td>
                <td>{$row['order_art_qtys']}</td>
                <td>{$row['total_amt']}</td>
                <td>{$row['username']}</td>
                </tr>
        </tbody>";
    }

    echo "</table>";
    echo "</div>";

    // Add button to generate PDF report for all orders
    echo "<button id='download-pdf'>Generate Orders Report</button>";
} else {

    echo "Error: " . mysqli_error($cn);
}

mysqli_close($cn);
?>

<!-- Include html2pdf library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

<script>
 document.getElementById('download-pdf').addEventListener('click', function() {
    const element = document.getElementById('order-table');
    html2pdf(element, {
        margin: 10,
        filename: 'All_Orders_Report.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
    });
});

</script>
</body>
</html>