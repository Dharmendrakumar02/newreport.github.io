<?php
include_once("config.php");
$cat_id=$_GET["id"];
if(isset($_GET["id"])){
	
	$cat_id=$_GET["id"];
 	$query=mysqli_query($con,"delete from category where category_id='$cat_id' ");
	if($query){
		mysqli_close($config);
 		header("Location:category.php");
		exit();
	}else{
		echo "error deleting records";
	}
 	
}
?>