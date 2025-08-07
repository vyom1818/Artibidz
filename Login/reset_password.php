<?php
session_start();

$message = ''; // Variable to store success or error message

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newPassword = $_POST['new_password'];
    $cn = mysqli_connect("localhost", "root", "", "artibidz") or die("check connection");

    // Retrieve the user ID from the session
    if (isset($_SESSION['user_id'])) {
        $userID = $_SESSION['user_id'];

        // Fetch the existing password
        $checkExistingPassword = "SELECT password FROM user WHERE user_id = ?";
        $stmt = mysqli_prepare($cn, $checkExistingPassword);
        mysqli_stmt_bind_param($stmt, "i", $userID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $existingPassword = $row['password'];

        // Validate password criteria
        if (strlen($newPassword) < 8 ||
            !preg_match('/[A-Z]/', $newPassword) ||
            !preg_match('/[a-z]/', $newPassword) ||
            !preg_match('/[0-9]/', $newPassword) ||
            !preg_match('/[\W]/', $newPassword)) {
            echo "<script>alert('Password must be at least 8 characters long and include uppercase, lowercase, number, and special character.')</script>";
            echo "<script>window.location.href = 'reset_password.php';</script>";
        } elseif ($newPassword === $existingPassword) {
            echo "<script>alert('Please enter a new password different from your existing password.')</script>";
            echo "<script>window.location.href = 'reset_password.php';</script>";
        } else {
            // Update the password in the database (plain text)
            $updatePassword = "UPDATE user SET password = ? WHERE user_id = ?";
            $stmt = mysqli_prepare($cn, $updatePassword);
            mysqli_stmt_bind_param($stmt, "si", $newPassword, $userID);

            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('Password reset successfully! Please log in with your new password.')</script>";
                echo "<script>window.location.href = 'login.php';</script>";
            } else {
                echo "Error updating password: " . mysqli_error($cn);
            }
        }
    } else {
        echo "<script>alert('User ID not found in the session.')</script>";
        echo "<script>window.location.href = 'reset_password.php';</script>";
    }

    // Close database connection
    mysqli_close($cn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
  <style>
    @import url(https://fonts.googleapis.com/css?family=Roboto:400,300,500);
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300..800&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Open Sans', sans-serif;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      width: 100vw;
      background-image: url('colorful-wallpaper-background-multicolored-generative-ai.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
    }

    .otp-box {
      display: flex;
      background: transparent;
      width: 25vw;
      height: 50vh;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
      border: 1px solid rgba(255, 255, 255, 0.5);
      backdrop-filter: blur(7px);
    }

    .form {
      width: 100%;
      padding: 20px;
    }

    .header {
      text-align: center;
      color: #fff;
    }

    h1 {
      margin-bottom: 20px;
    }

    .content {
      display: flex;
      align-items: center;
      flex-direction: column;
    }

    input[type="password"], input[type="submit"] {
      width: 90%;
      margin: 10px 0;
      padding: 10px;
      border: none;
      border-bottom: 1px solid #fff;
      background: transparent;
      color: #fff;
      font-size: 16px;
      transition: 0.2s ease;
    }

    input[type="password"]::placeholder {
      color: #fff;
    }

    input[type="password"]:focus {
      border-bottom: 2px solid #fff;
    }

    input[type="submit"] {
      background: #fff;
      color: #000;
      cursor: pointer;
      border-radius: 3px;
      transition: 0.3s ease;
    }

    input[type="submit"]:hover {
      background: rgba(255, 255, 255, 0.15);
      color: #fff;
      border: 2px solid #fff;
    }
  </style>
  <script>
    function validatePassword() {
        const passwordInput = document.getElementById('new_password');
        const password = passwordInput.value;
        const pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W]).{8,}$/;

        if (!pattern.test(password)) {
            alert('Password must be at least 8 characters long and include uppercase, lowercase, number, and special character.');
            return false;
        }
        return true;
    }
  </script>
</head>
<body>
  <div class="otp-box">
    <div class="form">
      <div class="header">
        <h1>Reset Password</h1>
      </div>
      <form action="reset_password.php" method="post" onsubmit="return validatePassword()">
        <div class="content">
          <input type="password" id="new_password" placeholder="New Password" name="new_password" required>
          <input type="submit" value="Reset Password">
        </div>
      </form>
    </div>
  </div>
</body>
</html>
