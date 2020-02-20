  <?php include 'inc/header.php'; ?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<div class="notfound">
    				<p><span>404</span> Not Found</p>
    			</div>
	        </div>
		</div>
		<div class="sidebar clear">

		<!-- catagory post from below  -->
			<div class="samesidebar clear">
				<h2>Catagory </h2>
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
				<h2>Popular articles</h2>
					<div class="popular clear">
						<h3><a href="#">Post title will be go here..</a></h3>
						<a href="#"><img src="images/post1.jpg" alt="post image"/></a>
						<p>Sidebar text will be go here.Sidebar text will be go here.Sidebar text will be go here.Sidebar text will be go here.</p>	
					</div>
					
					<div class="popular clear">
						<h3><a href="#">Post title will be go here..</a></h3>
						<a href="#"><img src="images/post1.jpg" alt="post image"/></a>
						<p>Sidebar text will be go here.Sidebar text will be go here.Sidebar text will be go here.Sidebar text will be go here.</p>	
					</div>
					
					<div class="popular clear">
						<h3><a href="#">Post title will be go here..</a></h3>
						<a href="#"><img src="images/post1.jpg" alt="post image"/></a>
						<p>Sidebar text will be go here.Sidebar text will be go here.Sidebar text will be go here.Sidebar text will be go here.</p>	
					</div>
					
					<div class="popular clear">
						<h3><a href="#">Post title will be go here..</a></h3>
						<a href="#"><img src="images/post1.jpg" alt="post image"/></a>
						<p>Sidebar text will be go here.Sidebar text will be go here.Sidebar text will be go here.Sidebar text will be go here.</p>	
					</div>				
				
			</div>
			
		</div>
	</div>

	<?php include 'inc/footer.php'; ?>