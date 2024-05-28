<?php

$class = $_POST["c"];
$id = $_POST["content"];
$w = $_POST["w"];

$tablename = $class;
include 'dbConnect.php';
$sql = "select * from " . $tablename . " where matric='$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $sql1 = "UPDATE " . $tablename . " SET " . $w . "='Present' where matric='" . $id . "'";
  $result1 = $conn->query($sql1);
  if (mysqli_query($conn, $sql1)) {
    $text = $row["name"] . " " . $row["matric"] . "attendance is recorded";
    echo "
			 <script>
			 alert('$text');
			 </script>
       ";
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }
} else {
  echo "
 			<script>
 			alert('The Matric Number is not found.');
 			</script>
       ";
}