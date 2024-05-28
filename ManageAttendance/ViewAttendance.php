<html>

<body>
    <!DOCTYPE html>
    <html lang="en">

    <?php session_start() ?>
    <?php require __DIR__ . '/../connectDB/functions.php' ?>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Manage Attendance</title>

        <!-- Bootstrap core CSS -->
        <link href="../startbootstrap-blog-home-gh-pages/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
        <!-- Custom styles for this template -->
        <link href="../startbootstrap-blog-home-gh-pages/css/blog-home.css" rel="stylesheet">
        <style>
            body {
                font-family: "Lato", sans-serif;
            }

            .sidenav {
                height: 100%;
                width: 0;
                position: fixed;
                z-index: 1;
                top: 50px;
                left: 0;
                background-color: #111;
                overflow-x: hidden;
                transition: 0.5s;
                padding-top: 60px;
            }

            .sidenav a {
                padding: 8px 8px 8px 32px;
                text-decoration: none;
                font-size: 20px;
                color: #818181;
                display: block;
                transition: 0.3s;
            }

            .sidenav a:hover {
                color: #f1f1f1;
            }

            .sidenav .closebtn {
                position: absolute;
                top: 0;
                right: 25px;
                font-size: 36px;
                margin-left: 50px;
            }

            #main {
                transition: margin-left .5s;
                padding: 16px;
            }

            @media screen and (max-height: 450px) {
                .sidenav {
                    padding-top: 15px;
                }

                .sidenav a {
                    font-size: 18px;
                }
            }
        </style>

    </head>

    <body>
        <div id="mySidenav" class="sidenav">
            <br><br>
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a class="nav-link" href="../News/ManageNews.php">Manage News</a>
            <a class="nav-link" href="../ManageApplication/manageApp.php">Manage Application</a>
            <a class="nav-link" href="../ManageUser/user.php">Manage User</a>
            <a class="nav-link" href="../ManageClass/manageClass.php">Manage Class</a>
            <a class="nav-link" href="AttendanceOption.php">Manage Attendance</a>
            <a class="nav-link" href="../Grade/ManageGrade.php">Manage Grade</a>
            <a class="nav-link" href="../Payment/managePayment.php">Manage Payment</a>
        </div>

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <button class="btn btn-dark" onclick="openNav()"><i class="navbar-toggler-icon"></i></button>&nbsp;&nbsp;
                <a class="navbar-brand" href="AdminPage.php">HYBUTM</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div id="main" class="container">
            <div class="col-md-6">
                <div>
                    <h2 class="my-4">Student
                        <small>ATTENDANCE</small>
                    </h2>
                </div>
                <?php
                $matric = $_GET['matric'];
                $section = $_GET['section'];
                include 'dbConnect.php';
                $sql = "select * from $section where matric='$matric'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    ?>
                    <table class="table">
                        <tr>
                            <th scope="row">Student Name:</th>
                            <td><?php echo $row["name"]; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Student Matric:</th>
                            <td><?php echo $row["matric"]; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Week 1 Attendance:</th>
                            <td><?php echo $row["week1"]; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Week 2 Attendance:</th>
                            <td><?php echo $row["week2"]; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Week 3 Attendance:</th>
                            <td><?php echo $row["week3"]; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Week 4 Attendance:</th>
                            <td><?php echo $row["week4"]; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Week 5 Attendance:</th>
                            <td><?php echo $row["week5"]; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Week 6 Attendance:</th>
                            <td><?php echo $row["week6"]; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Week 7 Attendance:</th>
                            <td><?php echo $row["week7"]; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Week 8 Attendance:</th>
                            <td><?php echo $row["week8"]; ?></td>
                        </tr>
                    </table>
                <?php } ?>
                <div align="right">
                    <button name="cancelbtn" class="btn btn-rounded btn-primary" onclick="history.back();">Back<i class="fa fa-angle-double-left pl-1"></i></button>
                </div>

            </div>
        </div>

        <!-- /.container -->

        <!-- Footer -->
        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white">Follow Us:
                    <a href="http://wwww.facebook.com/hybutm" target="_blank">
                        <img src="../images/fb-art.png" alt="FaceBook Page" style="width:30px;height:30px;" id="fb">FaceBook
                    </a>

                    <a href="https://www.instagram.com/hybutm/" target="_blank">
                        <img src="../images/ig-logo-email.png" alt="Instagram" style="width:30px;height:30px;" id="Insta">Instagram
                    </a></p>
            </div>
            <!-- /.container -->
        </footer>

        <!-- Bootstrap core JavaScript -->
        <script src="../startbootstrap-blog-home-gh-pages/vendor/jquery/jquery.min.js"></script>
        <script src="../startbootstrap-blog-home-gh-pages/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script>
            function openNav() {
                document.getElementById("mySidenav").style.width = "250px";
                document.getElementById("main").style.marginLeft = "250px";
            }

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
                document.getElementById("main").style.marginLeft = "auto";
            }
        </script>
    </body>

    </html>
</body>

</html>