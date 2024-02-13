<?php
session_start();
$cn = mysqli_connect("localhost", "root", "", "artibidz") or die("Check connection");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Login/login.php"); // Redirect to login page if not logged in
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

// Delete the artist profile
$sqlDeleteProfile = "DELETE FROM user WHERE user_id = $user_id";
$resultDeleteProfile = mysqli_query($cn, $sqlDeleteProfile);

// Check if deletion was successful
if ($resultDeleteProfile) {
    // Redirect to a relevant page
    header("Location: profile_deleted.php");
    exit();
} else {
    echo "Error deleting profile: " . mysqli_error($cn);
}

mysqli_close($cn);
?>
