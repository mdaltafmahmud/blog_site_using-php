
<?php include 'incAdmin/header.php'; ?>
<?php include 'incAdmin/sidebar.php'; ?>

<?php 
    if (!isset($_GET['catid']) || $_GET['catid'] == NULL ) {
        header("Location: catlist.php");
    }else{
        $catid = $_GET['catid'];
    }
?>

    <div class="grid_10">
        <div class="box round first grid">
            <h2>Update Category</h2>
        <div class="block copyblock"> 
               
     <!-- catagory update query  -->
    <?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name  = $_POST['name'];
        $name = mysqli_real_escape_string($db->link,$name);

        if (empty($name)) {
           echo "<span class='error'>Field Must Not Be Empty !!.</span>";
        } else{
            $query     = "UPDATE catagory SET name ='$name' WHERE id= '$catid'; ";
            $catUpdate = $db->update($query);
           if ($catUpdate) {
            echo "<span class='success'>Catagory Updated successfully !!.</span>";
           }else{
            echo "<span class='error'> Catagory Not Updated !!.</span>";
           }
            
        }
    }

    ?>

    <?php 
        $query ="SELECT * FROM catagory where id= '$catid' ORDER BY id DESC ";
        $catagory =$db->select($query);
        while ($result = $catagory->fetch_assoc()) {
    ?>
        <form action="" method="post">
        <table class="form">					
            <tr>
                <td>
                    <input type="text" name="name" value="<?php echo $result['name'];?>"  class="medium"/>
                </td>
                <td>
              </td>
            </tr>
            <tr> 
                <td>
                    <input type="submit" name="submit" Value="Save" />
                </td>
            </tr>
        </table>
        </form>
            <?php } ?>

                </div>
            </div>
        </div>

<?php include 'incAdmin/footer.php';?> 
