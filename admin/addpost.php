<?php include 'incAdmin/header.php';?>
<?php include 'incAdmin/sidebar.php';?>

        
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Post</h2>
        <div class="block">               
            <form action="" method="" enctype="multipart/form-data">
            <table class="form">
                
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter Post Title..." class="medium" />
                    </td>
                </tr>
                
                <!--  options start from below  -->
                <tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
       <select id="select" name="select">
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
  
