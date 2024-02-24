<?php
function connectToDatabase() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "artibidz";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function handleSearch($conn, $limit = 20) {
    $sql = "SELECT art.art_id, art.art_name, art.art_amt, art_image.art_image
    FROM art
    INNER JOIN sub_category ON art.sub_cat_id = sub_category.sub_cat_id
    INNER JOIN category ON sub_category.cat_id = category.cat_id
    INNER JOIN art_image ON art.art_id = art_image.art_id";

    // If search term is present, add search conditions to the query
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $sql .= " WHERE category.cat_name LIKE '%$search%' 
            OR sub_category.sub_cat_name LIKE '%$search%'
            OR art.art_name LIKE '%$search%'";
    }

    $sql .= " GROUP BY art.art_id";

    // Get total number of results
    $totalResult = $conn->query($sql);
    $totalRows = $totalResult->num_rows;

    // Calculate total pages
    $totalPages = ceil($totalRows / $limit);

    // Add pagination
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $offset = ($page - 1) * $limit;
    $sql .= " LIMIT $offset, $limit";

    $result = $conn->query($sql);

    return array($result, $totalPages);
}



function displayCategories($conn) {
    $categoryQuery = "SELECT * FROM category";
    $categoryResult = $conn->query($categoryQuery);

    if ($categoryResult->num_rows > 0) {
        while ($categoryRow = $categoryResult->fetch_assoc()) {
            $categoryId = $categoryRow['cat_id'];
            $categoryName = $categoryRow['cat_name'];
            ?>
            <li class="ddi">
                <a class="dropdown-item dda" href="#" onclick="getSubcategories(<?php echo $categoryId; ?>)">
                    <?php echo $categoryName; ?>
                </a>
                <!-- Subcategory dropdown -->
                <ul class="dropdown-menu subcategory-dropdown" id="subcategory-dropdown-<?php echo $categoryId; ?>"></ul>
            </li>
        <?php }
    } else {
        echo "<li>No categories found</li>";
    }
}

function addToCart($conn) {
    session_start();

    if(isset($_POST['add_to_cart'])) {
        // Check if user is logged in
        if(!isset($_SESSION['user_id'])) {
            // Redirect to login page
            header('Location: ../Login/login.php');
            exit;
        }

        $art_id = $_POST['art_id'];

        // Fetch the art details from the database based on the art_id
        $art_query = "SELECT * FROM art WHERE art_id = $art_id";
        $art_result = $conn->query($art_query);
        $art_row = $art_result->fetch_assoc();

        // Create a new item array to store the art details
        $item = array(
            'art_id' => $art_row['art_id'],
            'art_name' => $art_row['art_name'],
            'art_amt' => $art_row['art_amt'],
            'art_qty' => 1, // Initial quantity is 1
            'user_id' => $_SESSION['user_id'] // Store the user_id with the item
        );

        // Check if the cart session variable is set
        if(!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array(); // If not, create an empty array
        }

        // Check if the art is already in the cart for this user
        $art_in_cart = false;
        foreach($_SESSION['cart'] as $key => $cart_item) {
            if($cart_item['art_id'] == $item['art_id'] && $cart_item['user_id'] == $item['user_id']) {
                $_SESSION['cart'][$key]['art_qty']++; // If yes, increase the quantity
                $art_in_cart = true;
                break;
            }
        }

        // If the art is not already in the cart for this user, add it as a new item
        if(!$art_in_cart) {
            $_SESSION['cart'][] = $item;
        }

        // Redirect back to the index page or wherever you want
        header('Location: cart.php');
        exit;
    }
}
function clearCart() {
    // Check if user is logged in
    if (isset($_SESSION['user_id'])) {
        // Clear the cart for the logged-in user
        unset($_SESSION['cart']);
        
        // Return a success message
        return "Cart cleared successfully";
    } else {
        // Return an error message if user is not logged in
        return "User not logged in";
    }
}

// Check if the clearCart parameter is set and call the function
if (isset($_GET['clearCart']) && $_GET['clearCart'] == 'true') {
    echo clearCart();
}
?>

