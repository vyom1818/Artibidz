<?php session_start();
//include("../includes/connect.php");
 ?>
<html>
<head>
    <title>Insert Art</title>
    <style>
            @import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap');

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:"Open San", sans-serif;
}

body{
display:flex;
align-items: center;
justify-content: center;
/* min-height: 100vh; */
height:130vh;
width: 100%;
padding:0 10px;
}

body::before {
content: "";
position:absolute;
width: 100%;
height: 150vh;
background: url(colorful-wallpaper-background-multicolored-generative-ai.jpg);
background-position: center;
background-size: cover;
}

.container{
height:115vh;
width:30vw;
border-radius: 8px;
padding:30px;
text-align: center;
border: 1px solid rgba(255,255,255,0.5);
backdrop-filter: blur(7px);
-webkit-backdrop-filter: blur(7px);
}

form{
display: flex;
flex-direction: column;
}

h2{
font-size:2rem;
margin-bottom:20px;
color:#fff;
}

.input-field{
position: relative;
border-bottom: 2px solid #ccc;
margin:15px 0;
/* display:flex;
justify-content:space-between;
align-items:center; */
}

.input-field label{
position: absolute;
top:50%;
left:0;
transform: translateY(-50%);
color:#fff;
font-size: 16px;
pointer-events:none;
transition:0.15s ease;
}

.input-field input{
width: 100%;
height:40px;
background:transparent;
border:none;
outline:none;
font-size:16px;
color:#fff;
}

.input-field input:focus~label,
.input-field input:valid~label{
font-size: 0.8rem;
top:10px;
transform:translateY(-120%)
}

.container a{
color:#efefef;
text-decoration: none;
}

.container a:hover{
text-decoration: underline;
}

.button{
background: #fff;
color:#000;
font-weight:600;
border:none;
padding:12px 20px;
cursor: pointer;
border-radius: 3px;
font-size: 16px;
border:2px solid transparent;
transition:0.3s ease;
margin-top:5vh;
}

.button:hover{
color:#fff;
border-color: #fff;
background: rgba(255,255,255,0.15);
}

input[value] {
/* Your styles here */
/* position: absolute; */
}

.input-field {
position: relative;
margin: 15px 0;
}

select {
    box-sizing: border-box;
    margin-top: 20px;
    padding: 4px;
    border: none;
    /* border-bottom: 1px solid #fff; */
    font-family: 'Open San', sans-serif;
    /* font-weight: 400;
    font-size: 15px; */
    width: 26vw;
    height: 38px;
    transition: 0.2s ease;
    background:transparent;
    color:#fff;
}

select option {
    font-family:"Open San", sans-serif;
    background-color: black;
}

select:focus-visible{
    outline:none;
}

.input-field label {
position: absolute;
top: 0;
left: 0;
color: #fff;
font-size: 16px;
pointer-events: none;
transition: 0.15s ease;
}

.input-field input {
width: 100%;
height: 40px;
background: transparent;
border: none;
outline: none;
font-size: 16px;
color: #fff;
padding-top: 20px; /* Adjust the padding to create space between label and input */
}

.input-field input:focus ~ label,
.input-field input:valid ~ label {
font-size: 0.8rem;
top: 10px;
transform: translateY(-120%);
}

    .customFileButton1{
        background:transparent;
        color:#fff;
        border-bottom: 1px solid #fff;
        border-radius:0;
        margin:2vh 1vw;
        width:33%;
    }

    .customFileButton1:hover{
        cursor:pointer;
        color:#ccc;    
    }

    .customFileButton2{
        background:transparent;
        color:#fff;
        border-bottom: 1px solid #fff;
        border-radius:0;
        margin:2vh 1vw;
        padding-bottom:2vh;
        width:33%;
    }

    .customFileButton2:hover{
        cursor:pointer;
        color:#ccc;    
    }

    .customFileButton3{
        background:transparent;
        color:#fff;
        border-bottom: 1px solid #fff;
        border-radius:0;
        margin:2vh 1vw;
        padding-bottom:2vh;
        width:33%;
    }

    .customFileButton3:hover{
        cursor:pointer;
        color:#ccc;    
    }

    .img-input{
        position: relative;
        margin: 15px 0;
        /* position: absolute; */
        top:50%;
        right: 8.5vw;
        color:#fff;
        font-size: 16px;
    }

    .image-upload{
        display:flex;
        justify-content:space-evenly;
    }

    .radio-input {
        position: relative;
        margin: 15px 0;
        justify-content:center;
        align-items:center;
        display: flex;
        box-sizing: border-box;
        margin-bottom: 20px;
        padding: 4px;
        border: none;
        /* border-bottom: 1px solid #AAA; */
        font-family: 'Open Sans', sans-serif;
        /* font-weight: 300;
        font-size: 15px; */
        width: 26vw;
        height: 38px;
        transition: 0.2s ease;
    }

    .radio{
        display:flex;
        text-align:center;
        justify-content:center;
        margin-top:5vh;
        border-bottom: 2px solid #ccc;
        width:26vw;
    }

    .radio-input label{
        position: absolute;
        top: 0;
        left: 0;
        color: #fff;
        font-size: 16px;
        pointer-events: none;
        transition: 0.15s ease;
    }

    .radio-input input[type="radio"],
    .radio-input p
    {
        /* width: 50%; */
        height: 20px;
        background: transparent;
        border: none;
        outline: none;
        font-size: 18px;
        color: #fff;
        /* padding-top: 5vh;  */
    }

    .radio-input p{
        margin-right:2vw;
    }
    

    </style>
