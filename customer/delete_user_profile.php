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

// Fetch user details from the database based on the user_id
$sqlUser = "SELECT * FROM user WHERE user_id = $user_id";
$resultUser = mysqli_query($cn, $sqlUser);

// Check if the user exists
if (mysqli_num_rows($resultUser) == 1) {
    // Delete user profile from the database
    $sqlDeleteUser = "DELETE FROM user WHERE user_id = $user_id";
    $resultDeleteUser = mysqli_query($cn, $sqlDeleteUser);

    if ($resultDeleteUser) {
        // User profile deleted successfully, log out the user and redirect to login page
        session_destroy();
        header("Location: login.php");
        exit();
    } else {
        echo "<script>alert('Failed to delete profile.')</script>";
    }
} else {
    echo "User not found.";
    exit();
}
?>
