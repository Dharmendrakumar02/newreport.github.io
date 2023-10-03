<?php include_once("header.php"); ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Website Setting</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
			   <?php
			   
				include_once("config.php");
				$sql="SELECT * FROM image ";
				$result=mysqli_query($con,$sql) or die("Query failed");
				if(mysqli_num_rows($result)>0){
				while($row=mysqli_fetch_assoc($result)){
			
				?>
        
                  <!-- Form Start -->
                  <form action="save-setting.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="form-group">
						<label for="website_name">Website Name</label>
						<input type="text" name="website_name" value="<?php echo $row['websitename']; ?>" class="form-control" autocomplete>                                                         
					</div>
					<div class="form-group">
						<label for="logo">Website Logo</label>
						<input type="file" name="logo" /> 
						<img src="images/<?php echo $row['logo']; ?>" width="200px" height="100px">
						<input type="hidden" name="old_logo" value="<?php echo $row['logo']; ?>"/>
					</div>
					<div class="form-group">
						<label for="footer_desc">Footer Description</label>
						<textarea name="footer_desc" class="form-control" rows="S" required><?php echo $row['footerdesc']; ?></textarea>                                                         
					</div>
					<input type="submit" name="submit" class="btn btn-primary" value="Save"/>
                  </form>
                  <!-- /Form End -->
				<?php
					}
				}
				?>
						
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>

