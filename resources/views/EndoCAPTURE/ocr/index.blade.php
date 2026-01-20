<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <img src="{{url('public/ocr/test.png')}}">
    <div id="textdiv"></div>
    <script src="{{url('public/ocr/tesseract.min.js')}}"></script>
    <script src="{{url('public/camera/jquery.min.js')}}"></script>
    <script>
        function use_ocr(){
            img = "{{url("public/ocr/test.png")}}"
            Tesseract.recognize(img,'eng',{logger:m=>console.log(m)})
            .then(({ data: { text } }) => {
                console.log(text);
                $('#textdiv').html(text)
            })
        }
        use_ocr()
    </script>
</body>
</html>
