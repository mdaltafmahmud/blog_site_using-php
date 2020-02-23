<?php include  'inc/header.php'; ?>
<?php include  'inc/slider.php';?>

	<div class="contentsection contemplete clear">
	<div class="maincontent clear">
	
	<?php 
	// pagination
    $per_page =3;
   if (isset($_GET["page"])) {
	  $page =$_GET["page"];
   }else{
	$page =1;
   }
     $start_from = ($page-1) * $per_page;

	$sql         = "SELECT * FROM tbl_post";
	$result      = $db->select($sql);
	$total_rows  = 0;
	if($result){
		$total_rows  = mysqli_num_rows($result);
		$total_pages =ceil($total_rows/$per_page);
	}
	// pagination query end.......
	$query = "SELECT * FROM tbl_post limit $start_from, $per_page";
	$post  =$db->select($query);
	if ($post) {
		while ( $result_post =$post->fetch_assoc() ) {
				
	?>
	
		<div class="samepost clear">
			<h2><a href="post.php?id=<?php echo $result_post['id'];?>"><?php echo $result_post['title'];?></a></h2>
			<h4><?php echo $formate->formatDate($result_post['date']);?>  <a href="#"><?php echo $result_post['author'];?></a></h4>
				<a href="post.php"><img src="admin/<?php echo  $result_post['image']; ?>" alt="post image"/></a>
				<?php echo $formate->textshorten($result_post['body']);?>
			<div class="readmore clear">
				<a href="post.php?id=<?php echo $result_post['id'];?>">Read More</a>
			</div>
		</div>
     <!-- end here wile loop  condition and wile loop.... -->
	<?php }?>

	<!-- pagination -->
	<?php echo" <span class='pagination'> <a href ='index.php?page=1'>".'First Page'."</a>";
	for($i=1; $i<=$total_pages; $i++) { 
	echo "<a href ='index.php?page=".$i."'>".$i."</a>";
	};
  echo "<a href ='index.php?page=$total_pages'>".'Last Page'."</a>
 </span>"?>

	<!-- pagination -->
	
	 <?php }else{ header("Location:404.php");}?> <!-- end here if condition  .... -->
</div>

 <?php include 'inc/sidebar.php'; ?>
 </div>
<?php include 'inc/footer.php'; ?>