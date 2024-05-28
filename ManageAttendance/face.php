<?php

//The directory (relative to this file) that holds the images
$dir = "labeled_images";


//This array will hold all the image addresses
$result = array();

//Get all the files in the specified directory
$files = scandir($dir);


foreach ($files as $file) {


    $result[] = $file;
}

//Convert the array into JSON
json_encode($result);

$section = $_GET["section"];
$week = $_GET["week"];
echo "
    <input type='hidden' id='hideclass' name='section' value='" . $section . "'>
    <input type='hidden' id='hideweek' name='week' value='" . $week . "' >";
?>

<!DOCTYPE html>
<html lang="en">


<?php //require __DIR__ . '/../connectDB/functions.php' 
?>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Face Recognition Attendance</title>

    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="face-api.min.js"></script>


    <!-- Bootstrap core CSS -->
    <link href="../startbootstrap-blog-home-gh-pages/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="../startbootstrap-blog-home-gh-pages/css/blog-home.css" rel="stylesheet">
    <style>
        body {
            font-family: "Lato", sans-serif;
            height: inherit;
            min-height: 639px;
        }

        canvas {
            position: absolute;
            top: 242px;
            left: 480px;
        }

        .column {
            float: left;
            /* width: 600px;*/
            padding: 10px;
            height: 100px;
            /* Should be removed. Only for demonstration */
            text-align: center;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 50px;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 20px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        #main {
            transition: margin-left .5s;
            padding: 16px;
            height: -webkit-fill-available;
        }

        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
                font-size: 18px;
            }
        }
    </style>

</head>

<body>
    <div id="mySidenav" class="sidenav">
        <br><br>
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a class="nav-link" href="../News/ManageNews.php">Manage News</a>
        <a class="nav-link" href="../ManageApplication/manageApp.php">Manage Application</a>
        <a class="nav-link" href="../ManageUser/user.php">Manage User</a>
        <a class="nav-link" href="../ManageClass/manageClass.php">Manage Class</a>
        <a class="nav-link" href="AttendanceOption.php">Manage Attendance</a>
        <a class="nav-link" href="../Grade/ManageGrade.php">Manage Grade</a>
        <a class="nav-link" href="../Payment/managePayment.php">Manage Payment</a>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <button class="btn btn-dark" onclick="openNav()"><i class="navbar-toggler-icon"></i></button>&nbsp;&nbsp;
            <a class="navbar-brand" href="../AdminPage.php">HYBUTM</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <!-- Page Content -->
    <div id="main" class="container" style="min-height: 1000px;">

        <!-- Content Entries Column -->
        <div>
            <h2 class="my-4">Class
                <small>ATTENDANCE</small>
            </h2>
            <h4>Face Recognition</h4>
            <hr>
        </div>

        <br>
        <div class="row">
            <video id="video" width="540" height="420" autoplay muted style="position:relative;margin:auto;border:double;"></video>

        </div>
        <div class="row">
            <div class="column" style="width:250px;margin-left:300px;">
                <form id="myForm" method="post">
                    <div class="form-group row">
                        <h4>Result:</h4>
                        <input type="text" class="form-control" name="name" id="aname" disabled>
                    </div>
                </form>
            </div>

        </div>
        <div class="row" style="width:250px;margin-left:300px;">
            <div id="display"> </div>

        </div>
    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Follow Us:
                <a href="http://wwww.facebook.com/hybutm" target="_blank">
                    <img src="../images/fb-art.png" alt="FaceBook Page" style="width:30px;height:30px;" id="fb">FaceBook
                </a>

                <a href="https://www.instagram.com/hybutm/" target="_blank">
                    <img src="../images/ig-logo-email.png" alt="Instagram" style="width:30px;height:30px;" id="Insta">Instagram
                </a></p>
        </div>
        <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="../startbootstrap-blog-home-gh-pages/vendor/jquery/jquery.min.js"></script>
    <script src="../startbootstrap-blog-home-gh-pages/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginLeft = "auto";
        }
    </script>
    <script type="text/javascript">
        const video = document.getElementById('video')

        Promise.all([
            faceapi.nets.tinyFaceDetector.loadFromUri('models'),
            faceapi.nets.faceLandmark68Net.loadFromUri('models'),
            faceapi.nets.faceRecognitionNet.loadFromUri('models'),
            faceapi.nets.faceExpressionNet.loadFromUri('models'),
            faceapi.nets.ssdMobilenetv1.loadFromUri('models')
        ]).then(startVideo)

        var faceMatcher;

        function startVideo() {
            navigator.getUserMedia({
                    video: {}
                },
                stream => video.srcObject = stream,
                err => console.error(err)
            )

            const labeledFaceDescriptors = loadLabeledImages().then(labeledFaceDescriptors =>
                faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors, 0.6));
        }

        function loadLabeledImages() {

            //var httpReq = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");


            var labels = <?php echo json_encode($result); ?>

            labels = labels.filter(function(element) {
                return element !== ".";
            });
            labels = labels.filter(function(element) {
                return element !== "..";
            });
            return Promise.all(
                labels.map(async label => {
                    const descriptions = []
                    for (let i = 1; i <= 2; i++) {
                        console.log(`labeled_images/${label}/${i}.jpg`);
                        const img = await faceapi.fetchImage(`labeled_images/${label}/${i}.jpg`);
                        const detections = await faceapi.detectSingleFace(img).withFaceLandmarks()
                            .withFaceDescriptor()
                        descriptions.push(detections.descriptor)
                    }

                    return new faceapi.LabeledFaceDescriptors(label, descriptions)
                })
            )
        }

        video.addEventListener('play', () => {
            const canvas = faceapi.createCanvasFromMedia(video)
            document.body.append(canvas)
            const displaySize = {
                width: video.width,
                height: video.height
            }
            faceapi.matchDimensions(canvas, displaySize)
            setInterval(async () => {
                const detections = await faceapi.detectAllFaces(video, new faceapi
                        .TinyFaceDetectorOptions()).withFaceLandmarks().withFaceExpressions()
                    .withFaceDescriptors()
                console.log(detections)
                const resizedDetections = faceapi.resizeResults(detections, displaySize)
                console.log(resizedDetections);
                canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height)
                faceapi.draw.drawDetections(canvas, resizedDetections)
                faceapi.draw.drawFaceLandmarks(canvas, resizedDetections)
                faceapi.draw.drawFaceExpressions(canvas, resizedDetections)



                const results = resizedDetections.map(d => faceMatcher.findBestMatch(d.descriptor))
                console.log(results);

                const text = [
                    results[0]._label
                ]
                document.getElementById("aname").placeholder = text;
                //document.getElementById("myForm").submit();
                //var pdate = $("#pdate").val();
                //var name = docuument.getElementById("aname").placeholder;
                var x = document.getElementById("aname").placeholder;
                var y = document.getElementById("hideclass").value;
                var z = document.getElementById("hideweek").value;
                $.post("addattendance.php", {
                        x: x,
                        y: y,
                        z: z
                    },
                    function(data) {
                        $('#display').html(data);
                        $('#myForm')[0].reset();
                    });
                var div = document.getElementById("student");
                var myData = div.textContent;
                const anchor = {
                    x: 0,
                    y: 0
                }

                const drawOptions = {
                    anchorPosition: 'TOP_LEFT',
                    backgroundColor: 'rgba(0, 0, 0, 0.5)'
                }
                const drawBox = new faceapi.draw.DrawTextField(myData, anchor, drawOptions)
                drawBox.draw(canvas)
            }, 100)
        })
    </script>
</body>

</html>