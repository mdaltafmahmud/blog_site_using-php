

<?php include 'incAdmin/header.php'; ?>
<?php include 'incAdmin/sidebar.php'; ?>

    <div class="grid_10">
        <div class="box round first grid">
            <h2>Add New User</h2>
        <div class="block copyblock"> 
               
     <!-- user create query  -->
    <?php 

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $formate->validation($_POST['username']);
        $password = $formate->validation(md5($_POST['password']));
        $role     = (int)$formate->validation($_POST['role']);
        // var_dump($role);
        // var_dump($username);
        // var_dump($password);
        // die();

        $username = mysqli_real_escape_string($db->link,$username);
        $password = mysqli_real_escape_string($db->link,$password);
        $role     = mysqli_real_escape_string($db->link,$role);

    if ($username == "" || $password == '' || $role == '') {
        echo "<span class='error'>Field Must Not Be Empty !!.</span>";
        }else{
        $query      ="INSERT INTO user_tbl (username,password,role) VALUES('$username','$password',$role)";
        $userInsert =$db->insert($query);
        if ( $userInsert) {
        echo "<span class='success'>User Created successfully !!.</span>";
        }else{
        echo "<span class='error'> User Not Created !!.</span>";
        }
        
    }
}

?>


        <form action="" method="post">
        <table class="form">					
            <tr>
                 <td><label for="">User Name</label></td>
                <td>
                    <input type="text" name="username" placeholder="Enter  Username"/>
                </td>
            </tr>
            <tr>
                 <td><label for="">Password</label></td>
                <td>
                    <input type="text" name="password" placeholder="Enter  Password"/>
                </td>
            </tr>
            <tr>
                <td><label for="">User Role</label></td>
                <td>
                  <select name="role" id="select"> 
                      <option> Select User Role</option>
                      <option value="0"> Admin</option>
                      <option value="1"> Author</option>
                      <option value="2"> Editor</option>
                  </select>
                </td>
            </tr>

            <td></td>
            <tr> 
                <td>
                    <input type="submit" name="submit" Value="Create" />
                </td>
            </tr>

        </table>
        </form>
           

                </div>
            </div>
        </div>

<?php include 'incAdmin/footer.php';?> 
 