<?php include_once("header.php"); ?>

<?php
if(isset($_POST['update'])){
include_once('config.php');
$user_id=mysqli_real_escape_string($con,$_POST["user_id"]);
$fname=mysqli_real_escape_string($con,$_POST["fname"]);
$lname=mysqli_real_escape_string($con,$_POST["lname"]);
$username=mysqli_real_escape_string($con,$_POST["username"]);
$role=mysqli_real_escape_string($con,$_POST["role"]);
$code=mysqli_real_escape_string($con,rand(11111,9999));
 
 $sql1="UPDATE `user` SET `first_name`='$fname',`last_name`='$lname',
 `username`='$username',`role`='$role',`code`='$code' WHERE user_id='$user_id'";
$result1=mysqli_query($con,$sql1) or die("Query failed");
 if($result1){
	 echo "<script>alert('data modify');</script>";
	 header("Location:users.php");
	 }
 
}

?> 
 <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                  <!-- Form Start -->
				  <?php
					include_once('config.php');
 					$code=$_GET['code'];
					$sql="select * from user where code='$code'" ;
					$result=mysqli_query($con,$sql) or die("Query unsuccessful");
					if(mysqli_num_rows($result)>0)
					{
					while($row=mysqli_fetch_assoc($result)){
					
					?>
                   <form  action="<?php $_SERVER['PHP_SELF'];?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?= $row['user_id']; ?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" value="<?= $row['first_name']?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" value="<?= $row['last_name']?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?= $row['username']?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $row['role']; ?>" >
                              <?php
								if($row['role']==1){
								echo '<option value="0">Normal User</option>
										<option value="1" selected>Admin</option>';
										}else{
										echo '<option value="0" selected>Normal User</option>
										<option value="1">Admin</option>';
										}
 				
							 ?>
									
                          </select>
                      </div>
                      <input type="submit" name="update" class="btn btn-primary" value="Update" required />
                  </form>
				  <?php
					}
				}
				  ?>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
