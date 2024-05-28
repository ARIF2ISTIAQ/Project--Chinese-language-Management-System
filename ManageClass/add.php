<script>
function successful() {
    alert("Class Created!"); // this is the message in ""
    window.location = "manageClass.php";
}

function error() {
    alert("Tutor already handle 2 classes!\nAssign other tutor for the class."); // this is the message in ""
    window.history.back();
}
</script>
<?php
include 'dbConnect.php';
$course = $_GET["course"];
$section = $_GET["section"];
$medium = $_GET["medium"];
$sdate = $_GET["startdate"];
$day = $_GET["day"];
$tutor = $_GET["tutor"];

$sql = "SELECT * FROM tutor WHERE name='$tutor'";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    $row = $res->fetch_assoc();
    $class1 = $row['class1'];
    $class2 = $row['class2'];

    if ($class1 == null) {
        $sql = "INSERT INTO course(course, medium, sdate, section, day, tutor) VALUES ('$course','$medium','$sdate','$section','$day','$tutor')";

        if ($conn->query($sql) === TRUE) {
            $sql = "CREATE TABLE $section (matric varchar(10) NOT NULL,
            name varchar(50) NOT NULL,
            week1 varchar(20) DEFAULT 'Absent',
            week2 varchar(20) DEFAULT 'Absent',
            week3 varchar(20) DEFAULT 'Absent',
            week4 varchar(20) DEFAULT 'Absent',
            week5 varchar(20) DEFAULT 'Absent',
            week6 varchar(20) DEFAULT 'Absent',
            week7 varchar(20) DEFAULT 'Absent',
            week8 varchar(20) DEFAULT 'Absent',
            quiz1 float DEFAULT NULL,
            quiz2 float DEFAULT NULL,
            assignment float DEFAULT NULL,
            project float DEFAULT NULL,
            final float DEFAULT NULL,
            attendance float DEFAULT NULL,
            total float DEFAULT NULL,
            grade varchar(5) DEFAULT NULL)";
            if ($conn->query($sql) === TRUE) {
                $sql = "ALTER TABLE $section
                ADD PRIMARY KEY (matric)";
                if ($conn->query($sql) === TRUE) {
                    $sql = "UPDATE tutor SET class1='$section' WHERE name='$tutor'";
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
            echo "eno" . mysqli_error($conn);
        }
    } elseif ($class2 == null) {
        $sql = "INSERT INTO course(course, medium, sdate, section, day, tutor) VALUES ('$course','$medium','$sdate','$section','$day','$tutor')";

        if ($conn->query($sql) === TRUE) {
            $sql = "CREATE TABLE $section (matric varchar(10) NOT NULL,
            name varchar(50) NOT NULL,
            week1 varchar(20) DEFAULT 'Absent',
            week2 varchar(20) DEFAULT 'Absent',
            week3 varchar(20) DEFAULT 'Absent',
            week4 varchar(20) DEFAULT 'Absent',
            week5 varchar(20) DEFAULT 'Absent',
            week6 varchar(20) DEFAULT 'Absent',
            week7 varchar(20) DEFAULT 'Absent',
            week8 varchar(20) DEFAULT 'Absent',
            quiz1 float DEFAULT NULL,
            quiz2 float DEFAULT NULL,
            assignment float DEFAULT NULL,
            project float DEFAULT NULL,
            final float DEFAULT NULL,
            attendance float DEFAULT NULL,
            total float DEFAULT NULL,
            grade varchar(5) DEFAULT NULL)";
            if ($conn->query($sql) === TRUE) {
                $sql = "ALTER TABLE $section
                ADD PRIMARY KEY (matric)";
                if ($conn->query($sql) === TRUE) {
                    $sql = "UPDATE tutor SET class2='$section' WHERE name='$tutor'";
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
            echo "eno" . mysqli_error($conn);
        }
    } else {
        echo "<script>
        error();
        </script>";
    }
} else {
    echo "eno" . mysqli_error($conn);
}