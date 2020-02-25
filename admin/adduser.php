

<?php include 'incAdmin/header.php'; ?>
<?php include 'incAdmin/sidebar.php'; ?>
<?php
    if (!Session::get('userRole')=='0') { 
        echo "<script defer> location.href='index.php';</script>";
    }
 ?>
    <div class="grid_10">
        <div class="box round first grid">
            <h2>Add New User</h2>
        <div class="block copyblock"> 

     <!-- user create query  -->
    <?php 

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name     = $formate->validation($_POST['name']);
        $username = $formate->validation($_POST['username']);
        $password = $formate->validation(md5($_POST['password']));
        $email    = $formate->validation($_POST['email']);
        $role     = $formate->validation($_POST['role']);

        $name     = mysqli_real_escape_string($db->link,$name);
        $username = mysqli_real_escape_string($db->link,$username);
        $password = mysqli_real_escape_string($db->link,$password);
        $email    = mysqli_real_escape_string($db->link,$email);
        $role     = mysqli_real_escape_string($db->link,$role);

        if ( $name == " " ||$username == " " || $password == ' ' || $email == ' ' || $role == ' ') {
            echo "<span class='error'>Field Must Not Be Empty !!.</span>";
        }
        else{
            $emailquery ="SELECT * FROM user_tbl WHERE email= '$email' LIMIT 1 ";
            $mailcheck  = $db->select($emailquery);
            if($mailcheck != false){
                echo "<span class='error'> Email already exists !!.</span>";
            } 
            else{
                $query    ="INSERT INTO user_tbl (name,username, password, email, role) 
                VALUES('$name','$username','$password','$email', '$role')";

                $userInsert = $db->insert($query);
                if ($userInsert) {
                    echo "<span class='success'>User Created successfully !!.</span>";
                }else{
                echo "<span class='error'> User Not Created !!.</span>";
                } 
            }
        }
  }

?>
        <form action="adduser.php" method="post" id="sentmsg" >
        <table class="form">
        <tr>
                <td><label for=""> Name</label></td>
                <td>
                    <input type="text" name="name" placeholder="Enter name"/>
                </td>
            </tr>					
            <tr>
                <td><label for="">User Name</label></td>
                <td>
                    <input type="text" name="username" placeholder="Enter  Username"/>
                </td>
            </tr>
            <tr>
                <td><label for="">Email</label></td>
                <td>
                    <input type="email" name="email" placeholder="Enter a Valid Email Address"/>
                </td>
            </tr>
            <tr>
                <td><label for="">Password</label></td>
                <td>
                    <input type="password" name="password" placeholder="Enter  Password"/>
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
 