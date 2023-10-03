<?php
include_once("config.php");
if(empty($_FILES['new-image']['name'])){
	$new_name=$_POST['old_image'];
}else{
	$error=array();
	$file_name=$_FILES['new-image']['name'];
	$file_size=$_FILES['new-image']['size'];
	$file_tmp=$_FILES['new-image']['tmp_name'];
	$file_type=$_FILES['new-image']['type'];
	$file_ext=strtolower(end(explode('.',$file_name)));
	$extension=array('jpeg','png','jpg');
	if(in_array($file_ext,$extension)===false){
		$error[]="this file is not allow, please choose jpeg,png and jpg file";
	}
	if($file_size>2097157){
		$error[]="file size must be 2mb or lower";
	}
	$new_name=time()."-".basename($file_name);
	$target="upload/".$new_name;
	//$image_name=$new-image;
	if(empty($error)==true){
		move_uploaded_file($file_tmp,$target);
	}else{
		print_r($error);
		die();
	}
}
$sql="UPDATE `post` SET `title`='{$_POST['post_title']}',`description`='{$_POST['postdesc']}',`category`={$_POST['category']},
		`post_img`='{$new_name}' WHERE post_id={$_POST['post_id']};";
if($_POST['old_category'] = $_POST['category']){
$sql.="update category set post=post - 1 where category_id={$_POST['old_category']};";
$sql.="update category set post=post + 1 where category_id={$_POST['category']};";

}
$result=mysqli_multi_query($con,$sql) or die("Query failed");
if($result){
	header("Location:post.php");
}
?>