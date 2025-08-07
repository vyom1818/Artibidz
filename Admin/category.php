<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="stylecity.css">
    <link href="artibidz-logo.png" rel="shortcut icon"/>
    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById("mySidebar");
            sidebar.style.width = (sidebar.style.width === "20%") ? "110px" : "20%";
        }
    </script>
<?php session_start();
//include("../includes/connect.php");
 ?>            
<style>
.scrollbox{
    overflow: auto;
    padding-right: 10px;
    /* visibility: hidden; */
    height: 67vh;
}

::-webkit-scrollbar{
    width: 8px;
}

::-webkit-scrollbar-thumb{
    background: #e6e6e6;
    border-radius: 10px;
}

.sidebar{
    display: flex;
    flex-direction: column;
    padding: 20px 20px 0 20px;
}

.logo img{
    margin-top:2vh;
}

.body-wrapper{
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
}

.search{
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    background:#324960;
    width:74vw;
    color:white;
}

.take-input{
    display:flex;
    justify-content:space-around;
    align-items:center;
    padding:5px;
}

input[type="submit"]{
    background:#fff;
    border:1px solid white;
    height:3vh;
    width:6vw;
    border-radius:2px;
    color:black;
    margin:1vh 1vw;
}

input[type="submit"]:hover{
    cursor:pointer;
}

input[type="text"]{
    background:transparent;
    border-bottom:1px solid #fff;
    color:#fff;
}

.show-result{
    width: 41vw;
    text-align: center;
}

label{
    margin:1vh 1vw;
}
</style>
</head>
<body>
    <div class="sidebar" id="mySidebar">
        <header>
            <div class="logo">
                <img src="artibidz-logo.png" alt="">
            </div>
            <div class="bar" onclick="toggleSidebar()">
                <i class="fa-sharp fa-solid fa-bars fa-xl"></i>
            </div>
        </header>
        <div class="scrollbox">
            <div class="scrollbox-inner">

                <ul class="menu">
                    <li>
                <a href="admin.php">
                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="art_show.php">
                    <i class="fa-brands fa-slack"></i>
                    <span>Artifacts</span>
                </a>
            </li>
            <li>
                <a href="show_bid.php">
                    <i class="fa-solid fa-gavel"></i>
                    <span>Auction</span>
                </a>
            </li>
            <li>
                <a href="view_order.php">
                <i class="fa-solid fa-file-pen"></i>
                <span>Orders</span>
                </a>
            </li>
            <!-- <li>
                <a href="order_return.php">
                <i class="fa-solid fa-rotate-left"></i>
                <span>Order Return</span>
                </a>
            </li> -->
            <li>
                <a href="city.php">
                    <i class="fa-solid fa-city"></i>
                    <span>City</span>
                </a>
            </li>
            <li>
                <a href="state.php">
                    <i class="fa-solid fa-location-dot"></i>
                    <span>State</span>
                </a>
            </li>
            <li class="active">
                <a href="category.php">
                    <i class="fa-solid fa-table-list"></i>
                    <span>Category</span>
                </a>
            </li>
            <li>
                <a href="sub_category.php">
                    <i class="fa-solid fa-list"></i>
                    <span>Sub-Category</span>
                </a>
            </li>
            
            <li>
                <a href="payment.php">
                    <i class="fa-regular fa-credit-card"></i>
                    <span>Payment</span>
                </a>
            </li>
            <li>
                <a href="shipping.php">
                    <i class="fa-solid fa-truck"></i>
                    <span>Shipping</span>
                </a>
            </li>
            <li>
                <a href="feedback.php">
                    <i class="fa-regular fa-comment"></i>
                    <span>Feedback</span>
                </a>
            </li>
        </ul>
        </div>
        </div>
        <footer>
        <ul class="menu">
            <li>
                <a href="../login/login.php">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </footer>
    </div>

    <div class="main-content">
        
        <div class="header-wrapper">
            <div class="header-title">
                <h2>Category</h2>
                <span class="path">Artibidz > Dashboard > Category</span>
            </div>
            <div class="user-info">
                <a href="order_report.php" class="report-list">Report List</a>
            </div>
        </div>

        <div class="body-wrapper">

            
    <form action="categoryins.php" method="post">
        <div class="search">

            <div class="take-input">
                
                <label>
                    Category:
                    <input type="text" name="cat_name">
                </label>
                <input type="submit" value="Submit" name="btn">
            </div>
            
        </form>
            <div class="show-result">
                
                <?php
                if(isset($_SESSION['msg'])){
                    echo $_SESSION['msg'];
                    unset ($_SESSION['msg']);
                }
                ?>
<?php
     $cn=mysqli_connect("localhost","root","","artibidz") or die("Check connection");
     $sql = "select * from category";
     $result = mysqli_query($cn,$sql);
     
     echo "<br>";
     
    // echo mysqli_num_rows($result)." records found";?>
            </div>
        </div>
</table>
<?php
    echo "<div class='table-wrapper'>";
     echo "<table class='fl-table'>";
     echo "<thead>";
     echo "<tr>"; 
     echo "<th>Category Id</th>";
     echo "<th>Category Name</th>";
     echo "<th>Add New</th>";
     echo "</tr>";
     echo "</thead>";
     
     while($row = mysqli_fetch_array($result))   {
        echo "<tr>";
        echo "<tbody>";
        echo "<td>{$row['cat_id']}</td>";
        echo "<td>{$row['cat_name']}</td>";
        echo "<td><a class='anchor' href='edit_category.php?cat_id=$row[cat_id]}'>Edit</a> | <a class='anchor'href='del_category.php?cat_id=$row[cat_id]'>Delete</a></td>";
        echo "</tr>";
        echo "</tbody>";
    }
    echo "</table>";
    echo "</div>";
    ?>

</div>
</div>
</body>
</html>