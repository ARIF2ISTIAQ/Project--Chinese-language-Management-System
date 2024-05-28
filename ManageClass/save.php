<script>
function successful() {
    alert("Class Edited!"); // this is the message in ""
    window.location = "manageClass.php";
}
</script>
<?php
include 'dbConnect.php';
$ses = $_GET["ses"];
$course = $_GET["course"];
$section = $_GET["section"];
$medium = $_GET["medium"];
$sdate = $_GET["startdate"];
$day = $_GET["day"];
$tutor = $_GET["tutor"];

$sql = "UPDATE course SET course='$course', medium='$medium', sdate='$sdate', section='$section', day='$day', tutor='$tutor' WHERE section='$ses'";
if ($conn->query($sql) === TRUE) {
    echo "<script>
		successful();
		</script>";
} else {
    echo "eno" . mysqli_error($conn);
}