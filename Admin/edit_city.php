<?php session_start();
//include("../includes/connect.php")
?>
<html lang="en">

<?php
     $cn=mysqli_connect("localhost","root","","artibidz") or die("Check connection");
    if (isset($_GET['city_id'])) {
        $city_id = $_GET['city_id'];
    $sql = "select * from city where city_id='$city_id'";
    $result= mysqli_query($cn,$sql);
    $rec=mysqli_fetch_array($result);
    }
 
    
?>
<center>
<html>
    <body>
        <table>
            <h1>
            <header>
                    Edit City
              </header></h1>

        <form action="edit_city1.php" method="post">
        <input type="hidden" name="city_id" value="<?php echo $rec['city_id'];?>"/>
        <tr>
            <td><b>City Name:</b><br /></td>
            <td><input type="text" required value="<?php echo $rec['city_name']; ?>"
            name="city_name"/></td>
            <tr><td></td><td> <select name="state_id" id="">
            <?php
            $cn=mysqli_connect("localhost","root","","artibidz") or die("Check connection");
            $sql="select * from state";
            $result=mysqli_query($cn,$sql);
            while($row=mysqli_fetch_array($result))
            {
                echo "<option value='${row['state_id']}'>${row['state_name']}</option>";
            }

            ?>
        </select></td></tr>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" class="btn btn-danger" value="save"/><br /><br /></td>
            
            </tr>
            <tr>
                <td></td>
                <td><a href="city.php"><u><b>Back</b></u></a></td>
            </tr>
            </table>
        </body>
            
    
    </center>
    </html>
    <br><br><br><br><br>
    