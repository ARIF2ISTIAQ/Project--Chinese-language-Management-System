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

    <title><?= stripslashes($article->news_title) ?></title>
    <!-- Bootstrap core CSS -->
    <link href="../startbootstrap-blog-post-gh-pages/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../startbootstrap-blog-post-gh-pages/css/blog-post.css" rel="stylesheet">
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

            <!-- Post Content Column -->
            <div class="col-lg-8">
                <div>


                    <?php if ($article && !empty($article)) : ?>

                        <h1 class="mt-4"><img src="../images/logo.png" style="width:10%;height:10%;"><?= stripslashes($article->news_title) ?></h1>
                        <span>published on <?= date("m/d/Y H:i", strtotime($article->news_published_on)) ?> by
                            <?= stripslashes($article->news_author) ?></span>
                        <div>
                            <?php
                                $link = mysqli_connect("localhost", "root", "", "adproject");
                                $sql = "SELECT * FROM info_news WHERE news_id=" . $id_article;
                                $result = mysqli_query($link, $sql);
                                $output = '<br>';
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        if ($row['news_image'] != null) {
                                            $output .= '<img src="' . $row['news_image'] . '" height="50%" width="50%" style="border:double;"/><br><br>';
                                        }
                                    }
                                }
                                echo $output;
                                ?>

                            <p><?= nl2br(stripslashes($article->news_full_content)) ?></p>
                        </div>


                    <?php endif ?>
                </div>

                <hr>
                <hr>
                <h3>Other articles</h3>
                <div class="similar-posts">
                    <?php if ($other_articles && !empty($other_articles)) : ?>

                        <?php foreach ($other_articles as $key => $article) : ?>
                            <h4><a href="Post.php?newsid=<?= $article->news_id ?>"><?= stripslashes($article->news_title) ?></a>
                            </h4>
                            <p><?= nl2br(stripslashes($article->news_short_description)) ?></p>
                            <span>published on <?= date("m/d/Y H:i", strtotime($article->news_published_on)) ?> by
                                <?= stripslashes($article->news_author) ?></span>

                            <hr>
                        <?php endforeach ?>

                    <?php endif ?>

                </div>

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
                            <p>Something to edit? Click <a href="EditNews.php">HERE</a>
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
    <script src="startbootstrap-blog-post-gh-pages/vendor/jquery/jquery.min.js"></script>
    <script src="startbootstrap-blog-post-gh-pages/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
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