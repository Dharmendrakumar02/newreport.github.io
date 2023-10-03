<?php

include_once("header.php");
if($_SESSION['user_role']==0){
	header("Location:post.php");
}
							 
 
include_once("config.php");
$code=$_GET["code"];
if(isset($_GET["code"])){
	
	$code=$_GET["code"];
 	$query=mysqli_query($con,"delete from user where code='$code' ");
	if($query){
		mysqli_close($con);
 		header("Location:users.php");
		exit();
	}else{
		echo "error deleting records";
	}
 	
}
 ?>