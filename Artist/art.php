<?php session_start();
//include("../includes/connect.php");
 ?>
<html>
    <body>
<center>

        <table>
            <h1>
                    Art List
              </h1>

    <form action="art_ins.php" method="post" enctype="multipart/form-data" onsubmit="return validateFile()">
    <tr>
        <td>Art name:</td>
        <td><input type="text" name="art_name" placeholder="Enter Art Name" required><br /><br /></td>
        </tr>
        <tr>
            <td>Art Description:</td>
            <td><input type="text" name="art_desc" placeholder="Enter description"><br></td>
        </tr>   
        <tr>
            <td>Enter making date:</td><td><input type="date" name="art_date"></td>
        </tr>
        <tr>
            <td>Enter amount:</td><td><input type="text" name="art_amt"></td>
        </tr>

        <tr>
            <td>Enter Quantity:</td><td><input type="text" name="art_qty">
            </td>

        </tr>
        <tr>
            <td>Sale or Auction:</td>
            <td>
            <label for="sale">Sale</label>
            <input type="radio" name="sale_or_auction" value="sale">
            <label for="auction">Auction</label>
            <input type="radio" name="sale_or_auction"   value="auction">
        </td>
    </tr>
       <tr><td>Select category:</td><td> <select name="sub_cat_id" id="">
            <?php $cn=mysqli_connect("localhost","root","","artibidz") or die("Check connection");
           
            $sql="select * from sub_category";
            $result=mysqli_query($cn,$sql);
            while($row=mysqli_fetch_array($result))
            {
                echo "<option value='{$row['sub_cat_id']}'>{$row['sub_cat_name']}</option>";
            }

            ?>

        </select></td></tr>''
            <!-- <tr>
                <td>user id:</td>
                <td><input type="text" name="user_id"></td>
            </tr>
        <tr> -->
            <td>Upload art images:
            </td>
            <td> <input type="file" name="file1" accept=".jpg, .jpeg, .png" required><br></td>
        </tr>
        <tr>
            <td>
            </td>
            <td> <input type="file" name="file2" accept=".jpg, .jpeg, .png" required><br></td>
        </tr>
        <tr>
            <td>
            </td>
            <td> <input type="file" name="file3" accept=".jpg, .jpeg, .png" required><br></td>
        </tr>
    <tr>
        <td colspan="2" align="center"><input type="submit" value="submit" name="btn">
    </tr>
    <tr>
    <td>    
    <?php
    if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset ($_SESSION['msg']);
    }
    ?></td>
    </tr>
    </form>
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
    </table>
    
    <?php
    $sql = "SELECT a.*, u.username
    FROM art a
    JOIN user u ON a.user_id = u.user_id";


    $result = mysqli_query($cn,$sql);

    echo "<br>";
    
    echo mysqli_num_rows($result)." records found";
    echo " <table border='1'>";
    echo "<tr>";
    echo "<td>Art Id</td>";
    echo "<td>Art Name</td>";
    echo "<td>Description</td>";
    echo "<td>Date</td>";
    echo "<td>Art_amount</td>";
    echo "<td>Quantity</td>";
    echo"<td>sale or auction</td>";
    echo "<td>Sub-Category</td>";
    echo "<td>Category</td>";
    echo "<td>Art Images</td>";
    echo "<td>Artist name</td>";
    echo "<td>Edit | Delete</td>";
    echo "</tr>";
    echo "<br>";
                
    while($row = mysqli_fetch_array($result))   {
        echo "<tr>";
        echo "<td>{$row['art_id']}</td>";
        echo "<td>{$row['art_name']}</td>";
        echo "<td>{$row['art_desc']}</td>";
        echo "<td>{$row['art_date']}</td>";
        echo "<td>{$row['art_amt']}</td>";
        echo "<td>{$row['art_qty']}</td>";
        echo "<td>{$row['sale_or_auction']}</td>";


            $sql2="select * from sub_category where sub_cat_id=".$row['sub_cat_id'];
          $result2 = mysqli_query($cn,$sql2);
          $row2 = mysqli_fetch_array($result2);
        echo "<td>{$row2['sub_cat_name']}</td>";


        $sql3="select * from category where cat_id=".$row2['cat_id'];
          $result3 = mysqli_query($cn,$sql3);
          $row3 = mysqli_fetch_array($result3);
        echo "<td>{$row3['cat_name']}</td>";

            $sql1="select * from art_image where art_id={$row['art_id']}";
          $result1 = mysqli_query($cn,$sql1);
         echo "<td>";
            while($row1 = mysqli_fetch_array($result1))
            {
                echo"<img src='../{$row1['art_image']}'alt='{$row1['art_image']}' width=100 height=100 />";
               echo"&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
            }
            echo "<td>{$row['username']}</td>";

         echo "</td>";
        
        echo "<td><a href='edit_city.php?city_id=$row[art_id]'><u>Edit</u></a> | <a href='del_art.php?art_id=$row[art_id]'><u>Delete</u></a></td>";
        echo "</tr>";
    }
   
    echo "</table>";

    ?>
</center>
