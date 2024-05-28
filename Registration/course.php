<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>HYBUTM Main Page</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicons -->
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">

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
                <a href="../Login/index.php">
                    <h2>HYBUTM</h2>
                </a>
            </div>

            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li class=""><a href="../Login/index.php">Home</a></li>
                    <li class="menu-has-children menu-active"><a href="#" disabled>Login</a>
                        <ul>
                            <li><a href="../Login/Student/studentlogin.php">Student</a></li>
                            <li><a href="../Login/Admin/adminlogin.php">Administrator</a></li>
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
    <section id="hero" style="min-height: 1000px;">
        <div class="hero-container">
            <div class="row">
                <!-- Blog Entries Column -->
                <div>
                    <h2 class="my-3" style="font-size: 30px;">Course Registration</h2>

                    <!-- Registration Table -->
                    <div style="background-color: #f7f7f7; text-align:left; padding:10px; font-weight:bold;">
                        <label>Lecture Time: 8:00pm to 10:00pm</label><br>
                        <label>Venue: C25, FKM</label>
                    </div>
                    <br>
                    <div class="card mb-4">

                        <?php
                        $userid = $_GET["userid"];
                        include 'dbConnect.php';
                        $sql = "select * from course order by section asc";
                        $result = $conn->query($sql);
                        $num = 1;
                        ?>

                        <table class='table' id='myTable' style='width:100%;'>
                            <thead class="thead-dark">
                                <tr>
                                    <th>No.</th>
                                    <th>Course</th>
                                    <th>Section</th>
                                    <th>Medium</th>
                                    <th>Start Date</th>
                                    <th>Day</th>
                                    <th>Tutor</th>
                                    <th>Available</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <?php if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $available = 25 - $row['num'];
                                    ?>
                                    <tr>
                                        <td style='width:50px;'><?= $num ?></td>
                                        <td><?= $row['course'] ?></td>
                                        <td><?= $row['section'] ?></td>
                                        <td><?= $row['medium'] ?></td>
                                        <td><?= $row['sdate'] ?></td>
                                        <td><?= $row['day'] ?></td>
                                        <td><?= $row['tutor'] ?></td>
                                        <td><?= $available ?>/25</td>
                                        <td><?= $row['status'] ?></td>
                                        <td>
                                            <form action="regcourse.php" method="GET">
                                                <input type="text" name="course" value="<?= $row['course'] ?>" hidden>
                                                <input type="text" name="userid" value="<?= $_GET['userid'] ?>" hidden>
                                                <input type="text" name="section" value="<?= $row['section'] ?>" hidden>
                                                <?php if ($row['status'] == "FULL") { ?>
                                                    <input type='submit' class='register' name='register' value="Register" disabled>

                                                <?php } else { ?>
                                                    <input type='submit' class='register' name='register' value="Register">
                                                <?php } ?>


                                            </form>
                                        </td>
                                    </tr>
                            <?php $num++;
                                }
                            }
                            ?>
                        </table>

                    </div>


                </div>
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
                    <img src="../images/fb-art.png" alt="FaceBook Page" style="width:30px;height:30px;" id="fb">FaceBook
                </a>

                <a href="https://www.instagram.com/hybutm/" target="_blank">
                    <img src="../images/ig-logo-email.png" alt="Instagram" style="width:30px;height:30px;" id="Insta">Instagram
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

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

</body>

</html>