<?php include 'incAdmin/header.php';?>
<?php include 'incAdmin/sidebar.php';?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Post List</h2>
		<div class="block">  
			<table class="data display datatable" id="example">
			<thead>
				<tr>
					<th  width="2%" >NO</th>
					<th  width="15%">Post Title</th>
					<th  width="20%">Description</th>
					<th  width="8%">Catagory</th>
					<th  width="5%">image </th>
					<th  width="10%">Author</th>
					<th  width="10%">tags</th>
					<th  width="10%">Date</th>
					<th  width="15%">Action</th>
				</tr>
			</thead>
			<tbody>
		<?php 
		$query ="SELECT tbl_post.*,catagory.name FROM tbl_post 
		left JOIN catagory
		ON tbl_post.cat = catagory.id
		ORDER BY tbl_post.title DESC";
		$post = $db->select($query);
		if ($post) {
			$i=0;
			while ($result = $post->fetch_assoc()) {
				$i++;
		?>
		<tr class="odd gradeX">
			<td style="border-right:2px solid #ddd;"><?php echo $i;?></td>
			<td style="border-right:2px solid #ddd;"><?php echo $result['title'];?></td>
			<td style="border-right:2px solid #ddd;"><?php echo $formate->textshorten($result['body'],60);?></td>
			<td style="border-right:2px solid #ddd;"><?php echo $result['name'];?></td>
			<td style="border-right:2px solid #ddd;"><img  src="<?php echo $result['image'];?>"height="40px" width="60px"></td>
			<td style="border-right:2px solid #ddd;"><?php echo $result['author'];?></td>
			<td style="border-right:2px solid #ddd;"><?php echo $result['tags'];?></td>
			<td style="border-right:2px solid #ddd;"><?php echo $formate->formatDate($result['date']);?></td>
			
		<td>
		<a href="viewpost.php?viewpostid=<?php echo $result['id'];?>">View</a> 
		
		<?php if (Session::get('userId')== $result['userid'] || Session::get('userRole')=='0'){?>	
		||
		<a href="editpost.php?editpostid=<?php echo $result['id'];?>">Edit</a> 
		||
		<a onclick="return confirm('Are you sure to Delete this!!');" 
		href="deletepost.php?delpostid=<?php echo $result['id'];?>">Delete</a>
		</td>

		<?php }?>
	
		</tr>
				<?php } }?>
			</tbody>
		</table>

		</div>
	</div>
</div>


	<script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            $('.datatable').dataTable();
			setSidebarHeight();
        });
    </script>

<?php include 'incAdmin/footer.php';?>