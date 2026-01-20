
<style>

#container2 {
    position: relative;    
}

#example {
   position: absolute;
   top: 0px;
   left: 10px;
   padding: 6px;
   background-color: white;
   color: black;
   font-size: 20px;
}
</style>

@foreach ($img as $index=>$data)
@php
    $image_name = isset($data['na']) ? $data['na'] : '';
@endphp
@if ($index == 0)
    <div id="container2">
        <img src='{{"$url/store/$hn/$appointment/$image_name"}}'  class="image-list-img ms-2 " style="display:block; width:250px; height: auto">&nbsp;
        <div data-src='{{"$url/store/$hn/$appointment/$image_name"}}' id="dicom{{$index}}" class="w-100  position-relative" style="max-width: 150px;"></div>
        <div id="example">{{count($img)}}</div>
    </div>    
@endif
@endforeach


<script>

    // const getBase64StringFromDataURL = (dataURL) => dataURL.replace('data:', '').replace(/^.+,/, '');

    _initCornerstoneImageLoader()
    _initCornerstoneWADOImageLoader()


    // // Init cornerstone tools
    cornerstoneTools.init();

    var img_lg = $('.image-list-img').length

    for(i=0; i<img_lg;i++){
        let src = $($(".image-list-img")[i]).attr('src')
        // enable element
        let element = document.getElementById(`dicom${i}`)
        // cornerstone.enable(element)
        // cornerstone.loadImage(`wadouri:${src}`).then(function(image) {
        //     cornerstone.displayImage(element, image);
        // });
    }

    function _initCornerstoneImageLoader() {
        cornerstoneWebImageLoader.external.cornerstone = cornerstone;
    }

    function _initCornerstoneWADOImageLoader() {
        let baseUrl = 'https://tools.cornerstonejs.org/examples/'

        cornerstoneWADOImageLoader.external.cornerstone = cornerstone;
        cornerstoneWADOImageLoader.external.dicomParser = dicomParser;
        // Image Loader
        const config = {
            webWorkerPath: `${baseUrl}assets/image-loader/cornerstoneWADOImageLoaderWebWorker.js`,
            taskConfiguration: {
            decodeTask: {
                codecsPath: `${baseUrl}assets/image-loader/cornerstoneWADOImageLoaderCodecs.js`,
            },
            },
        };
        cornerstoneWADOImageLoader.webWorkerManager.initialize(config);
    }





</script>
