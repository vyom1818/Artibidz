<!DOCTYPE html>
<?php
// Include the FPDF library
require('../customer/fpdf.php');

// Create connection to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "artibidz";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styletable.css">
    <link href="artibidz-logo.png" rel="shortcut icon"/>
    <style>
    .logo img{
        margin-top:2vh;
    }
    .body-wrapper{
        flex-direction:column;
    }
    button{
        background:none;
    }
    button:hover{
        cursor:pointer;
    }
    </style>
</head>
<body>
<div class="main-content">

    <div class="body-wrapper">
    <div class="table-wrapper">
        <table class="fl-table">
            <h2><?php echo "Users who have placed orders:";?></h2>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Generate Report</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $sql_ordered_users = "SELECT DISTINCT u.user_id, u.username FROM user u LEFT JOIN orders o ON u.user_id = o.user_id WHERE o.user_id IS NOT NULL";
            $result_ordered_users = $conn->query($sql_ordered_users);

            // Display users who have placed orders and provide a button to generate report

            if ($result_ordered_users->num_rows > 0) {
                while ($row_ordered_user = $result_ordered_users->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo $row_ordered_user['user_id'];?></td>
                    <td><?php echo $row_ordered_user['username']; ?></td>
                    <td><?php echo "<button onclick='generateReport(" . $row_ordered_user['user_id'] . ")'>Generate Report</button>"; ?></td>
                </tr>
            <?php 
                }
            } else {
                echo "<tr><td colspan='3'>No users have placed orders.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <div class="table-wrapper">
        <table class="fl-table">
            <h2><?php echo "Users who haven't placed orders:";?></h2>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $sql_unordered_users = "SELECT user_id, username FROM user WHERE user_id NOT IN (SELECT user_id FROM orders)";
            $result_unordered_users = $conn->query($sql_unordered_users);

            // Display users who haven't placed orders

            if ($result_unordered_users->num_rows > 0) {
                while ($row_unordered_user = $result_unordered_users->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo $row_unordered_user['user_id']; ?></td>
                    <td><?php echo $row_unordered_user['username']; ?></td>
                </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='2'>All users have placed orders.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
    </div>

</div>


<script>
function generateReport(userId) {
    // Create a hidden iframe
    var iframe = document.createElement('iframe');
    iframe.style.display = 'none';
    document.body.appendChild(iframe);
    
    // Set its src to the PHP script with user_id parameter
    iframe.src = 'generate_report.php?user_id=' + userId;
}
</script>
</body>

<?php // Close database connection
$conn->close();
?>
</html>
