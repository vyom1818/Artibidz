<?php
session_start();

if (isset($_POST['otp'])) {
    $enteredOTP = $_POST['otp'];

    // Check if OTP is correct
    if ($enteredOTP == $_SESSION['otp']) {
        // Check if OTP has not expired (3 minutes)
        $otpStartTime = $_SESSION['otp_start_time'];
        $currentTime = time();

        if (($currentTime - $otpStartTime) <= 180) {
            // OTP is valid, perform user data insertion
            $fname = $_SESSION['fname'];
            $lname = $_SESSION['lname'];
            $gender = $_SESSION['gender'];
            $profile_pic = $_SESSION['profile_pic'];
            $username = $_SESSION['username'];
            $mail = $_SESSION['mail'];
            $contact_no = $_SESSION['contact_no'];
            $password = $_SESSION['password'];
            $security_question = $_SESSION['security_question'];
            $security_answer = $_SESSION['security_answer'];
            $date_of_birth = $_SESSION['date_of_birth'];
            $address = $_SESSION['address'];
            $city = $_SESSION['city_id'];
            $pincode = $_SESSION['pincode'];
            $user_type = $_SESSION['user_type'];
            $profile_pic_content=$_SESSION['profile_pic_content'];

            // File upload logic
            $targetDirectory = "../images/";
            $targetFile = $targetDirectory . basename($profile_pic);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            if ($imageFileType == "png" || $imageFileType == "jpg") {
                if (file_put_contents($targetFile, $profile_pic_content) !== false) {
                    $cn = mysqli_connect("localhost", "root", "", "artibidz") or die("check connection");
                    // Insert user data into the database
                    $sql = "INSERT INTO user (fname, lname, gender, profile_pic, username, email_address, contact_no, password, security_question, security_answer, date_of_birth, address, city_id, pincode, user_type) 
                            VALUES ('$fname', '$lname', '$gender', 'images/$profile_pic', '$username', '$mail', $contact_no, '$password', '$security_question', '$security_answer', '$date_of_birth', '$address', $city, $pincode, '$user_type')";

                    $result = mysqli_query($cn, $sql);

                    if ($result) {
                        // Set session variables for user_id and username
                        $_SESSION['user_id'] = mysqli_insert_id($cn);
                        $_SESSION['username'] = $username;

                        // Redirect based on user_type
                        if ($user_type == "customer") {
                            header("Location: ../customer/index.php");
                        } else if ($user_type == "artist") {
                            header("Location: ../Artist/artist_profile.php");
                        }
                        exit();
                    } else {
                        echo "Error inserting user data: " . mysqli_error($cn);
                    }
                } else {
                    echo "Failed to upload profile picture.";
                }
            } else {
                echo "Only png and jpg files are allowed.";
            }
        } else {
            echo "OTP has expired. Please try again.";
        }
    } else {
        echo "Invalid OTP. Please try again.";
    }
} else {
    echo "OTP not provided.";
}
?>
