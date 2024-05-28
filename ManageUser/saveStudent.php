<script>
function successful() {
    alert("Student Edited!"); // this is the message in ""
    window.location = "student.php";
}
</script>
<?php
include 'dbConnect.php';
$username = $_GET["username"];
$name = $_GET["name"];
$icno = $_GET["icno"];
$school = $_GET["school"];
$year = $_GET["year"];
$email = $_GET["email"];
$pnum = $_GET["num"];
$matric = $_GET["matric"];
$national = $_GET["national"];
$course = $_GET["course"];
$section = $_GET["section"];


$sql = "UPDATE student SET name='$name', icno='$icno', school='$school', year='$year', email='$email', pnum='$pnum', matric='$matric', national='$national', course='$course', section='$section' WHERE username='$username'";
if ($conn->query($sql) === TRUE) {
    $sql = "UPDATE studentlogin SET email='$email' WHERE username='$username'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
		successful();
		</script>";
    } else {
        echo "eno" . mysqli_error($conn);
    }
} else {
    echo "eno" . mysqli_error($conn);
}