<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <title>VDO</title>
    <style>
        canvas{
            width: 150px;
            height: 150px;
        }
        #barchart,#barchart2{
            display: none;
        }
    </style>
</head>
<body>
    {{-- <video class="video" src="http://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4" controls style="width: 0px;"></video>
    <video class="video" src="http://www.w3schools.com/html/movie.mp4" type="video/mp4" controls style="width: 0px;"></video>
    <div class="list">

    </div>


    <video src="http://www.w3schools.com/html/mov_bbb.mp4"></video>

    <div id="phone">
        <video class="video" src="http://localhost/test/Blender%20Day%201%20-%20Absolute%20Basics%20-%20Introduction%20Series%20for%20Beginners%20(%20compatible%20with%203.3).mp4" type="video/mp4" controls></video>
    </div>

    <div id="out_image"></div>

    <input type="button" value="Data to Image" id="data_to_image_btn" > --}}

    <div class="row">
        <div class="col-3" id="divtest" style="display:none">
            <div id="render2pdf" style="width:1000px;height:auto;">
                <center><h1 class="m-3">Chart to PDF</h1></center>
                @isset($charts)
                    @foreach ($charts as $c)
                        <img src="data:image/png;base64, {{$c}}" alt="">
                    @endforeach
                @endisset
                {{-- <div class="mt-2" id="barchart" style="width:50%; height:300px; margin:0 auto;"></div>
                <div class="mt-2" id="barchart2" style="width:50%; height:300px; margin:0 auto;"></div>
                <br> --}}
                <div style="width:80%; height:auto; margin:0 auto;">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eget semper ante. Donec vitae dolor egestas,
                        suscipit mauris in, maximus nisl. Sed libero diam, fringilla et lacus non, fermentum fringilla felis. Fusce
                        tempor tempor aliquet. Donec laoreet aliquet orci in sollicitudin. Sed non ornare eros. Quisque finibus eros
                        lorem, nec vehicula leo tincidunt nec. Nullam in felis odio. Ut sollicitudin, turpis sed placerat aliquet,
                        felis est tincidunt nunc, et rhoncus nulla lacus vitae dui. Vestibulum dictum sed odio tristique commodo.
                        Mauris dapibus, turpis vel consequat rhoncus, ante augue fringilla est, sed blandit nunc enim et nisi.
                        Nullam ornare eu quam ut facilisis. Vivamus sed tristique nisl. Duis aliquet ex ipsum, id maximus diam
                        placerat vitae.

                        Maecenas ac dolor risus. Phasellus elit velit, feugiat eget risus in, fringilla auctor est. Donec finibus quam fermentum varius finibus. Nam accumsan nibh et est ultrices maximus vel et lacus. Nulla eu nunc tortor. Suspendisse a porta magna, id consequat mauris. Integer magna dui, mollis vel lobortis nec, porta quis purus. Sed augue sapien, imperdiet in euismod sit amet, ultrices semper eros. Sed fringilla, felis eget venenatis euismod, nunc est congue quam, tempor auctor ante nisi eu lectus.

                        Praesent luctus, urna et cursus tempus, lacus nisi tincidunt quam, nec sodales augue velit vel ligula. Maecenas justo velit, lacinia a laoreet et, ultrices vitae purus. Quisque vel tortor molestie, vehicula lorem nec, efficitur libero. Sed non ligula quis enim posuere interdum. Suspendisse potenti. Morbi rutrum dapibus feugiat. Quisque ante purus, blandit id mauris non, efficitur mattis nibh.
                    </p>
                    <br>

                <img src="{{url("public/images/key1.png")}}" alt="">
                {{-- <img src="{{url("")}}/public/images/key2.png" alt=""> --}}

                </div>
            </div>
        </div>
        <div class="col-12" id="preview">
            <iframe src="" type="application/pdf" id="iframe_pv" width="100%" height="600" frameborder="0"></iframe>
        </div>
    </div>

    <div class="row">
        {{-- <button type="button" class="btn btn-primary" onclick="to_preview()">Preview</button> --}}
        {{-- <button type="button" class="btn btn-primary" onclick="to_PDF()">Create PDF</button> --}}
    </div>
    <br>
    <h1>Test read Dicom data</h1>
    <input type="text" class="form-control" id="wadoURL" value="http://localhost/test/can_not_read.dcm">
    <p id="status"></p>
    <button class="btn btn-info" onclick="get_dicom_data()">Get Data</button>

    <div class="row">
        <div id="status" class="alert alert-success">
            <div id="statusText">
                Status: Ready (no file loaded)
            </div>
            <ul id="warnings">

            </ul>
        </div>
    </div>

    {{--  --}}
    <div class="panel panel-default ">
        <div class="panel-heading">
            <h3 class="panel-title">Patient Information</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-6">
                    Patient Name: <span data-dicom="x00100010"></span>
                </div>
                <div class="col-xs-6">
                    Patient ID: <span data-dicom="x00100020"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    Patient Birth Date: <span data-dicom="x00100030"></span>
                </div>
                <div class="col-xs-6">
                    Patient Sex: <span data-dicom="x00100040"></span>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Study Information</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-6">
                    Study Description: <span data-dicom="x00081030"></span>
                </div>
                <div class="col-xs-6">
                    Protocol Name: <span data-dicom="x00181030"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    Accession #: <span data-dicom="x00080050"></span>
                </div>
                <div class="col-xs-6">
                    Study Id: <span data-dicom="x00200010"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    Study Date: <span data-dicom="x00080020"></span>
                </div>
                <div class="col-xs-6">
                    Study Time: <span data-dicom="x00080030"></span>
                </div>
            </div>

        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Series Information</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-6">
                    Series Description: <span data-dicom="x0008103e"></span>
                </div>
                <div class="col-xs-6">
                    Series #: <span data-dicom="x00200011"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    Modality: <span data-dicom="x00080060"></span>
                </div>
                <div class="col-xs-6">
                    Body Part: <span data-dicom="x00180015"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    Series Date: <span data-dicom="x00080021"></span>
                </div>
                <div class="col-xs-6">
                    Series Time: <span data-dicom="x00080031"></span>
                </div>
            </div>

        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Instance Information</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-6">
                    Instance #: <span data-dicom="x00200013"></span>
                </div>
                <div class="col-xs-6">
                    Acquisition #: <span data-dicom="x00200012"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    Acquisition Date: <span data-dicom="x00080022"></span>
                </div>
                <div class="col-xs-6">
                    Acquisition Time: <span data-dicom="x00080032"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    Content Date: <span data-dicom="x00080023"></span>
                </div>
                <div class="col-xs-6">
                    Content Time: <span data-dicom="x00080033"></span>
                </div>
            </div>



        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Image Information</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-6">
                    Rows: <span data-dicomUint="x00280010"></span>
                </div>
                <div class="col-xs-6">
                    Columns: <span data-dicomUint="x00280011"></span>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6">
                    Photometric Interpretation: <span data-dicom="x00280004"></span>
                </div>
                <div class="col-xs-6">
                    Image Type: <span data-dicom="x00080008"></span>
                </div>

            </div>

            <div class="row">
                <div class="col-xs-6">
                    Bits Allocated: <span data-dicomUint="x00280100"></span>
                </div>
                <div class="col-xs-6">
                    Bits Stored: <span data-dicomUint="x00280101"></span>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6">
                    HighBit: <span data-dicomUint="x00280102"></span>
                </div>
                <div class="col-xs-6">
                    Pixel Representation (0=us): <span data-dicomUint="x00280103"></span>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6">
                    Rescale Slope: <span data-dicom="x00281053"></span>
                </div>
                <div class="col-xs-6">
                    Rescale Intercept: <span data-dicom="x00281052"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    Image Position Patient: <span data-dicom="x00200032"></span>
                </div>
                <div class="col-xs-6">
                    Image Orientation Patient: <span data-dicom="x00200037"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    Pixel Spacing: <span data-dicom="x00280030"></span>
                </div>
                <div class="col-xs-6">
                    Samples Per Pixel: <span data-dicomUint="x00280002"></span>
                </div>
            </div>

        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Equipment Information</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-6">
                    Manufacturer: <span data-dicom="x00080070"></span>
                </div>
                <div class="col-xs-6">
                    Model: <span data-dicom="x00081090"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    Station Name: <span data-dicom="x00081010"></span>
                </div>
                <div class="col-xs-6">
                    AE Title: <span data-dicom="x00020016"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    Institution Name: <span data-dicom="x00080080"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    Software Version: <span data-dicom="x00181020"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    Implementation Version Name: <span data-dicom="x00020013"></span>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">UIDS</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12">
                    Study UID: <span data-dicom="x0020000d"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    Series UID: <span data-dicom="x0020000e"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    Instance UID: <span data-dicom="x00080018"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    SOP Class UID: <span data-dicom="x00080016"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    Transfer Syntax UID: <span data-dicom="x00020010"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    Frame of Reference UID: <span data-dicom="x00200052"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    WADO URL:
                    <div style="overflow:auto">
                        <span>http://localhost:3333/wado?requestType=WADO&studyUID=</span><span data-dicom="x0020000d"></span><span>&seriesUID=</span><span data-dicom="x0020000e"></span><span>&objectUID=</span><span data-dicom="x00080018"></span><span>&contentType=application%2Fdicom&transferSyntax=1.2.840.10008.1.2.1</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="page-header">
            <h1>Example of displaying a DICOM P10 multiframe images using Cornerstone</h1>
            <p class="lead">
                Enter a URL for a DICOM P10 multiframe sop instance to view it using cornerstone.
                <button id="toggleCollapseInfo" class="btn btn-primary" type="button">
                    Click for more info
                </button>
            </p>
        </div>
        <div id="collapseInfo" class="collapse" style="display:none;">
            <p>
                This example illustrates how to use the cornerstoneWADOImageLoader to get a DICOM P10
                SOP instance using HTTP and display it in your web browser using cornerstone.
                Not all transfer syntaxes are currently supported,
                <a href="https://github.com/cornerstonejs/cornerstoneWADOImageLoader/blob/master/docs/TransferSyntaxes.md">
                    click here for the full list.
                </a>
                For WADO-URI requests,
                you can request that the server return the SOP Instance in explicit little endian by
                appending the following query string to your URL:
                <code>&transferSyntax=1.2.840.10008.1.2.1</code>
            </p>
            <strong>If you get an HTTP error and your URL is correct, it is probably because the server is not configured to
                allow <a href="http://en.wikipedia.org/wiki/Cross-origin_resource_sharing">Cross Origin Requests</a>.
                Most browsers will allow you to enable cross domain requests via settings or command line switches,
                you can start chrome with the command line switch <code>--disable-web-security</code> to allow cross origin requests.
                See the  <a href="http://enable-cors.org/">Enable CORS site</a> for information about CORS.
            </strong>
            <br>
            <br>
            <p>
                Looking for a CORS proxy?  Try <a href="https://www.npmjs.com/package/corsproxy">CORSProxy</a>
            </p>
            <strong>Use of this example require IE10+ or any other modern browser.</strong>
            <hr>
        </div>
        <div id="loadProgress">Image Load Progress:</div>

        <div class="row">
            <form id="form" class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-sm-1" for="wadoURL">URL</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" id="wadoURL" placeholder="Enter WADO URL" value="https://raw.githubusercontent.com/cornerstonejs/cornerstoneWADOImageLoader/master/testImages/CT0012.fragmented_no_bot_jpeg_baseline.51.dcm">
                    </div>
                    <div class="col-sm-3">
                        <button class="form-control" type="button" id="downloadAndView" class="btn btn-primary">Download and View</button>
                    </div>
                </div>
            </form>
        </div>
        <br>
        <div style="width:512px;height:512px;position:relative;color: white;display:inline-block;border-style:solid;border-color:black;"
             oncontextmenu="return false"
             class='disable-selection noIbar'
             unselectable='on'
             onselectstart='return false;'
             onmousedown='return false;'>
            <div id="dicomImage"
                 style="width:512px;height:512px;top:0px;left:0px; position:absolute">
            </div>
        </div>
        <button class="btn btn-primary" onclick="play_clip()">Play</button>
        <button class="btn btn-primary" onclick="stop_clip()">Stop</button>
    </div>
    {{--  --}}
    <br>
    {{-- <h1>CHART PDF</h1> --}}


    {{-- <div id="preview" hidden></div> --}}




    <script src="{{asset('public/js/jquery.min.js')}}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.6.347/build/pdf.min.js"></script>
    {{-- <script src="https://mozilla.github.io/pdf.js/build/pdf.worker.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://code.jscharting.com/2.9.0/jscharting.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>

    <script src="{{asset('public/js/cornerstone/hammer.js')}}"></script>
    <script src="{{asset('public/js/cornerstone/dicomParser.min.js')}}"></script>
    <script src="{{asset('public/js/cornerstone/cornerstone.js')}}"></script>
    <script src="{{asset('public/js/cornerstone/cornerstoneMath.min.js')}}"></script>
    <script src="{{asset('public/js/cornerstone/cornerstoneTools.js')}}"></script>
    <script src="{{asset('public/js/cornerstone/cornerstoneWADOImageLoader.bundle.min.js')}}"></script>
    <script src="{{asset('public/js/cornerstone/cornerstoneWebImageLoader.js')}}"></script>
    {{-- <script src="https://unpkg.com/dicom-parser@1.8.3/dist/dicomParser.min.js"></script> --}}

    <script>
        var pdfjsLib = window['pdfjs-dist/build/pdf'];
        pdfjsLib.GlobalWorkerOptions.workerSrc = '//cdn.jsdelivr.net/npm/pdfjs-dist@2.6.347/build/pdf.worker.js';

        window.jsPDF = window.jspdf.jsPDF;

        JSC.Chart('barchart', {
            type: 'horizontal column',
            series: [
                {
                    points: [
                        {x: 'Apples', y: 50},
                        {x: 'Oranges', y: 42}
                    ]
                }
        ]});

        JSC.Chart('barchart2', {
            type: 'horizontal column',
            series: [
                {
                    name:'Andy',
                    points: [
                        {x: 'Apples', y: 50},
                        {x: 'Oranges', y: 32}
                    ]
                },{
                    name:'Anna',
                    points: [
                        {x: 'Apples', y: 30},
                        {x: 'Oranges', y: 22}
                    ]
                }
            ]
        });

        function to_preview(callback, to_image=false) {

            let input = document.querySelector("#render2pdf")
            document.getElementById('divtest').style.display = "block"

            html2canvas(input, { useCORS: true, allowTaint: true, scrollY: 0 }).then((canvas) => {
                const image = { type: 'jpeg', quality: 0.98 };
                const margin = [0.5, 0.5];
                const filename = 'myfile.pdf';

                var imgWidth = 8.5;
                var pageHeight = 11;

                var innerPageWidth = imgWidth - margin[0] * 2;
                var innerPageHeight = pageHeight - margin[1] * 2;

                // Calculate the number of pages.
                var pxFullHeight = canvas.height;
                var pxPageHeight = Math.floor(canvas.width * (pageHeight / imgWidth));
                var nPages = Math.ceil(pxFullHeight / pxPageHeight);

                // Define pageHeight separately so it can be trimmed on the final page.
                var pageHeight = innerPageHeight;

                // Create a one-page canvas to split up the full image.
                var pageCanvas = document.createElement('canvas');
                var pageCtx = pageCanvas.getContext('2d');
                pageCanvas.width = canvas.width;
                pageCanvas.height = pxPageHeight;

                // Initialize the PDF.
                var pdf = new jsPDF('p', 'in', [8.5, 11]);

                for (var page = 0; page < nPages; page++) {
                    // Trim the final page to reduce file size.
                    if (page === nPages - 1 && pxFullHeight % pxPageHeight !== 0) {
                    pageCanvas.height = pxFullHeight % pxPageHeight;
                    pageHeight = (pageCanvas.height * innerPageWidth) / pageCanvas.width;
                    }

                    // Display the page.
                    var w = pageCanvas.width;
                    var h = pageCanvas.height;
                    pageCtx.fillStyle = 'white';
                    pageCtx.fillRect(0, 0, w, h);
                    pageCtx.drawImage(canvas, 0, page * pxPageHeight, w, h, 0, 0, w, h);

                    // Add the page to the PDF.
                    if (page > 0) pdf.addPage();
                    // debugger;
                    var imgData = pageCanvas.toDataURL('image/' + image.type, image.quality);
                    // console.log(page, imgData);

                    pdf.addImage(imgData, image.type, margin[1], margin[0], innerPageWidth, pageHeight);
                }

                // pdf.save();
                if(to_image == false){
                    let data = pdf.output('bloburl')
                    callback(data)
                } else {
                    let datauri = pdf.output('datauristring')
                    callback(datauri, nPages)
                }

           })

           document.getElementById('divtest').style.display = "none"
        }

        function set_src(pdf_src){
            $('#iframe_pv').attr('src', pdf_src)
        }

        function to_image(datauri, page){
            console.log('page', page);
            let url = datauri
            var loadingTask = pdfjsLib.getDocument(url);
            loadingTask.promise.then(function(pdf) {
            console.log('PDF loaded');

            // Fetch the first page
            var pageNumber;
            for (let i = 1; i <= page; i++) {
                pageNumber = i
                pdf.getPage(pageNumber).then(function(page) {
                console.log('Page loaded', i);

                var viewport = page.getViewport({ scale: 4 });
                var canvas = document.createElement('canvas');
                var ctx = canvas.getContext('2d');
                var renderContext = { canvasContext: ctx, viewport: viewport };

                canvas.height = viewport.height;
                canvas.width = viewport.width;

                page.render(renderContext).promise.then(() => {
                    var dataUrl   = canvas.toDataURL();
                    console.log(dataUrl);
                    download_image(dataUrl)
                    // convertDataUrlToFile(dataUrl, `${fileName}-${pageNumber}.png`).then(resolve);
                });
                });

            }
            }, function (reason) {
            // PDF loading error
            console.error(reason);
            });
        }

        to_preview(set_src)
        to_preview(to_image, true)

        function to_PDF(){
            html2canvas(document.querySelector("#render2pdf")).then(canvas => {
                var element = document.createElement('a');
                let data = $('#iframe_pv').attr('src')
                element.setAttribute('href', data);
                element.setAttribute('download', 'aaa.pdf');
                element.style.display = 'none';
                document.body.appendChild(element);
                element.click();
                document.body.removeChild(element);
            });
        }

        function download_image(image_data){
            let a = document.createElement('a')
            a.href = image_data
            a.download = 'report.jpg'
            a.style.display = 'none'
            document.body.appendChild(a)
            a.click()
            a.remove()
        }

        TAG_DICT = []
        function get_dicom_data(){
            // Load the WADO object
            var url = $('#wadoURL').val();

            var oReq = new XMLHttpRequest();
            try {
                oReq.open("get", url, true);
                console.log('success!', oReq);
            }
            catch(err)
            {
                $('#status').removeClass('alert-success alert-info alert-warning').addClass('alert-danger');
                return false;
            }

            oReq.responseType = "arraybuffer";
            oReq.onreadystatechange = function(oEvent){
                if(oReq.readyState == 4){
                    if(oReq.status == 200){
                        var byteArray = new Uint8Array(oReq.response);
                        dumpByteArray(byteArray);
                    }
                    else {
                        $('#status').removeClass('alert-success alert-info alert-warning').addClass('alert-danger');
                        document.getElementById('statusText').innerHTML = 'Status: HTTP Error - status code ' + oReq.status + '; error text = ' + oReq.statusText;
                    }
                }
            };
            oReq.send();

            return false;
        }

        function getTag(tag) {
            var group = tag.substring(1,5);
            var element = tag.substring(5,9);
            var tagIndex = ("("+group+","+element+")").toUpperCase();
            // console.log(tagIndex);
            var attr = TAG_DICT[tagIndex];
            console.log(TAG_DICT);
            return attr;
        }

        function test(dataSet) {
            $('span[data-dicom]').each(function(index, value)
            {
                var attr = $(value).attr('data-dicom');
                var element = dataSet.elements[attr];
                var text = "";
                if(element !== undefined)
                {
                    var str = dataSet.string(attr);
                    if(str !== undefined) {
                        text = str;
                    }
                }
                $(value).text(text);
            });

            $('span[data-dicomUint]').each(function(index, value)
            {
                var attr = $(value).attr('data-dicomUint');
                var element = dataSet.elements[attr];
                var text = "";
                if(element !== undefined)
                {
                    if(element.length === 2)
                    {
                        text += dataSet.uint16(attr);
                    }
                    else if(element.length === 4)
                    {
                        text += dataSet.uint32(attr);
                    }
                }

                $(value).text(text);
            });
        }



        function dumpByteArray(byteArray){
            // Here we have the file data as an ArrayBuffer.  dicomParser requires as input a
            // Uint8Array so we create that here
            var kb = byteArray.length / 1024;
            var mb = kb / 1024;
            var byteStr = mb > 1 ? mb.toFixed(3) + " MB" : kb.toFixed(0) + " KB";
            document.getElementById('statusText').innerHTML = 'Status: Parsing ' + byteStr + ' bytes, please wait..';
            // set a short timeout to do the parse so the DOM has time to update itself with the above message



            setTimeout(function() {

                // Invoke the paresDicom function and get back a DataSet object with the contents
                var dataSet;
                try {
                    var start = new Date().getTime();
                    console.log(start);
                    dataSet = dicomParser.parseDicom(byteArray);
                    test(dataSet)
                    var output = [];

                }
                catch(err)
                {
                    console.log('error');
                    $('#status').removeClass('alert-success alert-info alert-warning').addClass('alert-danger');
                    document.getElementById('statusText').innerHTML = 'Status: Error - ' + err + ' (file of size ' + byteStr + ' )';
                }
            },10);

        }

    </script>

<script>
    cornerstoneWADOImageLoader.external.cornerstone = cornerstone;

    // Init cornerstone tools
    cornerstoneTools.init();

    cornerstoneWADOImageLoader.configure({
        beforeSend: function(xhr) {
            // Add custom headers here (e.g. auth tokens)
            //xhr.setRequestHeader('x-auth-token', 'my auth token');
        }
    });

    var loaded = false;

    function loadAndViewImage(url) {
        var element = document.getElementById('dicomImage');

        // since this is a multi-frame example, we need to load the DICOM SOP Instance into memory and parse it
        // so we know the number of frames it has so we can create the stack.  Calling load() will increment the reference
        // count so it will stay in memory until unload() is explicitly called and all other reference counts
        // held by the cornerstone cache are gone.  See below for more info
        cornerstoneWADOImageLoader.wadouri.dataSetCacheManager.load(url, cornerstoneWADOImageLoader.internal.xhrRequest).then(function(dataSet) {
            // dataset is now loaded, get the # of frames so we can build the array of imageIds
            var numFrames = dataSet.intString('x00280008');
            var FrameRate = 1000/dataSet.floatString('x00181063');
            if(!numFrames) {
                alert('Missing element NumberOfFrames (0028,0008)');
                // return;
                numFrames = 1
            }

            var imageIds = [];
            var imageIdRoot = 'wadouri:' + url;

            for(var i=0; i < numFrames; i++) {
                var imageId = imageIdRoot + "?frame="+i;
                imageIds.push(imageId);
            }

            var stack = {
                currentImageIdIndex : 0,
                imageIds: imageIds
            };

            // Load and cache the first image frame.  Each imageId cached by cornerstone increments
            // the reference count to make sure memory is cleaned up properly.
            cornerstone.loadAndCacheImage(imageIds[0]).then(function(image) {
                console.log(image);
                // now that we have an image frame in the cornerstone cache, we can decrement
                // the reference count added by load() above when we loaded the metadata.  This way
                // cornerstone will free all memory once all imageId's are removed from the cache
                cornerstoneWADOImageLoader.wadouri.dataSetCacheManager.unload(url);

                cornerstone.displayImage(element, image);
                if(loaded === false) {
                    const WwwcTool = cornerstoneTools.WwwcTool;
                    cornerstoneTools.addTool(WwwcTool)
                    cornerstoneTools.setToolActive('Wwwc', { mouseButtonMask: 1 })
                    // Set the stack as tool state
                    cornerstoneTools.addStackStateManager(element, ['stack', 'playClip']);
                    // cornerstoneTools.addStackStateManager(element, ['stack']);
                    cornerstoneTools.addToolState(element, 'stack', stack);
                    // Start playing the clip
                    // cornerstoneTools.playClip(element, FrameRate);
                    loaded = true;
                }
            }, function(err) {
                alert(err);
            });
            /*}
             catch(err) {
             alert(err);
             }*/
        });

    }

    function downloadAndView() {
        const url = document.getElementById('wadoURL').value;
        console.log(url);

        // image enable the dicomImage element and activate a few tools
        loadAndViewImage(url);

        return false;
    }

    cornerstone.events.addEventListener('cornerstoneimageloadprogress', function(event) {
        const eventData = event.detail;
        const loadProgress = document.getElementById('loadProgress');
        loadProgress.textContent = `Image Load Progress: ${eventData.percentComplete}%`;
    });

    const element = document.getElementById('dicomImage');
    // console.log(element, cornerstone);
    cornerstone.enable(element);
    // cornerstoneTools.mouseInput.enable(element);
    // cornerstoneTools.mouseWheelInput.enable(element);
    // Add our tool, and set it's mode
    const StackScrollMouseWheelTool = cornerstoneTools.StackScrollMouseWheelTool
    cornerstoneTools.addTool(StackScrollMouseWheelTool)
    cornerstoneTools.setToolActive('StackScrollMouseWheel', { })

    document.getElementById('downloadAndView').addEventListener('click', function(e) {
        downloadAndView();
    });

    const form = document.getElementById('form');
    form.addEventListener('submit', function() {
        downloadAndView();
        return false;
    });

    document.getElementById('toggleCollapseInfo').addEventListener('click', function() {
        if (document.getElementById('collapseInfo').style.display === 'none') {
            document.getElementById('collapseInfo').style.display = 'block';
        } else {
            document.getElementById('collapseInfo').style.display = 'none';
        }
    });

    function play_clip(){
        let fps = 30.0
        let element = document.getElementById('dicomImage')
        cornerstoneTools.playClip(element, fps);
    }

    function stop_clip(){
        let element = document.getElementById('dicomImage')
        cornerstoneTools.stopClip(element);
    }
</script>



</body>
</html>
