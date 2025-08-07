<?php 
    session_start();
    
    $cn=mysqli_connect("localhost","root","","artibidz") or die("Check connection");  
    if (isset($_GET['state_id'])) {
    $state_id = $_GET['state_id'];
    $sql = "select * from state where state_id='$state_id'";
    $result= mysqli_query($cn,$sql);
    $rec=mysqli_fetch_array($result);
   // header("Location:state.php");
    }
?>
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

        header,.state,.button{
            display:flex;
            justify-content:left;
            align-items:center;
            height:20vh;
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

        .btn-danger:hover{
            cursor:pointer;
        }

        .header{
            justify-content:center;
        }
    </style>
    
</head>
<body>

    <div class="container">

        <header>
            <h1>
                Edit State
            </h1>
            </header>
            
        <form action="edit_state1.php" method="post">
            
            <input type="hidden" name="state_id" value="<?php echo $rec['state_id'];?>"/>
            
            <div class="state">
                State Name:
                <input type="Text" name="state_name" value="<?php echo isset($rec['state_name']) ? $rec['state_name'] : ''; ?>"/>
            </div>
            
            <div class="button">
                <input type="submit" class="btn btn-danger" value="Save"/>
            </div>
        </form>        
    </div>
</body>    
</html>