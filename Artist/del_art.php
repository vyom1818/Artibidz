<?php
$cn = mysqli_connect("localhost", "root", "", "artibidz") or die("Check connection");


if (isset($_GET['art_id'])) {
    $art_id = $_GET['art_id'];



    // Delete records from 'art_image' table
    $sqlImage = "DELETE FROM `art_image` WHERE `art_id` = '$art_id';";
    mysqli_query($cn, $sqlImage);

    // Delete record from 'art' table
    $sqlArt = "DELETE FROM `art` WHERE `art_id` = '$art_id';";
    mysqli_query($cn, $sqlArt);

    $_SESSION['msg'] = "Art product deleted";
    header('location:art.php');
} 
?>
