<script>
function successful() {
    alert("Registered Successfully"); // this is the message in ""
    window.location = "../index.php";
}
</script>
<?php
$course = $_GET["course"];
$userid = $_GET["userid"];
$section = $_GET["section"];
include 'dbConnect.php';
$sql = "SELECT num FROM course WHERE section ='$section'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$num = $row['num'];
$num++;
if ($num == 25) {
    $sql = "UPDATE course SET num ='$num', status='FULL' WHERE section ='$section' ";
    if ($conn->query($sql) === TRUE) {
        $sql = "UPDATE student SET course='$course',section='$section' WHERE username='$userid'";
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
} else {
    $sql = "UPDATE course SET num ='$num' WHERE section ='$section'";
    if ($conn->query($sql) === TRUE) {
        $sql = "UPDATE student SET course='$course',section='$section' WHERE username='$userid'";
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
}