<script>
function successful() {
    alert("News Successfully Deleted"); // this is the message in ""
    window.location = "DeleteNews.php";
}
</script>
<?php
$link = mysqli_connect("localhost", "root", "");
if (!$link) {
    echo ('Error connecting to the database: ');
    exit();
}
$db = mysqli_select_db($link, 'adproject');
if (!$db) {
    echo ('Error selecting database: ');
    exit();
}
$id_article = (int) $_GET['newsid'];

$query = "DELETE FROM info_news WHERE news_id = '$id_article'";
$result = mysqli_query($link, $query);

if (!$result) {
    echo ('Error deleting news: ');
    exit();
} else {
    mysqli_close($link);
    echo '<script type="text/javascript">',
        'successful();',
        '</script>';
}
?>