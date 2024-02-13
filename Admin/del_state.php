<?php session_start();
//include("../includes/connect.php");
?>
<html>
    <body>
        <?php
         $cn=mysqli_connect("localhost","root","","artibidz") or die("Check connection");
            $state_id=$_GET['state_id'];
            $sql = "delete from state where state_id='$state_id'";

           $result = mysqli_query($cn,$sql);
           $_SESSION['msg']="State deleted";
          header("Location:state.php");
        ?>
       
    </body>
</html>