</head>
<body>

    <div class="container">

        <h2>Insert Art</h2>
        
        <form action="art_ins.php" method="post" enctype="multipart/form-data" onsubmit="return validateFile()">
        
        <div class="input-field">
            <label for="">Art Name:</label>
            <input type="text" name="art_name" required>
        </div>
        
        <div class="input-field">
            <label for="">Art Description:</label>
            <input type="text" name="art_desc">
        </div>
        
        <div class="input-field">
            <label for="">Enter Making Date:</label>
            <input type="date" name="art_date">
        </div>
        
        <div class="input-field">
            <label for="">Enter Amount:</label>
            <input type="text" name="art_amt">
        </div>
        
        <div class="input-field">
            <label for="">Enter Quantity:</label>
            <input type="text" name="art_qty">
        </div>
        
        <div class="radio-input">
            <label for="">Sale or Auction:</label>
            <div class="radio">
                <input type="radio" name="sale_or_auction" value="sale">
                <p>Sale</p>
                <input type="radio" name="sale_or_auction"   value="auction">
                <p>Auction</p>
            </div>
        </div>
        
        <div class="input-field">
            <label for="">Select Category:</label>
            <select name="sub_cat_id" id="">
                <?php $cn=mysqli_connect("localhost","root","","artibidz") or die("Check connection");
           
                $sql="select * from sub_category";
                $result=mysqli_query($cn,$sql);
                while($row=mysqli_fetch_array($result))
                {
                    echo "<option value='{$row['sub_cat_id']}'>{$row['sub_cat_name']}</option>";
                }
                ?>
            </select>
        </div>
        
        <div class="img-input">
            <label for="">Upload Art Images:</label>
        </div>
            
        <div class="image-upload">

            <input type="file" id="fileInput1" style="display: none;" name="file1" accept=".jpg, .jpeg, .png" style="border-bottom:none;" required/>
            <label for="fileInput1" class="customFileButton1">Image 1</label>

        <!-- <div class="input-field"> -->
        <input type="file" id="fileInput2" style="display: none;" name="file2" accept=".jpg, .jpeg, .png" />
        <label for="fileInput2" class="customFileButton2">Image 2</label>
        <!-- </div> -->

        <!-- <div class="input-field"> -->
            <input type="file" id="fileInput3" style="display: none;" name="file3" accept=".jpg, .jpeg, .png"/>
            <label for="fileInput3" class="customFileButton3">Image 3</label>
            <!-- </div> -->
            
            <script>
                document.getElementById('fileInput1').addEventListener('change', function() {
                    var label = document.querySelector('.customFileButton1');
                    if (this.files && this.files.length > 0) {
                label.textContent = 'Uploaded !!';
                } 
                else {
                    label.textContent = 'Image 1';
                }
                });
        
                document.getElementById('fileInput2').addEventListener('change', function() {
                var label = document.querySelector('.customFileButton2');
                if (this.files && this.files.length > 0) {
                label.textContent = 'Uploaded !!';
                } 
                else {
                    label.textContent = 'Image 2';
                }
                });
            
                document.getElementById('fileInput3').addEventListener('change', function() {
                var label = document.querySelector('.customFileButton3');
                if (this.files && this.files.length > 0) {
                label.textContent = 'Uploaded !!';
                } 
                else {
                    label.textContent = 'Image 3';
                }
                });
        </script>
        </div>

<input class="button" type="submit" value="Submit" name="btn">
        <?php
    if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset ($_SESSION['msg']);
}
?>
    </form>
    </div>
    <script>
        /* function validateFile() {
            // Get the file input element
            var fileInput = document.getElementById('file');
            
            // Get the selected file name
            var fileName = fileInput.value;
            
            // Get the file extension
            var fileExtension = fileName.split('.').pop().toLowerCase();
            
            // Define allowed file extensions
        var allowedExtensions = ['png', 'jpg', 'jpeg'];

        // Check if the file extension is allowed
        if (allowedExtensions.indexOf(fileExtension) === -1) {
            alert('Invalid file type. Please upload only .png, .jpg, or .jpeg files.');
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }*/
</script>
</body>
</html>
