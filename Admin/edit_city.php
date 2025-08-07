<html>
<head>
<title>Admin</title>  
    <style>
        *{
            margin:0;
            padding:0;
        }

        body{
            height:100vh;
            width:100vw;
            display:flex;
            justify-content:center;
            align-items:center;
            background:#64c5b1;
        }

        .container
        {    
            display:flex;
            flex-direction:column;
            justify-content:center;
            /* align-items:flex-start; */
            height:70vh;
            width:25vw;
            background:#324960;
            border-radius:50px;
            color:#fff;
        }

        a{
            color:white;
        }

        header,.city,.state,.button,.back{
            display:flex;
            justify-content:left;
            align-items:center;
            height:10vh;
            width:25vw;
            margin:3vh 5vw;
        }

        .btn-danger{
            height:5vh;
            width:7vw;
            border:1px solid white;
            border-radius:20px;
        }

        input[type="text"]{
            background:transparent;
            border:none;
            color:white;
            border-bottom:1px solid white;
        }

        input[type="text"]:focus-visible{
            background:transparent;
            border:none;
            outline:none;
            color:white;
            border-bottom:1px solid white;
        }

        select{
            background:transparent;
            border:none;
            color:white;
            border-bottom:1px solid white;
        }
        
        select:focus-visible{
            background:transparent;
            border:none;
            outline:none;
            color:white;
            border-bottom:1px solid white;
        }

        select:hover{
            cursor:pointer;
        }

        .btn-danger:hover{
            cursor:pointer;
        }

        .header{
            justify-content:center;
        }
    </style>
</head>
<?php session_start();
//include("../includes/connect.php")
?>
<?php
     $cn=mysqli_connect("localhost","root","","artibidz") or die("Check connection");
    if (isset($_GET['city_id'])) {
        $city_id = $_GET['city_id'];
    $sql = "select * from city where city_id='$city_id'";
    $result= mysqli_query($cn,$sql);
    $rec=mysqli_fetch_array($result);
    }
 
    
?>
    <body>

    <div class="container">
        <header>
            <h1>
                Edit City
            </h1>
        </header>

        <form action="edit_city1.php" method="post">
            
            <input type="hidden" name="city_id" value="<?php echo $rec['city_id'];?>"/>
        
            <div class="city">
                City Name: <input type="text" required value="<?php echo $rec['city_name']; ?>" name="city_name"/>
            </div>
            
            <div class="state">
                State Name:
                <select name="state_id" id="">
                <?php
                $cn=mysqli_connect("localhost","root","","artibidz") or die("Check connection");
                $sql="select * from state";
                $result=mysqli_query($cn,$sql);
                while($row=mysqli_fetch_array($result))
                {
                    echo "<option value='${row['state_id']}'>${row['state_name']}</option>";
                }
                ?>
                </select>            
            </div>
                
            <div class="button">
                <input type="submit" class="btn btn-danger" value="Save"/>
            </div>
        </form>

        <div class="back">
            <a href="city.php"> Back </a>
        </div>
    
    </div>   
        
    </body>  
</html>
