<!DOCTYPE html>
<html lang="en">
<!-- answer_security_question.php -->
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

session_start();
$email=$_SESSION['email'];

if (isset($_SESSION['security_question'])) {
    $securityQuestion = $_SESSION['security_question'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $userAnswer = $_POST['security_answer'];
        
        // Validate the user's answer (you might want to add additional validation)
        // Fetch the actual security answer from the database
        $sql = "SELECT user_id,security_answer FROM user WHERE security_question = ? and email_address = ?";

        // Add your database connection code here (similar to login2.php)
        $cn = mysqli_connect("localhost", "root", "", "artibidz") or die("check connection");
        $stmt = mysqli_prepare($cn, $sql);

        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ss", $securityQuestion, $email);


        // Execute the query
        mysqli_stmt_execute($stmt);

        // Bind result variables
        mysqli_stmt_bind_result($stmt, $userID, $correctAnswer);

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
                $mail->Username = 'artibidz@gmail.com'; // Replace with your Gmail address
                $mail->Password = 'kdwq lxfi eodu paro'; // Replace with your Gmail password
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                //Recipients
                $mail->setFrom('artibidz@gmail.com', 'Artibidz'); // Replace with your Gmail address and your name
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
            echo "<script>alert('Incorrect answer. Please try again.')</script>";
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


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <style>
    @import url(https://fonts.googleapis.com/css?family=Roboto:400,300,500);
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap');

    *{
      margin:0;
      padding:0;
      box-sizing:border-box;
      font-style:'Open San',sans-serif;
    }

    *focus{
      outline:none;
    }

    body {
      display:flex;
      justify-content:center;
      align-items:center;
      height:100vh;
      width:100vw;
      font-size: 16px;
      color: #222;
      font-family: 'Open San', sans-serif;
      /* font-weight: 400; */
      margin: 0;
      height: 100vh;
      width: 98vw;
      background-image: url('colorful-wallpaper-background-multicolored-generative-ai.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
    }

    .otp-box{
      display: flex;
      background:transparent;
      width: 25vw;
      height: 70vh;
      border-radius: 2px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
      border: 1px solid rgba(255,255,255,0.5);
      backdrop-filter: blur(7px);      
    }

    .form{
      width: 25vw;
      height: 50vh;
    }

    .header{
      width: 25vw;
      height: 18vh;
      text-align:center;
      color:#fff;
      font-style:'Open San',sans-serif;
      font weight:600;
    }

    h1{
      width: 25vw;
      /* font-weight: 400;
      font-size: 28px; */
      font-family: 'Open San', sans-serif;
      padding: 8vh;
    }

    .content{
      display: flex;
      align-items: center;
      width: 25vw;
      height: 50vh;
      flex-direction: column;
      margin-top:7vh;
    }
  
    input[type="text"]{
      box-sizing: border-box;
      margin:3vh 0;
      border: none;
      border-bottom: 1px solid #fff;
      font-family: 'Open San', sans-serif;
      /* font-weight: 400;
      font-size: 15px; */
      width: 18vw;
      height: 38px;
      transition: 0.2s ease;
      background:transparent;
      color:#fff;
    }  

    input[type="text"]::placeholder{
      color:#fff;
      font-size:16px;
    }

    input[type="text"]:focus,
    input[type="text"]:focus-visible
    {
      outline:none;
      border: none;
      border-bottom: 2px solid #16a085;
      transition: 0.2s ease;
    }

    input[type="submit"]{
      width:18vw;
      height:6vh;
      margin:3vh 0;
      background: #fff;
      color:#000;
      font-weight:600;
      border:none;
      /* padding:12px 20px; */
      cursor: pointer;
      border-radius: 3px;
      font-size: 16px;
      border:2px solid transparent;
      transition:0.3s ease;
    }

    input[type="submit"]:hover{
      cursor:pointer;
      /* font-size:2.5vh; */
      transition:0.5s ease;
      color:#fff;
      border-color: #fff;
      background: rgba(255,255,255,0.15);
    }

    .content p{
      box-sizing: border-box;
      margin-top:7vh;
      margin:1vh 0;
      border: none;
      /* border-bottom: 1px solid #fff; */
      font-family: 'Open San', sans-serif;
      /* font-weight: 400;
      font-size: 15px; */
      width: 18vw;
      height: 38px;
      transition: 0.2s ease;
      background:transparent;
      color:#fff;
    }
  
  </style>
</head>
<body>
  
  <div class="otp-box">

    <div class="form">

      <div class="header">
        <h1>Security Verification</h1>
      </div>

      <form action="answer_security_question.php" method="post">
    
        <div class="content">

          <p>Question : <?php echo $securityQuestion;?> </p>
        
          <input type="text" id="security_answer" placeholder="Your Answer" name="security_answer">
            
          <input type="submit" value="Submit" />
          
        </div>
        
      </form>
      
    </div>
    
  </div>   

</body>
</html>


<!-- HTML form to input the answer for the security question -->
<!-- <form class="pt-3" action="answer_security_question.php" method="post">
    <p>
    <?php 
    // echo $securityQuestion; 
    ?>
    </p>
    <div class="form-group">
        <input type="text" class="form-control form-control-lg" id="security_answer" placeholder="Your Answer" name="security_answer">
    </div>
    <div class="mt-3">
        <input type="submit" value="Submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" />
    </div>
</form> -->
