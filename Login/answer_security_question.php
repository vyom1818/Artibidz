<!-- answer_security_question.php -->
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

session_start();

if (isset($_SESSION['security_question'])) {
    $securityQuestion = $_SESSION['security_question'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $userAnswer = $_POST['security_answer'];

        // Validate the user's answer (you might want to add additional validation)
        // Fetch the actual security answer from the database
        $sql = "SELECT user_id, email_address, security_answer FROM user WHERE security_question = ?";

        // Add your database connection code here (similar to login2.php)
        $cn = mysqli_connect("localhost", "root", "", "artibidz") or die("check connection");
        $stmt = mysqli_prepare($cn, $sql);

        // Bind parameters
        mysqli_stmt_bind_param($stmt, "s", $securityQuestion);

        // Execute the query
        mysqli_stmt_execute($stmt);

        // Bind result variables
        mysqli_stmt_bind_result($stmt, $userID, $email, $correctAnswer);

        // Fetch the result
        mysqli_stmt_fetch($stmt);

        if ($userAnswer === $correctAnswer) {
            // Generate and send OTP
            $otp = rand(100000, 999999);
            $_SESSION['otp'] = $otp;
            $_SESSION['otp_start_time'] = time(); // Record the time when OTP was generated

            $_SESSION['to'] = $email; // Set the email address in the session

            // Send OTP to user's email using PHPMailer
            $to = $email;
            $subject = "OTP for Password Reset";
            $message = "Your OTP for password reset is: $otp";

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
                $mail->setFrom('devlopanchal87@gmail.com', 'DEVLO Panchal'); // Replace with your Gmail address and your name
                $mail->addAddress($to);

                //Content
                $mail->isHTML(false);
                $mail->Subject = $subject;
                $mail->Body = $message;

                $mail->send();

                // Redirect to the OTP verification page
                header("Location: enter_otp_for_password_reset.php");
                exit();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "Incorrect answer. Please try again.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
        // Close database connection
        mysqli_close($cn);
    }
} else {
    // If the security question is not set, redirect to the forgot password page
    header("Location: forgot_password.php");
    exit();
}
?>

<!-- HTML form to input the answer for the security question -->
<form class="pt-3" action="answer_security_question.php" method="post">
    <p><?php echo $securityQuestion; ?></p>
    <div class="form-group">
        <input type="text" class="form-control form-control-lg" id="security_answer" placeholder="Your Answer" name="security_answer">
    </div>
    <div class="mt-3">
        <input type="submit" value="Submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" />
    </div>
</form>
