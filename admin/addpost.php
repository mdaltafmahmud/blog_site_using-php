<?php include 'incAdmin/header.php';?>
<?php include 'incAdmin/sidebar.php';?>

        
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Post</h2>

        <?php 
        if ($_SERVER ['REQUEST_METHOD']== 'POST') {
           $title      = mysqli_real_escape_string($db->link, $_POST['title']);
           $catgory    = mysqli_real_escape_string($db->link, $_POST['catgory']);
           $body       = mysqli_real_escape_string($db->link, $_POST['body' ]);
           $tags       = mysqli_real_escape_string($db->link, $_POST['tags' ]);
           $author     = mysqli_real_escape_string($db->link, $_POST['author']);

           $permited  = array('jpg', 'jpeg', 'png', 'gif');
           $file_name = $_FILES['image']['name'];
           $file_size = $_FILES['image']['size'];
           $file_temp = $_FILES['image']['tmp_name'];
       
           $div = explode('.', $file_name);
           $file_ext = strtolower(end($div));
           $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
           $uploaded_image = "upload/images/".$unique_image;

           if ($title =="" || $body =="" || $tags =="" || $author =="" || $file_name =="") {
            echo "<span class='error'> Field Must Not Be Empty !!.</span>";
           }elseif ($file_size >1048567) {
            echo "<span class='error'>Image Size should be less then 1MB!</span>"; 

           } elseif (in_array($file_ext, $permited) === false) {
            echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
           } else{
                move_uploaded_file($file_temp,$uploaded_image);
                $query = "INSERT INTO tbl_post (cat,title,body,image,author,tags)
                VALUES($catgory,'$title','$body','$uploaded_image','$author','$tags')";
                $inserted_rows = $db->insert($query);
                if ($inserted_rows) {
                    echo "<span class='success'>Post Inserted Successfully.
                    </span>";
                }else {
                    echo "<span class='error'>Post Not Inserted !</span>";
                }
        }
    }
        
        ?>
        <div class="block">               
            <form action="addpost.php" method="post" enctype="multipart/form-data">
            <table class="form">
                
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" name="title" placeholder="Enter Post Title.." class="medium"/>
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
                      <option value="<?php echo $result['id'];?>"><?php echo $result['name'];?></option>  
                 <?php   } }?>
          </select>
                     </td>
                </tr> <!--  options end  here  -->
                   
                <tr> <!--  image upload start from below  -->
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input type="file" name="image" />
                    </td>
                </tr> <!--  image upload end here  -->

                <tr> <!--  text editor/ body text upload start from below  -->
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body"></textarea>
                    </td>
                </tr> <!--  text editor/ body text upload end here  -->

                <tr> <!--  tags options start from below  -->
                    <td>
                        <label>tags</label>
                    </td>
                    <td>
                        <input type="text" name="tags" placeholder="Enter your tags"></input>
                    </td>
                </tr> <!--  tags options  upload end here  -->  

                <tr> <!--  tags options start from below  -->
                    <td>
                        <label>Author</label>
                    </td>
                    <td>
                    <input readonly type="text" name="author"value ="<?php echo Session::get('username')?>"></input>
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
  
