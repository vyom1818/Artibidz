<?php session_start();
//include("../includes/connect.php");
?>
<html>
    <body>
       <?php
        $cn=mysqli_connect("localhost","root","","artibidz") or die("Check connection");
       $state_name=$_POST['state_name'];
       $query="insert into state(state_name)values ('$state_name')";
       $result=mysqli_query($cn,$query);
       $_SESSION['msg']="State inserted";
       header("Location:state.php");
       ?>
    </body>
   
</html>
