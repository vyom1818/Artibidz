<?php session_start();
//include("../includes/connect.php");
?>
<html lang="en">

<?php
    
    $cn=mysqli_connect("localhost","root","","artibidz") or die("Check connection");
    $cat_id = $_GET['cat_id'];
    $sql = "select * from category where cat_id='$cat_id'";
    $result= mysqli_query($cn,$sql);
    $rec=mysqli_fetch_array($result);
    mysqli_close($cn);
    
?>
<center>
<html>
    <body>
    <table>
            <h1>
            <header>
                    Edit Category
              </header></h1>

        <form action="edit_category1.php" method="post">
        <input type="hidden" name="cat_id" value="<?php echo $rec['cat_id'];?>"/>
        <tr>
            <td><b>Cat Name:</b><br /></td>
            <td><input type="text" required value="<?php echo $rec['cat_name']; ?>"
            name="cat_name"/></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" class="btn btn-danger" value="save"/><br /><br /></td>
            
        </tr>
        <tr>
            <td></td>
            <td><a href="category.php"><u><b>Back</b></u></a></td>
        </tr>
        </table>
    </body>
        

</center>
</html>
<br><br><br><br><br>
