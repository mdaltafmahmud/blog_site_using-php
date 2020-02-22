
<?php include 'incAdmin/header.php';?>
<?php include 'incAdmin/sidebar.php';?>
<style> 
.delaction {margin-left:10px;}
.delaction a{
    border:1px solid #ddd;
    color:#444;
    cursor:pointer;
    font-weight:normal;
    padding: 4px 15px;
    background:#f0f0f0;
}

</style>

<?php 
    
    if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL ) {
        header("Location: index.php");
       
    }else{
        $pageid = $_GET['pageid'];
    }
?>
        
<div class="grid_10">
    <div class="box round first grid">
        <h2> Edit Page</h2>

        <?php 
        if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
           $name      = mysqli_real_escape_string($db->link, $_POST['name']);
           $body      = mysqli_real_escape_string($db->link, $_POST['body']);


           if ($name =="" || $body =="") {
            echo "<span class='error'> Field Must Not Be Empty !!.</span>";
           }else{
               
                $query = "UPDATE  tbl_page SET name='$name',
                 body='$body' where id = $pageid";
                $updated_rows = $db->update($query);
                if ($updated_rows) {
                    echo "<span class='success'>Post Updated Successfully.
                    </span>";
                }else {
                    echo "<span class='error'>Post Not Updated !</span>";
                }
        }
    }
        
        ?>
        <div class="block">        
        <?php 
            $pagequery     = "SELECT * FROM tbl_page WHERE id ='$pageid' ";
            $pagesdetails  = $db->select($pagequery);
            if($pagesdetails){
            while($result = $pagesdetails->fetch_assoc()){
        
        ?>
                         
        <form action="" method="post">
            <table class="form">
                
                <tr>
                    <td>
                        <label>NAME</label>
                    </td>
                    <td>
                        <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium"/>
                    </td>
                </tr>

                <tr> <!--  text editor/ body text upload start from below  -->
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body">
                            <?php echo $result['body']; ?>
                        </textarea>
                    </td>
                </tr> <!--  text editor/ body text upload end here  -->
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="updated" />
                        <span class="delaction"><a onclick="return confirm('Are you Sure to Delete The page!');" href="delpage.php?delpage=<?php echo $result['id']; ?>">Delete</a></span>
                    </td>
                </tr>
            </table>
            </form>
            <?php } } ?> 
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
  
