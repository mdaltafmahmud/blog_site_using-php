<?php
		include '../lib/Session.php';
		Session::checksession();
	?>

<?php include  '../config/config.php';?>
<?php include  '../lib/Database.php';?>
<?php include  '../helpers/Format.php';?>
<?php 
	$db      = new Database();

?>

<?php 
	if (!isset($_GET['delpostid']) || $_GET['delpostid'] == NULL) {
		 header("Location: postlist.php");
	}else{
        $postid   = $_GET['delpostid'];
        $query    = "SELECT * FROM tbl_post WHERE id = '$postid'";
        $getData  =  $db->select($query);
        if($getData){
            while ($delimg = $getData->fetch_assoc() ) {
                $dellink = $delimg['image'];
                unlink($dellink );
            }
        }
        $delquery = "DELETE FROM tbl_post WHERE id = '$postid' ";
        $delData  = $db->delete($delquery);
        if ($delData) {
            echo "<script> alert('Data Deleted successfully'); </script>";
            header("Location:postlist.php");
        }else{
            echo "<script> alert('Data Not Deleted '); </script>";
            header("Location:postlist.php");
        }
	}

?>