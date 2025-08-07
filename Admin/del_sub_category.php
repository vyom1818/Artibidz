<?php session_start();
//include("../includes/connect.php");
?>
<html>
    <body>
        <?php
         $cn=mysqli_connect("localhost","root","","artibidz") or die("Check connection");
            $sub_cat_id=$_GET['sub_cat_id'];
            $sql = "delete from sub_category where sub_cat_id='$sub_cat_id'";

           $result = mysqli_query($cn,$sql);
           $_SESSION['msg']="Sub-Category Deleted";
          header("Location:sub_category.php");
        ?>
       
    </body>
</html>
