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

    [type=radio] {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* IMAGE STYLES */
    [type=radio]+img {
        cursor: pointer;
    }

    .radioimg {
        height: 300px;
        width: 300px;
        padding: 20px;
        margin: 20px;
    }

    .column {
        float: left;
        width: 33%;
        padding: 10px;
        height: 100%;
        /* Should be removed. Only for demonstration */
        text-align: center;
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    /* CHECKED STYLES */
    [type=radio]:checked+img {
        outline: 5px solid #f00;
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
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
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
    <div id="main" class="container" style="min-height: 639px;">

        <?php
        // get the database handler

        ?>

        <!-- Grade Entries Column -->
        <div>
            <h2 class="my-4">Manage
                <small>ATTENDANCE</small>
            </h2>
            <hr>
        </div>


        <form method="get">
            <div class="row">
                <div class="form-group col-4">
                    <h5>Select Section:</h5>
                    <select name='section' id='section' class="form-control" style="width: 200px">
                        <?php
                        include 'dbConnect.php';
                        $sql = "SELECT * FROM course ORDER BY section ASC";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) { ?>
                        <option value="<?= $row["section"] ?>"><?= $row["section"] ?></option>
                        <?php }
                                                                } ?>
                    </select>
                </div>
                <div class="form-group col-4">
                    <h5>Select Week:</h5>
                    <select name="week" id="week" class="form-control" style="width: 100px">
                        <option value="week1">week 1</option>
                        <option value="week2">week 2</option>
                        <option value="week3">week 3</option>
                        <option value="week4">week 4</option>
                        <option value="week5">week 5</option>
                        <option value="week6">week 6</option>
                        <option value="week7">week 7</option>
                        <option value="week8">week 8</option>
                    </select>
                </div>
            </div>


            <div class="row">
                <div class="column">
                    <label>
                        <input type="radio" name="atdoption" value="face" checked>
                        <img class="radioimg" src="images/faceicon.jpg"><br>
                        <text>Face Recognition</text>
                    </label>
                </div>
                <div class="column">
                    <label>
                        <input type="radio" name="atdoption" value="qr">
                        <img class="radioimg" src="images/qrcode.png"><br>
                        <text>QR Code</text>
                    </label>
                </div>
                <div class="column">
                    <label>
                        <input type="radio" name="atdoption" value="manual">
                        <img class="radioimg" src="images/document.png"><br>
                        <text>Manual Manage Attendance</text>
                    </label>
                </div>
            </div>
            <div style="text-align:center;" class="row">
                <input type="button" style="display: block; margin: 0 auto;" value="Take Attendance"
                    class="btn btn-rounded btn-primary" onclick="selectOption()">
            </div>
        </form>


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
                    <img src="../images/ig-logo-email.png" alt="Instagram" style="width:30px;height:30px;"
                        id="Insta">Instagram
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
    <script>
    function selectOption() {

        var selection = document.querySelector('input[name="atdoption"]:checked').value;
        var s = document.getElementById("section");
        var section = s.options[s.selectedIndex].value;
        var w = document.getElementById("week");
        var week = w.options[w.selectedIndex].value;
        switch (selection) {
            case "face":
                window.location = "face.php?section=" + section + "&week=" + week;
                break;

            case "qr":
                window.location = "scanattendance.php?section=" + section + "&week=" + week;
                break;

            case "manual":
                window.location = "ManualAttendance.php?section=" + section;
                break;

            default:
                alert("Error!");
                break;
        }

    }
    </script>
</body>

</html>