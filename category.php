<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
					<?php
					$cat_id=$_GET['cid'];
					$sql1="select * from category where category_id={$cat_id}";
					$result1=mysqli_query($con,$sql1) or die("Query failed");
					$row1=mysqli_fetch_assoc($result1);
					?>
                  <h2 class="page-heading"><?php echo $row1['category_name']; ?></h2>
                  <?php
						include_once("config.php");
						if(isset($_GET['cid'])){
						$cat_id=$_GET['cid'];
						}
					
						if(isset($_GET['page'])){
							$page=$_GET['page'];
						}else{
							$page=1;
						}
						$limit=4;
						$offset=($page-1)* $limit;
						$sql="SELECT post.post_id, post.title, post.description, post.post_date,post.post_img,
						category.category_name,post.category,post.author,user.username FROM `post`
						left join category on post.category=category.category_id
						left join user on post.author=user.user_id
						where post.category={$cat_id}
						order by  post.post_id DESC limit {$offset},{$limit} "; 
						$result=mysqli_query($con,$sql) or die("Query failed");
						if(mysqli_num_rows($result)>0){
							while($row=mysqli_fetch_assoc($result)){
						
						?>
					
						<div class="post-content">
						
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?id=<?php echo $row['post_id']; ?>"><img src="admin/upload/<?php echo $row['post_img'];?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?id=<?php echo $row['post_id']; ?>'><?php echo $row['title'];?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php?cid=<?php echo $row['category'];?>'><?php echo $row['category_name'];?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href='author.php?aid=<?php echo $row['author'];?>'><?php echo $row['username'];?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
												<?php echo $row['post_date'];?>
                                            </span>
                                        </div>
                                        <p class="description">
										<?php echo substr($row['description'],0,300). "...";?>
                                         </p>
                                        <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id']; ?>'>read more</a>
                                    </div>
                                </div>
                            </div>
							
                        </div>
                   
					<?php
							}
						}else{
							echo "No records found";
						}
						
					if(mysqli_num_rows($result1) >0 ){
						
					$total_record=$row1['post'];
					$total_page=ceil($total_record / $limit);
					echo '<center>';
					echo "<ul class='pagination admin-pagination' style='text-align:center;'>";
					if($page > 1){
					echo '<li><a href="index.php?cid='.$cat_id.'&page='.($page-1).'">Prev</a></li>';
					}
					for($i=1; $i<=$total_page; $i++){
						if($i==$page){
							$active="active";
						}else{
							$active="";
						}
						echo '<li class="'.$active.'"><a href="index.php?cid='.$cat_id.'&page='.$i.'">'.$i.'</a></li>';
					}
				if($total_page > $page){
				echo '<li><a href="index.php?cid='.$cat_id.'&page='.($page+1).'">Next</a></li>';
				}
				echo "</ul>";
				echo '</center>';
				}
					?>
					
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
