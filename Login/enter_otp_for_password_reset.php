<!DOCTYPE html>
<html lang="en">
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
                    echo "<script>alert('User ID not found.')</script>";
                }
            } else {
                echo "<script>alert('Email address not set in the session.')</script>";
            }
        } else {
            echo "<script>alert('OTP has expired. Please try again.')</script>";
            echo "<script>window.location.href = 'answer_security_question.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid OTP. Please try again.')</script>";
    }
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
      height: 50vh;
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
  
  </style>
</head>
<body>
  
  <div class="otp-box">

    <div class="form">

      <div class="header">
        <h1>Enter OTP</h1>
      </div>

      <form class="pt-3" action="enter_otp_for_password_reset.php" method="post">
    
        <div class="content">
        
          <input type="text" id="otp" placeholder="Enter OTP" name="otp">
            
          <input type="submit" value="Verify OTP" />
          
        </div>
        
      </form>
      
    </div>
    
  </div>   

</body>
</html>


<!-- HTML form to input the OTP for password reset -->
<!-- <form class="pt-3" action="enter_otp_for_password_reset.php" method="post">
    <div class="form-group">
        <input type="text" class="form-control form-control-lg" id="otp" placeholder="Enter OTP" name="otp">
    </div>
    <div class="mt-3">
        <input type="submit" value="Verify OTP" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" />
    </div>
</form> -->
