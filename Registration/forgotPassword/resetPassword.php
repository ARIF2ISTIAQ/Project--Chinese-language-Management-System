<?php
    require_once"functions.php";
    
    if(isset($_GET['email'])&& isset($_GET['token'])){

        $db=mysqli_connect('localhost', 'root', '', 'login');
        $email=mysqli_real_escape_string($db, $_GET['email']);
        $token=mysqli_real_escape_string($db, $_GET['token']);
      
        $sql = "SELECT id FROM users WHERE email='$email' AND token='$token'";
        $results = mysqli_query($db, $sql);
        
        if (mysqli_num_rows($results) > 0){
           
            $newPassword="utmmandarinclass";
            //$newPassword=generateNewString();
            $newPasswordEncrypted=password_hash($newPassword, PASSWORD_DEFAULT);

            $sql = "UPDATE users SET token='' WHERE email='$email'";
            $results = mysqli_query($db, $sql);
            $sql = "UPDATE users SET password='$newPasswordEncrypted' WHERE email='$email'";
            $results = mysqli_query($db, $sql);

            echo '<center>Your default new password is '.$newPassword.'</center><br><br>';
            echo '<div class="error"><p style="color:red;">Congratulations! Your default password has been updated successfully.</p>
                    <p><a href="http://localhost/UTM%20Mandarin%20Class/Login/login.php"> Login with your default password given.</a></p>
                    <p> Else, you might want to change the default password, complete the form below for default password changes.</p>
                  </div>';
                    
            
            ?>
                 <form class="login-form" action="submit_new.php" method="post" align="center">
		                <h2 class="form-title">New Password Reset</h2>
	        	        <div class="form-group">
			            <label>Email Address</label>
			            <input type="email" name="email"><br><br>
		                </div>
                        <div class="form-group">
                        <label>New password</label>
			            <input type="password" name="new_pass"><br><br>
	        	        </div>
		                <div class="form-group">
			            <label>Confirm new password</label>
			            <input type="password" name="new_pass_c"><br><br>
		                </div>
		                <div class="form-group">
			            <button type="submit" name="new_password" class="login-btn">Request Reset</button>
		                </div>
	            </form>
            <?php
            
            
        }else 
            redirectToLoginPage();
    } else{
        redirectToLoginPage();
    }
       
?>

