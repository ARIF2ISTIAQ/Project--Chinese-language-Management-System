<script>
function successful() {
    alert("Payment update successfully!"); // this is the message in ""
    window.location = "managePayment.php";
}
</script>
<?php

include("dbconnect.php");

if (isset($_POST['save'])) {
    $paid = $_POST['paid'];
    $paymentDate = $_POST['date'];
    $transaction_remark = $_POST['transaction_remark'];
    $username = $_POST['username'];

    $sql = "SELECT *  From student WHERE username = '$username'";
    $sq = $conn->query($sql);
    $sr = $sq->fetch_assoc();
    $outstanding = $sr['outstanding'];
    $ppaid = $sr['paid'];

    $toutstanding = $outstanding - $paid;
    $tpaid = $ppaid + $paid;
    $sql = "UPDATE student SET outstanding='$toutstanding', paid='$tpaid' WHERE username='$username'";
    if ($conn->query($sql) === TRUE) {
        $sql = "INSERT INTO payment(username, payment_date, transaction_remark, paid) VALUES ('$username','$paymentDate','$transaction_remark','$paid')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>
			successful();
            </script>";
        } else {
            echo "ERROR: Could not enter data." . mysqli_error($link);
        }
    } else {
        echo "ERROR: Could not enter data." . mysqli_error($link);
    }
} else {
    echo "ERROR: Could not enter data." . mysqli_error($link);
}