<?php

session_start();
include("dbconnect.php");

$username = $_GET['username'];
$query1 = "select * from student where username='$username'";
$result = $conn->query($query1);

while ($rowS = mysqli_fetch_array($result)) {
  echo '
           
                <div class="modal-dialog modal-lg">
                  <div id="divToPrint" class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Fees Details</h4>
                    </div>
                    <div class="modal-body">
                    <h4>Student Info</h4>

                        <div class="table-responsive">
                        <table class="table table-bordered">
                        <tr>
                        <th>Name</th>
                        <td>' . $rowS['name'] . '</td>
                        <th>Matric Number</th>
                        <td>' . $rowS['matric'] . '</td>
                        </tr>
                        <tr>
                        <th>Course</th>
                        <td>' . $rowS['course'] . '</td>
                        <th>Section</th>
                        <td>' . $rowS['section'] . '</td>
                        </tr>
                        </table>
                        </div> ';
}
echo '       <h4>Fee Info</h4>
                          <div class="table-responsive">
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th>Date</th>
                                <th>Paid</th>
                                <th>Remark</th>
                              </tr>
                            </thead>
                        <tbody>';

$sql = "select * from payment  where username='$username'";
$result = $conn->query($sql);
while ($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . date("d-m-Y", strtotime($row['payment_date'])) . "</td>";
  echo "<td>" . $row['paid'] . "</td>";
  echo "<td>" . $row['transaction_remark'] . "</td>";
  echo "</tr>";
}
echo '      </tbody>
                        </table>
                        </div> 
                        <br>
                        
                        <table style="width:300px;" >';

$sql = "select * from student where username='$username'";
$result = $conn->query($sql);
while ($row = mysqli_fetch_array($result)) {
  $totalFee = $row['paid'] + $row['outstanding'];
  echo '
                            <tr>
                            <th>Total Fees: </th>
                            <td>RM' . $totalFee . '</td>
                            </tr>
                            <tr>
                            <th>Total Paid: </th>
                            <td>RM' . $row['paid'] . '</td>
                            </tr>
                            <tr>
                            <th>Outstanding FEE: </th>
                            <td>RM' . $row['outstanding'] . '</td>
                            </tr>
                            </table>
                            <hr>
                            <p>Prepared By:<br> HYBUTM</p>';
}

echo '      </div>
                  <div class="modal-footer">
                    <button onClick="window.print()" class="btn btn-info" >Print </button>
                    <a href="managePayment.php"><button type="button" class="btn btn-danger" data-dismiss="modal">Back</button>
                  </div>
                  
                </div>
                </div>';


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Fees Details</title>

    <!-- Bootstrap core CSS -->
    <link href="../startbootstrap-blog-home-gh-pages/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="../startbootstrap-blog-home-gh-pages/css/blog-home.css" rel="stylesheet">

    <!-- Bootstrap core JavaScript -->
    <script src="../startbootstrap-blog-home-gh-pages/vendor/jquery/jquery.min.js"></script>
    <script src="../startbootstrap-blog-home-gh-pages/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</head>

</html>