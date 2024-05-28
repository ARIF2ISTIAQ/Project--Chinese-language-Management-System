<script>
function successful() {
    alert("User Successfully Deleted"); // this is the message in ""
    window.location = "admin.php";
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
$username = $_GET['username'];

$query = "DELETE FROM admin WHERE username = '$username'";
$result = mysqli_query($link, $query);

if (!$result) {
    echo ('Error deleting class: ');
    exit();
} else {
    $query = "DELETE FROM adminlogin WHERE username = '$username'";
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