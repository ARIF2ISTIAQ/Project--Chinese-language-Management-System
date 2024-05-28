<script>
function successful() {
    alert("Password Changed"); // this is the message in ""
    window.location = "adminProfile.php";
}

function wrongOldPass() {
    alert("Old Password is wrong!!\nTry again"); // this is the message in ""
    window.history.back();
}

function passDiff() {
    alert("New password and confirm password are different!\nTry again"); // this is the message in ""
    window.history.back();
}
</script>

<?php
include 'dbConnect.php';
$username = $_POST["username"];
$oldpw = $_POST["oldPass"];
$newpw = $_POST["newPass"];
$conpw = $_POST["conPass"];

$sql = "SELECT * FROM admin WHERE username='$username'";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $pw = $row["password"];
    if (password_verify($oldpw, $pw)) {
        if ($newpw != $conpw) {
            echo "<script>
			    passDiff();
			    </script>";
        } else {
            $newPassword = password_hash($newpw, PASSWORD_DEFAULT);
            $sql = "UPDATE admin SET password='$newPassword' WHERE username='$username'";
            if ($conn->query($sql) === TRUE) {
                $sql = "UPDATE adminlogin SET passwords='$newPassword' WHERE username='$username'";
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
    } else {
        echo "<script>
			wrongOldPass();
			</script>";
    }
} else {
    echo "eno" . mysqli_error($conn);
}