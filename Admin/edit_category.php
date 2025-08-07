<?php session_start();
 
    $cn=mysqli_connect("localhost","root","","artibidz") or die("Check connection");
    $cat_id = $_GET['cat_id'];
    $sql = "select * from category where cat_id='$cat_id'";
    $result= mysqli_query($cn,$sql);
    $rec=mysqli_fetch_array($result);
    mysqli_close($cn);
    
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

        a{
            color:white;
        }

        header,.cat,.button,.back{
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
                Edit Category
            </h1>
        </header>
        
        <form action="edit_category1.php" method="post">
        
            <input type="hidden" name="cat_id" value="<?php echo $rec['cat_id'];?>"/>
            
            <div class="cat">
                Cat Name:
                <input type="text" required value="<?php echo $rec['cat_name']; ?>"
                name="cat_name"/>
            </div>
            
            <div class="button">
                <input type="submit" class="btn btn-danger" value="save"/>
            </div>
            
            <div class="back">
                <a href="category.php">Back
            </div>
        </form>
    </div>
</body>
</html>