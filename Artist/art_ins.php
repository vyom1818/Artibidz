<?php
session_start();

// Function to upload files and insert into database
function upload($file, $highestValue, $cn)
{
    $targetDirectory = "../images/";
    $targetFile = $targetDirectory . basename($file['name']);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (isset($file)) {
        if ($imageFileType == "png" || $imageFileType == "jpg") {
            if (move_uploaded_file($file['tmp_name'], $targetFile)) {
                $sql = "INSERT INTO art_image(art_id, art_image) VALUES ('$highestValue', 'images/$file[name]')";
                $result = mysqli_query($cn, $sql);
                if (!$result) {
                    echo json_encode(["error" => "Failed to insert image into database."]);
                }
            } else {
                echo json_encode(["error" => "Failed to upload file."]);
            }
        } else {
            echo json_encode(["error" => "Only png and jpg files are allowed."]);
        }
    }
}

// Check if all form fields are set
if (
    isset($_POST['art_name']) && isset($_POST['art_desc']) &&
    isset($_POST['art_qty']) && isset($_POST['art_date']) &&
    isset($_POST['art_amt']) && isset($_POST['sub_cat_id']) &&
    isset($_SESSION['user_id']) // Check if user ID is set in the session
) {
    $cn = mysqli_connect("localhost", "root", "", "artibidz") or die("check connection");

    // Sanitize and retrieve form data
    $art_name = mysqli_real_escape_string($cn, $_POST['art_name']);
    $art_desc = mysqli_real_escape_string($cn, $_POST['art_desc']);
    $art_qty = intval($_POST['art_qty']); // Convert to integer
    $art_date = mysqli_real_escape_string($cn, $_POST['art_date']);
    $art_amt = floatval($_POST['art_amt']); // Convert to float
    $sub_cat_id = intval($_POST['sub_cat_id']); // Convert to integer
    $user_id = intval($_SESSION['user_id']); // Fetch user ID from session
    $sale_or_auction=$_POST['sale_or_auction'];

    // Insert art into database
    $sql = "INSERT INTO art (art_name, art_desc, art_date, art_amt, art_qty, sub_cat_id, user_id,sale_or_auction)VALUES('$art_name', '$art_desc', '$art_date', $art_amt, $art_qty, $sub_cat_id, $user_id,'$sale_or_auction')";
    $result = mysqli_query($cn, $sql);

    if ($result) {
        // Retrieve the highest art_id inserted
        $sql = "SELECT MAX(art_id) AS max FROM art";
        $result = mysqli_query($cn, $sql);
        $res = mysqli_fetch_array($result);
        $highestValue = $res['max'];

        // Upload and insert images into database
        upload($_FILES['file1'], $highestValue, $cn);
        upload($_FILES['file2'], $highestValue, $cn);
        upload($_FILES['file3'], $highestValue, $cn);

        $_SESSION['msg'] = "Art inserted";
        header("Location: art.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($cn);
    }
} else {
    echo "All fields are required";
}
?>
