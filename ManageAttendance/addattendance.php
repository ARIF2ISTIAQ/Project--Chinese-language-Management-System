<?php

$matric = $_POST["x"];;
$section = $_POST["y"];
$week = $_POST["z"];

if ($matric != null && $matric != "unknown") {

    include 'dbConnect.php';
    $sql = "SELECT * FROM $section WHERE matric='$matric'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $studentname = $row["name"];
        $sql1 = "UPDATE $section SET $week='Present' where matric='$matric'";
        $result1 = $conn->query($sql1);
        if (mysqli_query($conn, $sql1)) {
            $text = $studentname . " " . $matric . " attendance is recorded.";
            echo "<h5>" . $text . "</h5>";
            echo "
			 <script>
			 alert('$text');
			 </script>";
        } else {
            echo "
            <script>
            alert('The Matric Number is not found.');
            </script>";
        }
    }
}