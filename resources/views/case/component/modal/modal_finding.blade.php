<style>

</style>
<link rel="stylesheet" href="{{url("public/css/component/case/modal/modal_finding.css")}}">
<div class="modal fade modal-finging" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content p-5">
          <div class="row m-0 mb-3">
              <div class="col-lg-2">
                  <select name="" class="form-control" id="select_mainpart">
                      @foreach ($mainpartsub as $mps)
                        <option value="{{$mps->mainpartsub_id}}">{{$mps->mainpartsub_name}}</option>
                      @endforeach
                  </select>
              </div>
          </div>
          @foreach ($mainpartsub as $show_mps)


            <div class="submp{{$show_mps->mainpartsub_id}} mainpart">
                <div class="row">
                      <div class="scoll mb-5 pl-5">
                          <div class="table table-borderless" id="image_mp_{{$show_mps->mainpartsub_id}}">


                          </div>
                      </div>
                </div>
                <div class="row m-0 mt-5">
                    <div class="col-lg-8">
                        <div class="row m-0">
                            <div class="col-lg-3">
                                <h3>Lesion</h3>
                            </div>
                            <div class="col-lg-2">
                                <h3>Quantity</h3>
                            </div>
                            <div class="col-lg-2">
                                <h3>Size</h3>
                            </div>
                            <div class="col-lg-5">
                                <h3>Region</h3>
                            </div>
                        </div>

                        @php
                            $json_icd10 = jsonDecode($show_mps->mainpartsub_icd10);
                        @endphp


                        @foreach ($json_icd10 as $icd10_index)
                            @php
                                $tb_diagnostic = DB::table('tb_diagnostic')->where('icd10_index',$icd10_index)->first();
                                $x = 0;
                            @endphp


                        <div class="row m-0 mt-2 cn">
                            <div class="col-lg-3 mh-3">
                                <label class="checkbox">
                                    <input main_id="{{@$show_mps->mainpartsub_id}}" type="checkbox" name="Checkboxes[]" value="{{@$tb_diagnostic->diagnostic_name}}" v_id="{{@$tb_diagnostic->diagnostic_id}}" sub_id="{{$show_mps->mainpartsub_id}}icd{{@$tb_diagnostic->diagnostic_id}}" class="modal-menu-check">
                                    <span></span>
                                    &emsp;{{@$tb_diagnostic->diagnostic_name}}
                                </label>
                            </div>
                            <div class="col-lg-2 mh-3">
                                <div class="row m-0 modal-select {{$show_mps->mainpartsub_id}}icd{{@$tb_diagnostic->diagnostic_id}} rounded-0">
                                    <div class="col-6 p-0">
                                        <select main_id="{{$show_mps->mainpartsub_id}}" name="" id="" class="form-control form-control-sm rounded-0 qty" sub="{{$show_mps->mainpartsub_id}}icd{{@$tb_diagnostic->diagnostic_id}}">
                                            <option value="0">select</option>
                                            <option value="one">1</option>
                                            <option value="two">2</option>
                                            <option value="three">3</option>
                                            <option value="four">4</option>
                                            <option value="five">5</option>
                                        </select>
                                    </div>
                                    <div class="col-6 p-0">
                                        <input main_id="{{$show_mps->mainpartsub_id}}"
                                        type="text" name=""
                                        class="form-control form-control-sm rounded-0 qty{{$show_mps->mainpartsub_id}}icd{{@$tb_diagnostic->diagnostic_id}} text-data{{$show_mps->mainpartsub_id}} text-d autotext"
                                        sub_id="{{$show_mps->mainpartsub_id}}icd{{@$tb_diagnostic->diagnostic_id}}"
                                        sub_text="{{@$tb_diagnostic->diagnostic_name}}" ps="1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 mh-3">
                                <div class="row m-0 modal-select {{$show_mps->mainpartsub_id}}icd{{@$tb_diagnostic->diagnostic_id}} rounded-0">
                                    <div class="col-6 p-0">
                                        <select main_id="{{$show_mps->mainpartsub_id}}" name="" id="" class="form-control form-control-sm size" sub="{{$show_mps->mainpartsub_id}}icd{{@$tb_diagnostic->diagnostic_id}}">
                                            <option value="0">select</option>
                                            <option value="cm">cm</option>
                                            <option value="1 cm.">1 cm.</option>
                                            <option value="1.5 cm.">1.5 cm.</option>
                                            <option value="2 cm">2 cm</option>
                                            <option value="2.5 cm.">2.5 cm.</option>
                                            <option value="3 cm.">3 cm.</option>
                                        </select>
                                    </div>
                                    <div class="col-6 p-0">
                                        <input main_id="{{$show_mps->mainpartsub_id}}"
                                        type="text" name=""
                                        class="form-control form-control-sm rounded-0 size{{$show_mps->mainpartsub_id}}icd{{@$tb_diagnostic->diagnostic_id}} text-data{{$show_mps->mainpartsub_id}} text-d autotext"
                                        sub_id="{{$show_mps->mainpartsub_id}}icd{{@$tb_diagnostic->diagnostic_id}}"
                                        sub_text="size" ps="2">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 mh-3">
                                <div class="row m-0 modal-select {{$show_mps->mainpartsub_id}}icd{{@$tb_diagnostic->diagnostic_id}} rounded-0">
                                    <div class="col-3 p-0">
                                        <select main_id="{{$show_mps->mainpartsub_id}}" name="" id="" class="form-control form-control-sm region" sub="{{$show_mps->mainpartsub_id}}icd{{@$tb_diagnostic->diagnostic_id}}">
                                            <option value="0">select</option>
                                            <option value="upper _cm. form incisor">upper _cm. form incisor</option>
                                            <option value="middle _cm. form incisor">middle _cm. form incisor</option>
                                            <option value="lower _cm. form incisor">upper _cm. form incisor</option>
                                        </select>
                                    </div>
                                    <div class="col-9 p-0">
                                        <input main_id="{{$show_mps->mainpartsub_id}}"
                                        type="text" name=""
                                        class="form-control form-control-sm rounded-0 region{{$show_mps->mainpartsub_id}}icd{{@$tb_diagnostic->diagnostic_id}} text-data{{$show_mps->mainpartsub_id}} text-d autotext"
                                        sub_id="{{$show_mps->mainpartsub_id}}icd{{@$tb_diagnostic->diagnostic_id}}"
                                        sub_text="At" ps="2">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <div class="col-lg-4">
                        <div class="row m-0">
                            <div class="col-lg-12">
                                <h3>Preview</h3>
                            </div>
                            <div class="col-lg-12">
                                <textarea name="detail_text" id="detail_text{{$show_mps->mainpartsub_id}}" class="form-control save-textarea" rows="10"></textarea>
                            </div>
                            <div class="col-lg-6 mt-3">
                            <h3>Copy this selected to</h3>
                            <div class="box-check checkbox-list">
                                @foreach ($mainpartsub as $copy)
                                <label class="checkbox">
                                    <input type="checkbox" name="Checkboxes1" class="ck_copy" value="{{$copy->mainpartsub_id}}"/>
                                    <span></span>
                                    {{$copy->mainpartsub_name}}
                                </label>
                                @endforeach
                            </div>
                            </div>
                            <div class="col-lg-6 mt-3">
                                <button type="button" class="btn btn-success h-100 w-100 btn-finding-save" data-dismiss="modal">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          @endforeach

      </div>
    </div>
