<?php session_start();
//include("../includes/connect.php");
?>
<html>
    <body>
        <?php
         $cn=mysqli_connect("localhost","root","","artibidz") or die("Check connection");
        $state_id=$_POST['state_id'];
        $state_name=$_POST['state_name'];
        $sql="update state set state_name='$state_name' where state_id='$state_id'";
        $result=mysqli_query($cn,$sql);
       $_SESSION['msg']="State updated";
        header("Location:state.php");

        ?>
    </body>
</html>