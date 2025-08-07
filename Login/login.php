<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <form action="login2.php" method="post">
            <h2>Login Form</h2>
            <div class="input-field">
                <input type="text" id="Email" name="email_or_username" autocomplete="off" required>
                <label for="">Email or Username</label>
            </div>
            <div class="input-field">
                <input type="password" id="exampleInputPassword1" name="psw" required>
                <label for="">Password</label>
            </div>
            <div class="forget">
                <label for="Save-login">
                    <input type="checkbox" id="Save-login" name="stay_signed_in">
                    <p>Stay Signed In</p>
                </label>
                <a href="forgot_password.php">Forgot Password ?</a>
            </div>
            <button type="submit">Log In</button>
            <div class="Create-account">
                <p>Don't have an account ? <a href="..\Register\Registration.php">Create account</a></p>
            </div>
        </form>
    </div>
</body>
</html>