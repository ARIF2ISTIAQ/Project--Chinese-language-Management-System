<?php
    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";
	
	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
   
    require_once"functions.php";

    if(isset($_POST['email'])){
        $db=mysqli_connect('localhost', 'root', '', 'login');
        $email=mysqli_real_escape_string($db, $_POST['email']);

        $sql = "SELECT email FROM users WHERE email='$email' ";
        $results = mysqli_query($db, $sql);
      
        if (mysqli_num_rows($results) > 0) {
            $token=generateNewString();
            
            $sql = "UPDATE users SET token='$token'WHERE email='$email'";
            $results = mysqli_query($db, $sql);

            $sql = "UPDATE users SET tokenExpire=DATE_ADD(NOW(), INTERVAL 5 MINUTE WHERE email='$email')";
            $results = mysqli_query($db, $sql);
			
			//SMTP needs accurate times, and the PHP time zone MUST be set
            //This should be done in your php.ini, but this is how to do it if you don't have access to that
            date_default_timezone_set('Etc/UTC');
            
            $mail= new PHPMailer;
    
            //Enable SMTP debugging
            // SMTP::DEBUG_OFF = off (for production use)
            // SMTP::DEBUG_CLIENT = client messages
            // SMTP::DEBUG_SERVER = client and server messages
                 $mail->SMTPDebug = SMTP::DEBUG_SERVER;                            
                //Set PHPMailer to use SMTP.
                $mail->isSMTP();            
                //Set SMTP host name by using a remote smtp server                          
                 $mail->Host = "smtp.gmail.com";
                 //Set this to true if SMTP host requires authentication to send email
                $mail->SMTPAuth = true;                          
                //Provide real username and password     
                $mail->Username = "utmmandarinclass@gmail.com";                 
	            $mail->Password = "utmmandarinclass2019";                     
                //If SMTP requires TLS/SSL encryption then set it
                $mail->SMTPSecure = "tls";                         
                //Set TCP port to connect to 
                $mail->Port = 587;  
                //Whether to use SMTP authentication
                 $mail->SMTPAuth = true;
			
			    $mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			    );
    
             $mail->addAddress($email);
            // need to specify real email address
            $mail->setFrom("utmmandarinclass@gmail.com","UTM Mandarin Class");  
            $mail->Subject="Reset Password";
            $mail->isHTML(true);
            $mail->Body="
                Hi, dear users<br><br>It appears that you have requested for password reset.<br>In order to reset your password, click on the link below:
                <a href='http://localhost/UTM%20Mandarin%20Class/Login/forgotPassword/resetPassword.php?email=$email&token=$token'><br>Reset Password Link</a><br><br>

                 Kind Regards,<br>
                 UTM MANDARIN LANGUAGE SOCIETY MANAGEMENT.
                ";
    
           if($mail->send())
                echo "Please check your email inbox!";
           //exit(json_encode(array("status"=>1,"msg"=>'Please check your email inbox!')));
            else
                 echo "Error! Try again.";
                //exit(json_encode(array("status"=>0,"msg"=>'Error! Try again.')));
        }else 
            exit(json_encode(array("status"=>0,"msg"=>'No users found within database!Invalid email entered')));  
    }
        
    
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <title>Forgot Password System</title>    
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-md-offset-3"align="center">
                    <img src="image.png">
                    <input class="form-control" id="email" placeholder="username@email.com"><br>
                    <input type="button" class="btn btn-primary" name="ForgotPassword" value="Reset your password"> 
                    <br><br>
                    <span id="response"></span>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>
        <script type="text/javascript">
            var email= $("#email");

            $(document).ready(function(){
               $('.btn-primary').on('click',function(){
                    if(email.val()!=""){
                        email.css("border","1px solid green");

                        $.ajax({
                            url:'forgotPassword.php',
                            method:'POST',
                            dataType:'json',
                            data:{
                                email:email.val()
                            }, success:function(response){
                                if(!response.success){
                                    $("#response").html(response.msg).css('color',"red");
                                }
                                else{
                                    $("#response").html(response.msg).css('color',"green");
                                }
                                    
                            }
                        });
                    }else
                        email.css('border','1px solid red');
                });
            });
        </script>
    </body>
</html>
