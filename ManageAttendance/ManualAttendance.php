<!DOCTYPE html>
<html lang="en">

<?php session_start() ?>
<?php require __DIR__ . '/../connectDB/functions.php' ?>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Manual Record Attendance</title>

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
            <a class="navbar-brand" href="../AdminPage.php">HYBUTM</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div id="main" class="container-fluid">
        <div class="col-md-12">
            <div>
                <h2 class="my-4">Manage
                    <small>ATTENDANCE</small>
                </h2>
                <h3>Student List</h3>
            </div>
            <div class="row" style="margin-left: 20px;">
                <a href="AttendanceOption.php" class="btn btn-primary" style="right: 75px; position:absolute;">Back&nbsp;<i class="fa fa-angle-double-left"></i></a>
            </div>
            <br><br>
            <table class="table table-responsive table-hover table-sm" style="display:table; min-height:300px;">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Matric</th>
                        <th scope="col">Name</th>
                        <th scope="col">Week1</th>
                        <th scope="col">Week2</th>
                        <th scope="col">Week3</th>
                        <th scope="col">Week4</th>
                        <th scope="col">Week5</th>
                        <th scope="col">Week6</th>
                        <th scope="col">Week7</th>
                        <th scope="col">Week8</th>
                        <th scope="col" style="text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // $w = $_GET["week"];
                    $section = $_GET["section"];
                    include 'dbConnect.php';
                    $sql = "select * from " . $section;
                    $result = $conn->query($sql);
                    $num = 1;
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                    ?>
                            <tr>

                                <td style='width:50px;'><?= $num ?>.</td>
                                <td><?= $row["name"]; ?></td>
                                <td><?= $row["matric"]; ?></td>
                                <td><input type="text" style="width:80px;" value="<?php echo $row["week1"]; ?>" id="w1" disabled></td>
                                <td><input type="text" style="width:80px;" value="<?php echo $row["week2"]; ?>" id="w2" disabled></td>
                                <td><input type="text" style="width:80px;" value="<?php echo $row["week3"]; ?>" id="w3" disabled></td>
                                <td><input type="text" style="width:80px;" value="<?php echo $row["week4"]; ?>" id="w4" disabled></td>
                                <td><input type="text" style="width:80px;" value="<?php echo $row["week5"]; ?>" id="w5" disabled></td>
                                <td><input type="text" style="width:80px;" value="<?php echo $row["week6"]; ?>" id="w6" disabled></td>
                                <td><input type="text" style="width:80px;" value="<?php echo $row["week7"]; ?>" id="w7" disabled></td>
                                <td><input type="text" style="width:80px;" value="<?php echo $row["week8"]; ?>" id="w8" disabled></td>

                                <td>
                                    <a role="button" href="EditAttendance.php?matric=<?= $row["matric"]; ?>&section=<?= $section; ?>" class="btn btn-rounded btn-primary btn-sm">Edit&nbsp;<i class="fa fa-edit pl-1"></i></a>
                                    <a role="button" href="ViewAttendance.php?matric=<?= $row["matric"]; ?>&section=<?= $section; ?>" class="btn btn-rounded btn-primary btn-sm">&nbsp;View<i class="fa fa-eye pl-1"></i>&nbsp;</a>
                                </td>
                            </tr>
                    <?php $num++;
                                                                                                                }
                                                                                                            } ?>
                </tbody>
            </table>
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