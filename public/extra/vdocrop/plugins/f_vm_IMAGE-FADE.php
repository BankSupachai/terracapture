<div class="col-md-12" >
<div class="collapse" id="f_vm_IMAGE-FADE">
  <div class="card card-body">
		<!-- Watermark Video Form -->
        <div class="col-md-12" style="background-color: #e8e8e8;">
            <h2> Watermark It!</h2>
             <form method="post" action="" enctype="multipart/form-data">
                <div class="col-md-6">
                 <?php
                      $d = dir("watermark");
                         while (false !== ($entry = $d->read())) {
                        if ($entry === '.' || $entry === '..') continue;
                     echo "<img src='watermark/{$entry}'> <input type='radio' id='wm' name='wm' value='watermark/{$entry}' onclick='setImage(this);'> <br><hr>";
                        }
                     $d->close();
                    ?>
               </div>
               <div class="col-md-6">
                  Format Must Be 00:00:02.00 (Hour:Minute:Seconds.Miliseconds)
                <div class="input-group">
                    <input  class="form-control" type="text" name="inat" id="inat" placeholder="Fade In Time i.e 00:00:02.00" required> <span class="input-group-btn"> <a id="getintime" class="btn btn-primary">Get Time</a></span>
                    </div><div class="input-group">
                    <input  class="form-control" type="text" name="outat" id="outat" placeholder="Fade Out Time i.e 00:00:10.00" required> <span class="input-group-btn"><a id="getouttime" class="btn btn-primary">Get Time</a></span>
                     </div>
               </div>
               <br><br>
                <div class="input-group">
                <input  class="form-control posifade" type="text" name="pos" id="posifade" placeholder="Watermark Position" required>
                <input class="form-control width col-md-6" type="text" name="widthimg" id="widthimg" placeholder="Watermark Size Width" required="">
                 
                </div>
                <input class="btn btn-primary btn-block" type="submit" name="watermarkfd" id="crop" value="Watermark" >
               
            </form>
            </br>
            <small>
                Info : Set IN and Out Time In Seconds > Select Watermark and Drag To Posistion > Doubble Click On IT and Hit The Watermark Button.
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
        $('#posifade').val(percentLeft + ':' + percentTop);
    });
})
</script>

<script>
    //get video time for thumbnail
function fromSeconds(seconds, showHours) {
    if(showHours) {
        var hours = Math.floor(seconds / 3600),
            seconds = seconds - hours * 3600;
    }
    var minutes = ("0" + Math.floor(seconds/60)).slice(-2);
    var seconds = ("0" + parseInt(seconds%60,10)).slice(-2);

    if(showHours) {
        var timestring = hours + ":" + minutes + ":" + seconds;
    } else {
        var timestring = minutes + ":" + seconds;
    }
    return timestring;
}
var video = $('#vdo');
 
$('#getintime').click(function(){
    $('#inat').val(video[0].currentTime);
});
$('#getouttime').click(function(){
    $('#outat').val(video[0].currentTime);
});
</script>

<?php
// Watermark Over Video Image
if (isset($_POST["watermarkfd"])) {
    $file = $_GET['f'];
    $file = substr($file, 0, strpos($file, "?"));
    $wmt  = $_POST['wm'];
    $pos  = $_POST['pos'];
    $pose = explode(':',$pos);
    $posx = $pose[0];
    $posx = ($posx / 100);   
    $posy = $pose[1];
    $posy = ($posy / 100);   
    $width  = $_POST['widthimg'];  
    
    $intime  = $_POST['inat'];
    $outtime  = $_POST['outat'];
    
    $fileo = $folder . $file;
    $filew = $folder . $file.'_WM_FADE_'.time().'.mp4';
    $cmd = $ffmpeg.' -i '.$fileo.' -framerate 30000/1001 -loop 1 -i '.$wmt.' -filter_complex "[1:v] scale='.$width.':-1, fade=in:st='.$intime.':d=1:alpha=1,fade=out:st='.$outtime.':d=1:alpha=1 [ov]; [0:v][ov] overlay=x='.$posx.'*W:y='.$posy.'*H [v]" -map "[v]" -map 0:a -c:v libx264 -c:a copy -shortest '.$filew;
    exec($cmd);

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
 