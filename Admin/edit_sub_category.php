<?php session_start();

     $cn=mysqli_connect("localhost","root","","artibidz") or die("Check connection");
    if (isset($_GET['sub_cat_id'])) {
        $sub_cat_id = $_GET['sub_cat_id'];
    $sql = "select * from sub_category where sub_cat_id='$sub_cat_id'";
    $result= mysqli_query($cn,$sql);
    $rec=mysqli_fetch_array($result);
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
            width:28vw;
            background:#324960;
            border-radius:50px;
            color:#fff;
        }

        a{
            color:white;
        }

        header,.subname,.selsub,.button,.back{
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
<body>
    
    <div class="container">
        <header>
            <h1>
                Edit Sub-Category
            </h1>
        </header>

        <form action="edit_sub_category1.php" method="post">

            <input type="hidden" name="sub_cat_id" value="<?php echo $rec['sub_cat_id'];?>"/>

            <div class="subname">
                Sub-Category Name:
                <input type="text" required value="<?php echo $rec['sub_cat_name'];?>" name="sub_cat_name"/>
            </div>
            
            <div class="selsub">
                Select Category:
                <select name="cat_id">
                <?php
                $cn=mysqli_connect("localhost","root","","artibidz") or die("Check connection");
                $sql="select * from category";
                $result=mysqli_query($cn,$sql);
                while($row=mysqli_fetch_array($result))
                {
                    echo "<option value='${row['cat_id']}'>${row['cat_name']}</option>";
                }?>
                </select>
            </div>
        
            <div class="button">
                <input type="submit" class="btn btn-danger" value="save"/>
            </div>
                
            <div class="back">
                <a href="sub_category.php">Back</a>
            </div>
        
        </form>
    </div>
    </body>    
</html>