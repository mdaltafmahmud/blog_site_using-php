<?php include 'inc/header.php'; ?>
<?php 
if (!isset($_GET['id']) || $_GET['id']==NULL ) {
	header("Location:404.php");
}else{
	$id = $_GET['id'];
}

?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">

			<?php 
			$query= "SELECT * FROM tbl_post where id=$id";
			$post  = $db->select($query);
			if($post) {
				while ($result_post = $post->fetch_assoc()) {
					
			?>
			
		<h2><a><?php echo $result_post['title'];?></a></h2>
		<h4><?php echo $formate->formatDate($result_post['date']);?><a href="#"><?php echo $result_post['author'];?></a></h4>
		<a href="#"><img src="admin/<?php echo  $result_post['image']; ?>"/></a>
		<?php echo $formate->textshorten($result_post['body']);?>

			<?php
			   $catid        = $result_post['cat'];
			   $reletedpost  = "SELECT * FROM tbl_post WHERE cat= '$catid' limit 3 ";
			   $post         = $db->select($reletedpost);
			   if($post) {
			   while ($relted_post = $post->fetch_assoc()) {?>
						<div class="relatedpost clear">
							<h2><?php echo $relted_post['title']; ?></h2>
							<a href="post.php?id=<?php echo $relted_post['id'];?>">
							<img src="admin/<?php echo  $relted_post['image']; ?>"/></a>
						</div>
					<?php } }else{echo "No Related Post are Available";}?>
			    <?php  }} else{ header("Location:404.php");}?>
		</div>

</div>
	<?php include 'inc/sidebar.php'; ?>
	</div>
		</div>
	<?php include 'inc/footer.php'; ?>