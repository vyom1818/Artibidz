<?php session_start();
//include("../includes/connect.php")
?>
<html lang="en">

<?php
     $cn=mysqli_connect("localhost","root","","artibidz") or die("Check connection");
    if (isset($_GET['sub_cat_id'])) {
        $sub_cat_id = $_GET['sub_cat_id'];
    $sql = "select * from sub_category where sub_cat_id='$sub_cat_id'";
    $result= mysqli_query($cn,$sql);
    $rec=mysqli_fetch_array($result);
    }
 
    
?>
<center>
<html>
    <body>
        <table>
            <h1>
            <header>
                    Edit Sub-Category
              </header></h1>

        <form action="edit_sub_category1.php" method="post">
        <input type="hidden" name="sub_cat_id" value="<?php echo $rec['sub_cat_id'];?>"/>
        <tr>
            <td><b>Sub-Category Name:</b><br /></td>
            <td><input type="text" required value="<?php echo $rec['sub_cat_name'];?>" name="sub_cat_name"/></td>
            <tr><td>Select Category:</td>
            <td> <select name="cat_id">
            <?php
            $cn=mysqli_connect("localhost","root","","artibidz") or die("Check connection");
            $sql="select * from category";
            $result=mysqli_query($cn,$sql);
            while($row=mysqli_fetch_array($result))
            {
                echo "<option value='${row['cat_id']}'>${row['cat_name']}</option>";
            }

            ?>
        </select></td></tr>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" class="btn btn-danger" value="save"/><br /><br /></td>
            
            </tr>
            <tr>
                <td></td>
                <td><a href="sub_category.php"><u><b>Back</b></u></a></td>
            </tr>
            </table>
        </body>
            
    
    </center>
    </html>
    <br><br><br><br><br>
    