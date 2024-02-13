<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

session_start();

$cn = mysqli_connect("localhost", "root", "", "artibidz") or die("check connection");

$emailOrUsername = $_POST['email_or_username'];
$password = $_POST['psw'];

// Check if the input is an email or username
if (filter_var($emailOrUsername, FILTER_VALIDATE_EMAIL)) {
    $sql = "SELECT user_id, username, email_address, user_type FROM user WHERE email_address = '$emailOrUsername' AND password = '$password'";
} else {
    $sql = "SELECT user_id, username, email_address, user_type FROM user WHERE username = '$emailOrUsername' AND password = '$password'";
}

$result = mysqli_query($cn, $sql);
$arr = mysqli_fetch_array($result);

$count = mysqli_num_rows($result);

if ($count > 0) {
    // Generate OTP
    $otp = rand(100000, 999999);
    $_SESSION['otp'] = $otp;
    $_SESSION['otp_start_time'] = time(); // Record the time when OTP was generated

    // Set additional session variables
    $_SESSION['user_type'] = $arr['user_type'];
    $_SESSION['user_id'] = $arr['user_id'];

    // Send OTP to user's email using PHPMailer
    $to = $arr['email_address'];
    $subject = "OTP for Login";
    $message = "Your OTP for login is: $otp";

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0; // Enable debugging for troubleshooting (0 for no debug output)
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to Gmail
        $mail->SMTPAuth = true;
        $mail->Username = 'devlopanchal87@gmail.com'; // Replace with your Gmail address
        $mail->Password = 'pvek zpdo whss fygu'; // Replace with your Gmail password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        //Recipients
        $mail->setFrom('devlopanchal87@gmail.com', 'Artibidz'); // Replace with your Gmail address and your name
        $mail->addAddress($to);

        //Content
        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();

        header("Location: enter_otp.php"); // Redirect to the OTP verification page
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid email/username or password.";
}

$cn->close();
?>
