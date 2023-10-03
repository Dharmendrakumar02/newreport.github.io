<?php
$cat_id=$_GET['id'];
if(isset($_POST['submit'])){
include_once('config.php');
$catname=$_POST['cat_name']; 
 $sql1="UPDATE `category` SET `category_name`='$catname' WHERE category_id='$cat_id'";
$result1=mysqli_query($con,$sql1) or die("Query failed");
 if($result1){
	 echo "<script>alert('data modify');</script>";
	 header("Location:category.php");
	 }
 
}

?>

<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
			  <?php
					include_once('config.php');
					$sql="select * from category where category_id='$cat_id'" ;
					$result=mysqli_query($con,$sql) or die("Query unsuccessful");
					if(mysqli_num_rows($result)>0)
					{
					while($row=mysqli_fetch_assoc($result)){
					
					?>
                  
                  <form action="<?php $_SERVER["PHP_SELF"];?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $row['category_id'];?>" placeholder=""/>
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name'];?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
				  <?php
					}
					}
				  ?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
