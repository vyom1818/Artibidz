<?php
session_start();
// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "artibidz";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$order_id = $_GET['order_id'];

// Fetch ship_status from shipping table
$sql = "SELECT ship_status FROM shipping WHERE order_id = '$order_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $ship_status = $row["ship_status"];

    // Determine which steps should be active based on ship_status
    switch ($ship_status) {
        case "Pending":
            $step1_class = "active";
            $step2_class = "";
            $step3_class = "";
            $step4_class = "";
            break;
        case "Shipped":
            $step1_class = "active";
            $step2_class = "active";
            $step3_class = "";
            $step4_class = "";
            break;
        case "Out for delivery":
            $step1_class = "active";
            $step2_class = "active";
            $step3_class = "active";
            $step4_class = "";
            break;
        case "Delivered":
            $step1_class = "active";
            $step2_class = "active";
            $step3_class = "active";
            $step4_class = "active";
            break;
        default:
            $step1_class = "";
            $step2_class = "";
            $step3_class = "";
            $step4_class = "";
    }
} else {
    // Handle case where no shipping information is found for the order
    $step1_class = "";
    $step2_class = "";
    $step3_class = "";
    $step4_class = "";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Progress</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            color: #000;
            overflow-x: hidden;
            height: 100%;
            background-color: #8C9EFF;
            background-repeat: no-repeat;
        }

        .card {
            z-index: 0;
            background-color: #ECEFF1;
            padding-bottom: 20px;
            margin-top: 90px;
            margin-bottom: 90px;
            border-radius: 10px;
        }

        .top {
            padding-top: 40px;
            padding-left: 13% !important;
            padding-right: 13% !important;
        }

        /*Icon progressbar*/
        #progressbar {
            margin-bottom: 30px;
            overflow: hidden;
            color: #455A64;
            padding-left: 0px;
            margin-top: 30px;
        }

        #progressbar li {
            list-style-type: none;
            font-size: 13px;
            width: 25%;
            float: left;
            position: relative;
            font-weight: 400;
        }

        #progressbar .step0:before {
            font-family: FontAwesome;
            content: "\f10c";
            color: #fff;
        }

        #progressbar li:before {
            width: 40px;
            height: 40px;
            line-height: 45px;
            display: block;
            font-size: 20px;
            background: #C5CAE9;
            border-radius: 50%;
            margin: auto;
            padding: 0px;
        }

        /*ProgressBar connectors*/
        #progressbar li:after {
            content: '';
            width: 100%;
            height: 12px;
            background: #C5CAE9;
            position: absolute;
            left: 0;
            top: 16px;
            z-index: -1;
        }

        #progressbar li:last-child:after {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
            position: absolute;
            left: -50%;
        }

        #progressbar li:nth-child(2):after, #progressbar li:nth-child(3):after {
            left: -50%;
        }

        #progressbar li:first-child:after {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
            position: absolute;
            left: 50%;
        }

        #progressbar li:last-child:after {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        #progressbar li:first-child:after {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        /*Color number of the step and the connector before it*/
        #progressbar li.active:before, #progressbar li.active:after {
            background: #651FFF;
        }

        #progressbar li.active:before {
            font-family: FontAwesome;
            content: "\f00c";
        }

        .icon {
            width: 60px;
            height: 60px;
            margin-right: 15px;
        }

        .icon-content {
            padding-bottom: 20px;
        }

        @media screen and (max-width: 992px) {
            .icon-content {
                width: 50%;
            }
        }
    </style>
</head>
<body>
    <div class="container px-1 px-md-4 py-5 mx-auto">
        <div class="card">
            <div class="row d-flex justify-content-between px-3 top">
                <div class="d-flex">
                    <h5><span class="text-primary font-weight-bold"><?php echo strtoupper($_GET['order_id']); ?></span></h5>
                </div>
                <div class="d-flex flex-column text-sm-right">
                    <p class="mb-0">Expected Arrival <span><?php echo $_SESSION['date']; ?></span></p>
                </div>
            </div>
            <!-- Add class 'active' to progress -->
            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <ul id="progressbar" class="text-center">
                        <li class="<?php echo $step1_class; ?>"></li>
                        <li class="<?php echo $step2_class; ?>"></li>
                        <li class="<?php echo $step3_class; ?>"></li>
                        <li class="<?php echo $step4_class; ?>"></li>
                    </ul>
                </div>
            </div>
            <div class="row justify-content-between top">
                <div class="row d-flex icon-content">
                    <img class="icon" src="https://i.imgur.com/9nnc9Et.png">
                    <div class="d-flex flex-column">
                        <p class="font-weight-bold">Order<br>Processed</p>
                    </div>
                </div>
                <div class="row d-flex icon-content">
                    <img class="icon" src="https://i.imgur.com/u1AzR7w.png">
                    <div class="d-flex flex-column">
                        <p class="font-weight-bold">Order<br>Shipped</p>
                    </div>
                </div>
                <div class="row d-flex icon-content">
                    <img class="icon" src="https://i.imgur.com/TkPm63y.png">
                    <div class="d-flex flex-column">
                        <p class="font-weight-bold">Order<br>On Route</p>
                    </div>
                </div>
                <div class="row d-flex icon-content">
                    <img class="icon" src="https://i.imgur.com/HdsziHP.png">
                    <div class="d-flex flex-column">
                        <p class="font-weight-bold">Order<br>Arrived</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
