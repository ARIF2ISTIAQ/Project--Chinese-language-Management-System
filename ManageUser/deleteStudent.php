<script>
function successful() {
    alert("Student Successfully Deleted"); // this is the message in ""
    window.location = "student.php";
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
$section = $_GET['section'];
$sql = "SELECT * FROM student WHERE username ='$username'";
$result = $link->query($sql);
$row = $result->fetch_assoc();
$matric = $row['matric'];

$query = "DELETE FROM student WHERE username = '$username'";
$result = mysqli_query($link, $query);

if (!$result) {
    echo ('Error deleting class: ');
    exit();
} else {
    $query = "DELETE FROM studentlogin WHERE username = '$username'";
    $result = mysqli_query($link, $query);

    if (!$result) {
        echo ('Error deleting class: ');
        exit();
    } else {
        $sql = "SELECT num FROM course WHERE section ='$section'";
        $result = $link->query($sql);
        $row = $result->fetch_assoc();
        $num = $row['num'];
        $num--;
        $sql = "UPDATE course SET num ='$num' WHERE section ='$section'";

        if ($link->query($sql) === false) {
            echo ('Error deleting class: ');
            exit();
        } else {
            $sql = "DELETE FROM $section WHERE matric='$matric'";

            if ($link->query($sql) === false) {
                echo ('Error deleting class: ');
                exit();
            } else {
                mysqli_close($link);
                echo '<script type="text/javascript">',
                    'successful();',
                    '</script>';
            }
        }
    }
}
?>