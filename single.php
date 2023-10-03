<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                    <div class="post-container">
					<?php
					include_once("config.php");
						if(isset($_GET['id'])){
						$post_id=$_GET['id'];
						}
						$sql="SELECT post.post_id, post.title, post.description, post.post_date,
						post.post_img,post.author,post.category,
						category.category_name, user.username FROM `post`
						left join category on post.category=category.category_id
						left join user on post.author=user.user_id 
						where post_id={$post_id}"; 
						$result=mysqli_query($con,$sql) or die("Query failed");
						if(mysqli_num_rows($result)>0){
							while($row=mysqli_fetch_assoc($result)){
						
						?>
                        
                        <div class="post-content single-post">
                            <h3><?php echo $row['title'];?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <a href='category.php?cid=<?php echo $row['category']; ?>'><?php echo $row['category_name'];?></a>
                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php?aid=<?php echo $row['author']; ?>'><?php echo $row['username'];?></a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php echo $row['post_date'];?>
                                </span>
                            </div>
                            <img class="single-feature-image" src="admin/upload/<?php echo $row['post_img'];?>" alt=""  height="350px"/>
                            <p class="description justify-content-center" style="margin:20px 40px;">
							<?php echo $row['description'];?>
                            </p>
                        
                        </div>
						<?php
						}
						}else{
							echo "No records found";
						}
						?>
                    </div>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
