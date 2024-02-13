<?php session_start();
//include("../includes/connect.php");
?>
<html>
    <body>
        <?php
         $cn=mysqli_connect("localhost","root","","artibidz") or die("Check connection");
        $sub_cat_id=$_POST['sub_cat_id'];
        $sub_cat_name=$_POST['sub_cat_name'];
        $cat_id=$_POST['cat_id'];
        $sql="update sub_category set sub_cat_name='$sub_cat_name',cat_id='$cat_id' where sub_cat_id='$sub_cat_id'";
        $result=mysqli_query($cn,$sql);
       $_SESSION['msg']="Sub-category updated";
       header("Location:sub_category.php");

        ?>
    </body>
</html>