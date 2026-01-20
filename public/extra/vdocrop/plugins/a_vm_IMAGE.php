<div class="col-md-12" >
<div class="collapse" id="a_vm_IMAGE">
  <div class="card card-body">
		<!-- Watermark Video Form -->
        <div class="col-md-12" style="background-color: #e8e8e8;">
            <h2> Watermark It!</h2>
             <form method="post" action="" enctype="multipart/form-data">
             <div class="row">
                <div class="col-md-6">
                    <?php
                        $d = dir("watermark");
                            while (false !== ($entry = $d->read())) {
                            if ($entry === '.' || $entry === '..') continue;
                        echo "<img src='watermark/{$entry}'> <input type='radio' id='wm' name='wm' value='watermark/{$entry}' onclick='setImage(this);'> <br><hr>";
                            }
                        $d->close();
                        ?>
                    <br/>
                </div>
                <div class="col-md-6">
                    <input  class="form-control posiimg col-md-6" type="text" name="posiimg" id="posiimg" placeholder="Watermark Position" required>
                    <input class="form-control width col-md-6" type="text" name="widthimg" id="widthimg" placeholder="Watermark Size Width" required="">
                    <input class="btn btn-primary btn-block" type="submit" name="watermark" id="crop" value="Watermark" >
                </div>
                </div>   
            </form>
            </br>
            <small>
                Info : Select Watermark and Drag To Posistion > Doubble Click On IT and Hit The Watermark Button.
            </small>  
        
        </div>

  </div>
</div>
 </div>
<script>
function setImage(select){
    var image = document.getElementsByName("image-swap")[0];
    image.src = $("input[name='wm']:checked").val();
}

$(function() {
    $(document).dblclick(function(e) {
        var wrapper = $("#draggable").offset();
        var px = wrapper.left;
        var py = wrapper.top;
        var wmwidth = $('#draggable img').width();
        var vidsize = document.getElementById("vdo");
        var imgwpr = $("#image").width() / $('#vdo').width() * 100;
        var calw = (vidsize.videoWidth*imgwpr)/100;
        $('.width').val(calw);
        var position = $('#draggable').position();
        var percentLeft = position.left/$('#vids').width() * 100;
        var percentTop = position.top/$('#vids').height() *100;
        $('#posiimg').val(percentLeft + ':' + percentTop);
    });
})
</script>
<?php
// Watermark Over Video Image
if (isset($_POST["watermark"])) {
    $file = $_GET['f'];
    $file = substr($file, 0, strpos($file, "?"));
    $wmt  = $_POST['wm'];
    $pos  = $_POST['posiimg'];
    $pose = explode(':',$pos);
    $posx = $pose[0];
    $posx = ($posx / 100);   
    $posy = $pose[1];
    $posy = ($posy / 100);   
    $width  = $_POST['widthimg'];  

    $fileo = $folder . $file;
    $filew = $folder . $file.'_WM_'.time().'.mp4';
    //for older verisons  
    //$cmd = "$ffmpeg -i $fileo -vf 'movie=$wmt [watermark]; [in][watermark] overlay=$pos [out]' $quality '$filew' 2>&1";
    //$cmd = "$ffmpeg -i $fileo -i $wmt -filter_complex scale=$width,overlay=x=$posx*W:y=$posy*H -map 0:a -y $filew 2>&1";
    $cmd = "$ffmpeg -i $fileo -i $wmt -filter_complex [1]scale=$width:-1[b];[0][b]overlay=x=$posx*W:y=$posy*H  $filew 2>&1";

    echo $cmd.'<br>';
    
    exec($cmd ,$output);
  
    if(!$keeporiginal){
    rename($filew, $fileo);
    }
    $thumb = "$fileo.jpeg";
    
    if (file_exists($thumb)) {
        unlink($thumb);
    }
    echo "<script> window.location = 'list.php'; </script>";
}
?>
 