
		<div class="sidebar clear">
			<div class="samesidebar clear">
				<h2>Categories</h2>
					<ul>

			<?php 
			    $query     = "SELECT * FROM catagory ";
			    $catagory  = $db->select($query);
			    if($catagory) {
				while ( $result_catagory =  $catagory->fetch_assoc()) {		
			?>		 
				<li><a href="posts.php?catagory=<?php echo $result_catagory['id'];?>">
				<?php echo $result_catagory['name'];?></a></li>
				<?php }} ?>					
					</ul>
			</div>
			
			<div class="samesidebar clear">
				<h2>Latest articles</h2>

				<?php
			$query = "SELECT * FROM tbl_post limit 4";
			$post  = $db->select($query);
			if ($post) {
				while ( $result_post =$post->fetch_assoc() ) {
					
	      ?>

		<div class="popular clear">
		<h3><a href="post.php?id=<?php echo $result_post['id'];?>"><?php echo $result_post['title'];?></a></h3>
		<a href="#"><img src="admin/upload/images/<?php echo $result_post['image']; ?>" alt="post image"/></a>
		<?php echo $formate->textshorten($result_post['body'],120);?>
		</div>

					  <!-- end here wile loop  condition and wile loop.... -->
        	<?php }}else{ header("Location:404.php");}?>
			   </div>
		  </div>