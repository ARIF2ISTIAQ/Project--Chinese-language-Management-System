<script>
function successful() {
    var id = "<?php echo $_GET['class_id'] ?>";
    alert("Successfully saved"); // this is the message in ""
    window.location.href = "grade.php?class_id=" + id;
}
</script>
<?php
if (isset($_GET['save'])) {

    $link = mysqli_connect("localhost", "root", "");
    if (!$link) {
        echo ('Error connecting to the database: ');
        exit();
    }
    $db = mysqli_select_db($link, 'adproject');
    if (!$db) {
        echo ('Error selecting database ');
        exit();
    }

    $class_id = $_GET["class_id"];
    $id = $_GET["id"];
    $q1 = (float) $_GET["q1"];
    $q2 = (float) $_GET["q2"];
    $assignment = (float) $_GET["assignment"];
    $project = (float) $_GET["project"];
    $final = (float) $_GET["final"];
    $attendance = (float) $_GET["attendance"];

    // if ($q1 == NULL || $q2 == NULL || $assignment == NULL || $project == NULL || $final == NULL || $attendance == NULL) {
    //     $query = "UPDATE students SET quiz1 = '$q1', quiz2 = '$q2', assignment = '$assignment', project = '$project', final = '$final', attendance = '$attendance' WHERE matric = '$id'";
    //     $result = mysqli_query($link, $query);
    // } else {
    $total = $q1 + $q2 + $assignment + $project + $final + $attendance;
    if ($total >= 80) {
        $grade = "A+";
    } else if ($total >= 75) {
        $grade = "A";
    } else if ($total >= 70) {
        $grade = "A-";
    } else if ($total >= 65) {
        $grade = "B+";
    } else if ($total >= 60) {
        $grade = "B";
    } else if ($total >= 55) {
        $grade = "B-";
    } else if ($total >= 50) {
        $grade = "C+";
    } else if ($total >= 45) {
        $grade = "C";
    } else if ($total >= 40) {
        $grade = "C-";
    } else {
        $grade = "F";
    }
    $query = "UPDATE " . $class_id . " SET quiz1 = '$q1', quiz2 = '$q2', assignment = '$assignment', project = '$project', final = '$final', attendance = '$attendance', total = '$total', grade = '$grade'  WHERE matric = '$id'";
    $result = mysqli_query($link, $query);
    // }

    if (!$result) {
        echo ('Error saving mark: ');
        exit();
    } else {
        mysqli_close($link);
        echo '<script type="text/javascript">',
            'successful();',
            '</script>';
    }
}
?>