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
           
           $to         = $formate->validation($_POST['toemail']);
           $from       = $formate->validation($_POST['fromemail']);
           $subject    = $formate->validation($_POST['subject']);
           $message    = $formate->validation($_POST['message']);
           $sendmsg    = mail($to,$subject,$message,$from);
           if ($sendmsg ) {
               echo "<span class='success'> Message Sent Sucessfully...</span>";
           }else{
            echo "<span class='error'> Something Went Wrong...</span>";
           }

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
                    <td><label>To</label></td>
                    <td>
                        <input type="text" readonly name="toemail" value="<?php echo $result['email'];?>" class="medium"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>From</label>
                    </td>
                    <td>
                        <input type="text" name="fromemail" placholder="Please Enter Your Email Address.." class="medium"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Subject</label>
                    </td>
                    <td>
                        <input type="text" name="subject" placholder="Please Enter Your Email Address.." class="medium"/>
                    </td>
                </tr>
                <tr> 
                    <td><label>Message</label> </td>
                    <td>
                    <textarea  class="tinymce" name="message"> 
                            <?php echo $result['body'];?>
                    </textarea>
                    </td>
                </tr> 

                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Send" />
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
        location.href="inbox.php";
        })

        
    </script>
   <?php include 'incAdmin/footer.php';?>
  
