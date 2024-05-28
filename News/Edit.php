<!DOCTYPE html>
<html lang="en">

<?php session_start() ?>
<?php require __DIR__ . '/../connectDB/functions.php' ?>
<?php
// get the database handler
$dbh = connect_to_db(); // function created in dbconnect, remember?

$id_article = (int) $_GET['newsid'];

if (!empty($id_article) && $id_article > 0) {
    // Fecth news
    $article = getAnArticle($id_article, $dbh);
    $article = $article[0];
} else {
    $article = false;
    echo "<strong>Wrong article!</strong>";
}

$other_articles = getOtherArticles($id_article, $dbh);

?>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Edit News</title>

    <!-- Bootstrap core CSS -->
    <link href="../startbootstrap-blog-home-gh-pages/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

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
        <a class="nav-link" href="ManageNews.php">Manage News</a>
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

        <div class="row">

            <!-- Form Entries Column -->
            <div class="col-md-8">

                <h1 class="my-4"><img src="../images/logo.png" style="width:10%;height:10%;">Edit
                    <small>NEWS</small>
                </h1>

                <!-- Title -->
                <div class="card mb-4">

                    <div class="card-body">
                        <form name="form1" method="post" action="EditFunction.php" enctype="multipart/form-data">
                            <h4>Title</h4>
                            <input type="hidden" name="id" value="<?= $article->news_id ?>">
                            <input type="text" class="form-control" name="title" value="<?= stripslashes($article->news_title) ?>" required>

                    </div>

                </div>

                <!-- Content -->
                <div class="card mb-4">

                    <div class="card-body" style="height:300px">
                        <h4>Short Description</h4>
                        <textarea class="form-control" row="5" style="height:200px" name="description" required><?= stripslashes($article->news_short_description) ?></textarea>
                    </div>

                </div>

                <div class="card mb-4">

                    <div class="card-body" style="height:300px">
                        <h4>Full Content</h4>
                        <textarea class="form-control" row="5" style="height:200px" name="content" required><?= stripslashes($article->news_full_content) ?></textarea>
                    </div>

                </div>

                <div class="card mb-4">

                    <div class="card-body">
                        <form name="form1" method="post" action="Create.php">
                            <h4>Author</h4>
                            <input type="text" class="form-control" name="author" value="<?= stripslashes($article->news_author) ?>" required>

                    </div>

                </div>

                <!-- Upload Image -->

                <script type="text/javascript">
                    function readURL(input) {

                        if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function(e) {
                                $('#blah').attr('src', e.target.result);
                            }

                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                </script>

                <div class="card mb-4">

                    <div class="card-body">
                        <h4>Select image to upload</h4>
                        <p>Upload news image if you want to change the previous image</p>
                        <p>Otherwise, do nothing in this field</p>
                        <img id="blah" src="#" alt="" style="width:30%;height:30%;" />
                    </div>
                    <div class="card-footer text-muted">
                        <input type="file" name="image" class="btn btn-primary" accept="image/*" onchange="readURL(this);">
                    </div>
                </div>

                <!-- Submit -->
                <ul class="pagination justify-content-center mb-4" style="float:right;">
                    <li class="page-item">
                        <input type="submit" value="Save" name="savebtn" class="btn btn-secondary">
                        <input type="button" value="Cancel" name="cancelbtn" class="btn btn-secondary" onclick="history.back();">
                    </li>
                </ul>
                </form>
            </div>

            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Create Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Create News</h5>
                    <div class="card-body">
                        <div class="input-group">
                            <p>Need to post a news? Click <a href="CreateNews.php">HERE</a>
                        </div>
                    </div>
                </div>

                <!-- Edit Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Edit News</h5>
                    <div class="card-body">
                        <div class="input-group">
                            <p>Select a news to edit.</p>
                            <p>Remember to save your works after correction.</p>
                        </div>
                    </div>
                </div>

                <!-- Delete Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Delete News</h5>
                    <div class="card-body">
                        <div class="input-group">
                            <p>Expired news? Click <a href="DeleteNews.php">HERE</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- /.row -->

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
    <script src="startbootstrap-blog-home-gh-pages/vendor/jquery/jquery.min.js"></script>
    <script src="startbootstrap-blog-home-gh-pages/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
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