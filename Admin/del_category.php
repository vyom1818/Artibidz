<?php session_start();
//include("../includes/connect.php");
?>
<html>
    <body>
        <?php
         $cn=mysqli_connect("localhost","root","","artibidz") or die("Check connection");
            $cat_id=$_GET['cat_id'];
            $sql = "delete from category where cat_id='$cat_id'";

           $result = mysqli_query($cn,$sql);
           $_SESSION['msg']="Category Deleted";
          header("Location:category.php");
        ?>
       
    </body>
</html>
