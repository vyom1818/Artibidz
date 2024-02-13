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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email_address = $_POST['email_address'];
    $contact_no = $_POST['contact_no'];

    // Update artist profile in the database
    $sqlUpdate = "UPDATE user SET fname='$fname', lname='$lname', email_address='$email_address', contact_no='$contact_no' WHERE user_id = $user_id";
    $resultUpdate = mysqli_query($cn, $sqlUpdate);

    // Check if update was successful
    if ($resultUpdate) {
        // Redirect to artist profile page
        header("Location: artist_profile.php");
        exit();
    } else {
        echo "Error updating profile: " . mysqli_error($cn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Artist Profile</title>
    <!-- Add your CSS styles here -->
    <style>
        /* Your CSS styles here */
    </style>
</head>

<body>
    <center>
        <h1>Edit Artist Profile</h1>
        <!-- Display form pre-filled with artist's current details -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="fname">First Name:</label>
            <input type="text" id="fname" name="fname" value="<?php echo $artist['fname']; ?>"><br><br>

            <label for="lname">Last Name:</label>
            <input type="text" id="lname" name="lname" value="<?php echo $artist['lname']; ?>"><br><br>

            <label for="email_address">Email Address:</label>
            <input type="text" id="email_address" name="email_address" value="<?php echo $artist['email_address']; ?>"><br><br>

            <label for="contact_no">Contact Number:</label>
            <input type="text" id="contact_no" name="contact_no" value="<?php echo $artist['contact_no']; ?>"><br><br>

            <input type="submit" value="Submit">
        </form>
    </center>
</body>

</html>

<?php
// Close database connection
mysqli_close($cn);
?>
