<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
			<?php
			include_once("config.php");
							
			if(isset($_GET['page'])){
			$page=$_GET['page'];
			}else{
				$page=1;
			}
			$limit=4;
			$offset=($page-1)* $limit;
			$sql="select * from category order by category_id DESC limit {$offset},{$limit}";
			$result=mysqli_query($con,$sql) or die("Query failed");
				if(mysqli_num_rows($result)>0){
						
			?>
                <table class="table content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                      <?php 
					  $serial=$offset+1;
 					  while($row=mysqli_fetch_assoc($result)){
 					 ?>
                          <tr>
                              <td class='id'><?=$serial?></td>
                              <td><?=$row['category_name']?></td>
                               <td><?=$row['post']?></td>
                               <td class='edit'><a href='update-category.php?id=<?=$row['category_id']?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-category.php?id=<?=$row['category_id']?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
					  <?php 
					  $serial++;
					  } ?>
                      
                    </tbody>
                </table>
				<?php
				}
					$sql1="select * from category";
					$result1=mysqli_query($con,$sql1) or die("Query failed");
					if(mysqli_num_rows($result1) >0 ){
						
					$total_record=mysqli_num_rows($result1);
					$total_page=ceil($total_record / $limit);
					echo '<center>';
					echo "<ul class='pagination admin-pagination' style='text-align:center;'>";
					if($page > 1){
					echo '<li><a href="category.php?page='.($page-1).'">Prev</a></li>';
					}
					for($i=1; $i<=$total_page; $i++){
						if($i==$page){
							$active="active";
						}else{
							$active="";
						}
						echo '<li class="'.$active.'"><a href="category.php?page='.$i.'">'.$i.'</a></li>';
					}
				if($total_page > $page){
				echo '<li><a href="category.php?page='.($page+1).'">Next</a></li>';
				}
				echo "</ul>";
				echo '</center>';
				}
				?>
             </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
