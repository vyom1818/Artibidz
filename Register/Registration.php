<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
    <script>
    // Function to validate the strength of the password
    function validatePassword() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirmPassword").value;

        // Regular expression to check password strength
        var strongPasswordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/;

        // Check if password meets the strength requirements
        if (!strongPasswordRegex.test(password)) {
            alert(
                "Password must be at least 8 characters long, contain an uppercase letter, a lowercase letter, a number, and a special character."
            );
            return false;
        }

        // Check if confirm password matches the password
        if (password !== confirmPassword) {
            alert("Passwords do not match.");
            return false;
        }

        return true;
    }
</script>



<style>
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap');

    *{
        font-family:"Open San", sans-serif;
    }

    .choice{
        display: flex;
        box-sizing: border-box;
        margin-bottom: 20px;
        padding: 4px;
        border: none;
        border-bottom: 1px solid #AAA;
        font-family: 'Open Sans', sans-serif;
        /* font-weight: 300;
        font-size: 15px; */
        width: 18vw;
        height: 38px;
        transition: 0.2s ease;
    }

    .title{
        margin: 5px;
        margin-left:0;
    }

    .file-input {
        padding: 5px 0px;
        margin-bottom: 10px;
        width: 50%; 
        text-align: center;
        border-radius: 3px;
    }

    button{
        background-color: #009579;
        color:white;
    }

    .customFileButton {
        background-color: #fff;
        cursor: pointer;
        border-radius: 3px;
        display: flex;
        box-sizing: border-box;
        margin-bottom: 20px;
        padding: 4px;
        border-bottom: 1px solid #AAA;
        font-family: 'Open San', sans-serif;
        /* font-weight: 300;
        font-size: 15px; */
        width: 18vw;
        height: 38px;
        transition: 0.2s ease;
    }

    .choice:hover,
    .choice:focus{
        border-bottom: 2px solid #16a085;
        transition: 0.2s ease;
    }

    .customFileButton:hover,
    .customFileButton:focus{
        border-bottom: 2px solid #16a085;
        transition: 0.2s ease;
    }

    input[type="date"]:focus{
        color : black;
    }

    input[type="submit"] {
        top:0;
    }
    
    body {
        margin: 0;
        height: 100vh;
        width: 100vw;
        background-image: url('colorful-wallpaper-background-multicolored-generative-ai.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
    
    .registration-box{
        width:45vw;
        border: 1px solid rgba(255,255,255,0.5);
        backdrop-filter: blur(7px);
        background:transparent;
    }

    h1{
        color:#fff;
        font-family: 'Open San', sans-serif;
    }
    
    input[type="text"],
    input[type="number"],
    input[type="email"],
    input[type="file"],
    input[type="password"],
    input[type="date"],
    select {
        box-sizing: border-box;
        margin-bottom: 20px;
        padding: 4px;
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

    input[type="text"]::placeholder,
    input[type="number"]::placeholder,
    input[type="email"]::placeholder,
    input[type="password"]::placeholder
    {
        background:transparent;
        color:#fff;
        font-family: 'Open San', sans-serif;
    }

    .choice .title{
        font-family: 'Open San', sans-serif;
        color:white;
    }

    .choice{
        border-bottom: 1px solid #fff;
        border-radius:0;
    }

    .customFileButton{
        background:transparent;
        color:#fff;
        border-bottom: 1px solid #fff;
        border-radius:0;
    }

    input[type="submit"]{
        background:#fff;
        color:#000;
        border:none;
        outline:none;
        font-weight:500;
        border-radius:3px;
        border:2px solid transparent;
        transition:0.3s ease;
    }

    input[type="submit"]:hover{
        color:#fff;
        border-color: #fff;
        background: rgba(255,255,255,0.15);
    }

    select option {
        background-color: black;
    }

    .header{
        display:flex;
        justify-content:space-between;
    }

    .logo{
        height:7vh;
        width:5vw;
        margin-right:2.5vw;
        margin-top:1.6vh;
    }

</style>
</head>
<body>

<!-- <div id="live-wallpaper"> -->
        <!-- <video autoplay loop muted> -->
            <!-- <source src="bg10.mp4" type="video/mp4"> -->
            <!-- You can add additional source elements for other video formats if needed -->
            <!-- Your browser does not support the video tag. -->
        <!-- </video> -->
<!-- </div> -->

    <div class="registration-box">

        <div class="form">
            <div class="header">
                <h1>Sign Up</h1>
                <img class="logo" src="artibidz-logo2.png"  alt="">
            </div>
            <form action="registration_code.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="content">
                    <div class="left">
                        <input type="text" class="input-field" placeholder="First Name" name="fname" autocomplete="off">
                        
                        <input type="number" placeholder="Contact Number"  name="contact_no" autocomplete="off" required>

                        <input type="email" placeholder="Email ID" name="mail" autocomplete="off" required>

                        <!-- <input id="fileInput" style="display: none;" type="file"/> -->
                        <input type="file" id="fileInput" style="display: none;" name="file" accept=".jpg, .jpeg, .png" required/>
                        <label for="fileInput" class="customFileButton">Upload Your Profile Photo</label>
                        
                        <script>
                            document.getElementById('fileInput').addEventListener('change', function() {
                            var label = document.querySelector('.customFileButton');
                            if (this.files && this.files.length > 0) {
                                label.textContent = 'Profile Photo Uploaded !!';
                            } 
                            else {
                                label.textContent = 'Upload Your Profile Photo';
                            }
                            });
                        </script>

                        <input type="text" placeholder="Username" name="username" autocomplete="off" required>

                        <input type="password" id="password" placeholder="Password" name="password" autocomplete="off" required>

                        <input type="password" id="confirmPassword" placeholder="Confirm Password" name="confirmPassword" autocomplete="off" required onblur="validatePassword()">
                        
                        <div class="choice">
                            <label class="title" for="gender">Gender : </label>
                            <input class="title" type="radio" value="male" name="gender">
                            <label class="title" for="male" >Male</label>
                            <input class="title" type="radio" value="female" name="gender">
                            <label class="title" for="female">Female</label>
                            <input class="title" type="radio" value="other" name="gender">
                            <label class="title" for="other" >Other</label>
                        </div>
                        
                        <input type="submit" name="signup_submit" value="Sign me up" />
                    </div>

                    <div class="right">
                        <input type="text" placeholder="Last Name" name="lname" autocomplete="off">

                        <input type="text" placeholder="Enter a Security Question"  name="security_question" autocomplete="off">        
                        <input type="text" placeholder="Enter a Security Answer" name="security_answer" autocomplete="off">
                        
                        <input type="text" placeholder="Address" name="address" autocomplete="off">

                        <!-- <label for="">State:</label> -->
                        <select name="state" value="state" id="state" onchange="getCities()">
                            <option class="ans" value="">Select State</option>
                            <?php
                                $cn = mysqli_connect("localhost","root","","artibidz") or die("check connection");
                                $sql = "select * from state";
                                $result = mysqli_query($cn,$sql);
                                while($row=mysqli_fetch_array($result))
                                {
                                     echo "<option value='${row['state_id']}'>${row['state_name']}</option>";
                                }
                            ?>
                        </select>

                        <!-- <label for="city">City:</label> -->
                        <select name="city" id="city">
                            <option class="ans" value="">Select City</option>
                        </select>
            
                        <input type="number" placeholder="Pincode" name="pincode" autocomplete="off">

                        <div class="choice">
                            <label class="title" for="user">User : </label>
                            <input class="title" type="radio"  value="customer" name="user">
                            <label class="title" for="customer">Customer</label>
                            <input class="title" type="radio" value="artist" name="user">
                            <label class="title" for="artist">Artist</label>
                        </div>

                    </div>
                </div>
            </form>
        </div>
        <div>
        <?php 
    if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset ($_SESSION['msg']);
    }
    ?>
        </div>
        <!-- <div class="image">
            <img id="bg" src="img.png" alt="">
            <img id="logo" src="artibidz-logo.png" alt="">
        </div> -->
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
    function getCities() {
        var state = document.getElementById("state").value;
        $.ajax({
            type: "POST",
            url: "get_cities.php",  // PHP script to fetch cities based on the selected state
            data: {state: state},
            success: function(response) {
                $("#city").html(response);
            }
        });
    }
</script>
</body>
</html>
