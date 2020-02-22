<?php include 'incAdmin/header.php';?>
<?php include 'incAdmin/sidebar.php';?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Post List</h2>
		<div class="block">  
			<table class="data display datatable" id="example">
			<thead>
				<tr>
					<th  width="5%">NO</th>
					<th  width="15%">Post Title</th>
					<th  width="24%">Description</th>
					<th  width="8%">Catagory</th>
					<th  width="8%">image </th>
					<th  width="10%">Author</th>
					<th  width="10%">tags</th>
					<th  width="10%">Date</th>
					<th  width="10%">Action</th>
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
			<td><?php echo $i;?></td>
			<td><a href="editpost.php?editpostid=<?php echo $result['id'];?>"><?php echo $result['title'];?></a></td>
			<td><?php echo $formate->textshorten($result['body'],60);?></td>
			<td><?php echo $result['name'];?></td>
			<td><img  src="<?php echo $result['image'];?>"height="40px" width="60px"></td>
			<td><?php echo $result['author'];?></td>
			<td><?php echo $result['tags'];?></td>
			<td><?php echo $formate->formatDate($result['date']);?></td>
			
			<td>
			<a href="editpost.php?editpostid=<?php echo $result['id'];?>">Edit</a> 
			||
			<a onclick="return confirm('Are you sure to Delete this!!');" 
			href="deletepost.php?delpostid=<?php echo $result['id'];?>">Delete</a>
			</td>
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