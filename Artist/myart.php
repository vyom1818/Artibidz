<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artist</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styletable.css">
    <link href="artibidz-logo.png" rel="shortcut icon"/>
    <style>
        th{
            background:#00425a;
            color:white;
        }
        .body-wrapper{
            height:100vh;
            flex-direction:column;
            justify-content:flex-start;
        }
        a{
            color:black;
            text-decoration:none;
        }
        .table-wrapper{
            width:100%;
        }
    </style>
</head>
<body>
<div class="main-content">

    <div class="body-wrapper">
    <div class="filter-sort">
    <form method="post">
        <label for="from_date">From Date:</label>
        <input type="date" id="from_date" name="from_date" required>

        <label for="to_date">To Date:</label>
        <input type="date" id="to_date" name="to_date" required>

        <input type="submit" name="apply_filter" value="Apply">

        <label for="sort_by">Sort By:</label>
        <select name="sort_by" id="sort_by">
            <option value="art_date">Date</option>
            <option value="art_amt">Price</option>
            <option value="sale_or_auction">Sale or Auction</option>
        </select>

        <input type="submit" name="sort" value="Sort">
    </form>
</div>
        <?php
        
        $cn = mysqli_connect("localhost", "root", "", "artibidz") or die("check connection");

        // Ensure user_id is set in the session
        if (!isset($_SESSION['user_id'])) {
            // Handle the case where user_id is not set
            // Redirect or display an error message
            exit("User ID is not set.");
        }
        
        $user_id = $_SESSION['user_id'];

        // Initialize variables for date filter and sort order
        $date_filter = "";
        $sort_order = "";

        // Check if filter form is submitted
        if(isset($_POST['apply_filter'])) {
            $from_date = $_POST['from_date'];
            $to_date = $_POST['to_date'];
            $date_filter = "AND art_date BETWEEN '$from_date' AND '$to_date'";
        }

        // Check if sort form is submitted
        if(isset($_POST['sort'])) {
            $sort_by = $_POST['sort_by'];
            $sort_order = "ORDER BY $sort_by";
        }
        
        $sql = "SELECT a.*, u.username
        FROM art a
        JOIN user u ON a.user_id = u.user_id
        WHERE a.user_id = $user_id $date_filter $sort_order";

        $result = mysqli_query($cn, $sql);

        echo "<br>";
        echo "<div class='table-wrapper'>";
        echo "<table class='fl-table'";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Art Id</th>";
        echo "<th>Art Name</th>";
        echo "<th>Description</th>";
        echo "<th>Date</th>";
        echo "<th>Price</th>";
        echo "<th>Quantity</th>";
        echo "<th>Sale or Auction</th>";
        echo "<th>Sub-Category</th>";
        echo "<th>Category</th>";
        echo "<th>Art Images</th>";
        echo "<th>Artist name</th>";
        echo "<th>Edit</th>";
        echo "</tr>";
        echo "</thead>";

        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<tbody>";
            echo "<td>{$row['art_id']}</td>";
            echo "<td>{$row['art_name']}</td>";
            echo "<td>" . substr($row['art_desc'], 0, 5) . "</td>";
            echo "<td>{$row['art_date']}</td>";
            echo "<td>{$row['art_amt']}</td>";
            echo "<td>{$row['art_qty']}</td>";
            echo "<td>{$row['sale_or_auction']}</td>";
        
            $sql2 = "SELECT * FROM sub_category WHERE sub_cat_id=" . $row['sub_cat_id'];
            $result2 = mysqli_query($cn, $sql2);
            $row2 = mysqli_fetch_array($result2);
            echo "<td>{$row2['sub_cat_name']}</td>";
        
            $sql3 = "SELECT * FROM category WHERE cat_id=" . $row2['cat_id'];
            $result3 = mysqli_query($cn, $sql3);
            $row3 = mysqli_fetch_array($result3);
            echo "<td>{$row3['cat_name']}</td>";
        
            $sql1 = "SELECT * FROM art_image WHERE art_id={$row['art_id']}";
            $result1 = mysqli_query($cn, $sql1);
            echo "<td>";
            
            while ($row1 = mysqli_fetch_array($result1)) {
                echo "<img src='../{$row1['art_image']}' alt='{$row1['art_image']}' width=100 height=100 />";
                echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
            }
       
            echo "<td>{$row['username']}</td>";
            
            echo "</td>";
        
            echo "<td><a href='edit_art.php?art_id=$row[art_id]'>Edit</a></td>";
            
            echo "</tr></tbody>";
        }

        echo "</table>";
        echo "</div>";
        
        ?>
    </div>
</div>



</body>
</html>
