<?php
$id=$_GET['art_id'];
 $cn=mysqli_connect("localhost","root","","artibidz") or die("Check connection");
            $sql="delete from art where art_id=".$id;
            mysqli_query($cn,$sql);
            $sql="delete from art_image where art_id=".$id;
            mysqli_query($cn,$sql);
            header('location:art.php');

?>