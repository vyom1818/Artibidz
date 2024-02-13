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
$sqlUser = "SELECT * FROM user WHERE user_id = $user_id AND user_type = 'customer'";
$resultUser = mysqli_query($cn, $sqlUser);

// Check if the user exists and has the correct user_type
$user = mysqli_fetch_assoc($resultUser);



// Handle form submission for profile picture upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profile_pic"])) {
    // File validation (rigorous validation is crucial for security)
    $targetDirectory = "../images/";
    $targetFile = $targetDirectory . basename($_FILES["profile_pic"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if ($imageFileType == "png" || $imageFileType == "jpg") {
        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $targetFile)) {
            echo "The file " . basename($_FILES["profile_pic"]["name"]) . " has been uploaded.";

            // Construct full file path including directory
            $new_profile_pic = "images/" . basename($_FILES["profile_pic"]["name"]);

            // Update database with new profile picture path
            $sqlUpdatePic = "UPDATE user SET profile_pic='$new_profile_pic' WHERE user_id = $user_id";
            $resultUpdatePic = mysqli_query($cn, $sqlUpdatePic);

            if (!$resultUpdatePic) {
                echo "Error updating profile picture: " . mysqli_error($cn);
            } else {
                // Redirect to user profile page after successful update
                header("Location: user_profile.php");
                exit();
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Invalid file type. Only png and jpg files are allowed.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile with Images</title>
    <style>
        /* Your CSS styles here */
        .image-gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .image-gallery img {
            max-width: 200px;
            height: auto;
        }

        .user-info-table {
            border-collapse: collapse;
            width: 80%;
            margin-top: 20px;
            text-align: left;
        }

        .user-info-table th,
        .user-info-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .user-info-table th {
            background-color: #f2f2f2;
        }

        .anchor {
            text-decoration: none;
            color: blue;
        }
    </style>
</head>

<body>
    <center>
        <h1>User Profile</h1>

        <?php
        // Display user profile details
        if ($user) {
            echo "<img src='../{$user['profile_pic']}' alt='{$user['profile_pic']}' width='100' height='100' />";
        ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <h2>Update Profile Picture</h2>
                <input type="file" name="profile_pic" accept="image/*" required>
                <input type="submit" value="Upload" name="submit">
            </form>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="submit" name="remove_profile_pic" value="Remove Profile Picture">
            </form>

            <!-- Display user information -->
            <h2>User Information</h2>
            <table class="user-info-table">
                <th>First Name</th>
                <td><?php echo $user['fname']; ?></td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td><?php echo $user['lname']; ?></td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td><?php echo $user['username']; ?></td>
                </tr>
                <tr>
                    <th>Email Address</th>
                    <td><?php echo $user['email_address']; ?></td>
                </tr>
                <tr>
                    <th>Contact Number</th>
                    <td><?php echo $user['contact_no']; ?></td>
                </tr>
                <tr>
                    <th>Actions</th>
                    <td>
                        <a class="anchor" href="order.php">My Orders</a> |
                        <a class="anchor" href="edit_user_profile.php">Edit Profile</a> |
                        <a class="anchor" href="delete_user_profile.php">Delete Profile</a>
                    </td>
                </tr>
            </table>

            <?php }
        ?>
    </center>
</body>

</html>
