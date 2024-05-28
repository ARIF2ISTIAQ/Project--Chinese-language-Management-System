<!DOCTYPE html>
<html lang="en">


<?php require __DIR__ . '/../connectDB/functions.php' ?>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MANAGE APPLICATION</title>

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
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a class="nav-link" href="../AdminPage.php">Home</a>
        <a class="nav-link" href="../News/ManageNews.php">Manage News</a>
        <a class="nav-link" href="manageApp.php">Manage Application</a>
        <a class="nav-link" href="../ManageUser/user.php">Manage User</a>
        <a class="nav-link" href="../ManageClass/manageClass.php">Manage Class</a>
        <a class="nav-link" href="../ManageAttendance/AttendanceOption.php">Manage Attendance</a>
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
                        <a class="nav-link" href="../index.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <!-- Page Content -->
    <div id="main" class="container">

        <!-- Grade Entries Column -->
        <div>
            <h2 class="my-4">Manage
                <small>APPLICATION</small>
            </h2>
        </div>
        <?php
        include 'dbConnect.php';
        $username = $_GET['username'];
        $sql = "SELECT * FROM student WHERE username='$username'";
        $result = $conn->query($sql);
        ?>
        <table class='table' id='myTable' style='width:60%; font-weight:bold;'>
            <?php if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td>
                            Name:
                        </td>
                        <td>
                            <?= $row['name'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            IC/Password Number:
                        </td>
                        <td>
                            <?= $row['icno'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Matric Number:
                        </td>
                        <td>
                            <?= $row['matric'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Faculty:
                        </td>
                        <td>
                            <?= $row['school'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Nationality:
                        </td>
                        <td>
                            <?= $row['national'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Year of Study:
                        </td>
                        <td>
                            <?= $row['year'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Email:
                        </td>
                        <td>
                            <?= $row['email'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Contact Number:
                        </td>
                        <td>
                            <?= $row['pnum'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Course:
                        </td>
                        <td>
                            <?= $row['course'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Section:
                        </td>
                        <td>
                            <?= $row['section'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Status:
                        </td>
                        <td>
                            <?= $row['status'] ?>
                        </td>
                    </tr>
            <?php }
            }
            ?>
            <tr>
                <td>

                </td>
                <td>
                    <a role="button" href="accept.php?username=<?= $username ?>" class="btn btn-rounded btn-primary btn-sm">Accept</a>
                    <a role="button" href="reject.php?username=<?= $username ?>" class="btn btn-rounded btn-primary btn-sm">Reject</a>
                    <a role="button" href="manageApp.php" class="btn btn-rounded btn-primary btn-sm">Back</a>
                </td>
            </tr>
        </table>

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