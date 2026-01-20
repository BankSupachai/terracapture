<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<title>EndoINDEX</title>
<meta name="description" content="File Upload widget with multiple file selection, drag&amp;drop support, progress bars, validation and preview images, audio and video for jQuery. Supports cross-domain, chunked and resumable file uploads and client-side image resizing. Works with any server-side platform (PHP, Python, Ruby on Rails, Java, Node.js, Go etc.) that supports standard HTML form file uploads.">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="{{url('public/selfupload/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{url('public/selfupload/css/style.css')}}">
<link rel="stylesheet" href="{{url('public/selfupload/css/blueimp-gallery.min.css')}}">
<link rel="stylesheet" href="{{url('public/selfupload/css/jquery.fileupload.css')}}">
<link rel="stylesheet" href="{{url('public/selfupload/css/jquery.fileupload-ui.css')}}">
<link href="{{url('public/css/font-awesome.min.css')}}"                          rel="stylesheet" type="text/css"/>
<link href="{{url('public/css/bootstrap.min.css')}}"                             rel="stylesheet" type="text/css"/>
<noscript><link rel="stylesheet" href="{{url('public/selfupload/css/jquery.fileupload-noscript.css')}}"></noscript>
<noscript><link rel="stylesheet" href="{{url('public/selfupload/css/jquery.fileupload-ui-noscript.css')}}"></noscript>
<style>
        .bg{
            /* background-image: url("../../public/image/blue.jpg"); */
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        h1{
            /* font-family: 'Redressed', cursive; */
            color: green;
            text-shadow: 0px 0px 2px skyblue;
        }
        .btn{
            padding: 1em;
            font-size: initial;
        }
        td{
            font-size: x-large;
            vertical-align: inherit !important;
        }
</style>
<script>
function backpage() {
  window.location=document.referrer;
}
</script>


</head>
<body style="min-height: 88em;padding: 0;" class="bg">


<table width="100%">
  <tr>
    <td align="right">

        @php
            $cid = $_GET['case_id'];
            $url = url("loadpic/$cid");
        @endphp

      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </td>
  </tr>
</table>
<div class="row" style="width: 100%;margin-top:2%;">
    <div class="col-1"></div>
    <div class="col-10">
        <div class="card">
            <div class="card-body" style="background: linear-gradient(90deg, rgba(230,255,255,0.4654236694677871) 0%, rgba(255,255,255,0.4206057422969187) 100%);">
                <div class="row">

                    <div class="col-1">
                        <a href="<?php echo $url;?>" class="btn btn-lg btn-info"><i class="fa fa-angle-double-left" aria-hidden="true"></i> ย้อนกลับ </a>
                    </div>
                    <div class="col-10 text-center"><br><br>
                        <h1><i class="fa fa-file-image-o" aria-hidden="true"></i> Add Photo (รองรับไฟล์ jpg png mp4)</h1>
                    </div>
                    <div class="col-1"></div>
                </div>
                <div class="container" style="margin: 0;max-width: 100%;">

                    <form id="fileupload" action="{{url('selfupload')}}" method="POST" enctype="multipart/form-data" style="width: 100%;">
                        @csrf
                        <noscript><input type="hidden" name="redirect" value="add_photo.php"></noscript>
                        <div class="row fileupload-buttonbar" style="width: 100%;">
                        <div class="col-lg-5 fileupload-progress fade">
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                </div>
                                <!-- The extended global progress state -->
                                <div class="progress-extended">&nbsp;</div>
                            </div>
                            <div class="col-lg-7 text-right">
                                <span class="btn btn-success btn-lg fileinput-button">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    <span>Add files...</span>
                                    <input type="file" name="files[]" multiple>
                                    <input type="hidden" name="hn" value="<?php echo $_GET['hn']; ?>">
                                    <input type="hidden" name="case_id" value="<?php echo $_GET['case_id']; ?>">
                                </span>


                                <button type="submit" class="btn btn-primary btn-lg start">
                                <i class="fa fa-cloud-download" aria-hidden="true"></i>
                                    <span>Start upload</span>
                                </button>


                                <button type="reset" class="btn btn-warning btn-lg cancel">
                                <i class="fa fa-times" aria-hidden="true"></i>
                                    <span>Cancel upload</span>
                                </button>
                                <!--
                                    <button type="button" class="btn btn-danger btn-lg delete">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                                    <span>Delete</span>
                                </button>
                                -->
                                <?php /*
                                <input type="checkbox" class="toggle">
                                */ ?>
                                <span class="fileupload-process"></span>
                            </div>
                        </div>
                        <table role="presentation" class="table table-striped">
                            <tbody class="files"></tbody>
                        </table>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <div class="col-1"></div>
</div>



<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td class="text-right">
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary btn-lg start" filename="{%=file.name%}" disabled>
                <i class="fa fa-cloud-download" aria-hidden="true"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning btn-lg cancel">
                <i class="fa fa-times" aria-hidden="true"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>


<?php //{% for (var i=0, file; file=o.files[i]; i++) { %}?>
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=0; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger btn-lg delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning btn-lg cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<script src="{{url('public/selfupload/js/jquery.min.js')}}"></script>


<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="{{url('public/selfupload/js/vendor/jquery.ui.widget.js')}}"></script>
<script src="{{url('public/selfupload/js/tmpl.min.js')}}"></script>
<script src="{{url('public/selfupload/js/load-image.all.min.js')}}"></script>
<script src="{{url('public/selfupload/js/canvas-to-blob.min.js')}}"></script>
<script src="{{url('public/selfupload/js/bootstrap.min.js')}}"></script>
<script src="{{url('public/selfupload/js/jquery.blueimp-gallery.min.js')}}"></script>
<script src="{{url('public/selfupload/js/jquery.iframe-transport.js')}}"></script>
<script src="{{url('public/selfupload/js/jquery.fileupload.js')}}"></script>
<script src="{{url('public/selfupload/js/jquery.fileupload-process.js')}}"></script>
<script src="{{url('public/selfupload/js/jquery.fileupload-image.js')}}"></script>
<script src="{{url('public/selfupload/js/jquery.fileupload-audio.js')}}"></script>
<script src="{{url('public/selfupload/js/jquery.fileupload-video.js')}}"></script>
<script src="{{url('public/selfupload/js/jquery.fileupload-validate.js')}}"></script>
<script src="{{url('public/selfupload/js/jquery.fileupload-ui.js')}}"></script>
<script src="{{url('public/selfupload/js/main.js')}}"></script>

</body>
</html>
