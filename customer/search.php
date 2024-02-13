<?php
// Add database connection code here (same as in index.php)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "artibidz";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_GET['search'])){
    $search = $_GET['search'];
    $sql = "SELECT art.art_id, art.art_name, art.art_amt, art_image.art_image
	FROM art
	INNER JOIN sub_category ON art.sub_cat_id = sub_category.sub_cat_id
	INNER JOIN category ON sub_category.cat_id = category.cat_id
	INNER JOIN art_image ON art.art_id = art_image.art_id
	WHERE category.cat_name LIKE '%$search%' 
	   OR sub_category.sub_cat_name LIKE '%$search%'
	   OR art.art_name LIKE '%$search%'
	GROUP BY art.art_id";
    $result = $conn->query($sql);

    // Output search results
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<div class="mix col-lg-3 col-md-6 best">';
            echo '<div class="product-item">';
            // Output product details here
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "<p>No results found.</p>";
    }
}
?>
