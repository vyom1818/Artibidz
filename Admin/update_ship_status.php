<?php
// Assuming you have a database connection already established
$cn = mysqli_connect("localhost", "root", "", "artibidz") or die("Connection failed: " . mysqli_connect_error());

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ship_id = $_POST['ship_id'];
    $new_status = $_POST['status'];

    // Update the ship_status in the shipping table
    $query = "UPDATE shipping SET ship_status = '$new_status' WHERE ship_id = '$ship_id'";
    if (mysqli_query($cn, $query)) {
        echo "Status updated successfully";
        header("Location:shipping.php");
    } else {
        echo "Error updating status: " . mysqli_error($cn);
    }
}

// Close database connection
mysqli_close($cn);
?>
