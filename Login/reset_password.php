<?php
session_start();

$message = ''; // Variable to store success or error message

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newPassword = $_POST['new_password'];
    $cn = mysqli_connect("localhost", "root", "", "artibidz") or die("check connection");

    // Validate and update the new password in the database
    // Add your database connection code here (similar to login2.php)

    // Retrieve the user ID from the session
    if (isset($_SESSION['user_id'])) {
        $userID = $_SESSION['user_id'];

        $sql = "UPDATE user SET password = '$newPassword' WHERE user_id = $userID";

        if (mysqli_query($cn, $sql)) {
            // Password reset successfully
            $message = "Password reset successfully 😀. Your new password is 👉: $newPassword";
            // Additional steps, such as redirecting to the login page, can be added here
        } else {
            $message = "Error updating password: " . mysqli_error($cn);
        }
    } else {
        $message = "User ID not found in the session.";
    }

    // Close database connection
    mysqli_close($cn);
}
?>

<!-- Display the success message or error -->
<div class="pt-3">
    <?php if (!empty($message)) : ?>
        <p><?php echo $message; ?></p>
        <a href="login.php">Back</a>
    <?php endif; ?>
</div>

<!-- HTML form to input the new password -->
<?php if (empty($message)) : ?>
    <form class="pt-3" action="reset_password.php" method="post">
        <div class="form-group">
            <input type="password" class="form-control form-control-lg" id="new_password" placeholder="New Password" name="new_password" required>
        </div>
        <div class="mt-3">
            <input type="submit" value="Reset Password" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" />
        </div>
    </form>
<?php endif; ?>
