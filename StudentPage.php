<!DOCTYPE html>
<html lang="en">

<?php session_start() ?>
<?php require __DIR__ . '/connectDB/functions.php' ?>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>HOME PAGE</title>

    <!-- Bootstrap core CSS -->
    <link href="startbootstrap-blog-home-gh-pages/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="startbootstrap-blog-home-gh-pages/css/blog-home.css" rel="stylesheet">

</head>

<body>
    <?php
    include 'dbConnect.php';
    $username = $_SESSION['susername'];
    $sql = "SELECT * FROM student WHERE username='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="StudentPage.php">HYBUTM</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php"
                            onclick="return  confirm('Are you sure want to Logout?')">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <!-- Page Content -->
    <div id="main" class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="my-4"><img src="images/logo.png" style="width:10%;height:10%;">UTM
                    <small>MANDARIN CLASS</small>
                </h1>
                <p>Welcome to UTM Mandarin Class. <em>Learning Mandarin is fun!</em></p>
                <h2 class="my-4">Latest
                    <small>NEWS</small>
                </h2>
                <hr>

                <!-- Blog Post -->
                <div class="col-lg-8">
                    <?php
                            // get the database handler
                            $dbh = connect_to_db(); // function created in dbconnect, remember?
                            // Fecth news
                            $news = fetchNews($dbh);
                            ?>

                    <?php if ($news && !empty($news)) : ?>

                    <?php foreach ($news as $key => $article) : ?>
                    <h3><a
                            href="News/studentPost.php?newsid=<?= $article->news_id ?>"><?= stripslashes($article->news_title) ?></a>
                    </h3>
                    <p><?= stripslashes($article->news_short_description) ?></p>
                    <span>published on <?= date("m/d/Y H:i", strtotime($article->news_published_on)) ?> by
                        <?= stripslashes($article->news_author) ?></span>
                    <hr>
                    <?php endforeach ?>

                    <?php endif ?>
                </div>
            </div>


            <!-- Sidebar Widgets Column -->
            <div class="col-md-4" style="text-align: right;">
                <br><br>
                <h3>Welcome <br> <?= $row['name'] ?></h3>
                <img id="blah" src="<?= $row['image'] ?>" style="width:200px; height:auto; border:double;">
                <br><br>
                <a href="Profile/studentProfile.php" style="font-size: 25px;">View Profile</a>
                <br><br>
                <?php if ($row['outstanding'] > 0) { ?>
                <h5 style="color:red">Outstanding Fee: RM<?= $row['outstanding'] ?></h5>
                <?php } ?>
                <?php } ?>
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
                    <img src="images/fb-art.png" alt="FaceBook Page" style="width:30px;height:30px;" id="fb">FaceBook
                </a>

                <a href="https://www.instagram.com/hybutm/" target="_blank">
                    <img src="images/ig-logo-email.png" alt="Instagram" style="width:30px;height:30px;"
                        id="Insta">Instagram
                </a></p>
        </div>
        <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="startbootstrap-blog-home-gh-pages/vendor/jquery/jquery.min.js"></script>
    <script src="startbootstrap-blog-home-gh-pages/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>