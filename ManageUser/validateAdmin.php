<script>
function successful() {
    alert("User is added!"); // this is the message in ""
    window.location = "admin.php";
}

function errorUser() {
    alert("Username already existed! Try another!"); // this is the message in ""
    window.location = "addAdmin.php";
}

function errorEmail() {
    alert("Email already used! Try another!"); // this is the message in ""
    window.location = "addAdmin.php";
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
    $role = $_GET["role"];

    include 'dbConnect.php';


    $sql_u = "SELECT * FROM admin WHERE username='$userid'";
    $res_u = mysqli_query($conn, $sql_u);

    if (mysqli_num_rows($res_u) > 0) {
        echo "<script>
			errorUser();
			</script>";
    } else {
        $sql_u = "SELECT * FROM admin WHERE email='$email'";
        $res_u = mysqli_query($conn, $sql_u);

        if (mysqli_num_rows($res_u) > 0) {
            echo "<script>
			errorEmail();
            </script>";
        } else {
            $sql = "INSERT INTO admin(username, name, icno, school, year, email, pnum, password, matric, role) VALUES ('$userid', '$name', '$icno','$school','$year','$email','$pnum','$pw','$matric','$role')";
            if ($conn->query($sql) === TRUE) {
                $sql = "INSERT INTO adminlogin (username, passwords, email) VALUES ('$userid', '$pw', '$email')";
                if ($conn->query($sql) === TRUE) {
                    if ($role == "Tutor") {
                        $sql = "INSERT INTO tutor (name, email) VALUES ('$name', '$email')";
                        if ($conn->query($sql) === TRUE) {
                            echo "<script>
			                successful();
			                </script>";
                        } else {
                            echo "eno" . mysqli_error($conn);
                        }
                    } else {
                        echo "<script>
			            successful();
			            </script>";
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