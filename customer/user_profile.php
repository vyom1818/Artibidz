<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location:../Login/login.php");
    exit();
}

$cn = mysqli_connect("localhost", "root", "", "artibidz") or die("Check connection");

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

// Handle form submission for removing profile picture
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["remove_profile_pic"])) {
    // Update database to remove profile picture path
    $sqlRemovePic = "UPDATE user SET profile_pic=NULL WHERE user_id = $user_id";
    $resultRemovePic = mysqli_query($cn, $sqlRemovePic);

    if (!$resultRemovePic) {
        echo "Error removing profile picture: " . mysqli_error($cn);
    } else {
        // Delete the profile picture file from the server
        $filePath = "../images/" . $user['profile_pic']; // Assuming profile_pic stores the file name
        if (file_exists($filePath) && unlink($filePath)) {
            echo "Profile picture removed successfully.";
        } else {
            echo "Error deleting profile picture file.";
        }
        // Redirect to user profile page after successful removal
        header("Location: user_profile.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="img/artibidz-logo.png" rel="shortcut icon"/>
    <style>

    .profile-head {
        transform: translateY(5rem)
    }

    .cover {
        background-image: url(https://images.unsplash.com/photo-1530305408560-82d13781b33a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1352&q=80);
        background-size: cover;
        background-repeat: no-repeat
    }

    body {
        /* background: #654ea3;
        background: linear-gradient(to right, #e96443, #904e95);
        min-height: 100vh; */
        overflow-x:hidden;
        background: #64c5b1;
        /* rgba(251, 194, 235, 1) */
        background: linear-gradient(to bottom, #64c5b1, rgba(166, 193, 238, 1));
        /* background: -webkit-linear-gradient(to right, rgba(251, 194, 235, 1), rgba(166, 193, 238, 1)); */
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

    #opt1 {
        background-image:url('order.jpg');
        background-position:bottom;
        background-size:cover;
        height: 25vh;
        width:18vw;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
    }

    a{
        text-decoration:none;
    }

    #opt2 {
        background-image:url('userprofile2.jpg');
        background-position:center;
        background-size:cover;
        height: 25vh;
        width:18vw;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
    }

    #opt3 {
        background: #be0707;
        height: 8vh;
        width:35.5vw;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
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
        width:101vw;
        height:100vh;
    }
    #remove {
        margin-left: 5vw;
    }
    
    </style>
</head>

<body>

<div class="row py-5 px-4">
    <div class="col-md-5 mx-auto"> <!-- Profile widget --> 
        <div id="whole" class="bg-white shadow rounded overflow-hidden"> 
            <div class="px-4 pt-0 pb-4 cover">
                <div class="media align-items-end profile-head"> 
                    <?php if ($user) : ?>
                        <div class="profile mr-3">
                            <?php if (!empty($user['profile_pic'])) : ?>
                                <img src="../<?php echo $user['profile_pic']; ?>" alt="Profile Picture" width="130" class="rounded mb-2 img-thumbnail">
                                <?php else : ?>
                                    <img src="../images/836.jpg" alt="Profile Picture" width="130" class="rounded mb-2 img-thumbnail">
                                    <!-- <p>No profile picture available</p> -->
                                    <?php endif; ?>
                                    <!-- <img src="https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=80" alt="..." width="130" class="rounded mb-2 img-thumbnail"> -->
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <input type="submit" id="remove" class="btn btn-outline-dark btn-sm" name="remove_profile_pic" value="Remove Picture">
                        </form>
                        <!-- <a class="anchor" href="edit_user_profile.php">Edit Profile</a> -->
                    </div> 
                    <div class="media-body mb-5 text-white"> 
                    <h4 class="mt-0 mb-0"><?php echo ucfirst($user['fname']); ?> <?php echo ucfirst($user['lname']); ?></h4>

                        <p class="small mb-4"> 
                            <!-- <i class="fas fa-map-marker-alt mr-2"></i> -->
                            <?php echo $user['username']; ?>
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
                                <input type="file" id="fileInput" style="display: none;" name="profile_pic" accept=".jpg, .jpeg, .png" required/>
                                <label for="fileInput" class="customFileButton btn btn-outline-dark btn-sm" id="select">Select Profile Photo</label>
                                <input type="submit" value="Click Here to Upload" class="customFileButton btn btn-outline-dark btn-sm">
                            </form>
                            <!-- <input type="file" name="profile_pic" accept="image/*" required> -->
                            <!-- Photos -->
                        </small> 
                    </li> 
                    <li class="list-inline-item"> 
                        <!-- <h5 class="font-weight-bold mb-0 d-block">745</h5>
                        <small class="text-muted"> 
                            <i class="fas fa-user mr-1"></i>Followers
                        </small>  -->
                    </li> 
                    <li class="list-inline-item"> 
                        <!-- <h5 class="font-weight-bold mb-0 d-block">340</h5>
                        <small class="text-muted"> 
                            <i class="fas fa-user mr-1"></i>Following
                        </small>  -->
                    </li> 
                </ul> 
            </div> 
            
            <div class="px-4 py-3"> 
                <h5 class="mb-0">About</h5> 
                <div class="p-4 rounded shadow-sm bg-light"> 
                    <p class="font-italic mb-0">Contact No. : <?php echo $user['contact_no']; ?></p> 
                    <p class="font-italic mb-0">Email Address : <?php echo $user['email_address']; ?></p> 
                    <p class="font-italic mb-0">Role : Customer</p> 
                </div> 
            </div> 
            
            <div class="actions px-4 py-3">
                <h5 class="mb-0">Actions</h5>
                <div class="options p-4 rounded shadow-sm bg-light">
                    <a class="op1 anchor" href="order.php">My orders</a>
                    <!-- <a class="op2 anchor" href="myart.php">My Art</a> -->
                    <a class="op3 anchor" href="edit_user_profile.php">Edit Profile</a>
                    <a class="op4 anchor" href="../Admin/logout.php">Log Out</a>
                </div>
            </div>
            
             
        </div> 
    </div>
</div>
    <!-- <div class="container">
        <h1>User Profile</h1>


            </div>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <input type="file" name="profile_pic" accept="image/*" required>
                <input type="submit" value="Upload">
            </form>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="submit" name="remove_profile_pic" value="Remove Profile Picture">
            </form>

            <h2>User Information</h2>
            <table class="user-info-table">
                <tr>
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
                        <a class="anchor" href="order.php">My Orders</a>
                        <a class="anchor" href="edit_user_profile.php">Edit Profile</a>
                        <a class="anchor" href="delete_user_profile.php">Delete Profile</a>
                    </td>
                </tr>
            </table>
        <?php else : ?>
            <p>User not found or not a customer.</p>
        <?php endif; ?>
    </div> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">>
</body>

</html>