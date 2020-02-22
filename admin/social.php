
<?php include 'incAdmin/header.php';?>
<?php include 'incAdmin/sidebar.php';?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Social Media</h2>
                <?php 
        if ($_SERVER ['REQUEST_METHOD'] == 'POST') {

           $fb    = $formate->validation($_POST['fb']);
           $twit  = $formate->validation($_POST['twit']);
           $link  = $formate->validation($_POST['link']);
           $google= $formate->validation($_POST['google']);

           $fb     = mysqli_real_escape_string($db->link,  $fb  );
           $twit   = mysqli_real_escape_string($db->link, $twit );
           $link   = mysqli_real_escape_string($db->link, $link );
           $google = mysqli_real_escape_string($db->link, $google);

           if ($fb =="" || $twit =="" || $link =="" || $google =="" ) {
            echo "<span class='error'> Field Must Not Be Empty !!.</span>";
           }else{
            $query =" UPDATE tbl_social
            SET 
            fb ='$fb',
            twit  ='$twit',
            link  ='$link',
            google  ='$google'
            WHERE id = '1' ";
            $updated_rows = $db->update($query);
            if ($updated_rows) {
                echo "<span class='success'>data Updated Successfully.
                </span>";
            }else {
                echo "<span class='error'>data Not Updated !</span>";
            }

           }
        }
?>
    <div class="block">    
    <?php
$query      = "SELECT * FROM   tbl_social WHERE id= 1";
$social = $db->select( $query);
if ($social) {
    while ($result_social = $social->fetch_assoc()) {
?>         
        <form action="social.php" method="post">
        <table class="form">					
            <tr>
                <td>
                    <label>Facebook</label>
                </td>
                <td>
                    <input type="text" name="fb" value ="<?php echo $result_social['fb'];?>" class="medium" />
                </td>
            </tr>
                <tr>
                <td>
                    <label>Twitter</label>
                </td>
                <td>
                    <input type="text" name="twit" value ="<?php echo $result_social['twit'];?>" class="medium" />
                </td>
            </tr>
            
                <tr>
                <td>
                    <label>LinkedIn</label>
                </td>
                <td>
                    <input type="text" name="link" value ="<?php echo $result_social['link'];?>" class="medium" />
                </td>
            </tr>
            
                <tr>
                <td>
                    <label>Google Plus</label>
                </td>
                <td>
                    <input type="text" name="google"  value ="<?php echo $result_social['google'];?>" class="medium" />
                </td>
            </tr>
            
                <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" Value="Update" />
                </td>
            </tr>
        </table>
        </form>

    <?php } } ?>
    </div>
            </div>
        </div>

 <?php include 'incAdmin/footer.php';?>
