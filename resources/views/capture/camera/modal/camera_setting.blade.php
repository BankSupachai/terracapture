<style>

    #camera_setting .modal-body{
        background: #353A3E;
    }


    #camera_setting .modal-dialog{
        margin: auto;
        margin-top: 4em !important;
        width: fit-content !important;
        max-width: unset !important;
    }
    #camera_setting .modal-content{
        border: none;
    }
    .box-data{
        background: #222529;
        padding: 1em;
    }
    /* #camera_setting .form-control{
        border: none;
        background: black;
        color: #fff;
    } */
    #camera_setting .btn-sm{
        padding: 0.2em;
    }
    #camera_setting .border-right{border-right: 1px solid #fff;}
    .list-cases{
        border-bottom: 1px solid #5b5959;
        padding: 0.5em;
    }
    .menu-list-scroll{
        width: 100%;
        height: 600px;
        overflow-y: auto;
    }
    /* #camera_setting .modal-body .h-500px{
        height: 500px;
    } */
    .h-500px table tr td{
        vertical-align: middle;
    }
    .h-500px table tr td:nth-child(3),.h-500px table tr td:nth-child(4){
        width: 35% !important;
    }
    #camera_setting select.form-control:not([size]):not([multiple]) {
        height: calc(2.25rem + 11px);
    }
</style>



<div class="modal fade" id="camera_setting" tabindex="-1" role="dialog" aria-labelledby="camera_settingl" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-body">
            <div class="row m-0">
                <div class="col-7"><u class="text-light">VIDEO SETTING</u></div>
                <div class="col-5"><u class="text-light">SOUND SETTING</u></div>
                <div class="col-7 border-right h-500px mt-5">
                    <table class="table table-borderless w-100">
                        <tr>
                            <td class="text-center">Input</td>
                            <td class="text-center">Off/On</td>
                            <td class="text-center">Name</td>
                            <td class="text-center">Source</td>
                        </tr>
                        @for($i=1;$i<=4;$i++)
                            <tr>
                                <td class="text-center">Input {{$i}}</td>
                                <td class="text-center">
                                    <label class="switch mb-0">
                                        <input type="checkbox" sub="{{$i}}" class="select_camera_list save_config" id="camera_{{$i}}" @if($i==1) disabled="disabled" checked="checked" @endif @if(@$connection["camera_$i"]=='on') checked @endif>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td><input type="text" class="form-control form-control-sm camera_set_name save_config" id="name_camera{{$i}}" @if(isset($connection["name_camera$i"])) value="{{@$connection["name_camera$i"]}}" @else value="text {{$i}}" @endif sub="{{$i}}"></td>
                                <td>
                                    <select name="" class="form-control save_config" id="source_{{$i}}">
                                        @for($ii=1;$ii<5;$ii++)
                                            <option value="{{$ii}}" @if(@$connection["source_$i"]== "$ii") selected @endif>Source {{$ii}}</option>
                                        @endfor
                                    </select>
                                </td>
                            </tr>
                        @endfor
                    </table>
                </div>
                <div class="col-5 h-500px mt-5">
                    <div class="row m-0">
                        <div class="col-12">Capture sound</div>
                        <div class="col-12">
                            <select name="" id="sound" class="form-control save_config">
                                @for($ii=1;$ii<5;$ii++)
                                    <option value="{{$ii}}" @if(@$connection["sound"]== "$ii") selected @endif>Sound {{$ii}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-12 mt-5">Record sound</div>
                        <div class="col-12">
                            <select name="" class="form-control save_config" id="language">
                                <option value="Thai"  @if(@$connection["language"]== "Thai") selected @endif>Thai</option>
                                <option value="ENG"   @if(@$connection["language"]== "ENG")  selected @endif>ENG</option>
                                <option value="Japan" @if(@$connection["language"]== "Japan")selected @endif>Japan</option>
                            </select>
                        </div>
                        <div class="col-6 mt-5 text-center">Auto Patient in time </div>
                        <div class="col-6 mt-5 text-center">Auto Start time</div>
                        <div class="col-6 text-center">
                            <label class="switch mb-0">
                                <input type="checkbox" class="save_config"  id="auto_pt_time" @if(@$connection['auto_pt_time'] != 'off') checked="checked" @endif>
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="col-6 text-center">
                            <label class="switch mb-0">
                                <input type="checkbox" class="save_config"  id="auto_time_start" @if(@$connection['auto_time_start'] != 'off') checked="checked" @endif>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      </div>
    </div>
</div>
<script>
    $(".select_camera_list").click(function(){
        var sub = $(this).attr('sub')
        if($(this).is(':checked')){
            $("#menu_set_"+sub).addClass('active')
        }else{
            $("#menu_set_"+sub).removeClass('active')
        }
        set_show_camera()
    })

    $(".camera_set_name").keyup(function(){
        var sub = $(this).attr('sub')
        var this_val = $(this).val()
        $("#name_label_"+sub).html(this_val)
    })


    function set_show_camera(){
        var count_switch = $(".select_camera_list:checked").length
        var class_set    = "col-lg-12"
        var class_height = "h-100"
        $(".set_class_camera").removeClass('col-lg-12').removeClass('col-lg-6').removeClass('h-100').removeClass('h-50')
        if(count_switch>1){
             class_set    = "col-lg-6"
             class_height = "h-50"
        }
        for(i=0;i<4;i++){
            var this_id = i+1;
            var sub = $($(".select_camera_list")[i]).attr('sub')
            if($($(".select_camera_list")[i]).is(':checked')){
                $("#image"+this_id).addClass('d-flex')
                $("#image"+this_id).removeClass('d-none')
                $("#image"+this_id).addClass(class_set)
                $("#image"+this_id).addClass(class_height)
            }else{
                $("#image"+this_id).addClass('d-none').removeClass('d-flex')
            }



        }
    }
</script>
