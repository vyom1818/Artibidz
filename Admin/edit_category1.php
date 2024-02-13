<?php session_start();
//include("../includes/connect.php");
?>
<html>
    <body>
        <?php
         $cn=mysqli_connect("localhost","root","","artibidz") or die("Check connection");
        $cat_id=$_POST['cat_id'];
        $cat_name=$_POST['cat_name'];
        $sql="update category set cat_name='$cat_name' where cat_id='$cat_id'";
        $result=mysqli_query($cn,$sql);
       $_SESSION['msg']="category updated";
       header("Location:category.php");

        ?>
    </body>
</html>