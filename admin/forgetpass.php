<?php
		include '../lib/Session.php';
		Session::checklogin();
	?>
	<?php include  '../config/config.php';?>
	<?php include  '../lib/Database.php';?>
	<?php include  '../helpers/Format.php';?>
	<?php 
		$db      = new Database();
		$formate = new Format();
	?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Password recovery</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">

	<?php 
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $formate->validation($_POST['email']);
        $email = mysqli_real_escape_string($db->link, $email);
        if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            echo "<span style='color:red;font-size:18px;'>Invaild Email Address ..!!</span>";
        }else {
                    $emailquery ="SELECT * FROM user_tbl WHERE email= '$email' LIMIT 1 ";
                    $mailcheck  = $db->select($emailquery);
                    if($mailcheck != false){
                    while ($value =$mailcheck->fetch_assoc() ) {
                    $userid   = $value['id'];
                    $username = $value['username'];
               }
                    $text    = substr($email,0, 3);
                    $rand    = rand(10000 ,99999);
                    $newPass = "$text$rand";
                    $password= md5($newPass);

                    $query          = "UPDATE user_tbl SET password ='$password' WHERE id= '$userid'; ";
                    $userpassUpdate = $db->update($query);
                    $to        =  $email;
                    $from      ="altafit@gmail.com";
                    $headers   ="From:$from\n";
                    $headers  .= 'MIME-Version: 1.0';
                    $headers  .= 'Content-type: text/html; charset=iso-8859-1';
                    $subject   ="your password";
                    $message   ="Your username is".$username ." And Your password is" .$newPass." please visit 
                    to login ";

                    $sendmail = mail( $to ,$subject ,$message ,$headers);
                    if($sendmail){
                        echo "<span style='color:green;font-size:18px;'>Check Your Email For New Password..!!</span>";
                    }else{
                        echo "<span style='color:red;font-size:18px;'>Mail Not Sent ..!!</span>";
                    }

              }else{
                echo "<span style='color:red;font-size:18px;'>Email Not Exists ..!!</span>";
            } 
          }
        }
	
	?>
		<form action="" method="post">
			<h1>Recover Password</h1>
			<div>
				<input type="text" placeholder="Enter Valid Email Address" required="" name="email"/>
			</div>

			<div>
				<input type="submit" value="Send Email" />
			</div>
		</form><!-- form -->

		<div class="button">
			<a href="login.php">Login</a>
		</div>
		
		<!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>