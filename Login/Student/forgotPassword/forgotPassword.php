<?php
require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "functions.php";

if (isset($_POST['email'])) {
    $db = mysqli_connect('localhost', 'root', '', 'adproject');
    $email = mysqli_real_escape_string($db, $_POST['email']);

    $sql = "SELECT email FROM studentlogin WHERE email='$email' ";
    $results = mysqli_query($db, $sql);

    if (mysqli_num_rows($results) > 0) {
        $token = generateNewString();

        $sql = "UPDATE studentlogin SET token='$token'WHERE email='$email'";
        $results = mysqli_query($db, $sql);

        $sql = "UPDATE studentlogin SET tokenExpire=DATE_ADD(NOW(), INTERVAL 5 MINUTE WHERE email='$email')";
        $results = mysqli_query($db, $sql);

        //SMTP needs accurate times, and the PHP time zone MUST be set
        //This should be done in your php.ini, but this is how to do it if you don't have access to that
        date_default_timezone_set('Etc/UTC');

        $mail = new PHPMailer;

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
        $mail->setFrom("utmmandarinclass@gmail.com", "UTM Mandarin Class");
        $mail->Subject = "Reset Password";
        $mail->isHTML(true);
        $mail->Body = "
                Hi, dear users<br><br>It appears that you have requested for password reset.<br>In order to reset your password, click on the link below:
                <a href='http://localhost/AD%20Project%20System/Login/Student/forgotPassword/resetPassword.php?email=$email&token=$token'><br>Reset Password Link</a><br><br>

                 Kind Regards,<br>
                 UTM MANDARIN LANGUAGE SOCIETY MANAGEMENT.
                ";

        if ($mail->send())
            echo "Please check your email inbox!";
        //exit(json_encode(array("status"=>1,"msg"=>'Please check your email inbox!')));
        else
            echo "Error! Try again.";
        //exit(json_encode(array("status"=>0,"msg"=>'Error! Try again.')));
    } else
        exit(json_encode(array("status" => 0, "msg" => 'No users found within database!Invalid email entered')));
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Forgot Password System</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicons -->
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700"
        rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="css/style.css" rel="stylesheet">
    <style type="text/css">
    .login-form {
        width: 340px;
        margin: 50px auto;
    }

    .login-form form {
        margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }

    .login-form h2 {
        margin: 0 0 15px;
    }

    .form-control,
    .btn {
        min-height: 38px;
        border-radius: 2px;
    }

    .btn {
        font-size: 15px;
        font-weight: bold;
    }
    </style>

</head>

<body>

    <!--==========================
  Header
  ============================-->
    <header id="header">
        <div class="container">

            <div id="logo" class="pull-left">
                <a href="../../../index.php">
                    <h2>HYBUTM</h2>
                </a>
            </div>

            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li class=""><a href="../../../index.php">Home</a></li>
                    <li class="menu-has-children menu-active"><a href="#" disabled>Login</a>
                        <ul>
                            <li><a href="../studentlogin.php">Student</a></li>
                            <li><a href="../../Admin/adminlogin.php">Administrator</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- #nav-menu-container -->
        </div>
    </header>
    <!-- #header -->

    <!--==========================
    Hero Section
  ============================-->
    <section id="hero">
        <div class="hero-container">
            <div class="login-form">
                <form>
                    <h5 style="color:black;">Reset Password</h5>
                    <img src="image.png" width="100%" height="100%">
                    <label style="float:left; color:black; font-size:medium;">Please enter your email address</label>
                    <input class="form-control" id="email" placeholder="username@email.com"><br>
                    <input type="button" class="btn btn-primary" name="ForgotPassword" value="Reset your password">
                    <br><br>
                    <span id="response"></span>
                </form>
            </div>
        </div>
    </section>
    <!-- #hero -->

    <!--==========================
    Footer
  ============================-->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">

            </div>
        </div>

        <div class="container">
            <p class="m-0 text-center text-white">Follow Us:
                <a href="http://wwww.facebook.com/hybutm" target="_blank">
                    <img src="../../../images/fb-art.png" alt="FaceBook Page" style="width:30px;height:30px;"
                        id="fb">FaceBook
                </a>

                <a href="https://www.instagram.com/hybutm/" target="_blank">
                    <img src="../../../images/ig-logo-email.png" alt="Instagram" style="width:30px;height:30px;"
                        id="Insta">Instagram
                </a></p>
        </div>
    </footer>
    <!-- #footer -->

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/jquery/jquery-migrate.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/superfish/hoverIntent.js"></script>
    <script src="lib/superfish/superfish.min.js"></script>

    <!-- Contact Form JavaScript File -->
    <script src="contactform/contactform.js"></script>

    <!-- Template Main Javascript File -->
    <script src="js/main.js"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script type="text/javascript">
    var email = $("#email");

    $(document).ready(function() {
        $('.btn-primary').on('click', function() {
            if (email.val() != "") {
                email.css("border", "1px solid green");

                $.ajax({
                    url: 'forgotPassword.php',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        email: email.val()
                    },
                    success: function(response) {
                        if (!response.success) {
                            $("#response").html(response.msg).css('color', "red");
                        } else {
                            $("#response").html(response.msg).css('color', "green");

                        }

                    }
                });
            } else
                email.css('border', '1px solid red');
            alert("Reset password link has been sent to your email.");
            window.location = "../../index.php";
        });
    });
    </script>

</body>

</html>