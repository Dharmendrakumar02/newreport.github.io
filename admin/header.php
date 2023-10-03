<?php
include_once("config.php");

session_start();

if(!isset($_SESSION['username'])){
	
	header("Location:index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
	     <title>News ADMIN Panel</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <!-- Bootstrap -->
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="../css/font-awesome.css">
        <!-- Custom stlylesheet -->
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <!-- HEADER -->
        <div id="header-admin">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-2">
					<?php
					
					include_once("config.php");
					
					
					$sql="SELECT  * FROM image";
					$result=mysqli_query($con,$sql) or die("Query failed");
					if(mysqli_num_rows($result)>0){
						while($row=mysqli_fetch_assoc($result)){
							if($row['logo']==""){
								echo '<a href="index.php" ><h1>'.$row['websitename'].'</h1>';
							}else{
								echo '<a href="index.php"><img class="logo" style="height:70px; width:203px;" src="./images/'.$row['logo'].'"></a>';
							}
					 	}
					}
					
					?>
					</div>
                    <!-- /LOGO -->
                      <!-- LOGO-Out -->
                    <div class="col-md-offset-9  col-md-1">
                        <a href="logout.php" class="admin-logout" ><span class="text-danger small">Hello <?= $_SESSION['username'];?>,
						logout</span></a>
                    </div>
                    <!-- /LOGO-Out -->
                </div>
            </div>
        </div>
        <!-- /HEADER -->
        <!-- Menu Bar -->
        <div id="admin-menubar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                       <ul class="admin-menu">
                            <li>
                                <a href="post.php">Post</a>
                            </li>
							<?php
							if($_SESSION['user_role']==1){
								
							
							?>
                            <li>
                                <a href="category.php">Category</a>
                            </li>
                            <li>
                                <a href="users.php">Users</a>
                            </li>
							<li>
                                <a href="setting.php">Setting</a>
                            </li>
							<?php
							}
							?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Menu Bar -->
