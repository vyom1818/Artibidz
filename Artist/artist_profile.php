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

// Fetch the images associated with the artist from the art_image table
$sqlImages = "SELECT art_image.* 
              FROM art_image 
              INNER JOIN art ON art_image.art_id = art.art_id 
              WHERE art.user_id = $user_id";
$resultImages = mysqli_query($cn, $sqlImages);

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
                // Redirect to artist profile page after successful update
                header("Location: artist_profile.php");
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
    <title>Artist Profile with Images</title>
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

        .artist-info-table {
            border-collapse: collapse;
            width: 80%;
            margin-top: 20px;
            text-align: left;
        }

        .artist-info-table th,
        .artist-info-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .artist-info-table th {
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
        <h1>Artist Profile</h1>

        <?php
        // Display artist profile details
        if ($artist) {
            echo "<img src='../{$artist['profile_pic']}' alt='{$artist['profile_pic']}' width='100' height='100' />";
        ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <h2>Update Profile Picture</h2>
                <input type="file" name="profile_pic" accept="image/*" required>
                <input type="submit" value="Upload" name="submit">
            </form>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="submit" name="remove_profile_pic" value="Remove Profile Picture">
            </form>

            <!-- Display artist information -->
            <h2>Artist Information</h2>
            <table class="artist-info-table">
                <th>First Name</th>
                <td><?php echo $artist['fname']; ?></td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td><?php echo $artist['lname']; ?></td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td><?php echo $artist['username']; ?></td>
                </tr>
                <tr>
                    <th>Email Address</th>
                    <td><?php echo $artist['email_address']; ?></td>
                </tr>
                <tr>
                    <th>Contact Number</th>
                    <td><?php echo $artist['contact_no']; ?></td>
                </tr>
                <tr>
                    <th>Actions</th>
                    <td>
                        <a class="anchor" href="art.php">Add Arts</a> |
                        <a class="anchor" href="edit_artist_profile.php">Edit PROFILE</a> |
                        <a class="anchor" href="delete_artist_profile.php">Delete PROFILE</a>
                    </td>
                </tr>
            </table>

            <!-- Display images associated with the artist -->
            <h2>Artist's Images</h2>
            <div class="image-gallery">
                <?php
                // Iterate through each image and display them
                while ($image = mysqli_fetch_assoc($resultImages)) {
                    echo "<img src='../{$image['art_image']}' alt='{$image['art_image']}' width='100' height='100' />";
                }
                ?>
            </div>
        <?php
        } else {
            echo "<p>No artist profile found.</p>";
        }
        ?>
    </center>
</body>

</html>
