<?php
session_start();
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

    // Add condition to get only arts available on sale
    $sql .= " AND art.sale_or_auction = 'Sale'";

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
    // session_start();

    if(isset($_POST['add_to_cart'])) {
        // Check if user is logged in
        if(!isset($_SESSION['user_id'])) {
            // Redirect to login page
            header('Location: ../Login/login.php');
            exit;
        }

        $art_id = $_POST['art_id'];
        $user_id = $_SESSION['user_id'];

        // Check if the art is already in the cart for this user
        $check_query = "SELECT * FROM cart WHERE art_id = $art_id AND user_id = $user_id";
        $check_result = $conn->query($check_query);

        if ($check_result->num_rows > 0) {
            // If the art is already in the cart, update the quantity
            $cart_item = $check_result->fetch_assoc();
            $new_qty = $cart_item['cart_art_qty'] + 1;
            $update_query = "UPDATE cart SET cart_art_qty = $new_qty WHERE cart_id = {$cart_item['cart_id']}";
            $conn->query($update_query);
        } else {
            // If the art is not in the cart, insert a new record
            $insert_query = "INSERT INTO cart (user_id, art_id, cart_art_qty) VALUES ($user_id, $art_id, 1)";
            $conn->query($insert_query);
        }

        // Redirect back to the index page or wherever you want
        header('Location: cart.php');
        exit;
    }
}

// Function to get total price for an art
function getTotalPrice($qty, $price) {
    return $qty * $price;
}

// Function to update cart
function updateCart($artId, $qty) {
    // session_start();
    $conn = connectToDatabase();
    $userId = $_SESSION['user_id'];
    $updateQuery = "UPDATE cart SET cart_art_qty = $qty WHERE user_id = $userId AND art_id = $artId";
    $conn->query($updateQuery);
}

// Function to remove item from cart
function removeItemFromCart($artId) {
    // session_start();
    $conn = connectToDatabase();
    $userId = $_SESSION['user_id'];
    $deleteQuery = "DELETE FROM cart WHERE user_id = $userId AND art_id = $artId";
    $conn->query($deleteQuery);
}

// Function to clear cart
function clearCart() {
    // session_start();
    $conn = connectToDatabase();
    $userId = $_SESSION['user_id'];
    $deleteQuery = "DELETE FROM cart WHERE user_id = $userId";
    $conn->query($deleteQuery);
}

// functions.php

function getCartItems($userId) {
    $conn = connectToDatabase();

    // Prepare SQL query
    $sql = "SELECT art_id, cart_art_qty FROM cart WHERE user_id = ?";

    // Prepare statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();

    // Bind result variables
    $stmt->bind_result($artId, $cartArtQty);

    $cartItems = array();

    // Fetch results into an array
    while ($stmt->fetch()) {
        $cartItems[] = array(
            'art_id' => $artId,
            'cart_art_qty' => $cartArtQty
        );
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();

    return $cartItems;
}
// functions.php

function getArtAmt($artId) {
    $conn = connectToDatabase();


    $sql = "SELECT art_amt FROM art WHERE art_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $artId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['art_amt'];
    } else {
        return 0; // Return 0 if art_amt not found
    }
}


function getAuctionArts($conn, $perPage) {
    // Initialize arts array
    $arts = array();

    // Count total auction arts
    $sqlCount = "SELECT COUNT(*) AS total FROM art WHERE sale_or_auction = 'Auction'";
    $resultCount = $conn->query($sqlCount);
    $totalCount = $resultCount->fetch_assoc()['total'];

    // Calculate total pages
    $totalPages = ceil($totalCount / $perPage);

    // Get current page
    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    // Calculate offset
    $offset = ($page - 1) * $perPage;

    // Fetch arts for current page
    $sql = "SELECT art.*, 
                (SELECT art_image FROM art_image WHERE art_id = art.art_id LIMIT 1) AS art_image 
            FROM art 
            WHERE sale_or_auction = 'Auction'
            LIMIT $offset, $perPage";
    $result = $conn->query($sql);

    // Populate arts array
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $arts[] = $row;
        }
    }

    // Return arts array and total pages
    return array($arts, $totalPages);
}
