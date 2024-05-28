<script>
function successful() {
    alert(
        "Success! \nYou had changed your password ! \nPlease log in with your latest password changed!"
    ); // this is the message in ""
    window.location = "../../../index.php";
}
</script>
<?php

$msg = "";

if (isset($_POST['new_password'])) {
    $db = mysqli_connect('localhost', 'root', '', 'adproject');
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $new_pass = mysqli_real_escape_string($db, $_POST['new_pass']);
    $new_pass_c = mysqli_real_escape_string($db, $_POST['new_pass_c']);

    $newPasswordEncrypted = password_hash($new_pass, PASSWORD_DEFAULT);

    if ($new_pass != $new_pass_c) {
        $msg = "<p>Password do not match, both password should be same.<br /><br /></p>";
    }
    if ($msg != "") {
        echo "<div class='error'>" . $msg . "</div><br />";
    } else {
        $sql = "UPDATE adminlogin SET token='' WHERE email='$email'";
        $results = mysqli_query($db, $sql);
        $sql = "UPDATE adminlogin SET passwords='$newPasswordEncrypted' WHERE email='$email'";
        $results = mysqli_query($db, $sql);
        echo '<script type="text/javascript">',
            'successful();',
            '</script>';
    }
}