<script>
function successful() {
    alert("Class Successfully Deleted"); // this is the message in ""
    window.location = "manageClass.php";
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
$section = $_GET['section'];

$query = "DELETE FROM course WHERE section = '$section'";
$result = mysqli_query($link, $query);

if (!$result) {
    echo ('Error deleting class: ');
    exit();
} else {
    $query = "DROP TABLE $section";
    $result = mysqli_query($link, $query);

    if (!$result) {
        echo ('Error deleting class: ');
        exit();
    } else {
        mysqli_close($link);
        echo '<script type="text/javascript">',
            'successful();',
            '</script>';
    }
}
?>