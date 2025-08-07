<?php
session_start();
$cn = mysqli_connect("localhost", "root", "", "artibidz") or die("Check connection");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location:../Login/login.php"); // Redirect to login page if not logged in
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
              INNER JOIN (
                  SELECT art_id, MIN(art_image_id) AS min_image_id
                  FROM art_image
                  GROUP BY art_id
              ) AS min_images ON art_image.art_id = min_images.art_id AND art_image.art_image_id = min_images.min_image_id
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
// Handle form submission for removing profile picture
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["remove_profile_pic"])) {
    // Update database to remove profile picture path
    $sqlRemovePic = "UPDATE user SET profile_pic=NULL WHERE user_id = $user_id";
    $resultRemovePic = mysqli_query($cn, $sqlRemovePic);
  
    if (!$resultRemovePic) {
      echo "Error removing profile picture: " . mysqli_error($cn);
    } else {
      // Delete the profile picture file from the server
      $filePath = "../" . $user['profile_pic']; // Assuming profile_pic stores the file name
      if (file_exists($filePath) && unlink($filePath)) {
        echo "Profile picture removed successfully.";
      } else {
        echo "Error deleting profile picture file.";
      }
      // Redirect to user profile page after successful removal
      header("Location: artist_profile.php");
      exit();
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artist Profile with Images</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <style>

    .profile-head {
        transform: translateY(5rem)
    }

    .cover {
        background-image: url(https://images.unsplash.com/photo-1530305408560-82d13781b33a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1352&q=80);
        background-size: cover;
        background-repeat: no-repeat;
    }

    body {
        /* background: #654ea3;
        background: linear-gradient(to right, #e96443, #904e95);
        min-height: 100vh; */
        overflow-x:hidden;
        background: #64c5b1;
        /* rgba(251, 194, 235, 1) */
        background: linear-gradient(to bottom, #64c5b1, rgba(166, 193, 238, 1));
        background-repeat:none;
    }

    label{
        margin-bottom:0;
    }

    #remove{
        width:8.1rem;
    }

    .list-inline-item:not(:last-child) {
        margin-right: 0;
    }

    #select:hover {
        color: #fff;
        background-color: #343a40;
        border-color: #343a40;
    }

    .font-italic {
        margin: 1vh auto;
    }

    a{
        text-decoration:none;
        background:#00425a;
        color:#fff;
        padding:5px 15px;
        border-radius:5px;
        /* margin:5px; */
    }

    a:hover{
        text-decoration:none;
        color:#f1f1f1;
    }

    #artwork{
        height:35vh;
        width:22vw;
        padding:5px;
        border-radius:5px;
    }

    .opt1{
        width:88vw;
    }

    .actions{
        display:flex;
        flex-direction:column;
    }

    .options{
        display:flex;
        justify-content:space-between;
        align-items:center;
    }

    .op1{
        background-color:#009688;
    }
    .op2{
        background-color:#5c6bc0;
    }
    .op3{
        background-color:#ba68c8;
    }
    .op4{
        background-color:#F44336;
    }

    .py-5{
        padding-bottom:0 !important;
    }
    .py-5{
        padding-top:0 !important;
    }
    .py-3{
        margin: 0 5vw;
    }
    .px-4{
        padding-left:0 !important;
    }
    .mx-auto{
        margin-left:0 !important;
        margin-right: 0 !important; 
    }
    .mb-4{
        margin-bottom: 2.5rem !important;
    }
    .mb-2{
        margin-left: 5vw;
    }
    #whole{
        width:99vw
    }
    #remove {
        margin-left: 5vw;
    }
    </style>
</head>

<body>

<div class="row py-5 px-4" style=".pb-5, .py-5 {padding-bottom: 3rem !important;}">
    <div class="col-md-5 mx-auto">
        <div class="bg-white shadow rounded overflow-hidden" id="whole"> 
            <div class="px-4 pt-0 pb-4 cover">
                <div class="media align-items-end profile-head"> 
                    <div class="profile mr-3">
                        <?php
                            if ($artist){
                            echo "<img src='../{$artist['profile_pic']}' alt='{$artist['profile_pic']}' width='130' class='rounded mb-2 img-thumbnail'/>";                            
                            ?>

                                
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <input type="submit" id="remove" class="btn btn-outline-dark btn-sm" name="remove_profile_pic" value="Remove Picture">
                            </form> 
                    </div> 
                    <div class="media-body mb-5 text-white"> 
                            
                        <h4 class="mt-0 mb-0">
                        <?php echo ucfirst($artist['fname']); ?>
                        <?php echo ucfirst($artist['lname']); ?>
                        </h4> 
                            
                        <p class="small mb-4"> 
                        <!-- <i class="fas fa-map-marker-alt mr-2"></i> -->
                        <?php echo $artist['username']; ?>
                        </p> 
                        
                    </div> 
                </div> 
            </div> 
            
            <div class="bg-light p-4 d-flex justify-content-end text-center"> 
                <ul class="list-inline mb-0"> 
                    <li class="list-inline-item"> 
                        <!-- <h5 class="font-weight-bold mb-0 d-block">215</h5> -->
                        <small class="text-muted"> 
                            <i class="fas fa-image mr-1">
                            </i>

                            <form class="py-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                            
                            <input type="file" name="profile_pic" accept="image/*" id="fileInput" style="display: none;" required>
                            <label for="fileInput" class="customFileButton btn btn-outline-dark btn-sm" id="select">Select Profile Photo</label>
                            <input type="submit" value="Click Here to Upload" class="customFileButton btn btn-outline-dark btn-sm" name="submit">
                            </form>
                        </small> 
                    </li>
                </ul> 
            </div> 
            
            <div class="px-4 py-3"> 
                <h5 class="mb-0">About</h5> 
                <div class="p-4 rounded shadow-sm bg-light"> 
                    <p class="font-italic mb-0">Contact No. : <?php echo $artist['contact_no']; ?></p> 
                    <p class="font-italic mb-0">Email Address : <?php echo $artist['email_address']; ?></p> 
                    <p class="font-italic mb-0">Role : Artist</p> 
                </div> 
            </div> 

            <div class="actions px-4 py-3">
                <h5 class="mb-0">Actions</h5>
                <div class="options p-4 rounded shadow-sm bg-light">
                    <a class="op1 anchor" href="art.php">Add Art</a>
                    <a class="op2 anchor" href="myart.php">My Art</a>
                    <a class="op3 anchor" href="edit_artist_profile.php">Edit Profile</a>
                    <a class="op4 anchor" href="../Admin/logout.php">Log Out</a>
                </div>
            </div>

            <div class="py-4 px-4"> 
                <div class="d-flex align-items-center justify-content-between mb-3"> 
                    <h5 class="mb-0 py-3">My Art Images</h5>
                </div> 
                <div class="row"> 
                    <div class="col-lg-6 mb-2 pr-lg-1">
                        <div class="opt1">
                            <?php
                            while ($image = mysqli_fetch_assoc($resultImages)) {
                            echo "<img src='../{$image['art_image']}' alt='{$image['art_image']}' id='artwork'/>";
                            }
                            ?>
                        </div>
                    </div> 
                </div> 
            </div> 
        </div> 
    </div>
</div>

</div>
<?php
        } 
        else {
            echo "<p>No artist profile found.</p>";
        }
        ?>
</body>
</html>