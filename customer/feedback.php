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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    if(isset($_POST['art_id'])) {
        $art_id = mysqli_real_escape_string($cn, $_POST['art_id']);
    } else {
        $art_id = null;
    }
    $feedback = mysqli_real_escape_string($cn, $_POST['feedback']);

    // Get the current date and time
    $feedback_date = date('Y-m-d H:i:s');

    // Insert feedback into the database
    $insertQuery = "INSERT INTO feedback (user_id, art_id, feedback, feedback_date) VALUES ('$user_id', '$art_id', '$feedback', '$feedback_date')";
    if (mysqli_query($cn, $insertQuery)) {
        echo "<script>alert('Feedback Submitted Succefully !!')</script>";
        echo "<script>window.location.href = 'order.php';</script>";
    } else {
        echo "Error: " . $insertQuery . "<br>" . mysqli_error($cn);
    }
}

// Fetching art details to display
if(isset($_GET['art_id'])) {
    $art_id = $_GET['art_id']; // Assuming art_id is passed through GET method
} else {
    $art_id = null;
}
$query = "SELECT * FROM art WHERE art_id = '$art_id'";
$result = mysqli_query($cn, $query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artibidz</title>
    <link href="img/artibidz-logo.png" rel="shortcut icon"/>
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
height:60vh;
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

.input-field textarea {
width: 100%;
/* height: 40px; */
background: transparent;
border: none;
outline: none;
font-size: 16px;
color: #fff;
margin-top: 5vh; /* Adjust the padding to create space between label and input */
}

.input-field input:focus ~ label,
.input-field input:valid ~ label {
font-size: 0.8rem;
top: 10px;
transform: translateY(-120%);
}

h3{
    color:white;
}

h3{
    margin:5vh auto;
}

    </style>
</head>

<body>
    <div class="container">

        <h2>Feedback Form</h2>
        <?php if(!is_null($row) && isset($row['art_name'])): ?>
        <h3>Art Name: <?php echo ucfirst($row['art_name']); ?></h3>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete="off">
            
                <input type="hidden" name="art_id" value="<?php echo $art_id; ?>">
            <div class="input-field">

                <label for="feedback">Feedback:</label>
                
                <textarea id="feedback" name="feedback" rows="4" cols="50" required></textarea>
            </div>    
                
                <input class="button" type="submit" value="Submit Feedback">
            </form>
    </div>
    <?php else: ?>
        <p></p>
    <?php endif; ?>
</body>

</html>