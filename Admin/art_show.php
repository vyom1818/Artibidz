<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styletable.css">
    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById("mySidebar");
            sidebar.style.width = (sidebar.style.width === "20%") ? "110px" : "20%";
        }
        function showFullDescription(description) {
            document.getElementById("fullDescription").innerHTML = description;
            document.getElementById("myModal").style.display = "block";
        }
    
        function closeModal() {
            document.getElementById("myModal").style.display = "none";
        }
        function showFullImage(imageSrc) {
        var modal = document.getElementById("imageModal");
        var modalImg = document.getElementById("fullImage");
        modal.style.display = "block";
        modalImg.src = imageSrc;
    }

    function closeImageModal() {
        document.getElementById("imageModal").style.display = "none";
    }
    </script>
    <!-- JavaScript placed either in the <head> section or in an external file -->

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

.fl-table .desc{
    text-align:left;
    width:5vw;
    /* height:10vh; */
}

.fl-table td, .fl-table th {
    text-align:center;
    padding: 12px 2px;
}

/* Description */

/* Updated CSS */
.desc {
    text-align: left;
    width: 8vw;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 15vw; /* Adjust max-width as needed */
    cursor: pointer; /* Add cursor pointer to indicate it's clickable */
}

/* Tooltip */
.tooltip {
    position: relative;
    display: inline-block;
}

.tooltip .tooltiptext {
    visibility: hidden;
    width: max-content;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 10px;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -60px; /* Adjust according to your layout */
}

.tooltip:hover .tooltiptext {
    visibility: visible;
}

/* Modal */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    padding-top: 100px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.9);
}

.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
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
                    <li class="active">
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
                    <li>
                        <a href="order_return.php">
                            <i class="fa-solid fa-rotate-left"></i>
                            <span>Order Return</span>
                        </a>
                    </li>
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
                    <li>
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
                    <a href="#">
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
                <h2>Artifacts</h2>
                <span class="path">Artibidz > Dashboard > Artifacts</span>
            </div>
            <div class="user-info">
                <a href="#" class="report-list">Report List</a>
            </div>
        </div>
      
        <div class="body-wapper">
    <?php
     $cn=mysqli_connect("localhost","root","","artibidz") or die("Check connection");
    $sql = "select * from art";

    $result = mysqli_query($cn,$sql);

    echo "<br>";
    
    // echo mysqli_num_rows($result)." records found";
    echo "<div class='table-wrapper'>";
    echo " <table class='fl-table'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Art Id</th>";
    echo "<th>Art Name</th>";
    echo "<th>Description</th>";
    echo "<th>Date</th>";
    echo "<th>Art_amount</th>";
    echo "<th>Quantity</th>";
    echo "<th>Sub-Category</th>";
    echo "<th>Category</th>";
    echo "<th>Art Images</th>";
    //echo "<td>Edit | Delete</td>";
    echo "</tr>";
    echo "<thead>";
                
    while($row = mysqli_fetch_array($result))   {
      echo "<tr>";
      echo "<tbody>";
      echo "<td>{$row['art_id']}</td>";
      echo "<td>{$row['art_name']}</td>";
        // echo "<td class='desc'>{$row['art_desc']}</td>";
        // <!-- Inside the while loop where you display product descriptions -->
    ?>  
        <td class="desc tooltip" onclick="showFullDescription('<?php echo $row['art_desc']; ?>')">
    <?php echo $row['art_desc']; ?>
    <span class="tooltiptext">Click to view full description</span>
      </td>
<?php
        echo "<td>{$row['art_date']}</td>";
        echo "<td>{$row['art_amt']}</td>";
        echo "<td>{$row['art_qty']}</td>";
            $sql2="select * from sub_category where sub_cat_id=".$row['sub_cat_id'];
            $result2 = mysqli_query($cn,$sql2);
          $row2 = mysqli_fetch_array($result2);
        echo "<td>{$row2['sub_cat_name']}</td>";
        $sql3="select * from category where cat_id=".$row2['cat_id'];
          $result3 = mysqli_query($cn,$sql3);
          $row3 = mysqli_fetch_array($result3);
        echo "<td>{$row3['cat_name']}</td>";
            $sql1="select * from art_image where art_id={$row['art_id']}";
          $result1 = mysqli_query($cn,$sql1);
?>
          <!-- //  echo "<td class='desc'>";
        //     while($row1 = mysqli_fetch_array($result1))
        //     {
        //        echo"<img src=${row1['art_image']} alt='${row1['art_image']}' width=100 height=100 />";
        //        echo"&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
        //     }

        //  echo "</td>";

        // Inside the while loop where you display the images -->
<td class="desc art-images">
    <?php
    while($row1 = mysqli_fetch_array($result1)) {
        echo "<img src='../${row1['art_image']}' alt='${row1['art_image']}' onclick='showFullImage(\"${row1['art_image']}\")' width='100' height='100' />";
    }
    ?>
</td>
<?php
        
        // echo "<td><a href='edit_city.php?city_id=$row[art_id]'><u>Edit</u></a> | <a href='del_art.php?art_id=$row[art_id]'><u>Delete</u></a></td>";
        echo "</tr>";
        echo "</tbody>";
    }
   
    echo "</table>";
    echo "</div>";

    ?>

          </div>
      </div>
    <div id="imageModal" class="modal">
    <span class="close" onclick="closeImageModal()">&times;</span>
    <img class="modal-content" id="fullImage">
    </div>
      </body>
      </html>