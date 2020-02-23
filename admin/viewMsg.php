<?php include 'incAdmin/header.php';?>
<?php include 'incAdmin/sidebar.php';?>

<?php 
    if (!isset($_GET['msgid']) || $_GET['msgid'] == NULL ) {
         header("Location: inbox.php");
    }else{
        $msgid= $_GET['msgid'];
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>View Message</h2>

        <?php 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

       }
        
 ?>
       <div class="block">               
            <?php 
					$query    = "SELECT * FROM  tbl_contact WHERE id='$msgid' ";
					$msg = $db->select($query);
					if ($msg) {
					     $i=0;
					while($result = $msg->fetch_assoc() ){
					$i++;
				?>
            <table class="form">
        <form method="POST" id="msgsubmit" action="">
                <tr>
                    <td>
                        <label>NAME</label>
                    </td>
                    <td>
                       <input type="text"  value="<?php echo $result['firstname'].' '. $result['lastname']?>" class="medium"/>
                    </td>
                </tr>
                <tr>
                    <td><label>Email</label></td>
                    <td>
                        <input type="text"  value="<?php echo $result['email'];?>" class="medium"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Date</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $formate->formatDate($result['date']);?>" class="medium"/>
                    </td>
                </tr>
                <tr> 
                    <td><label>Message</label> </td>
                    <td>
                    <textarea  class="tinymce"> 
                            <?php echo $result['body'];?>
                    </textarea>
                    </td>
                </tr> 

                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Ok" />
                    </td>
                </tr>
            </table>
                    <?php } }?>
            </form>
        </div>
    </div>
</div>
    <!-- Load TinyMCE Editor -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
             

            
        });

         //submit ok 
        let msgsubmit = document.getElementById('msgsubmit');
        msgsubmit.addEventListener('submit',function(event){
            event.preventDefault();
            console.log('this is hit');
            location.href="inbox.php";
        })

        
    </script>
   <?php include 'incAdmin/footer.php';?>
  
