<?php
session_start();

$cn = mysqli_connect("localhost", "root", "", "artibidz") or die("Check connection");

if ($cn) {
    if (isset($_GET['art_id'])) {
        $art_id = $_GET['art_id'];

        // Delete records from 'art_image' table
        $sqlImage = "DELETE FROM `art_image` WHERE `art_id` = '$art_id';";
        $resultImage = mysqli_query($cn, $sqlImage);
        
        if ($resultImage) {
            // Delete record from 'art' table
            $sqlArt = "DELETE FROM `art` WHERE `art_id` = '$art_id';";
            $resultArt = mysqli_query($cn, $sqlArt);

            if ($resultArt) {
                $_SESSION['msg'] = "Art product deleted";
                header('location:myart.php');
                exit();
            } else {
                echo "Error deleting record from 'art' table: " . mysqli_error($cn);
            }
        } else {
            echo "Error deleting records from 'art_image' table: " . mysqli_error($cn);
        }
    } else {
        echo "Art ID not provided";
    }
} else {
    echo "Failed to connect to the database";
}
?>
