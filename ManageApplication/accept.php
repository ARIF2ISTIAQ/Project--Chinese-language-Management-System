<script>
function successful() {
    alert("Application Accepted!"); // this is the message in ""
    window.location = "manageApp.php";
}
</script>
<?php
include 'dbConnect.php';
$username = $_GET["username"];

$sql = "UPDATE student SET status = 'Accepted' WHERE username = '$username'";
if ($conn->query($sql) === TRUE) {
    $sql = "SELECT * FROM student WHERE username='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $matric = $row['matric'];
        $section = $row['section'];
        $sql = "INSERT INTO $section(name, matric) VALUES ('$name','$matric')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>
            successful();
            </script>";
        } else {
            echo "eno" . mysqli_error($conn);
        }
    }
} else {
    echo "eno" . mysqli_error($conn);
}