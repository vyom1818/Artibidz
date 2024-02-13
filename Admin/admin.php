<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styleadmin.css">
    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById("mySidebar");
            sidebar.style.width = (sidebar.style.width === "20%") ? "110px" : "20%";
        }
    </script>

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
                    <li class="active">
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
                <h2>Dashboard</h2>
                <span class="path">Artibidz > Dashboard</span>
            </div>
            <div class="user-info">
                <a href="#" class="report-list">Report List</a>
            </div>
        </div>
    </div>
</body>
</html>