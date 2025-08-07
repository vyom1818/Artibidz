<?php session_start();
//include("../includes/connect.php");
?>
<html>
    <body>
        <?php
         $cn=mysqli_connect("localhost","root","","artibidz") or die("Check connection");
            $city_id=$_GET['city_id'];
            $sql = "delete from city where city_id='$city_id'";

           $result = mysqli_query($cn,$sql);
           $_SESSION['msg']="City Deleted";
          header("Location:city.php");
        ?>
       
    </body>
</html>
