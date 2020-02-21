<?php include  'inc/header.php'; ?>
<?php include  'inc/slider.php';?>

<div class="contentsection contemplete clear">
	<div class="maincontent clear">

    <?php 
if (!isset($_GET['catagory']) || $_GET['catagory']== NULL ) {
	header("Location:404.php");
}else{
	$id = $_GET['catagory'];
}

?>

<?php
        $query = "SELECT * FROM tbl_post WHERE cat=$id";
		$post  = $db->select($query);
		if ($post) {
			while ( $result_post =$post->fetch_assoc() ) {
				
	?>
		<div class="samepost clear">
			<h2><a href="post.php?id=<?php echo $result_post['id'];?>"><?php echo $result_post['title'];?></a></h2>
			<h4><?php echo $formate->formatDate($result_post['date']);?>  <a href="#"><?php echo $result_post['author'];?></a></h4>
				<a href="#"><img src="upload/images/<?php echo  $result_post['image']; ?>" alt="post image"/></a>
				<?php echo $formate->textshorten($result_post['body']);?>
			<div class="readmore clear">
				<a href="post.php?id=<?php echo $result_post['id'];?>">Read More</a>
			</div>
		</div>
     <!-- end here wile loop  condition and wile loop.... -->
	<?php }}else{ ?>
			<h3>No Post Are Avilable in This catagory..</h3>
	<?php  }?>


	</div>
    <?php include 'inc/sidebar.php'; ?>
   
<?php include 'inc/footer.php'; ?>