<script>
function successful() {
    alert("Image Changed!"); // this is the message in ""
    window.location = "studentProfile.php";
}
</script>

<?php
include 'dbConnect.php';
$username = $_POST["username"];
$sql = "SELECT * FROM student WHERE username='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0)
    $row = $result->fetch_assoc();
$matric = $row['matric'];

$name = $_FILES['image']['name'];
$target_dir = "StudentPhoto/";
$extension = pathinfo($name, PATHINFO_EXTENSION);
$new = $matric . '.' . $extension;
$target_file = $target_dir . $new;

// Select file type
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Valid file extensions
$extensions_arr = array("jpg", "jpeg", "png", "gif");
// Check extension
if (in_array($imageFileType, $extensions_arr) || ($name == "")) {

    // Convert to base64
    if ($name != "") {
        $image_base64 = base64_encode(file_get_contents($_FILES['image']['tmp_name']));
        $image = 'data:image/' . $imageFileType . ';base64,' . $image_base64;

        // Insert record
        $sql = "UPDATE student SET image='$image' WHERE username='$username'";

        if ($conn->query($sql) === TRUE) {
            // Upload file
            move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
            echo "<script>
		successful();
		</script>";
        } else {
            echo "eno" . mysqli_error($conn);
        }
    }
}