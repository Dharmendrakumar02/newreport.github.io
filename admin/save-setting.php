<?php
include_once("config.php");
if(empty($_FILES['logo']['name'])){
	$file_name=$_POST['old_logo'];
}else{
	$error=array();
	$file_name=$_FILES['logo']['name'];	
	$file_size=$_FILES['logo']['size'];
	$file_tmp=$_FILES['logo']['tmp_name'];
	$file_type=$_FILES['logo']['type'];
	$file_ext=strtolower(end(explode('.',$file_name)));
	$extension=array('jpeg','png','jpg');
	if(in_array($file_ext,$extension)===false){
		$error[]="this file is not allow, please choose jpeg,png and jpg file";
	}
	if($file_size>2097157){
		$error[]="file size must be 2mb or lower";
	}
	if(empty($error)==true){
		move_uploaded_file($file_tmp,"images/".$file_name);
	}else{
		print_r($error);
		die();
	}
}
$sql="UPDATE `image` SET `websitename`='{$_POST['website_name']}',`logo`='{$file_name}',`footerdesc`='{$_POST['footer_desc']}' ";
$result=mysqli_query($con,$sql) or die("Query failed");
if($result){
	header("Location:setting.php");
}else{
	echo "Query failed";
}
?>