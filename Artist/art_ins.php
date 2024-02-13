<?php session_start() ?>
<html> 
	<body>
		<?php
	  function upload($file,$highestValue)
 { 
		$cn=mysqli_connect("localhost","root","","artibidz") or die("check connection");
	  	 $targetDirectory = "../images/";
	  $targetFile = $targetDirectory . basename($file['name']);
	  $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
	  	 if (isset($file)) 
	  	{
		  if ($imageFileType == "png" || $imageFileType == "jpg")
		   {
			      if (move_uploaded_file($file['tmp_name'], $targetFile)) 
			        {
				  		echo json_encode(["msg" => "Data Inserted."]);
				  		$sql="insert into art_image(art_id,art_image) values ('$highestValue','$targetFile')";
						$result=mysqli_query($cn,$sql);
		  			}else{
				  			echo json_encode(["error" => "Failed to upload file."]);
			  	 		 }
				  
			}else{
			  echo json_encode(["error" => "Only png and jpg files are allowed."]);
		  	}
		  }
		
} 
	  
	  
		$cn=mysqli_connect("localhost","root","","artibidz") or die("check connection");
		$art_name=$_POST['art_name'];
        $art_desc=$_POST['art_desc'];
        $art_qty=$_POST['art_qty'];
        $art_date=$_POST['art_date'];
        $art_amt=$_POST['art_amt'];
		$sub_cat_id=$_POST['sub_cat_id'];
		$user_id=$_SESSION['user_id'];


	   

		$sql="INSERT INTO art(art_name,art_desc,art_date,art_amt,art_qty,sub_cat_id,user_id)values('$art_name','$art_desc','$art_date',$art_amt,$art_qty,$sub_cat_id,$user_id)";
		$result=mysqli_query($cn,$sql);

		$sql="select max(art_id) AS max from art";
		$result=mysqli_query($cn,$sql);
		$res = mysqli_fetch_array( $result);
		$highestValue = $res['max'];
		echo $highestValue;
		upload($_FILES['file1'],$highestValue);
		upload($_FILES['file2'],$highestValue);
		upload($_FILES['file3'],$highestValue);

		$_SESSION['msg']="art inserted";
		header("Location:art.php");
	?>
</body>
</html>
