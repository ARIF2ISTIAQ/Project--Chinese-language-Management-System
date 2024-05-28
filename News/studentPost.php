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

</head>

<body>
    <?php
    include 'dbConnect.php';
    $username = $_SESSION['susername'];
    $sql = "SELECT * FROM student WHERE username='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $section = $row['section'];
        $matric = $row['matric'];
        ?>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="../StudentPage.php">HYBUTM</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php"
                            onclick="return  confirm('Are you sure want to Logout?')">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div id="main" class="container">

        <div class="row">

            <!-- Post Content Column -->
            <div class="col-lg-10">
                <div>


                    <?php if ($article && !empty($article)) : ?>

                    <h1 class="mt-4"><img src="../images/logo.png"
                            style="width:10%;height:10%;"><?= stripslashes($article->news_title) ?></h1>
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
                    <h4><a
                            href="studentPost.php?newsid=<?= $article->news_id ?>&username=<?= $username ?>"><?= stripslashes($article->news_title) ?></a>
                    </h4>
                    <p><?= nl2br(stripslashes($article->news_short_description)) ?></p>
                    <span>published on <?= date("m/d/Y H:i", strtotime($article->news_published_on)) ?> by
                        <?= stripslashes($article->news_author) ?></span>

                    <hr>
                    <?php endforeach ?>

                    <?php endif ?>

                </div>
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
    <script src="startbootstrap-blog-post-gh-pages/vendor/jquery/jquery.min.js"></script>
    <script src="startbootstrap-blog-post-gh-pages/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>