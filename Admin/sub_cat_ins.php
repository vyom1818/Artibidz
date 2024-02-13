

<?php session_start();
//include("../includes/connect.php");
?>
<html>
    <body>
       <?php
        $cn=mysqli_connect("localhost","root","","artibidz") or die("Check connection");
       $sub_cat_name=$_POST['sub_cat_name'];
       $cat_id=$_POST['cat_id'];
       $query="insert into sub_category(sub_cat_name,cat_id)values ('$sub_cat_name',$cat_id)";
       $result=mysqli_query($cn,$query);
       $_SESSION['msg']="sub-category inserted";
       header("Location:sub_category.php");
       ?>
    </body>
   
</html>
