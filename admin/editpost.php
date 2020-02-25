<?php include 'incAdmin/header.php';?>
<?php include 'incAdmin/sidebar.php';?>
<?php 
	if (!isset($_GET['editpostid']) || $_GET['editpostid'] == NULL) {
		header("Location:postlist.php");
	}else{
		$editpostid =$_GET['editpostid'];
	}

?>
        
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Post</h2>

        <?php 
        if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
           $title      = mysqli_real_escape_string($db->link, $_POST['title']);
           $catgory    = mysqli_real_escape_string($db->link, $_POST['catgory']);
           $body       = mysqli_real_escape_string($db->link, $_POST['body' ]);
           $tags       = mysqli_real_escape_string($db->link, $_POST['tags' ]);
           $author     = mysqli_real_escape_string($db->link, $_POST['author']);
           $userid     = mysqli_real_escape_string($db->link, $_POST['userid']);

           $permited  = array('jpg', 'jpeg', 'png', 'gif');
           $file_name = $_FILES['image']['name'];
           $file_size = $_FILES['image']['size'];
           $file_temp = $_FILES['image']['tmp_name'];
       
           $div = explode('.', $file_name);
           $file_ext = strtolower(end($div));
           $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
           $uploaded_image = "upload/images/".$unique_image;

           if ($title =="" || $catgory =="" || $body =="" || $tags =="" || $author =="" ) {
            echo "<span class='error'> Field Must Not Be Empty !!.</span>";

           }else{ 
           if (!empty($file_name)) {
           
           if ($file_size >1048567) {
            echo "<span class='error'>Image Size should be less then 1MB!</span>"; 

           } elseif (in_array($file_ext, $permited) === false) {
            echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
           } else{
                move_uploaded_file($file_temp,$uploaded_image);
                $query =" UPDATE tbl_post
                SET 
                cat    ='$catgory',
                title  ='$title',
                body   ='$body',
                image  ='$uploaded_image',
                author ='$author',
                tags   ='$tags',
                userid ='userid'
                WHERE id ='$editpostid'";
                $updated_rows = $db->update($query);

                if ($updated_rows) {
                    echo "<span class='success'>Post Updated Successfully.
                    </span>";
                }else {
                    echo "<span class='error'>Post Not Updated !</span>";
                }
        }
    }else{
        $query =" UPDATE tbl_post
        SET 
        cat      ='$catgory',
        title    ='$title',
        body     ='$body',
        author   ='$author',
        tags     ='$tags',
        userid   ='userid'
        WHERE id ='$editpostid'";
        $updated_rows = $db->update($query);

        if ($updated_rows) {
            echo "<span class='success'>Post Updated Successfully.
            </span>";
        }else {
            echo "<span class='error'>Post Not Updated !</span>";
        }

    }
}


    }
        
        ?>
        <div class="block">   
        <?php 
            $query ="SELECT * FROM tbl_post where id ='$editpostid' ORDER BY id DESC ";
            $post= $db->select($query);
            if ($post) {
               while ( $resultpost = $post->fetch_assoc() ) {
        
        ?>            
            <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
                
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" name="title" placeholder="Enter Post Title.." value="<?php echo  $resultpost['title'];?>" class="medium"/>
                    </td>
                </tr>
                
                <!--  options start from below  -->
                <tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
             <select id="select" name="catgory">
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
                   
                <tr> <!--  image upload start from below  -->
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img src="<?php echo  $resultpost['image'];?>"height="80px" width="200px"alt="post image">
                        <input type="file" name="image" />
                    </td>
                </tr> <!--  image upload end here  -->

                <tr> <!--  text editor/ body text upload start from below  -->
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body"> <?php echo  $resultpost['body'];?></textarea>
                    </td>
                </tr> <!--  text editor/ body text upload end here  -->

                <tr> <!--  tags options start from below  -->
                    <td>
                        <label>tags</label>
                    </td>
                    <td>
                        <input value="<?php echo  $resultpost['tags'];?>" name="tags" placeholder="Enter your tags"></input>
                    </td>
                </tr> <!--  tags options  upload end here  -->  

                <tr> <!--  tags options start from below  -->
                    <td>
                        <label>Author</label>
                    </td>
                    <td>
                    <input value="<?php echo  $resultpost['author'];?>" name="author" placeholder="Enter Author Name"></input>
                    </td>
                    <td>
                    <input readonly type="hidden" name="userid"value ="<?php echo Session::get('userId')?>"></input>
                    </td>
                </tr> <!--  tags options   end here  -->  
                

                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
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
    </script>
   <?php include 'incAdmin/footer.php';?>
  
