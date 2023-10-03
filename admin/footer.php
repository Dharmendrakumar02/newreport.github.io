<!-- Footer -->
<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
			<?php
			
				include_once("config.php");
				$sql="SELECT  * FROM Image ";
				$result=mysqli_query($con,$sql) or die("Query failed");
				if(mysqli_num_rows($result)>0){
					while($row=mysqli_fetch_assoc($result)){
			
				?>
                <span><?php echo $row['footerdesc']; ?></span>
				<?php
					}
				}
				
				?>
            </div>
        </div>
    </div>
</div>
<!-- /Footer -->
</body>
</html>
