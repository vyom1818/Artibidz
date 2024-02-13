<!-- enter_otp_for_password_reset.php -->
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $enteredOTP = $_POST['otp'];

    if ($enteredOTP == $_SESSION['otp']) {
        // Check if OTP has not expired (3 minutes)
        $otpStartTime = $_SESSION['otp_start_time'];
        $currentTime = time();

        if (($currentTime - $otpStartTime) <= 180) {
            // OTP is valid, retrieve user ID from the database
            $cn = mysqli_connect("localhost", "root", "", "artibidz") or die("check connection");
            $to = isset($_SESSION['to']) ? mysqli_real_escape_string($cn, $_SESSION['to']) : '';

            if (!empty($to)) {
                $sql = "SELECT user_id FROM user WHERE email_address = '$to'";
                $result = mysqli_query($cn, $sql);
                $row = mysqli_fetch_assoc($result);

                if ($row) {
                    $_SESSION['user_id'] = $row['user_id'];
                    header("Location: reset_password.php");
                    exit();
                } else {
                    echo "User ID not found.";
                }
            } else {
                echo "Email address not set in the session.";
            }
        } else {
            echo "OTP has expired. Please try again.";
        }
    } else {
        echo "Invalid OTP. Please try again.";
    }
}
?>

<!-- HTML form to input the OTP for password reset -->
<form class="pt-3" action="enter_otp_for_password_reset.php" method="post">
    <div class="form-group">
        <input type="text" class="form-control form-control-lg" id="otp" placeholder="Enter OTP" name="otp">
    </div>
    <div class="mt-3">
        <input type="submit" value="Verify OTP" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" />
    </div>
</form>
