<script>
function successful() {
    alert("Student is added!"); // this is the message in ""
    window.location = "student.php?";
}

function errorUser() {
    alert("Username already existed! Try another!"); // this is the message in ""
    window.location = "addStudent.php";
}

function errorEmail() {
    alert("Email already used! Try another!"); // this is the message in ""
    window.location = "addStudent.php";
}
</script>
<?php
if (isset($_GET['submitButton'])) {
    $userid = $_GET["userid"];
    $pw = $_GET["password"];
    $pw = password_hash($pw, PASSWORD_DEFAULT);
    $name = $_GET["name"];
    $icno = $_GET["icno"];
    $school = $_GET["school"];
    $year = $_GET["year"];
    $email = $_GET["email"];
    $pnum = $_GET["num"];
    $matric = $_GET["matric"];
    $national = $_GET["national"];
    $course = $_GET["course"];
    $section = $_GET["section"];

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
            $sql = "INSERT INTO student(username, name, icno, school, year, email, pnum, password, matric, national, course, section, status) VALUES ('$userid', '$name', '$icno','$school','$year','$email','$pnum','$pw','$matric','$national','$course','$section','Accepted')";
            if ($conn->query($sql) === TRUE) {
                $sql = "INSERT INTO studentlogin (username, passwords, email) VALUES ('$userid', '$pw', '$email')";
                if ($conn->query($sql) === TRUE) {
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
                                $sql = "INSERT INTO $section(name, matric) VALUES ('$name','$matric')";
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
                            echo "eno" . mysqli_error($conn);
                        }
                    } else {
                        $sql = "UPDATE course SET num ='$num' WHERE section ='$section'";
                        if ($conn->query($sql) === TRUE) {
                            $sql = "UPDATE student SET course='$course',section='$section' WHERE username='$userid'";
                            if ($conn->query($sql) === TRUE) {
                                $sql = "INSERT INTO $section(name, matric) VALUES ('$name','$matric')";
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
                            echo "eno" . mysqli_error($conn);
                        }
                    }
                } else {
                    echo "eno" . mysqli_error($conn);
                }
            } else {
                echo "eno" . mysqli_error($conn);
            }
        }
    }
}