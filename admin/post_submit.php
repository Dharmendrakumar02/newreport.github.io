<?php
if(isset($_FILES['fileToUpload'])){
	$error=array();
	$file_name=$_FILES['fileToUpload']['name'];
	$file_size=$_FILES['fileToUpload']['size'];
	$file_tmp=$_FILES['fileToUpload']['tmp_name'];
	$file_type=$_FILES['fileToUpload']['type'];
	$file_ext=strtolower(end(explode(".",$file_name)));
	$extension=array('jpeg','png','jpg');
	if(in_array($file_ext,$extension)===false){
		$error[]="this file is not allow, please choose jpeg,png and jpg file";
	}
	if($file_size>2097157){
		$error[]="file size must be 2mb or lower";
	}
	$new_name=time()."-".basename($file_name);
	$target="upload/".$new_name;
	
	if(empty($error)==true){
		move_uploaded_file($file_tmp,$target);
	}else{
		print_r($error);
		die();
	}
}

include_once("config.php");
	session_start();
 	$title=mysqli_real_escape_string($con,$_POST["post_title"]);
	$desc=mysqli_real_escape_string($con,$_POST["post_desc"]);
	$category=mysqli_real_escape_string($con,$_POST["category"]);
	$date=date('d M,Y');
	$author=$_SESSION["user_id"];
	
	$sql= "INSERT INTO `post`(`title`, `description`, `category`, `post_date`, `author`, `post_img`)
	VALUES ('$title','$desc','$category','$date',$author,'$new_name');";
	$sql.= "update category set post=post+1 where category_id=$category";
	if(mysqli_multi_query($con,$sql)){
		header("Location:post.php");
	}else{
		echo "<div class='alert alert-danger'>Query failed</div>";
	}

?>