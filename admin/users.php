<?php

include_once("header.php");

if($_SESSION['user_role']==0){
	header("Location:post.php");
}
						 
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
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
				
			$sql=mysqli_query($con,"SELECT * FROM `user` ORDER BY `user_id` ASC limit {$offset},{$limit}");
			if(mysqli_num_rows($sql)>0){
			?>
			
                  <table class="table content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody class=''>
					<?php
			
						$a=0;
						while($row = mysqli_fetch_array($sql)){
						$fname=$row["first_name"];
						$lname=$row["last_name"];
						$username=$row["username"];
						$role=$row["role"];
						$user_id=$row["user_id"];
						$code=$row["code"];
						$a=$a+1; 
						
					  ?>
					  <tr>
					  <td><?= $a ?></td>
					  <td><?= $fname. " " .$lname ?></td>
					  <td><?= $username ?></td>
					  <td><?= $role ?></td>
					  <td><?='<a href="update-user.php?code='.$code.'">Edit</a>'?></td>
					  <td><?='<a href="delete_user.php?code='.$code.'">Delete</a>'?></td>
					  </tr>
					<?php
						}
					?>
					</tbody>
                  </table>
				  <?php
						}
					$sql1="select * from user";
					$result1=mysqli_query($con,$sql1) or die("Query failed");
					if(mysqli_num_rows($result1) >0 ){
						
					$total_record=mysqli_num_rows($result1);
					$total_page=ceil($total_record / $limit);
					echo '<center>';
					echo "<ul class='pagination admin-pagination' style='text-align:center;'>";
					if($page > 1){
					echo '<li><a href="users.php?page='.($page-1).'">Prev</a></li>';
					}
					for($i=1; $i<=$total_page; $i++){
						if($i==$page){
							$active="active";
						}else{
							$active="";
						}
						echo '<li class="'.$active.'"><a href="users.php?page='.$i.'">'.$i.'</a></li>';
					}
				if($total_page > $page){
				echo '<li><a href="users.php?page='.($page+1).'">Next</a></li>';
				}
				echo "</ul>";
				echo '</center>';
				}
					
				?>
             </div>
          </div>
      </div>
  </div>
