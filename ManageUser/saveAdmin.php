<script>
function successful() {
    alert("User Edited!"); // this is the message in ""
    window.location = "admin.php";
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
$role = $_GET["role"];


$sql = "UPDATE admin SET name='$name', icno='$icno', school='$school', year='$year', email='$email', pnum='$pnum', matric='$matric', role='$role' WHERE username='$username'";
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