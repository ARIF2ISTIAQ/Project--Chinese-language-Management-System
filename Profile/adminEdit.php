<script>
function successful() {
    alert("Information Saved!"); // this is the message in ""
    window.location = "adminProfile.php";
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


$sql = "UPDATE admin SET name='$name', icno='$icno', school='$school', year='$year', email='$email', pnum='$pnum', matric='$matric' WHERE username='$username'";
if ($conn->query($sql) === TRUE) {
    $sql = "UPDATE adminlogin SET email='$email' WHERE username='$username'";
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