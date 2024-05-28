<!DOCTYPE html>
<html lang="en">

<?php session_start() ?>
<?php require __DIR__ . '/../connectDB/functions.php' ?>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Edit Admin</title>

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
    <style type="text/css">
        .login-form {
            margin-left: 30%;
            margin-right: 30%;
            width: 40%;
            position: relative;
            margin-top: 20px;
        }

        .login-form form {
            margin-bottom: auto;
            background: #f7f7f7;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 15px;
        }

        /* .login-form h2 {
        margin: 0 0 15px;
    } */

        .form-control,
        .btn {
            min-height: 38px;
            border-radius: 2px;
            font-size: 15px;
            padding: 5px;
        }

        .btn {
            font-size: 15px;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 10px;
        }
    </style>

</head>

<body>
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a class="nav-link" href="../AdminPage.php">Home</a>
        <a class="nav-link" href="../News/ManageNews.php">Manage News</a>
        <a class="nav-link" href="../ManageApplication/manageApp.php">Manage Application</a>
        <a class="nav-link" href="user.php">Manage User</a>
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
                        <a class="nav-link" href="../logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <!-- Page Content -->
    <div id="main" class="container">


        <!-- Grade Entries Column -->
        <div>
            <h2 class="my-4">Edit
                <small>ADMIN</small>
            </h2>
            <hr>
        </div>

        <br>

        <div class="login-form">

            <form action="saveAdmin.php" method="get">
                <?php
                include "dbConnect.php";
                $username = $_GET["username"];
                $sql = "SELECT * FROM admin WHERE username='$username'";
                $res = $conn->query($sql);
                if ($res->num_rows > 0) {
                    while ($row = $res->fetch_assoc()) { ?>
                        <h2 class="text-center" style="color: black;margin-bottom:10px;">Admin Form</h2>
                        <input type="text" name="username" value="<?= $row["username"] ?>" hidden>
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" class="form-control" name="name" required="required" placeholder="Full Name" value="<?= $row["name"] ?>">
                        </div>
                        <div class="form-group">
                            <label>Matric Number:</label>
                            <input type="text" class="form-control" name="matric" required="required" placeholder="Matric Number" value="<?= $row["matric"] ?>">
                        </div>
                        <div class="form-group">
                            <label>IC/Passport Number:</label>
                            <input type="text" class="form-control" name="icno" required="required" placeholder="IC/Passport Number" value="<?= $row["icno"] ?>">
                        </div>
                        <div class="form-group">
                            <label>Faculty:</label>
                            <select name="school" required class="form-control">
                                <?php if ($row["school"] == "FABU") { ?>
                                    <option value="">-- Faculty --</option>
                                    <option value="FABU" selected>FABU</option>
                                    <option value="FE">FE</option>
                                    <option value="FS">FS</option>
                                    <option value="AHIBS">AHIBS</option>
                                    <option value="FSSH">FSSH</option>
                                    <option value="RAZAK">RAZAK</option>
                                    <option value="MJIIT">MJIIT</option>
                                <?php } elseif ($row["school"] == "FE") { ?>
                                    <option value="">-- Faculty --</option>
                                    <option value="FABU">FABU</option>
                                    <option value="FE" selected>FE</option>
                                    <option value="FS">FS</option>
                                    <option value="AHIBS">AHIBS</option>
                                    <option value="FSSH">FSSH</option>
                                    <option value="RAZAK">RAZAK</option>
                                    <option value="MJIIT">MJIIT</option>
                                <?php } elseif ($row["school"] == "FS") { ?>
                                    <option value="">-- Faculty --</option>
                                    <option value="FABU">FABU</option>
                                    <option value="FE">FE</option>
                                    <option value="FS" selected>FS</option>
                                    <option value="AHIBS">AHIBS</option>
                                    <option value="FSSH">FSSH</option>
                                    <option value="RAZAK">RAZAK</option>
                                    <option value="MJIIT">MJIIT</option>
                                <?php } elseif ($row["school"] == "AHIBS") { ?>
                                    <option value="">-- Faculty --</option>
                                    <option value="FABU">FABU</option>
                                    <option value="FE">FE</option>
                                    <option value="FS">FS</option>
                                    <option value="AHIBS" selected>AHIBS</option>
                                    <option value="FSSH">FSSH</option>
                                    <option value="RAZAK">RAZAK</option>
                                    <option value="MJIIT">MJIIT</option>
                                <?php } elseif ($row["school"] == "FSSH") { ?>
                                    <option value="">-- Faculty --</option>
                                    <option value="FABU">FABU</option>
                                    <option value="FE">FE</option>
                                    <option value="FS">FS</option>
                                    <option value="AHIBS">AHIBS</option>
                                    <option value="FSSH" selected>FSSH</option>
                                    <option value="RAZAK">RAZAK</option>
                                    <option value="MJIIT">MJIIT</option>
                                <?php } elseif ($row["school"] == "RAZAK") { ?>
                                    <option value="">-- Faculty --</option>
                                    <option value="FABU">FABU</option>
                                    <option value="FE">FE</option>
                                    <option value="FS">FS</option>
                                    <option value="AHIBS">AHIBS</option>
                                    <option value="FSSH">FSSH</option>
                                    <option value="RAZAK" selected>RAZAK</option>
                                    <option value="MJIIT">MJIIT</option>
                                <?php } else { ?>
                                    <option value="">-- Faculty --</option>
                                    <option value="FABU">FABU</option>
                                    <option value="FE">FE</option>
                                    <option value="FS">FS</option>
                                    <option value="AHIBS">AHIBS</option>
                                    <option value="FSSH">FSSH</option>
                                    <option value="RAZAK">RAZAK</option>
                                    <option value="MJIIT" selected>MJIIT</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Year of Study:</label>
                            <select name="year" required class="form-control">
                                <?php if ($row["year"] == "First") { ?>
                                    <option value="">-- Select Year of Study --</option>
                                    <option value="First" selected>First</option>
                                    <option value="Second">Second</option>
                                    <option value="Third">Third</option>
                                    <option value="Forth">Forth</option>
                                <?php } elseif ($row["year"] == "Second") { ?>
                                    <option value="">-- Select Year of Study --</option>
                                    <option value="First">First</option>
                                    <option value="Second" selected>Second</option>
                                    <option value="Third">Third</option>
                                    <option value="Forth">Forth</option>
                                <?php } elseif ($row["year"] == "Third") { ?>
                                    <option value="">-- Select Year of Study --</option>
                                    <option value="First">First</option>
                                    <option value="Second">Second</option>
                                    <option value="Third" selected>Third</option>
                                    <option value="Forth">Forth</option>
                                <?php } else { ?>
                                    <option value="">-- Select Year of Study --</option>
                                    <option value="First">First</option>
                                    <option value="Second">Second</option>
                                    <option value="Third">Third</option>
                                    <option value="Forth" selected>Forth</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" class="form-control" name="email" required="required" placeholder="E-mail" value="<?= $row["email"] ?>">
                        </div>
                        <div class="form-group">
                            <label>Contact Number:</label>
                            <input type="text" class="form-control" name="num" required="required" pattern="^(\+?6?01)[0-46-9]-*[0-9]{7,8}$" placeholder="Phone Number" value="<?= $row["pnum"] ?>">
                        </div>
                        <div class="form-group">
                            <label>Role:</label>
                            <select name="role" required class="form-control">
                                <?php if ($row["role"] == "Admin") { ?>
                                    <option value="">-- User Role --</option>
                                    <option value="Admin" selected>Admin</option>
                                    <option value="Tutor">Tutor</option>
                                <?php } else { ?>
                                    <option value="">-- User Role --</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Tutor" selected>Tutor</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group" align="right">
                            <input type="submit" name="submitButton" class="btn btn-rounded btn-primary" value="Save">
                            <a role="button" href="admin.php" class="btn btn-rounded btn-primary">Cancel</a>
                        </div>

                <?php
                    }
                }
                ?>
            </form>
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