<?php include 'incAdmin/header.php';?>
<?php include 'incAdmin/sidebar.php';?>

<style> 
.leftside{float:left;width:70%}
.rightside{float:left;width:20%}
.rightside img{height:160px; width:170px;}
</style>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Site Title and Description</h2>

            <!-- Update  title slogan logo from below -->
<?php 
        if ($_SERVER ['REQUEST_METHOD'] == 'POST') {

           $title      = $formate->validation($_POST['title']);
           $slogan     = $formate->validation($_POST['slogan']);
           $title      = mysqli_real_escape_string($db->link, $title );
           $slogan     = mysqli_real_escape_string($db->link, $slogan);

           $permited  = array('png');
           $file_name = $_FILES['logo']['name'];
           $file_size = $_FILES['logo']['size'];
           $file_temp = $_FILES['logo']['tmp_name'];
       
           $div = explode('.', $file_name);
           $file_ext = strtolower(end($div));
           $same_image ='logo'.'.'.$file_ext;
           $uploaded_image = "upload/images/".$same_image;

           if ($title =="" || $slogan =="" ) {
            echo "<span class='error'> Field Must Not Be Empty !!.</span>";

           }else{ 
           if (!empty($file_name)) {
           
           if ($file_size >1048567) {
            echo "<span class='error'>Image Size should be less then 1MB!</span>"; 

           } elseif (in_array($file_ext, $permited) === false) {
            echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
           } else{
                move_uploaded_file($file_temp,$uploaded_image);
                $query =" UPDATE title_sllogan
                SET 
                slogan ='$slogan',
                title  ='$title',
                image  ='$uploaded_image'
                WHERE id = '1' ";
                $updated_rows = $db->update($query);

                if ($updated_rows) {
                    echo "<span class='success'>Post Updated Successfully.
                    </span>";
                }else {
                    echo "<span class='error'>Post Not Updated !</span>";
                }
        }
    }else{
        $query =" UPDATE title_sllogan
                SET 
                slogan ='$slogan',
                title  ='$title'
                WHERE id = '1' ";
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
<!--  end here Update  title slogan logo from below -->
            <?php
            $query      = "SELECT * FROM  title_sllogan WHERE id= 1";
            $blog_title = $db->select( $query);
            if ($blog_title) {
                while ($result_blog = $blog_title->fetch_assoc()) {
            ?>
                <div class="block sloginblock">  
                <div class="leftside">             
                 <form action="" method ="post" enctype="multipart/form-data">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Website Title</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result_blog['title'];?>"  name="title" class="medium" />
                            </td>
                        </tr>

						 <tr>
                            <td>
                                <label>Website Slogan</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result_blog['slogan'];?>" name="slogan" class="medium" />
                            </td>
                        </tr>
						 
                    <tr>
                            <td>
                                <label for="">Upload Logo</label>
                            </td>
                            <td>
                                <input type="file" name="logo">
                            </td>
                     </tr>
						
						 <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    </div>
                    <div class="rightside"> <img src="<?php echo $result_blog['logo'];?>" alt="logo"></div>
                </div>

<?php  } } ?>
                
            </div>
        </div>

<?php include 'incAdmin/footer.php';?>
