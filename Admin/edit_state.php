<?php session_start();
//include("../includes/connect.php")
?>
<html lang="en">

<?php
   $cn=mysqli_connect("localhost","root","","artibidz") or die("Check connection");  
    if (isset($_GET['state_id'])) {
    $state_id = $_GET['state_id'];
    $sql = "select * from state where state_id='$state_id'";
    $result= mysqli_query($cn,$sql);
    $rec=mysqli_fetch_array($result);
   // header("Location:state.php");
    }
 
    
?>
<center>
<html>
    <body>
        <table>
            <h1>
            <header>
                    Edit State
              </header></h1>

        <form action="edit_state1.php" method="post">
        <input type="hidden" name="state_id" value="<?php echo $rec['state_id'];?>"/>
        <tr>
            <td><b>State Name:</b><br /></td>
            <td><input type="Text" name="state_name" value="<?php echo isset($rec['state_name']) ? $rec['state_name'] : ''; ?>"/>
</td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" class="btn btn-danger" value="save"/><br /><br /></td>
            
            </tr>
           
            </table>
        </body>
            
    
    </center>
    </html>
    <br><br><br><br><br>
    