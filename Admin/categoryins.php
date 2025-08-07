<?php session_start();
//include("../includes/connect.php");
 ?>
 <html>
    <body>
       <?php
        $cn=mysqli_connect("localhost","root","","artibidz") or die("Check connection");
       $cat_name=$_POST['cat_name'];
       $query="insert into category(cat_name)values ('$cat_name')";
       $result=mysqli_query($cn,$query);
       $_SESSION['msg']="Category Inserted";
       header("Location:category.php");
       ?>
    </body>
   
</html>
