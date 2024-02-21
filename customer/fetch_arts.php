<?php
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "artibidz";

 $conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['subcategory'])) {
    $subcategory = $_GET['subcategory'];
    $query = "SELECT * FROM art WHERE sub_cat_id = (SELECT sub_cat_id FROM sub_category WHERE sub_cat_name  like '$subcategory')";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<div class="mix col-lg-3 col-md-6 best">';
                echo $row['art_name'];
            echo '</div>';
        }
    } else {
        echo '<p>No results found.</p>';
    }
} else {
    echo '<p>No subcategory selected.</p>';
}

$conn->close();
?>
