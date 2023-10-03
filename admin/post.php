<?php include_once('header.php'); ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
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
				
 				if($_SESSION["user_role"]==1){								 
				$sql="SELECT post.post_id, post.title, post.description, post.post_date, 
				category.category_name,post.category, user.username FROM `post`
				left join category on post.category=category.category_id
				left join user on post.author=user.user_id
				order by  post.post_id DESC limit {$offset},{$limit} "; 
			}
			
			elseif($_SESSION['user_role']==0){								 
				$sql="SELECT post.post_id, post.title, post.description, post.post_date, 
				category.category_name,post.category, user.username FROM `post`
				left join category on post.category=category.category_id
				left join user on post.author=user.user_id
				where post.author={$_SESSION['user_id']}
				order by  post.post_id DESC limit {$offset},{$limit} "; 
			}
			
 			$result=mysqli_query($con,$sql) or die("Query failed");
			if(mysqli_num_rows($result)>0){
			
			?>
			
                  <table class="table content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
					  
					  <?php 
					  
					  $serial=$offset+1;
					  while($row=mysqli_fetch_assoc($result)){?>
                          <tr>
                              <td class='id'><?php echo $serial?></td>
                              <td><?=$row['title']?></td>
                              <td><?=$row['category_name']?></td>
                              <td><?=$row['post_date']?></td>
                              <td><?=$row['username']?></td>
                              <td class='edit'><a href='update-post.php?id=<?=$row['post_id']?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?id=<?=$row['post_id']?>& cat_id =<?php echo $row['category'];?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
					  <?php 
					 $serial++;
					 } 
					 
					 ?>
                      </tbody>
                  </table>
				   <?php
				   
						}
					
					$sql1="select * from post";
					$result1=mysqli_query($con,$sql1) or die("Query failed");
					if(mysqli_num_rows($result1) >0 ){
						
					$total_record=mysqli_num_rows($result1);
					$total_page=ceil($total_record / $limit);
					echo '<center>';
					echo "<ul class='pagination admin-pagination' style='text-align:center;'>";
					if($page > 1){
					echo '<li><a href="post.php?page='.($page-1).'">Prev</a></li>';
					}
					for($i=1; $i<=$total_page; $i++){
						if($i==$page){
							$active="active";
						}else{
							$active="";
						}
						echo '<li class="'.$active.'"><a href="post.php?page='.$i.'">'.$i.'</a></li>';
					}
				if($total_page > $page){
				echo '<li><a href="post.php?page='.($page+1).'">Next</a></li>';
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
