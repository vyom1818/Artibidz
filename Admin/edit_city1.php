<?php session_start();
//include("../includes/connect.php");
?>
<html>
    <body>
        <?php
         $cn=mysqli_connect("localhost","root","","artibidz") or die("Check connection");
        $city_id=$_POST['city_id'];
        $city_name=$_POST['city_name'];
        $state_id=$_POST['state_id'];
        $sql="update city set city_name='$city_name',state_id='$state_id' where city_id='$city_id'";
        $result=mysqli_query($cn,$sql);
       $_SESSION['msg']="city updated";
       header("Location:city.php");

        ?>
    </body>
</html>