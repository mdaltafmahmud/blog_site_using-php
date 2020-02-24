<?php include 'incAdmin/header.php';?>
<?php include 'incAdmin/sidebar.php';?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>User List</h2>

		<?php 
		if (isset($_GET['deluser'])) {
			$delid    = $_GET['deluser'];
			$delquery = "DELETE FROM user_tbl WHERE id = '$delid'";
			$deldata  =	$db->delete($delquery);
			
			if ($deldata) {
				echo "<span class='success'>UserData Deleted successfully !!.</span>";
			   }else{
				echo "<span class='error'> UserData Not Deleted !!.</span>";
			   }
		}
		
		?>
		<div class="block">        
			<table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Name</th>
					<th>User Name</th>
                    <th>Email</th>
                    <th>Details</th>
                    <th>Role</th>
                    <th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				
				$query    = "SELECT * FROM user_tbl ORDER BY id DESC ";
				$userDetails = $db->select($query);
				if ($userDetails) {
					$i=0;
					while($result = $userDetails->fetch_assoc() ){
						$i++;
				?>

				<tr class="odd gradeX">
					<td><?php echo $i?></td>
					<td><?php echo $result['name'];?></td>
                    <td><?php echo $result['username'];?></td>
                    <td><?php echo $result['email'];?></td>
                    <td><?php echo $formate->textshorten($result['details'],30);?></td>
                    <td>
                        <?php 
                            if ( $result['role']    == '0') {
                                echo "Admin";
                            }elseif($result['role'] == '1'){
                                echo "Author";
                            }elseif($result['role'] == '2'){
                                echo "Editor";
                            }
                        ?>
                    </td>



					<td><a href="viewuser.php?userid=<?php echo $result['id'];?>">View</a> || 
					<a onclick="return confirm('Are You Sure To Delete!');" href="?deluser=<?php echo $result['id'];?>">Delete</a> 
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
