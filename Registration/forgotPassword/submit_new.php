<?php

    $msg="";
   
    if (isset($_POST['new_password'])) {
        $db=mysqli_connect('localhost', 'root', '', 'login');
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $new_pass = mysqli_real_escape_string($db, $_POST['new_pass']);
        $new_pass_c = mysqli_real_escape_string($db, $_POST['new_pass_c']);
        
        $newPasswordEncrypted=password_hash($new_pass, PASSWORD_DEFAULT);
        
        if($new_pass!=$new_pass_c){
            $msg="<p>Password do not match, both password should be same.<br /><br /></p>";
        }
        if($msg!=""){
            echo "<div class='error'>".$msg."</div><br />";
        }else{
            $sql = "UPDATE users SET token='' WHERE email='$email'";
            $results = mysqli_query($db, $sql);
            $sql = "UPDATE users SET password='$newPasswordEncrypted' WHERE email='$email'";
            $results = mysqli_query($db, $sql);
            echo"<span style='color:green;'><p>Success! You had changed your password ! Please log in with your latest password change!</p>";
            echo '<p><a href="http://localhost/UTM%20Mandarin%20Class/Login/login.php">
            Click here</a> to Login.</p>';
        }
    }
?>