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
    navigator.getUserMedia({ video: {} },
            stream => video.srcObject = stream,
            err => console.error(err)
        )
        // faceMatcher = loadLabeledImages();
    const labeledFaceDescriptors = loadLabeledImages().then(labeledFaceDescriptors =>
        faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors, 0.6));
}

function loadLabeledImages() {

    var httpReq = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");

    //When it loads,
    httpReq.onload = function() {

        //Convert the result back into JSON
        var labels = <?php echo json_encode($sampleArray); ?>;
    }
    alert(labels[0]);
    //Request the page
    // try {
    //     httpReq.open("GET", "GetFiles.php", true);
    //     httpReq.send(null);
    // } catch (e) {
    //     console.log(e);
    // }
    alert("asfasfsa");
    return Promise.all(
        labels.map(async label => {
            const descriptions = []
            for (let i = 1; i <= 2; i++) {
                const img = await faceapi.fetchImage(`labeled_images/${label}/${i}.jpg`);
                // `https://raw.githubusercontent.com/WebDevSimplified/Face-Recognition-JavaScript/master/labeled_images/${label}/${i}.jpg`)
                const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor()
                descriptions.push(detections.descriptor)
            }

            return new faceapi.LabeledFaceDescriptors(label, descriptions)
        })
    )
}

video.addEventListener('play', () => {
    const canvas = faceapi.createCanvasFromMedia(video)
    document.body.append(canvas)
    const displaySize = { width: video.width, height: video.height }
    faceapi.matchDimensions(canvas, displaySize)
    setInterval(async() => {
        const detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions()).withFaceLandmarks().withFaceExpressions().withFaceDescriptors()
        console.log(detections)
        const resizedDetections = faceapi.resizeResults(detections, displaySize)
        console.log(resizedDetections);
        canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height)
        faceapi.draw.drawDetections(canvas, resizedDetections)
        faceapi.draw.drawFaceLandmarks(canvas, resizedDetections)
        faceapi.draw.drawFaceExpressions(canvas, resizedDetections)



        // const displaySize = { width: image.width, height: image.height }
        // faceapi.matchDimensions(canvas, displaySize)
        // const detections = await faceapi.detectAllFaces(image).withFaceLandmarks().withFaceDescriptors()
        // const resizedDetections = faceapi.resizeResults(detections, displaySize)
        const results = resizedDetections.map(d => faceMatcher.findBestMatch(d.descriptor))
        console.log(results);
        const text = [
            results[0]._label
        ]
        const anchor = { x: 0, y: 0 }
            // see DrawTextField below
        const drawOptions = {
            anchorPosition: 'TOP_LEFT',
            backgroundColor: 'rgba(0, 0, 0, 0.5)'
        }
        const drawBox = new faceapi.draw.DrawTextField(text, anchor, drawOptions)
        drawBox.draw(canvas)
    }, 100)
})

// const imageUpload = document.getElementById('imageUpload')

// Promise.all([
//   faceapi.nets.faceRecognitionNet.loadFromUri('models'),
//   faceapi.nets.faceLandmark68Net.loadFromUri('models'),
//   faceapi.nets.ssdMobilenetv1.loadFromUri('models')
// ]).then(start)

// async function start() {
//   const container = document.createElement('div')
//   container.style.position = 'relative'
//   document.body.append(container)
//   const labeledFaceDescriptors = await loadLabeledImages()
//   const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors, 0.6)
//   let image
//   let canvas
//   document.body.append('Loaded')
//   imageUpload.addEventListener('change', async () => {
//     if (image) image.remove()
//     if (canvas) canvas.remove()
//     image = await faceapi.bufferToImage(imageUpload.files[0])
//     container.append(image)
//     canvas = faceapi.createCanvasFromMedia(image)
//     container.append(canvas)
//     const displaySize = { width: image.width, height: image.height }
//     faceapi.matchDimensions(canvas, displaySize)
//     const detections = await faceapi.detectAllFaces(image).withFaceLandmarks().withFaceDescriptors()
//     const resizedDetections = faceapi.resizeResults(detections, displaySize)
//     const results = resizedDetections.map(d => faceMatcher.findBestMatch(d.descriptor))
//     results.forEach((result, i) => {
//       const box = resizedDetections[i].detection.box
//       const drawBox = new faceapi.draw.DrawBox(box, { label: result.toString() })
//       drawBox.draw(canvas)
//     })
//   })
// }