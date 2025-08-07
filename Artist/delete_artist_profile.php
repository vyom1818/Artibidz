<?php
session_start();
$cn = mysqli_connect("localhost", "root", "", "artibidz") or die("Check connection");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Assuming user_id is set in the session
$user_id = $_SESSION['user_id'];

// Fetch user details from the database based on the user_id and user_type
$sqlUser = "SELECT * FROM user WHERE user_id = $user_id AND user_type = 'artist'";
$resultUser = mysqli_query($cn, $sqlUser);

// Check if the user exists and has the correct user_type
$artist = mysqli_fetch_assoc($resultUser);

// Check if the artist exists
if (!$artist) {
    die("Artist profile not found.");
}

// Disable foreign key checks
mysqli_query($cn, "SET FOREIGN_KEY_CHECKS = 0");

// Delete related records in the 'shipping' table
$sqlDeleteShipping = "DELETE FROM shipping WHERE order_id IN (SELECT order_id FROM orders WHERE user_id = $user_id)";
$resultDeleteShipping = mysqli_query($cn, $sqlDeleteShipping);

// Check if deletion was successful
if (!$resultDeleteShipping) {
    echo "Error deleting related shipping records: " . mysqli_error($cn);
    exit();
}

// Enable foreign key checks
mysqli_query($cn, "SET FOREIGN_KEY_CHECKS = 1");

// Delete related records in the 'orders' table
$sqlDeleteOrders = "DELETE FROM orders WHERE user_id = $user_id";
$resultDeleteOrders = mysqli_query($cn, $sqlDeleteOrders);

// Check if deletion was successful
if (!$resultDeleteOrders) {
    echo "Error deleting related orders records: " . mysqli_error($cn);
    exit();
}

// Delete related records in the 'feedback' table
$sqlDeleteFeedback = "DELETE FROM feedback WHERE user_id = $user_id";
$resultDeleteFeedback = mysqli_query($cn, $sqlDeleteFeedback);

// Check if deletion was successful
if (!$resultDeleteFeedback) {
    echo "Error deleting related feedback records: " . mysqli_error($cn);
    exit();
}

// Delete related records in the 'art_image' table
$sqlDeleteArtImages = "DELETE FROM art_image WHERE art_id IN (SELECT art_id FROM art WHERE user_id = $user_id)";
$resultDeleteArtImages = mysqli_query($cn, $sqlDeleteArtImages);

// Check if deletion was successful
if (!$resultDeleteArtImages) {
    echo "Error deleting related art images: " . mysqli_error($cn);
    exit();
}

// Now delete the artist's art records
$sqlDeleteArt = "DELETE FROM art WHERE user_id = $user_id";
$resultDeleteArt = mysqli_query($cn, $sqlDeleteArt);

// Check if deletion was successful
if (!$resultDeleteArt) {
    echo "Error deleting related art records: " . mysqli_error($cn);
    exit();
}

// Now delete the artist profile
$sqlDeleteProfile = "DELETE FROM user WHERE user_id = $user_id";
$resultDeleteProfile = mysqli_query($cn, $sqlDeleteProfile);

// Check if deletion was successful
if ($resultDeleteProfile) {
    // Redirect to a relevant page
    header("Location:../Register/Registration.php");
    exit();
} else {
    echo "Error deleting profile: " . mysqli_error($cn);
}

mysqli_close($cn);
?>
