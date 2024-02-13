<?php

$cn=mysqli_connect("localhost","root","","artibidz") or die("Check connection");
if ($cn->connect_error) {
    die("Connection failed: " . $cn->connect_error);
}

// SQL query to fetch the required data using joins
$sql = "SELECT orr.order_return_id, orr.order_id, art.art_name, art.art_amt, usr.username, orr.return_date, orr.order_return_desc
        FROM order_return orr
        JOIN orders ord ON orr.order_id = ord.order_id
        JOIN art ON orr.art_id = art.art_id
        JOIN user usr ON ord.user_id = usr.user_id";

$result = $cn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Output table header
    echo "<table border='1'>
            <tr>
                <th>Order Return ID</th>
                <th>Order ID</th>
                <th>Art Name</th>
                <th>Art Amount</th>
                <th>Username</th>
                <th>Return Date</th>
                <th>Order Return Description</th>
            </tr>";

    // Output data from each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['order_return_id']}</td>
                <td>{$row['order_id']}</td>
                <td>{$row['art_name']}</td>
                <td>{$row['art_amt']}</td>
                <td>{$row['username']}</td>
                <td>{$row['return_date']}</td>
                <td>{$row['order_return_desc']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No results found";
}

// Close the database connection
$cn->close();
?>
