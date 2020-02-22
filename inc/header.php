
<?php include  'config/config.php';?>
<?php include  'lib/Database.php';?>
<?php include  'helpers/Format.php';?>
<?php 
	$db      = new Database();
	$formate = new Format();
?>


<!DOCTYPE html>
<html>
<head>

	<?php 
	if(isset($_GET['pageid'])){
		$PageTitle =$_GET['pageid'];
		$query     ="SELECT * FROM tbl_page WHERE id='$PageTitle' ";
		$pages  = $db->select($query);
		if($pages){
		while($result = $pages->fetch_assoc()){ ?>
		<title><?php echo $result['name'];?>-<?php echo TITLE;?></title> <?php } } }else{ ?>
			<title><?php echo $formate->title(); ?> -<?php echo TITLE;?></title>
		<?php }?>
	
	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
	<meta name="keywords" content="blog,cms blog">
	<meta name="author" content="Altaf Mahmud">
	<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
	<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="style.css">
	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/jquery.nivo.slider.js" type="text/javascript"></script>

<script type="text/javascript">
$(window).load(function() {
	$('#slider').nivoSlider({
		effect:'random',
		slices:10,
		animSpeed:500,
		pauseTime:5000,
		startSlide:0, //Set starting Slide (0 index)
		directionNav:false,
		directionNavHide:false, //Only show on hover
		controlNav:false, //1,2,3...
		controlNavThumbs:false, //Use thumbnails for Control Nav
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0.8, //Universal caption opacity
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){} //Triggers after all slides have been shown
	});
});
</script>


<style> 
.pagination{
	display:block;
	font-size: 20px;
	margin-top: 10px;
	text-align: center;
	padding:10px;
}

.pagination a{
	background: #e6a54b none repeat scroll 0 0;
	text-decoration:none;
	border:1px solid #a7700c;
	color:#333;
	margin-left:2px;
	padding:2px 10px;

}

.pagination a:hover{
	background:#be2723;
	color:white;
}

</style>
</head>

<body>
	<div class="headersection templete clear">
		<a href="index.php">
			<div class="logo">

			<?php
            $query      = "SELECT * FROM  title_sllogan WHERE id= 1";
            $blog_title = $db->select( $query);
            if ($blog_title) {
                while ($result_blog = $blog_title->fetch_assoc()) {
            ?>
				<img src="admin/<?php echo $result_blog['logo'] ; ?>"  alt="Logo"/>
				<h2><?php echo $result_blog['title'];?></h2>
				<p><?php echo $result_blog['slogan'];?></p>
			</div>
				<?php } }  ?>
		</a>
		<div class="social clear">
	<div class="icon clear">

	<?php
	$query      = "SELECT * FROM   tbl_social WHERE id= 1";
	$social     = $db->select( $query);
	if ($social) {
		while ($result_social = $social->fetch_assoc()) {
	?>   
		<a href="<?php echo $result_social['fb'];?>" target="_blank"><i class="fa fa-facebook"></i></a>
		<a href="<?php echo $result_social['twit'];?>" target="_blank"><i class="fa fa-twitter"></i></a>
		<a href="<?php echo $result_social['link'];?>" target="_blank"><i class="fa fa-linkedin"></i></a>
		<a href="<?php echo $result_social['google'];?>" target="_blank"><i class="fa fa-google-plus"></i></a>
	</div>
				<?php } }?>

			<div class="searchbtn clear">
				<form action="search.php" method="get">
					<input type="text" name="search" placeholder="Search keyword..."/>
					<input type="submit" name="submit" value="Search"/>
				</form>
			</div>
		</div>
	</div>
	<div class="navsection templete">
		<ul>
			<li><a id="active" href="index.php">Home</a></li>
			<?php 
                    $query     ="SELECT * FROM tbl_page ";
                    $pages  = $db->select($query);
                    if($pages){
                    while($result = $pages->fetch_assoc()){
                ?>
                 <li><a href="page.php?pageid=<?php echo $result['id'];?>"><?php echo $result['name'];?></a> </li>
                    <?php } }?>
			<li><a href="contact.php">Contact</a></li>
		</ul>
	</div>


<?php 
  function pagination($total_pages){
	    $output  = "";
		$output .= "<span class='pagination' > <a href ='index.php?page=1'>".'First Page'."</a>";
		for($i=1; $i<=$total_pages; $i++) { 
			$output .= "<a href='index.php?page=".$i."'>".$i."</a>";
		};
		$output .="<a href='index.php?page=$total_pages'>".'Last Page'."</a></span>";

		return $output;
  }

?>