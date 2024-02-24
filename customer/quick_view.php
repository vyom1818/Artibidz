<?php
// Establish database connection
$cn = mysqli_connect("localhost", "root", "", "artibidz") or die("Check connection");

// Check if art_id is provided in the URL
if(isset($_GET['art_id'])) {
    $art_id = $_GET['art_id'];

    // SQL query to fetch art details
    $sqlArtDetails = "SELECT art.*, 
                     (SELECT fname FROM user WHERE user_id = art.user_id) AS artist_name 
                      FROM art 
                      WHERE art.art_id = $art_id";
    
    // Execute the SQL query
    $resultArtDetails = mysqli_query($cn, $sqlArtDetails);
    
    // Fetch the art details and assign it to $artDetails
    $artDetails = mysqli_fetch_assoc($resultArtDetails);
    
    // Fetch images related to the art
    $sqlImages = "SELECT * FROM art_image WHERE art_id = $art_id";
    $resultImages = mysqli_query($cn, $sqlImages);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Details</title>
    
</head>
<body>
    <h1>Art Details</h1>
    
    <?php if(isset($artDetails)): ?>
    <div>
        <h2><?php echo $artDetails['art_name']; ?></h2>
        <p>Description: <?php echo $artDetails['art_desc']; ?></p>
        <p>Price: $<?php echo $artDetails['art_amt']; ?></p>
        <p>Art Date: <?php echo $artDetails['art_date']; ?></p>
        <p>Artist: <?php echo $artDetails['artist_name']; ?></p>
        <div class="art-images center">
            <?php while($image = mysqli_fetch_assoc($resultImages)): ?>
                <img src="../<?php echo $image['art_image']; ?>" alt="<?php echo $image['art_image']; ?>" onclick="showFullImage('<?php echo $image['art_image']; ?>')" width="100" height="100" />
            <?php endwhile; ?>
        </div>
    </div>
    <?php endif; ?>
</body>
</html>
