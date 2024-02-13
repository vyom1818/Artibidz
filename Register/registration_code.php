<?php
session_start();

// Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

$cn = mysqli_connect("localhost", "root", "", "artibidz") or die("check connection");

if (isset($_POST['signup_submit'])) {
    // Get the email submitted by the user
    $mail = $_POST['mail'];

    // Check if the email already exists in the database
    $check_query = "SELECT * FROM user WHERE email_address = '$mail'";
    $check_result = mysqli_query($cn, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        // If email exists, show error message to the user and stop further processing
        echo "<script>alert('Email already exists! Please use a different email.');</script>";
        header("Location:Registration.php");
        exit(); // Stop further processing
    }
    // Get all the input submitted by the user
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
  
    $contact_no = $_POST['contact_no'];
    $password = $_POST['password'];
    $profile_pic = $_FILES['file']['name'];
    $security_question = $_POST['security_question'];
    $security_answer = $_POST['security_answer'];
    $date_of_birth = $_POST['dob'];
    $address = $_POST['address'];
    $city_id = $_POST['city'];
    $pincode = $_POST['pincode'];
    $user_type = $_POST['user'];
    $gender = $_POST['gender'];
    $profile_pic1=$_FILES['file']['tmp_name'];

    // Your existing code for processing form data

    // Generate OTP
    $otp = rand(100000, 999999);
    $_SESSION['otp'] = $otp;
	$_SESSION['otp_start_time'] = time(); // Record the time when OTP was generated
    // Store user input in the session
	$_SESSION['fname'] = $fname;
    $_SESSION['lname'] = $lname;
    $_SESSION['username'] = $username;
    $_SESSION['mail'] = $mail;
    $_SESSION['contact_no'] = $contact_no;
    $_SESSION['password'] = $password;
    $_SESSION['profile_pic'] = $profile_pic;
    $_SESSION['security_question'] = $security_question;
    $_SESSION['security_answer'] = $security_answer;
    $_SESSION['date_of_birth'] = $date_of_birth;
    $_SESSION['address'] = $address;
    $_SESSION['city_id'] = $city_id;
    $_SESSION['pincode'] = $pincode;
    $_SESSION['user_type'] = $user_type;
    $_SESSION['gender'] = $gender;
    $profile_pic_content = file_get_contents($profile_pic1);
    $_SESSION['profile_pic_content']=$profile_pic_content;

    // Send OTP to user's email using PHPMailer
    $to = $mail;
    $subject = "OTP for Email Verification";
    $message = "Your OTP for email verification is: $otp";

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
        echo "Email with OTP sent successfully.";

        // Redirect the user to the OTP verification page
        header("Location: enter_otp1.php");
        exit();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
