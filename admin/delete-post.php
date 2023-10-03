<?php
include_once("config.php");
$post_id=$_GET["id"];
$cat_id=$_GET['category_id'];	
  	$query1="select * from post where post_id='$post_id'";
	$result1=mysqli_query($con,$query1) or die("Query failed :selected ");
	$row = mysqli_fetch_assoc($result1);
	unlink("upload/".$row['post_img']);
 	
   	$query="delete from post where post_id='$post_id';";
	$query.="update category set post=post - 1 where category_id='$cat_id'";
	$result=mysqli_multi_query($con,$query);
	if($query){
		mysqli_close($con);
 		header("Location:post.php");
	}else{
		echo "<div class='alert alert-warning'> Recard can't delete</div>";
	}
 	
 ?>