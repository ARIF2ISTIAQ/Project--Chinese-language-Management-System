<script>
function successful() {
    alert("Information Saved!"); // this is the message in ""
    window.location = "studentProfile.php";
}
</script>
<?php
include 'dbConnect.php';
$username = $_POST["username"];
$name = $_POST["name"];
$icno = $_POST["icno"];
$school = $_POST["school"];
$year = $_POST["year"];
$email = $_POST["email"];
$pnum = $_POST["num"];
$matric = $_POST["matric"];
$national = $_POST["national"];


$sql = "UPDATE student SET name='$name', icno='$icno', school='$school', year='$year', email='$email', pnum='$pnum', matric='$matric', national='$national' WHERE username='$username'";
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