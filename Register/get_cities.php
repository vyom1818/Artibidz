<?php
    $cn = mysqli_connect("localhost","root","","artibidz") or die("check connection");

if (isset($_POST['state'])) {
    $state = $_POST['state'];
    
    // Replace this with your own logic to fetch cities from a database or another source
    $sql = "select * from city where state_id = $state";
    $result = mysqli_query($cn,$sql);
    
    $options = "<option value=''>Select City</option>";
    while($row=mysqli_fetch_array($result))
    {
        echo "<option value='${row['city_id']}'>${row['city_name']}</option>";
    }

    echo $options;
}
?>
