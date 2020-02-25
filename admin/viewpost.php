<?php include 'incAdmin/header.php';?>
<?php include 'incAdmin/sidebar.php';?>
<?php 
	if (!isset($_GET['viewpostid']) || $_GET['viewpostid'] == NULL) {
		echo "<script>location='postlist.php';</script>";
	}else{
		$viewpostid =$_GET['viewpostid'];
	}

?>
        
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Post</h2>

        <?php 
        if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
         } 
        ?>
        <div class="block">   
        <?php 
            $query ="SELECT * FROM tbl_post where id ='$viewpostid' ORDER BY id DESC ";
            $post= $db->select($query);
            if ($post) {
               while ( $resultpost = $post->fetch_assoc() ) {
              ?>            
            <form action="" method="post" enctype="multipart/form-data" id="msgsubmit">
            <table class="form">
                
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" name="title" readonly value="<?php echo  $resultpost['title'];?>" class="medium"/>
                    </td>
                </tr>
                
                <!--  options start from below  -->
                <tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                <select   id="select" name="catgory">
                 <option> Select Category  </option> 
                  <?php 
                $query     ="SELECT * FROM catagory ";
                $catagory  = $db->select($query);
                if($catagory){
                while($result = $catagory->fetch_assoc()){
                     ?>
                      <option 
                      <?php 
                      if ($resultpost['cat']== $result['id']) { ?>
                          selected ="selected"
                     <?php  } ?>
                      
                      value="<?php echo $result['id'];?>"><?php echo $result['name'];?> 
                      </option>  

                 <?php   } }?>
          </select>
                     </td>
                </tr> <!--  options end  here  -->
                   
                <tr> 
                    <td>
                        <label> Image</label>
                    </td>
                    <td>
                        <img src="<?php echo  $resultpost['image'];?>"height="80px" width="200px"alt="post image">
                    
                    </td>
                </tr>

                <tr> <!--  text editor/ body text upload start from below  -->
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea class="tinymce"  readonly > <?php echo  $resultpost['body'];?></textarea>
                    </td>
                </tr> <!--  text editor/ body text upload end here  -->

                <tr> <!--  tags options start from below  -->
                    <td>
                        <label>tags</label>
                    </td>
                    <td>
                        <input value="<?php echo  $resultpost['tags']; ?>"  readonly></input>
                    </td>
                </tr> <!--  tags options  upload end here  -->  

                <tr> <!--  tags options start from below  -->
                    <td>
                        <label>Author</label>
                    </td>
                    <td>
                    <input value="<?php echo  $resultpost['author'];?>"  readonly></input>
                    </td>
  
                </tr> <!--  tags options   end here  -->  
                

                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="ok" />
                    </td>
                </tr>
            </table>
            </form>
            <?php   } }?>
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


        let msgsubmit = document.getElementById('msgsubmit');
        msgsubmit.addEventListener('submit',function(event){
        event.preventDefault();
        location.href="postlist.php";
        })
    </script>
   <?php include 'incAdmin/footer.php';?>
  
