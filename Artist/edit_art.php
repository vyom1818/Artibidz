<?php
session_start();
$cn = mysqli_connect("localhost", "root", "", "artibidz") or die("Check connection");

// Ensure user_id is set in the session
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page or handle the case where the user is not logged in
    exit("User not logged in");
}

// Fetch user ID from session
$user_id = $_SESSION['user_id'];

// Fetch the art details including art image from the database
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['art_id'])) {
    $art_id = intval($_GET['art_id']);

    // Fetch art details from the database
    $query = "SELECT * FROM art WHERE art_id = $art_id AND user_id = $user_id";
    $result = mysqli_query($cn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $art = mysqli_fetch_assoc($result);
    } else {
        $_SESSION['msg'] = "Art not found or you don't have permission to edit this art.";
        header("Location: art.php");
        exit();
    }
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission for updating art details
    $art_id = intval($_POST['art_id']);

    // Fetch existing art details from the database
    $query = "SELECT * FROM art WHERE art_id = $art_id AND user_id = $user_id";
    $result = mysqli_query($cn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Art exists, proceed with updating
        $art = mysqli_fetch_assoc($result);

        // Update art details in the database
        $art_name = mysqli_real_escape_string($cn, $_POST['art_name']);
        $art_desc = mysqli_real_escape_string($cn, $_POST['art_desc']);
        $art_qty = intval($_POST['art_qty']);
        $art_date = mysqli_real_escape_string($cn, $_POST['art_date']);
        $art_amt = floatval($_POST['art_amt']);

        $update_query = "UPDATE art 
                        SET art_name = '$art_name', 
                            art_desc = '$art_desc', 
                            art_qty = $art_qty, 
                            art_date = '$art_date', 
                            art_amt = $art_amt
                        WHERE art_id = $art_id";

        // Execute the query and handle any errors
        $resultUpdate = mysqli_query($cn, $update_query);
        if (!$resultUpdate) {
            // If there is an error, print the error message and the query for debugging
            echo "Error updating record: " . mysqli_error($cn);
            echo "Query: " . $update_query;
            exit(); // Terminate script execution after encountering an error
        } else {
            $_SESSION['msg'] = "Art details updated successfully.";

            // Handle image upload
            if ($_FILES['art_image']['size'] > 0) {
                // Call the upload function to handle image upload
                upload($_FILES['art_image'], $art_id, $cn);
            }

            header("Location: myart.php");
            exit();
        }
    } else {
        // Art not found or user doesn't have permission
        $_SESSION['msg'] = "Art not found or you don't have permission to edit this art.";
        header("Location: art.php");
        exit();
    }
} else {
    // If the form is not submitted through GET or POST, redirect to the art.php page
    header("Location: myart.php");
    exit();
}

// Function to upload files and insert into database
function upload($file, $art_id, $cn)
{
    $targetDirectory = "../images/";
    $targetFile = $targetDirectory . basename($file['name']);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if ($imageFileType == "png" || $imageFileType == "jpg") {
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            // Construct full file path including directory
            $new_art_image = "images/" . basename($file['name']);

            // Update database with new art image path in the art_image table
            $sqlUpdatePic = "UPDATE art_image SET art_image='$new_art_image' WHERE art_id = $art_id";
            $resultUpdatePic = mysqli_query($cn, $sqlUpdatePic);

            if (!$resultUpdatePic) {
                $_SESSION['msg'] = "Error updating art image: " . mysqli_error($cn);
            }
        } else {
            $_SESSION['msg'] = "Sorry, there was an error uploading your file.";
        }
    } else {
        $_SESSION['msg'] = "Invalid file type. Only png and jpg files are allowed.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Art</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap');

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:"Open San", sans-serif;
}

body{
display:flex;
align-items: center;
justify-content: center;
min-height: 100vh;
width: 100%;
padding:0 10px;
}

body::before {
content: "";
position:absolute;
width: 100%;
height: 100%;
background: url(colorful-wallpaper-background-multicolored-generative-ai.jpg);
background-position: center;
background-size: cover;
}

.container{
height:92vh;
width:30vw;
border-radius: 8px;
padding:30px;
text-align: center;
border: 1px solid rgba(255,255,255,0.5);
backdrop-filter: blur(7px);
-webkit-backdrop-filter: blur(7px);
}

form{
display: flex;
flex-direction: column;
}

h2{
font-size:2rem;
margin-bottom:20px;
color:#fff;
}

.input-field{
position: relative;
border-bottom: 2px solid #ccc;
margin:15px 0;
/* display:flex;
justify-content:space-between;
align-items:center; */
}

.input-field label{
position: absolute;
top:50%;
left:0;
transform: translateY(-50%);
color:#fff;
font-size: 16px;
pointer-events:none;
transition:0.15s ease;
}

.input-field input{
width: 100%;
height:40px;
background:transparent;
border:none;
outline:none;
font-size:16px;
color:#fff;
}

.input-field input:focus~label,
.input-field input:valid~label{
font-size: 0.8rem;
top:10px;
transform:translateY(-120%)
}

.container a{
color:#efefef;
text-decoration: none;
}

.container a:hover{
text-decoration: underline;
}

.button{
background: #fff;
color:#000;
font-weight:600;
border:none;
padding:12px 20px;
cursor: pointer;
border-radius: 3px;
font-size: 16px;
border:2px solid transparent;
transition:0.3s ease;
margin-top:5vh;
}

.button:hover{
color:#fff;
border-color: #fff;
background: rgba(255,255,255,0.15);
}

input[value] {
/* Your styles here */
/* position: absolute; */
}

.input-field {
position: relative;
margin: 15px 0;
}

.input-field label {
position: absolute;
top: 0;
left: 0;
color: #fff;
font-size: 16px;
pointer-events: none;
transition: 0.15s ease;
}

.input-field input ,.input-field textarea{
width: 100%;
height: 40px;
background: transparent;
border: none;
outline: none;
font-size: 16px;
color: #fff;
padding-top: 20px; /* Adjust the padding to create space between label and input */
}

.input-field input:focus ~ label,
.input-field input:valid ~ label {
font-size: 0.8rem;
top: 10px;
transform: translateY(-120%);
}

    </style>
</head>
<body>
    <div class="container">

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            
        <h2>Edit Art</h2>
        
        <div class="input-field">
            
            <input type="hidden" name="art_id" value="<?php echo $art['art_id']; ?>">
            
            <label>Art name:</label>
            <input type="text" name="art_name" value="<?php echo $art['art_name']; ?>" required>
        </div>

        <div class="input-field">
            <label>Art description:</label><br>
            <textarea name="art_desc" rows="4" cols="50"><?php echo $art['art_desc']; ?></textarea>
        </div>
        
        <div class="input-field">
            <label>Quantity:</label>
            <input type="number" name="art_qty" value="<?php echo $art['art_qty']; ?>" required>
        </div>

        <div class="input-field">
            <label>Art date:</label>
            <input type="date" name="art_date" value="<?php echo $art['art_date']; ?>" required>
        </div>
        
        <div class="input-field">
            <label>Amount:</label>
            <input type="number" name="art_amt" value="<?php echo $art['art_amt']; ?>" step="0.01" required>
        </div>

        <div class="input-field">
            <label>Upload New Image:</label><br>
            <input type="file" name="art_image" accept="image/*">
            
            <?php if ($art && isset($art['art_image'])): ?>
                <img src="../<?php echo $art['art_image']; ?>" alt="Current Art Image" width="100" height="100" />
                <?php endif; ?>
        </div>
        
            <input class="button" type="submit" value="Update" name="submit">
        </form>
    </div>
</body>
</html>