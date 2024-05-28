<!DOCTYPE html>
<html lang="en">

<?php session_start() ?>
<?php require __DIR__ . '/../connectDB/functions.php' ?>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Manage Payment</title>

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
        <a class="nav-link" href="../ManageApplication/manageApp.php">Manage Application</a>
        <a class="nav-link" href="../ManageUser/user.php">Manage User</a>
        <a class="nav-link" href="../ManageClass/manageClass.php">Manage Class</a>
        <a class="nav-link" href="../ManageAttendance/AttendanceOption.php">Manage Attendance</a>
        <a class="nav-link" href="../Grade/ManageGrade.php">Manage Grade</a>
        <a class="nav-link" href="managePayment.php">Manage Payment</a>
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


        <!-- Grade Entries Column -->
        <div>
            <h2 class="my-4">Manage
                <small>PAYMENT</small>
            </h2>
            <hr>
        </div>

        <br>
        <form action="" method="post">
            <h4>Search:&nbsp;&nbsp;</h4>
            <div class="row" style="margin-left: 0;">
                <input class="form-control" style="width: 150px; margin-right:10px;" type="text" name="name" placeholder="Name">
                <input type="submit" class="btn btn-primary" name="sname" value="Search Name">
                <input class="form-control" style="width: 150px; margin-right:10px;margin-left:10px;" type="text" name="matric" placeholder="Matric">
                <input type="submit" class="btn btn-primary" name="smatric" value="Search Matric">
                <input class="form-control" style="width: 150px; margin-right:10px;margin-left:10px;" type="text" name="section" placeholder="Section">
                <input type="submit" class="btn btn-primary" name="ssection" value="Search Section">
            </div>
        </form>

        <div style="min-height:330px;">
            <br>
            <table class="table table-striped">
                <thead>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Matric</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Course</th>
                    <th>Section</th>
                    <th>Outstanding Fee</th>
                    <th style="text-align: center;">Action</th>
                </thead>
                <?php
                if (isset($_POST["sname"])) {
                    $search_value = $_POST["name"];
                    include "dbConnect.php";
                    if ($conn->connect_error) {
                        echo 'Connection Faild: ' . $conn->connect_error;
                    } else {
                        $sql = "SELECT * FROM student WHERE name LIKE '%$search_value%' ORDER BY name ASC";

                        $res = $conn->query($sql);
                        $num = 1; ?>
                        <tbody>
                            <?php while ($row = $res->fetch_assoc()) { ?>
                                <tr>
                                    <td><?= $num ?></td>
                                    <td><?= $row["name"] ?></td>
                                    <td><?= $row["matric"] ?></td>
                                    <td><?= $row["email"] ?></td>
                                    <td><?= $row["pnum"] ?></td>
                                    <td><?= $row["course"] ?></td>
                                    <td><?= $row["section"] ?></td>
                                    <?php if ($row["outstanding"] > 0) { ?>
                                        <td align="center" style="color: red">RM<?= $row["outstanding"] ?></td>
                                    <?php } else { ?>
                                        <td align="center">RM<?= $row["outstanding"] ?></td>
                                    <?php } ?>
                                    <td style="text-align: center;">
                                        <button type='button' class='btn btn-primary btn-sm' data-toggle="modal" data-target="#payfees" data-id='<?= $row["username"] ?>' data-name='<?= $row["name"] ?>' data-matrix='<?= $row["matric"] ?>' data-course='<?= $row["course"] ?>' data-section='<?= $row["section"] ?>' data-balance='<?= $row["outstanding"] ?>'>
                                            <i class='fa fa-usd'></i>Take Fee</button>
                                        <a href="viewReport.php?username=<?= $row["username"] ?>" class="btn btn-primary btn-sm">
                                            <i class='fa fa-file-text'></i>Transaction Record</a>
                                    </td>
                                </tr>



                            <?php $num++;
                                    }
                                }
                            } elseif (isset($_POST["smatric"])) {
                                $search_value = $_POST["matric"];
                                include "dbConnect.php";
                                if ($conn->connect_error) {
                                    echo 'Connection Faild: ' . $conn->connect_error;
                                } else {
                                    $sql = "SELECT * FROM student WHERE matric LIKE '%$search_value%' ORDER BY name ASC";

                                    $res = $conn->query($sql);
                                    $num = 1; ?>
                        <tbody>
                            <?php while ($row = $res->fetch_assoc()) { ?>
                                <tr>
                                    <td><?= $num ?></td>
                                    <td><?= $row["name"] ?></td>
                                    <td><?= $row["matric"] ?></td>
                                    <td><?= $row["email"] ?></td>
                                    <td><?= $row["pnum"] ?></td>
                                    <td><?= $row["course"] ?></td>
                                    <td><?= $row["section"] ?></td>
                                    <?php if ($row["outstanding"] > 0) { ?>
                                        <td align="center" style="color: red">RM<?= $row["outstanding"] ?></td>
                                    <?php } else { ?>
                                        <td align="center">RM<?= $row["outstanding"] ?></td>
                                    <?php } ?>
                                    <td style="text-align: center;">
                                        <button type='button' class='btn btn-primary btn-sm' data-toggle="modal" data-target="#payfees" data-id='<?= $row["username"] ?>' data-name='<?= $row["name"] ?>' data-matrix='<?= $row["matric"] ?>' data-course='<?= $row["course"] ?>' data-section='<?= $row["section"] ?>' data-balance='<?= $row["outstanding"] ?>'>
                                            <i class='fa fa-usd'></i>Take Fee</button>
                                        <a href="viewReport.php?username=<?= $row["username"] ?>" class="btn btn-primary btn-sm">
                                            <i class='fa fa-file-text'></i>Transaction Record</a>
                                    </td>
                                </tr>



                            <?php $num++;
                                    }
                                }
                            } elseif (isset($_POST["ssection"])) {
                                $search_value = $_POST["section"];
                                include "dbConnect.php";
                                if ($conn->connect_error) {
                                    echo 'Connection Faild: ' . $conn->connect_error;
                                } else {
                                    $sql = "SELECT * FROM student WHERE section LIKE '%$search_value%' ORDER BY name ASC";

                                    $res = $conn->query($sql);
                                    $num = 1; ?>
                        <tbody>
                            <?php while ($row = $res->fetch_assoc()) { ?>
                                <tr>
                                    <td><?= $num ?></td>
                                    <td><?= $row["name"] ?></td>
                                    <td><?= $row["matric"] ?></td>
                                    <td><?= $row["email"] ?></td>
                                    <td><?= $row["pnum"] ?></td>
                                    <td><?= $row["course"] ?></td>
                                    <td><?= $row["section"] ?></td>
                                    <?php if ($row["outstanding"] > 0) { ?>
                                        <td align="center" style="color: red">RM<?= $row["outstanding"] ?></td>
                                    <?php } else { ?>
                                        <td align="center">RM<?= $row["outstanding"] ?></td>
                                    <?php } ?>
                                    <td style="text-align: center;">
                                        <button type='button' class='btn btn-primary btn-sm' data-toggle="modal" data-target="#payfees" data-id='<?= $row["username"] ?>' data-name='<?= $row["name"] ?>' data-matrix='<?= $row["matric"] ?>' data-course='<?= $row["course"] ?>' data-section='<?= $row["section"] ?>' data-balance='<?= $row["outstanding"] ?>'>
                                            <i class='fa fa-usd'></i>Take Fee</button>
                                        <a href="viewReport.php?username=<?= $row["username"] ?>" class="btn btn-primary btn-sm">
                                            <i class='fa fa-file-text'></i>Transaction Record</a>
                                    </td>
                                </tr>
                            <?php $num++;
                                    }
                                }
                            } else {
                                include "dbConnect.php";
                                if ($conn->connect_error) {
                                    echo 'Connection Faild: ' . $conn->connect_error;
                                } else {
                                    $sql = "SELECT * FROM student ORDER BY name ASC";

                                    $res = $conn->query($sql);
                                    $num = 1; ?>
                        <tbody>
                            <?php while ($row = $res->fetch_assoc()) { ?>
                                <tr>
                                    <td><?= $num ?></td>
                                    <td><?= $row["name"] ?></td>
                                    <td><?= $row["matric"] ?></td>
                                    <td><?= $row["email"] ?></td>
                                    <td><?= $row["pnum"] ?></td>
                                    <td><?= $row["course"] ?></td>
                                    <td><?= $row["section"] ?></td>
                                    <?php if ($row["outstanding"] > 0) { ?>
                                        <td align="center" style="color: red">RM<?= $row["outstanding"] ?></td>
                                    <?php } else { ?>
                                        <td align="center">RM<?= $row["outstanding"] ?></td>
                                    <?php } ?>
                                    <td style="text-align: center;">
                                        <button type='button' class='btn btn-primary btn-sm' data-toggle="modal" data-target="#payfees" data-username='<?= $row["username"] ?>' data-name='<?= $row["name"] ?>' data-matric='<?= $row["matric"] ?>' data-course='<?= $row["course"] ?>' data-section='<?= $row["section"] ?>' data-outstanding='<?= $row["outstanding"] ?>'>
                                            <i class='fa fa-usd'></i>Take Fee</button>
                                        <a href="viewReport.php?username=<?= $row["username"] ?>" class="btn btn-primary btn-sm">
                                            <i class='fa fa-file-text'></i>Transaction Record</a>
                                    </td>
                                </tr>
                    <?php $num++;
                            }
                        }
                    }
                    ?>
                        </tbody>
            </table>
        </div> <!-- Modal -->
        <div class="modal fade" id="payfees" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Take Fee</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" style="min-height: 350px; ">
                        <form id="form_modal" action="recordFee.php" method="POST" class="form-container">
                            <input type="text" name="username" value="" hidden>
                            <div class="form-group row">
                                <label class="control-label col-sm-4" for="name">Name:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="name" disabled>
                                </div>
                            </div><br>

                            <div class="form-group row">
                                <label class="control-label col-sm-4" for="matric">Matric
                                    No:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="matric" disabled>
                                </div>
                            </div><br>

                            <div class="form-group row">
                                <label for="course" class="control-label col-sm-4">Course
                                    Taken</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="course" disabled>
                                </div>
                            </div><br>

                            <div class="form-group row">
                                <label class="control-label col-sm-4" for="section">Section:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="section" disabled>
                                </div>
                            </div><br>

                            <div class="form-group row">
                                <label class="control-label col-sm-4" for="outstanding">Outstanding Fee:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="outstanding" disabled>
                                </div>
                            </div><br>

                            <div class="form-group row">
                                <label class="control-label col-sm-4" for="paid">Paid:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="paid" onkeypress="return isNumberKey(event)" required>
                                </div>
                            </div><br>

                            <div class="form-group row">
                                <label class="control-label col-sm-4" for="date">Payment Date:</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" name="date" required>
                                </div>
                            </div><br>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="remark">Remark:</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="transaction_remark" required></textarea>
                                </div>
                            </div><br><br>

                            <div class="modal-footer">
                                <input type="submit" name="save" class="btn btn-info" value="Save" />
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <!-- End Modal -->


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
        $('#payfees').on('show.bs.modal', function(e) {
            var username = $(e.relatedTarget).data('username');
            $(e.currentTarget).find('input[name="username"]').val(username);

            var name = $(e.relatedTarget).data('name');
            $(e.currentTarget).find('input[name="name"]').val(name);

            var matric = $(e.relatedTarget).data('matric');
            $(e.currentTarget).find('input[name="matric"]').val(matric);

            var course = $(e.relatedTarget).data('course');
            $(e.currentTarget).find('input[name="course"]').val(course);

            var section = $(e.relatedTarget).data('section');
            $(e.currentTarget).find('input[name="section"]').val(section);

            var outstanding = $(e.relatedTarget).data('outstanding');
            $(e.currentTarget).find('input[name="outstanding"]').val(outstanding);


        });
    </script>
</body>

</html>