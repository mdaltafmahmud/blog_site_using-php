<?php
		include '../lib/Session.php';
		Session::checksession();
	?>

<?php include  '../config/config.php';?>
<?php include  '../lib/Database.php';?>

<?php 
	$db      = new Database();

?>

<?php 
	if (!isset($_GET['delpage']) || $_GET['delpage'] == NULL) {
		 header("Location: index.php");
	}else{
        $delid   = $_GET['delpage'];
        $query    = "SELECT * FROM tbl_page WHERE id = '$delid '";
        $getData  =  $db->select($query);
        if($getData){
            while ($delimg = $getData->fetch_assoc() ) {
                $dellink = $delimg['image'];
                unlink($dellink );
            }
        }
    }
    $delquery = "DELETE FROM tbl_page WHERE id = '$delid' ";
    $delData  = $db->delete($delquery);
    if ($delData) {
        echo "<script> alert('page Deleted successfully'); </script>";
        header("Location:index.php");
    }else{
        echo "<script> alert('Page Not Deleted '); </script>";
        header("Location:index.php");
    }

?>