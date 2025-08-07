<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        p{
            color:red;
        }

        body {
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
            width:100vw;
            font-size: 16px;
            color: #222;
            font-family: 'Roboto', sans-serif;
            font-weight: 400;
            margin: 0;
            height: 100vh;
            width: 98vw;
            background-image: url('colorful-wallpaper-background-multicolored-generative-ai.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        h3{
            box-sizing:border-box;
            text-align:center;
            height:20vh;
            width:25vw;
            background:transparent;
            padding:8vh 0;
            color:#fff;
            border-radius: 2px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255,255,255,0.5);
            backdrop-filter: blur(8px);     
        }

    </style>
</head>
<body>

<?php
session_start();

if (isset($_POST['otp'])) {
    $enteredOTP = $_POST['otp'];

    // Check if OTP is correct
    if ($enteredOTP == $_SESSION['otp']) {
        // Check if OTP has not expired (3 minutes)
        $otpStartTime = $_SESSION['otp_start_time'];
        $currentTime = time();

        if (($currentTime - $otpStartTime) <= 180) {
            // OTP is valid, redirect to the appropriate page based on user type
            $userType = $_SESSION['user_type'];

            if ($userType == "admin") {
                header("Location: ../Admin/admin.php");
            } else if ($userType == "customer") {
                header("Location: ../customer/index.php");
            } else if ($userType == "artist") {
                header("Location: ../Artist/artist_profile.php");
            }
        } else {
            echo "<script>alert('OTP has Expired, Please try again.</script>";
            echo "<script>window.location.href = 'login.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid OTP, Please try again.')</script>";
        echo "<script>window.location.href = 'enter_otp.php';</script>";
    }
} else {
    echo "<script>alert('OTP Not Provided.')</script>";
    echo "<script>window.location.href = 'enter_otp.php';</script>";
}
?>

</body>
</html>
