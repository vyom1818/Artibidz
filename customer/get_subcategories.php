<?php
// Include database connection code
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

if (isset($_GET['category_id'])) {
    $categoryId = $_GET['category_id'];

    // Fetch subcategories based on the selected category
    $subcategoryQuery = "SELECT * FROM sub_category WHERE cat_id = $categoryId";
    $subcategoryResult = $conn->query($subcategoryQuery);

    if ($subcategoryResult->num_rows > 0) {
        while ($subcategoryRow = $subcategoryResult->fetch_assoc()) {
            $subcategoryName = $subcategoryRow['sub_cat_name'];
            ?>
            <li class="ddi">
                <a class="dropdown-item dda" href="#" onclick="getArts(<?php echo $subcategoryRow['sub_cat_id']; ?>)">
                    <?php echo $subcategoryName; ?>
                </a>
            </li>
        <?php }
    } else {
        echo "<li>No subcategories found</li>";
    }
}
?>