</div>
<script>
    $(".btn-finding-save").click(function(){
        var count_tr = $(".save-textarea").length
        for(i=0;i<count_tr;i++){

            var lines = ($($(".save-textarea")[i]).val().split("\n").length*2)+'em';
            var textarea_data = $($(".save-textarea")[i]).val()
            var select_id = $($('.select-imgs')[i]).attr('sub');
            if($($('.modal-menu-check')[i]).prop("checked") == true){
                var ck_it = $($('.modal-menu-check')[i]).val()
                if($('.boxicd10[value="'+ck_it+'"]').prop("checked") == false){
                    $('.boxicd10[value="'+ck_it+'"]').click()
                }

            }
            if(select_id!=undefined){
                var select_val = $($('.select-imgs')[i]).val();
                var input_val = $('.text-img[sub="'+select_id+'"]').val();
                $('.selectmainsub[photo_id="'+select_id+'"]').val(select_val).change()
                $('#phototext_select'+select_id).val(input_val)
                $('#phototext_select'+select_id).focusout()
            }
            if(textarea_data.length>5){
                $($(".finding_")[i]).val(textarea_data)
                $($(".finding_")[i]).focusout()
                $($(".finding_")[i]).css('height',lines)
            }
        }
    })

    $('.boxicd10').change(function(){
        if($(this).prop("checked") == false){
            var ck_val = $(this).val()
            var count = $('.modal-menu-check[value="'+ck_val+'"]').length
            for(i=0;i<count;i++){
                if($($('.modal-menu-check[value="'+ck_val+'"]')[i]).prop("checked") == true){
                    $($('.modal-menu-check[value="'+ck_val+'"]')[i]).click()
                }
            }
        }
        // $('#modal_progress').modal('show');
        $(".btn-finding-save").click()
        // setTimeout(function(){
        //     $('#modal_progress').modal('hide');
        //  }, 500);
    })
    $(".ck_copy").click(function(){
        var menu_id     = $("#select_mainpart").val()
        var ck_val      = $(this).val()
        var count       = $('.modal-menu-check[main_id="'+menu_id+'"]').length
        var t_detail    = $("#detail_text"+menu_id).val()
            // alert(menu_id)
        for(i=0;i<count;i++){
            if($($('.modal-menu-check[main_id="'+menu_id+'"]')[i]).prop("checked") == true){
                var data        = $($('.modal-menu-check[main_id="'+menu_id+'"]')[i]).attr('v_id')
                var data_qty    = $($('.qty[main_id="'+menu_id+'"]')[i]).val()
                var data_size   = $($('.size[main_id="'+menu_id+'"]')[i]).val()
                var data_region = $($('.region[main_id="'+menu_id+'"]')[i]).val()
                var text_qty    = $('.qty'+menu_id+'icd'+data).val()
                var text_size   = $('.size'+menu_id+'icd'+data).val()
                var text_region = $('.region'+menu_id+'icd'+data).val()
                console.log(data)
                if($('.modal-menu-check[sub_id="'+ck_val+'icd'+data+'"]').prop("checked") == false){
                    $('.'+ck_val+'icd'+data).addClass('active');
                    $('.modal-menu-check[sub_id="'+ck_val+'icd'+data+'"]').attr("checked",true)
                    $($('.qty[main_id="'+ck_val+'"]')[i]).val(data_qty)
                    $($('.size[main_id="'+ck_val+'"]')[i]).val(data_size)
                    $($('.region[main_id="'+ck_val+'"]')[i]).val(data_region)
                    $('.qty'+ck_val+'icd'+data).val(text_qty)
                    $('.size'+ck_val+'icd'+data).val(text_size)
                    $('.region'+ck_val+'icd'+data).val(text_region)
                }
            }
        }
        $('#modal_progress').modal('show');
        $("#detail_text"+ck_val).val(t_detail)
        setTimeout(function(){
            $('#modal_progress').modal('hide');
         }, 500);
    })
    function gen_image(){
        var mp_img_count = $(".selectmainsub").length
        setTimeout(function(){
            $(".img_s").remove();
            $(".select_modal_wiath").remove();
            for(i=0;i<mp_img_count;i++){
                var text_v = $($(".photo_savetxt")[i]).val()
                var name_sub =  $($(".selectmainsub")[i]).val();
                var save_image_mp = $($(".selectmainsub")[i]).attr('photo_id');
                var image_mp = $("#photoselect"+save_image_mp).attr("src");
                var selected_img = $($(".selectmainsub")[i]).val();
                var img_src = "<div class='select_modal_wiath'><div class='img_s'><img src='"+image_mp+"' class='img_modal'></div>"
                    img_src+= "<select class='form-control w-90 select-imgs'"
                    img_src+= "sub='"+save_image_mp+"' "
                    img_src+= "onchange='"
                    img_src+= 'move_img(this,"'+image_mp+'","'+save_image_mp+'")'
                    img_src+= "'>"
                    @foreach ($mainpartsub as $gen)
                        img_src+= "<option value='{{$gen->mainpartsub_id}}"+"'"
                        if("{{$gen->mainpartsub_id}}"==selected_img){
                            img_src+= " selected"
                        }
                        img_src+=">{{$gen->mainpartsub_name}}</option>"
                    @endforeach
                    img_src+= "</select>"
                    img_src+= "<input type='text' class='form-control w-90 text-img' sub='"+save_image_mp+"' value='"+text_v+"'>"
                    img_src+= "</div>"
                $("#image_mp_"+name_sub).append(img_src)
            }
        }, 500);
        $('#modal_progress').modal('show');
        setTimeout(function(){
            $('#modal_progress').modal('hide');
         }, 500);
    }

    function move_img(data,img,id){

        var send_image = data.value
        var send_src = img
        var text_i = $('.text-img[sub="'+id+'"]').val();
        $('.text-img[sub="'+id+'"]').remove();
        $(data).remove();
        $('.img_modal[src="'+send_src+'"]').remove()
        var img_src_new = "<div class='select_modal_wiath'><div class='img_s'><img src='"+send_src+"' class='img_modal'></div>"
            img_src_new+= "<select class='form-control w-90 select-imgs' "
            img_src_new+= "sub='"+id+"' "
            img_src_new+= "onchange='"
            img_src_new+= 'move_img(this,"'+send_src+'","'+id+'")'
            img_src_new+= "'>"
            @foreach ($mainpartsub as $gens)
            img_src_new+= "<option value='{{$gens->mainpartsub_id}}"+"'"
                if("{{$gens->mainpartsub_id}}"==send_image){
                    img_src_new+= " selected"
                }
                img_src_new+=">{{$gens->mainpartsub_name}}</option>"
            @endforeach
            img_src_new+= "</select>"
            img_src_new+= "<input type='text' class='form-control w-90 text-img'sub='"+id+"' value='"+text_i+"'>"
            img_src_new+= "</div>"

        $('#modal_progress').modal('show');
        $("#image_mp_"+send_image).append(img_src_new)
        setTimeout(function(){
            $('#modal_progress').modal('hide');
         }, 500);
    }


    $(".btn-finding").click(function(){
        var select_finding = $(this).attr('sub_data');
        setTimeout(function(){
            $("#select_mainpart").val(select_finding).change()
         }, 1000);
    })
    $("#select_mainpart").change(function(){
        var this_tab = $(this).val()
        $(".mainpart").removeClass('active');
        $(".submp"+this_tab).addClass('active')

    })
    $(".modal-menu-check").click(function(){
        var id = $(this).attr('sub_id')
        var main_id = $(this).attr('main_id')
        if($(this).prop("checked") == true){
            $("."+id).addClass('active')
                // console.log("Checkbox is checked.");
        }
        else if($(this).prop("checked") == false){
            $("."+id).removeClass('active')
            // console.log("Checkbox is unchecked.");
        }
        call_data(id,main_id)
    })
    $(".qty").change(function(){
        var qty = $(this).attr('sub')
        var value = $(this).val()
        var main_id = $(this).attr('main_id')
        if(value!=0){
            $('.qty'+qty).val(value);
        }else{
            $('.qty'+qty).val(null);
        }
        call_data(qty,main_id)
    })
    $(".size").change(function(){
        var size = $(this).attr('sub');
        var value = $(this).val()
        var main_id = $(this).attr('main_id')
        if(value!=0){
            $('.size'+size).val(value);
        }else{
            $('.size'+size).val(null);
        }
        call_data(size,main_id)
    })
    $(".region").change(function(){
        var region = $(this).attr('sub');
        var value = $(this).val()
        var main_id = $(this).attr('main_id')

        if(value!=0){
            $('.region'+region).val(value);
        }else{
            $('.region'+region).val(null);
        }
        call_data(region,main_id)
    })
    $(".text-d").on('change keyup',function(){
        var sub_id = $(this).attr('sub_id');
        var main_id = $(this).attr('main_id')
        call_data(sub_id,main_id)
    })
    function call_data(id,m_id){
        var ct = $(".text-data"+m_id).length
        var text = '';
        var save_val = '';
        var save_text = '';
        var ps = '';
        var line = '';
        var max = ct-1;
        for(i=0;i<ct;i++){
            save_val = $($(".text-data"+m_id)[i]).val()
            save_text = $($(".text-data"+m_id)[i]).attr('sub_text')
            var sub_ids = $($(".text-data"+m_id)[i]).attr('sub_id')
            ps = $($(".text-data"+m_id)[i]).attr('ps')
            // if(save_val.length>1){

                if($('.modal-menu-check[sub_id="'+sub_ids+'"]').prop("checked") == true){
                        if(save_text=='At'){
                            line = "\n"
                        }else{
                            line = ""
                        }
                        if(i==max){
                            line = ""
                        }
                        if(save_val.length==0){
                            if(save_text=='size'||save_text=='At'){
                                save_text = ""
                            }
                        }
                        if(ps==1){
                            text += save_val+" "+save_text+line
                        }else{
                            text += " "+save_text+" "+save_val+line
                        }
                        console.log(save_text)

                }
            }
        // }
        // console.log(text)
        // $('#modal_progress').modal('show');
        $("#detail_text"+m_id).val(text)
        // setTimeout(function(){
            // $('#modal_progress').modal('hide');
        //  }, 500);
    }
</script>
