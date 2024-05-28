<script>
function successful() {
    alert("Application Rejected!"); // this is the message in ""
    window.location = "manageApp.php";
}
</script>
<?php
include 'dbConnect.php';
$username = $_GET["username"];

$sql = "UPDATE student SET status = 'Rejected' WHERE username = '$username'";
if ($conn->query($sql) === TRUE) {
    echo "<script>
		successful();
		</script>";
} else {
    echo "eno" . mysqli_error($conn);
}