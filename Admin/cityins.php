<?php session_start();
//include("../includes/connect.php");
?>
<html>
    <body>
       <?php
        $cn=mysqli_connect("localhost","root","","artibidz") or die("Check connection");
       $city_name=$_POST['city_name'];
       $state_id=$_POST['state_id'];
       $query="insert into city(city_name,state_id)values ('$city_name',$state_id)";
       $result=mysqli_query($cn,$query);
       echo "<center>";
       $_SESSION['msg']="City Inserted";
       echo "</center>";
       header("Location:city.php");
       ?>
    </body>
   
</html>
