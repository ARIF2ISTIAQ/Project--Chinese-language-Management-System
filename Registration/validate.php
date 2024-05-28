<script>
function successful() {
    alert("Please select available course"); // this is the message in ""
    window.location = "course.php?userid=<?= $_POST['userid'] ?>";
}

function errorUser() {
    alert("Username already existed! Try another!"); // this is the message in ""
    window.location = "registration.php";
}

function errorEmail() {
    alert("Email already used! Try another!"); // this is the message in ""
    window.location = "registration.php";
}
</script>
<?php
if (isset($_POST['submitButton'])) {
    $userid = $_POST["userid"];
    $pw = $_POST["password"];
    $pw = password_hash($pw, PASSWORD_DEFAULT);
    $fname = $_POST["name"];
    $icno = $_POST["icno"];
    $national = $_POST["national"];
    $school = $_POST["school"];
    $year = $_POST["year"];
    $email = $_POST["email"];
    $pnum = $_POST["num"];
    $matric = $_POST["matric"];

    include 'dbConnect.php';


    $sql_u = "SELECT * FROM student WHERE username='$userid'";
    $res_u = mysqli_query($conn, $sql_u);

    if (mysqli_num_rows($res_u) > 0) {
        echo "<script>
			errorUser();
			</script>";
    } else {
        $sql_u = "SELECT * FROM student WHERE email='$email'";
        $res_u = mysqli_query($conn, $sql_u);

        if (mysqli_num_rows($res_u) > 0) {
            echo "<script>
			errorEmail();
            </script>";
        } else {
            $name = $_FILES['image']['name'];
            $target_dir = "../Profile/StudentPhoto/";
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
                    $sql = "INSERT INTO student(username, name, icno, national, school, year, email, pnum, password, matric, image) VALUES ('$userid', '$fname', '$icno','$national','$school','$year','$email','$pnum','$pw','$matric','$image')";

                    if ($conn->query($sql) === TRUE) {
                        // Upload file
                        copy($_FILES['image']['tmp_name'], $target_file);

                        $sql = "INSERT INTO studentlogin (username, passwords, email) VALUES ('$userid', '$pw', '$email')";
                        if ($conn->query($sql) === TRUE) {
                            $filename = $_POST["matric"];
                            $target_dir = "../ManageAttendance/labeled_images/" . $filename . "/";

                            //Check if the directory already exists.
                            if (!is_dir($target_dir)) {
                                //Directory does not exist, so lets create it.
                                mkdir($target_dir, 0755, true);
                            }
                            //$target_dir = "labeled_images/".$filename."/";
                            $target_file1 = $target_dir . basename($_FILES["image"]["name"]);
                            $target_file2 = $target_dir . basename($_FILES["image2"]["name"]);

                            // Select file type
                            $imageFileType1 = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));
                            $imageFileType2 = strtolower(pathinfo($target_file2, PATHINFO_EXTENSION));

                            // Valid file extensions
                            $extensions_arr = array("jpg", "jpeg", "png", "gif");

                            // Check extension
                            if (in_array($imageFileType1, $extensions_arr)) {

                                // Upload file
                                move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . "1." . $imageFileType1);
                            }
                            if (in_array($imageFileType2, $extensions_arr)) {

                                // Upload file
                                move_uploaded_file($_FILES['image2']['tmp_name'], $target_dir . "2." . $imageFileType2);
                            }
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
            }
        }
    }
}