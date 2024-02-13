<!-- forgot_password.php -->
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $emailOrUsername = $_POST['email_or_username'];

    // Validate email/username (you might want to add additional validation)
    if (filter_var($emailOrUsername, FILTER_VALIDATE_EMAIL)) {
        // If input is an email, use it to fetch the security question
        $sql = "SELECT security_question FROM user WHERE email_address = '$emailOrUsername'";
    } else {
        // If input is a username, use it to fetch the security question
        $sql = "SELECT security_question FROM user WHERE username = '$emailOrUsername'";
    }

    // Execute the query
    // Add your database connection code here (similar to login2.php)
    $cn = mysqli_connect("localhost", "root", "", "artibidz") or die("check connection");

    $result = mysqli_query($cn, $sql);
    $securityQuestionArr = mysqli_fetch_array($result);

    if ($securityQuestionArr) {
        $securityQuestion = $securityQuestionArr['security_question'];
        $_SESSION['security_question'] = $securityQuestion;

        // Redirect to the page where the user will answer the security question
        header("Location: answer_security_question.php");
        exit();
    } else {
        echo "Invalid email/username.";
    }
}
?>

<!-- HTML form to input email/username for forgot password -->
<form class="pt-3" action="forgot_password.php" method="post">
    <div class="form-group">
        <input type="text" class="form-control form-control-lg" id="email_or_username" placeholder="Email or Username" name="email_or_username">
    </div>
    <div class="mt-3">
        <input type="submit" value="Next" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" />
    </div>
</form>
