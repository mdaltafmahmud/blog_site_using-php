
<?php include 'incAdmin/header.php';?>
<?php include 'incAdmin/sidebar.php';?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
				<?php 
			if (isset($_GET['seenid'])) {
			$seenid =$_GET['seenid'];
			$query     = "UPDATE tbl_contact SET status ='1' WHERE id= '$seenid'; ";
            $seenUpdate = $db->update($query);
           if ($seenUpdate) {
            echo "<span class='success'> Message Sent in the seen box !!.</span>";
           }else{
            echo "<span class='error'>  Something Went Wrong!!.</span>";
           }
					}
			   ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					
					$query    = "SELECT * FROM  tbl_contact WHERE status='0' ORDER BY id DESC ";
					$msg = $db->select($query);
					if ($msg) {
					     $i=0;
					while($result = $msg->fetch_assoc() ){
					$i++;
				?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['firstname'].' '.$result['lastname'];?></td>
							<td><?php echo $result['email'];?></td>
							<td><?php echo $formate->textshorten($result['body'],30);?></td>
							<td><?php echo $formate->formatDate($result['date']);?></td>
							<td>
							<a href="viewMsg.php?msgid=<?php echo $result['id'];?>"> View</a> ||
							<a href="replayMsg.php?msgid=<?php echo $result['id'];?>"> replay</a>||
							<a onclick= "return confirm('Are You Sure to Move this!')" href="?seenid=<?php echo $result['id'];?>"> Seen</a> 
							</td>
						</tr>

					<?php } }?>
					</tbody>
				</table>
               </div>
            </div>

			<div class="box round first grid">
                <h2>Seen Message </h2>
     <?php
	 if (isset($_GET['delid'])) {
		$delid =$_GET['delid'];
		$delquery = "DELETE FROM tbl_contact WHERE id = '$delid' ";
        $delData  = $db->delete($delquery);
        if ($delData) {
            echo "<script> alert('Message Deleted successfully'); </script>";
           
        }else{
            echo "<script> alert('Message Not Deleted '); </script>";
          
		}
	}
		?>
                <div class="block">        
				<table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					
					$query    = "SELECT * FROM  tbl_contact WHERE status='1' ORDER BY id DESC ";
					$msg = $db->select($query);
					if ($msg) {
					     $i=0;
					while($result = $msg->fetch_assoc() ){
					$i++;
				?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['firstname'].' '.$result['lastname'];?></td>
							<td><?php echo $result['email'];?></td>
							<td><?php echo $formate->textshorten($result['body'],30);?></td>
							<td><?php echo $formate->formatDate($result['date']);?></td>
							<td>
							<a href="viewMsg.php?msgid=<?php echo $result['id'];?>"> View</a> ||
							<a onclick="return confirm('Are You Sure To Delete !')" href="?delid=<?php echo $result['id'];?>"> Delete</a>
							
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
