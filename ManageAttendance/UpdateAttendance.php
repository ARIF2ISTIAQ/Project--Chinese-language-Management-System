<script>
function successful() {
    alert("Successfully saved"); // this is the message in ""
    window.location.href = "ManualAttendance.php?section=<?= $_GET['section'] ?>";
}
</script>
<?php
if (isset($_GET['save'])) {
    $w1 = $_GET["w1"];
    $w2 = $_GET["w2"];
    $w3 = $_GET["w3"];
    $w4 = $_GET["w4"];
    $w5 = $_GET["w5"];
    $w6 = $_GET["w6"];
    $w7 = $_GET["w7"];
    $w8 = $_GET["w8"];
    $section = $_GET["section"];
    $matric = $_GET["matric"];
    include 'dbConnect.php';

    $sql = "UPDATE $section SET week1='$w1',week2='$w2',week3='$w3',week4='$w4',week5='$w5',week6='$w6',week7='$w7',week8='$w8' where matric='$matric'";
    $result = $conn->query($sql);
    if (mysqli_query($conn, $sql)) {
        echo '<script type="text/javascript">',
            'successful();',
            '</script>';
    } else { }
}
?>