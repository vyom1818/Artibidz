<?php
session_start();
$cn = mysqli_connect("localhost", "root", "", "artibidz") or die("Check connection");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Fetching the art ID from the URL parameter
if(isset($_GET['art_id'])) {
    $art_id = mysqli_real_escape_string($cn, $_GET['art_id']);
} else {
    echo "Art ID not provided.";
    exit();
}

// Fetching feedback from the database for the specified art
$query = "SELECT f.feedback_id, f.feedback, f.feedback_date, u.username 
          FROM feedback f
          INNER JOIN user u ON f.user_id = u.user_id
          WHERE f.art_id = '$art_id'";
$result = mysqli_query($cn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Display</title>
</head>

<body>
    <h1>Feedback Display</h1>
    <?php if(mysqli_num_rows($result) > 0): ?>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <div>
                <strong>User: <?php echo $row['username']; ?></strong><br>
                <strong>Feedback ID: <?php echo $row['feedback_id']; ?></strong><br>
                <strong>Feedback Date: <?php echo $row['feedback_date']; ?></strong><br>
                <p><?php echo $row['feedback']; ?></p>
                <hr>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No feedback available for this art.</p>
    <?php endif; ?>
</body>

</html>
