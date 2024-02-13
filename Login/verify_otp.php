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
                header("Location: ../customer/user_profile.php");
            } else if ($userType == "artist") {
                header("Location: ../Artist/artist_profile.php");
            }
        } else {
            echo "OTP has expired. Please try again.";
        }
    } else {
        echo "Invalid OTP. Please try again.";
    }
} else {
    echo "OTP not provided.";
}
?>
