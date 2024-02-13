<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
<style>
    .choice{
    display: flex;
    box-sizing: border-box;
    margin-bottom: 20px;
    padding: 4px;
    border: none;
    border-bottom: 1px solid #AAA;
    font-family: 'Roboto', sans-serif;
    font-weight: 300;
    font-size: 15px;
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
    font-family: 'Roboto', sans-serif;
    font-weight: 300;
    font-size: 15px;
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
</style>
</head>
<body>
    <div class="registration-box">

        <div class="form">
            <div class="header">
                <h1>Sign Up</h1>
            </div>
            <form action="registration_code.php" method="POST" enctype="multipart/form-data">
            <div class="content">
                    <div class="left">
                        <input type="text" class="input-field" placeholder="First Name" name="fname">
                        
                        <input type="number" placeholder="Contact Number"  name="contact_no" required>

                        <input type="email" placeholder="Email ID" name="mail" required>

                        <!-- <input id="fileInput" style="display: none;" type="file"/> -->
                        <input type="file" id="fileInput" style="display: none;" name="file" accept=".jpg, .jpeg, .png" required/>
                        <label for="fileInput" class="customFileButton">Upload Your Profile Photo</label>
                        
                        <input type="text" placeholder="Username" name="username" required>
                        
                        <input type="password" placeholder="Password" name="password" required>
                        
                        <input type="date" name="dob">
                        
                        
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
                        <input type="text" placeholder="Last Name" name="lname">

                        <input type="text" placeholder="Enter a Security Question"  name="security_question">        
                        <input type="text" placeholder="Enter a Security Answer" name="security_answer">
                        
                        <input type="text" placeholder="Address" name="address">

                        <!-- <label for="">State:</label> -->
                        <select name="state" value="state" id="state" onchange="getCities()">
                            <option value="">Select State</option>
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
                            <option value="">Select City</option>
                        </select>
            
                        <input type="number" placeholder="Pincode" name="pincode">

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
        <div class="image">
            <img id="bg" src="img.png" alt="">
            <img id="logo" src="artibidz-logo.png" alt="">
        </div>
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
