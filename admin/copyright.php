
<?php include 'incAdmin/header.php';?>
<?php include 'incAdmin/sidebar.php';?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Copyright Text</h2>

        <?php 
        if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
           $note    = $formate->validation($_POST['note']);
           $note    = mysqli_real_escape_string($db->link,$note);

           if ($note =="") {
            echo "<span class='error'> Field Must Not Be Empty !!.</span>";
           }else{
            $query =" UPDATE tbl_footer
            SET 
            note ='$note'
            WHERE id = '1'";
            $updated_rows = $db->update($query);
            if ($updated_rows) {
                echo "<span class='success'>CopyRight Updated Successfully.
                </span>";
            }else {
                echo "<span class='error'>CopyRight Not Updated !</span>";
            }

           }
        }
?>
        <div class="block copyblock"> 
        <?php
        $query      = "SELECT * FROM tbl_footer WHERE id='1'";
        $copyright = $db->select( $query);
        if ($copyright) {
            while ($result_copyright = $copyright->fetch_assoc()) {
        ?> 
            <form action="" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" value="<?php echo $result_copyright['note'];?>" name="note" class="large" />
                    </td>
                </tr>
                
                    <tr> 
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
            <?php } }?>


        </div>
    </div>
</div>
  <?php include 'incAdmin/footer.php';?>