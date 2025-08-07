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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
   

    // Update artist profile in the database
    $sqlUpdate = "UPDATE user SET fname='$fname', lname='$lname' WHERE user_id = $user_id";
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
height:78vh;
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

.input-field input {
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

        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" autocomplete="off">

        <h2>Edit User Profile</h2>
            
        <div class="input-field">
            <label for="fname">First Name:</label>
            <input type="text" id="fname" name="fname" value="<?php echo $artist['fname']; ?>"><br><br>
        </div>

        <div class="input-field">
            <label for="lname">Last Name:</label>
            <input type="text" id="lname" name="lname" value="<?php echo $artist['lname']; ?>"><br><br>
        </div>

        <div class="input-field">
            <label for="email_address">Email Address:</label>
            <input type="text" id="email_address" name="email_address" value="<?php echo $artist['email_address']; ?>" readonly style="filter: blur(1px);"><br><br>
        </div>
            
        <div class="input-field">
            <label for="contact_no">Contact Number:</label>
            <input type="text" id="contact_no" name="contact_no" value="<?php echo $artist['contact_no']; ?>" readonly style="filter: blur(1px);"><br><br>
        </div>
            

            <input class="button" type="submit" value="Submit">
        </form>
    </div>
</body>
    
</html>

<?php
// Close database connection
mysqli_close($cn);
?>
