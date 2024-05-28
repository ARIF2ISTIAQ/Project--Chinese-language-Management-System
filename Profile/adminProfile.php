<!DOCTYPE html>
<html lang="en">

<?php session_start() ?>
<?php require __DIR__ . '\..\connectDB\functions.php' ?>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MY PROFILE</title>

    <!-- Bootstrap core CSS -->
    <link href="../startbootstrap-blog-home-gh-pages/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../startbootstrap-blog-home-gh-pages/css/blog-home.css" rel="stylesheet">

    <style>
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

        body {
            background: -webkit-linear-gradient(left, #737373, #d9d9d9);
            font-family: "Lato", sans-serif;
        }

        .emp-profile {
            padding: 5%;
            margin-top: 3%;
            margin-bottom: 3%;
            border-radius: 0.5rem;
            background: #fff;
        }


        .profile-img img {
            max-height: 250px;
            width: 250px;
            height: auto;
        }

        .profile-img .file {
            position: relative;
            overflow: hidden;
            margin-top: -20%;
            width: 250px;
            border: none;
            border-radius: 0;
            font-size: 15px;
            background: #212529b8;
        }

        .profile-img .file input {
            position: absolute;
            opacity: 0;
            right: 0;
            top: 0;
        }

        .profile-head h2 {
            color: #333;
        }

        .profile-head h3 {
            color: #0062cc;
        }

        .profile-head .nav-tabs {
            margin-bottom: 5%;
            font-size: 18px;
        }

        .profile-head .nav-tabs .nav-link {
            font-weight: 600;
            border: none;
        }

        .profile-head .nav-tabs .nav-link.active {
            border: none;
            border-bottom: 2px solid #0062cc;
        }

        .profile-work {
            padding: 14%;
            margin-top: -15%;
        }

        .profile-work p {
            font-size: 12px;
            color: #818182;
            font-weight: 600;
            margin-top: 10%;
        }

        .profile-work a {
            text-decoration: none;
            color: #495057;
            font-weight: 600;
            font-size: 14px;
        }

        .profile-work ul {
            list-style: none;
        }

        .profile-tab label {
            font-weight: 600;
            font-size: 18px;
        }

        .profile-tab p {
            font-weight: 600;
            color: #0062cc;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <?php
    include 'dbConnect.php';
    $username = $_SESSION['ausername'];
    $sql = "SELECT * FROM admin WHERE username='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        ?>

        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a class="nav-link" href="../AdminPage.php">Home</a>
            <a class="nav-link" href="../News/ManageNews.php">Manage News</a>
            <a class="nav-link" href="../ManageApplication/manageApp.php">Manage Application</a>
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
                            <a class="nav-link" href="../logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div id="main" class="container">
            <div class="container emp-profile">

                <div class="row">
                    <div class="col-md-4">
                        <form id="imageFile" action="adminChgImg.php" method="POST" enctype="multipart/form-data">
                            <div class="profile-img">
                                <input type="text" name="username" value="<?= $username ?>" hidden>
                                <img id="blah" src="<?= $row['image'] ?>" style="border:double;">
                                <div class="file btn btn-lg btn-primary">
                                    Change Photo
                                    <input type="file" name="image" accept="image/*" onchange="readURL(this);">
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-8">
                        <div class="profile-head">
                            <br><br><br>
                            <h2>
                                <?= $row['name'] ?>
                            </h2>
                            <h3>
                                HYB <?= $row['role'] ?>
                            </h3>
                            <br>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                                <?php if ($row['role'] == "Tutor") { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Class Handled</a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4" style="font-size:20px;">
                        <input type="button" class="btn btn-link btn-lg" data-toggle="modal" data-target="#myModal" value="Change Password">
                        <br>
                        <hr class="col-md-8" align="left">
                        <input type="button" class="btn btn-link btn-lg" data-toggle="modal" data-target="#myModal2" value="Edit Profile">
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Change Password</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body" style="min-height: 350px; ">
                                    <form id="form_modal" action="adminChgPass.php" method="POST" class="form-container">
                                        <input type="text" name="username" value="<?= $username ?>" hidden>
                                        <div class="form-group">
                                            <h5>Old Password:</h5>
                                            <input type="password" class="form-control" name="oldPass" placeholder="Old Password">
                                        </div>
                                        <div class="form-group">
                                            <h5>New Password:</h5>
                                            <input type="password" class="form-control" name="newPass" placeholder="New Password">
                                        </div>
                                        <div class="form-group">
                                            <h5>Confirm Password:</h5>
                                            <input type="password" class="form-control" name="conPass" placeholder="Confirm Password">
                                        </div>
                                        <div align="right">
                                            <button onclick="form_submit()" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- End Modal -->

                    <!-- Modal 2 -->
                    <div class="modal fade" id="myModal2" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit Profile</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body" style="min-height: 350px; ">
                                    <form id="form_modal2" action="adminEdit.php" method="POST" class="form-container">
                                        <input type="text" name="username" value="<?= $username ?>" hidden>
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
                                        <div align="right">
                                            <button onclick="form_submit2()" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- End Modal 2 -->

                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Username</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?= $row['username'] ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?= $row['name'] ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>IC/Passport</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?= $row['icno'] ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Matric Number</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?= $row['matric'] ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Faculty</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?= $row['school'] ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Year of Study</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?= $row['year'] ?> Year</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?= $row['email'] ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Contact Number</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?= $row['pnum'] ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php
                                $sql = "SELECT * FROM tutor WHERE name='$name'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    $rowG = $result->fetch_assoc()
                                    ?>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>First Class</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?= $rowG['class1'] ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Second Class</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?= $rowG['class2'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div align="right">
                            <br><br>
                            <a href="../AdminPage.php" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                </div>

            </div>
        <?php } ?>
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
            function form_submit() {
                document.getElementById("form_modal").submit();
            }

            function form_submit2() {
                document.getElementById("form_modal2").submit();
            }
        </script>
        <script type="text/javascript">
            function readURL(input) {
                if (input.files[0].size > 300000) {
                    alert("Image is too big!\nMaxinum size of image is 300KB.");
                    input.value = "";
                } else {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('#blah').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]);
                        document.getElementById("imageFile").submit();
                    }
                }
            }
        </script>
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