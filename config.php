 <?php
 $hostname="localhost";
 $username="root";
 $password="";
  $con = mysqli_connect("$hostname","$username","$password");
  if(!$con)
  {
	  die("server failed" .mysqli_connect_errno());
  }
  else{
	  mysqli_select_db($con,"new_website");
  }
 
 ?>
 