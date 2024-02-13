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
    $user = mysqli_fetch_assoc($resultUser);

    // Handle form submission for profile update
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email_address = $_POST['email_address'];
        $contact_no = $_POST['contact_no'];

        // Update user information in the database
        $sqlUpdate = "UPDATE user SET fname='$fname', lname='$lname', email_address='$email_address', contact_no='$contact_no' WHERE user_id = $user_id";
        $resultUpdate = mysqli_query($cn, $sqlUpdate);

        if ($resultUpdate) {
            header("Location: user_profile.php"); // Redirect to user_profile.php after successful update
            exit();
        } else {
            echo "<script>alert('Failed to update profile.')</script>";
        }
    }
} else {
    echo "User not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Profile</title>
    <style>
        /* Your CSS styles here */
        /* Example style for form layout */
        form {
            width: 50%;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <h1>Edit User Profile</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="fname">First Name:</label>
        <input type="text" id="fname" name="fname" value="<?php echo $user['fname']; ?>" required>

        <label for="lname">Last Name:</label>
        <input type="text" id="lname" name="lname" value="<?php echo $user['lname']; ?>" required>

        <label for="email_address">Email Address:</label>
        <input type="email" id="email_address" name="email_address" value="<?php echo $user['email_address']; ?>" required>

        <label for="contact_no">Contact Number:</label>
        <input type="tel" id="contact_no" name="contact_no" value="<?php echo $user['contact_no']; ?>" required>

        <input type="submit" value="Save Changes">
    </form>
</body>

</html>
