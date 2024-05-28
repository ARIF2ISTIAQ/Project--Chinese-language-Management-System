<?php
require_once "functions.php";

if (isset($_GET['email']) && isset($_GET['token'])) {

    $db = mysqli_connect('localhost', 'root', '', 'adproject');
    $email = mysqli_real_escape_string($db, $_GET['email']);
    $token = mysqli_real_escape_string($db, $_GET['token']);

    $sql = "SELECT id FROM adminlogin WHERE email='$email' AND token='$token'";
    $results = mysqli_query($db, $sql);

    if (mysqli_num_rows($results) > 0) {

        $newPassword = "utmmandarinclass";
        //$newPassword=generateNewString();
        $newPasswordEncrypted = password_hash($newPassword, PASSWORD_DEFAULT);

        $sql = "UPDATE adminlogin SET token='' WHERE email='$email'";
        $results = mysqli_query($db, $sql);
        $sql = "UPDATE adminlogin SET passwords='$newPasswordEncrypted' WHERE email='$email'";
        $results = mysqli_query($db, $sql);
        ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Reset Password</title>
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
        width: 700px;
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
                            <li><a href="../../Student/studentlogin.php">Student</a></li>
                            <li><a href="../adminlogin.php">Administrator</a></li>
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
                <form class="login-form" action="submit_new.php" method="post" style="text-align:left;">
                    <div style="border-style:solid; padding:20px">
                        <label>Your default new password is "<?= $newPassword ?>"</label>
                        <div class="error">
                            <label style="color:red;">Congratulations! Your default password has been updated
                                successfully.
                            </label>
                            <label>Click the link to return to login page.&nbsp;<a
                                    href="http://localhost/AD%20Project%20System/index.php">Login Page</a></label>
                            <label> Else, you might want to change the default password, complete the form below for
                                default
                                password
                                changes.</label>
                        </div>
                    </div>
                    <br>
                    <h2 class="form-title" style="color:black;">New Password Reset</h2>
                    <div style="color:black;">
                        <div class="form-group">
                            <label>Email Address:&nbsp;</label>
                            <input type="email" name="email" placeholder="Email"><br>
                        </div>
                        <div class="form-group">
                            <label>New password:&nbsp;</label>
                            <input type="password" name="new_pass" placeholder="Password"><br>
                        </div>
                        <div class="form-group">
                            <label>Confirm new password:&nbsp;</label>
                            <input type="password" name="new_pass_c" placeholder="Confirm Password"><br>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="new_password" class="btn btn-primary login-btn">Request
                                Reset</button>
                        </div>
                    </div>

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

</body>

</html>
<?php

    }
    //     } else
    //         redirectToLoginPage();
    // } else {
    //     redirectToLoginPage();
}

?>