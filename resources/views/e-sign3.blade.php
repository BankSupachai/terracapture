<!doctype html>
<html>

<head>
    <link href="{{ url('public/extra/esign/colorpicker.css') }}" rel="stylesheet">
    <link href="{{ url('public/extra/esign/literally.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style type="text/css">
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            margin: 0;

        }

        /* .fs-container ,.toolbar{
            width: 100%;
            height: 100%;
            padding: 0 !important;
            margin: 0 !important;
        } */

        .fs-container {
            width: 100%;
            height: 100%;
            margin: auto;
        }

        .literally {
            width: 100%;
            height: 100%;
        }
        html,body{
            height: 100%;
            width: 100%;
        }
        .clear-button{
            top: 0 !important;
            width: 15em !important;
            height: 2em !important;
            line-height: 2em !important;
            font-size: 2em !important;
            border-radius: 0 !important;
        }
        .literally .toolbar{
            /* width: min-content; */
        }
        .toolbar-row-left{
            display: none;
        }
        .action-buttons .button-group{
            display: none !important;
            position: absolute !important;
        }
        #canvas{height: 100% !important;}
    </style>
</head>

<body>
    <div class="fs-container">
        <div class="literally"><canvas id="canvas"></canvas></div>
    </div>

    <script src="{{ url('public/extra/esign/literallycanvas.fat.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $(document).bind('touchmove', function(e) {

                var canvas = document.getElementById('canvas');
                var dataURL = canvas.toDataURL();

                $.post('{{ url('photomove') }}', {
                    event       : 'create_sign',
                    folderdate  : '{{ $_GET['folderdate']}}',
                    cid         : '{{ $_GET['cid'] }}',
                    hn          : '{{ $_GET['hn'] }}',
                    datapic     : dataURL
                }, function(data, status) {});

                if (e.target === document.documentElement) {
                    return e.preventDefault();
                }

            });

            $('.literally').literallycanvas();
        });


        $('#canvas').mouseup(function() {
            var canvas = document.getElementById('canvas');
            var dataURL = canvas.toDataURL();

            $.post('{{ url('photomove') }}', {
                event       : 'create_sign',
                folderdate  : '{{ $_GET['folderdate']}}',
                cid         : '{{ $_GET['cid'] }}',
                hn          : '{{ $_GET['hn'] }}',
                datapic     : dataURL
            }, function(data, status) {});

        });


    </script>

</body>

</html>
