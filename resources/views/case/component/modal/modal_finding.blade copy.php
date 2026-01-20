<style>
    .scoll{
        overflow-x: auto;
        width: 100%;
    }

    .w-20{
        width: 20%;
    }
    ::-webkit-scrollbar {
    width: 10px;
    height: 10px;
}

::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px grey;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: #B5B5C3;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: skyblue;
}
.box-check{
    border: 1px solid #E4E6EF;
    border-radius: 5px;
    padding: 5px;
}
.modal-select{
    display: none;
}
.modal-select.active{
    display: flex;
}
.cn{
    align-items: center;
}
.mh-3{
    min-height: 2em;
}
.mainpart{
    display: none;
}
.mainpart.active{
    display: block;
}
.img_modal{
   border: 4px solid #fff;
    width: 200px;
    height: 200px;
}
.img_s{
    display: inline;
    width: 210px;
    height: 210px;
}
</style>
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
                      <div class="scoll mb-5">
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
                            <div class="col-lg-3">
                                <h3>Quantity</h3>
                            </div>
                            <div class="col-lg-3">
                                <h3>Size</h3>
                            </div>
                            <div class="col-lg-3">
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
                                    <input type="checkbox" name="Checkboxes{{$x}}" value="Test 0{{$x}}" sub_id="{{$x}}" class="modal-menu-check">
                                    <span></span>
                                    &emsp;{{@$tb_diagnostic->diagnostic_name}} [{{@$tb_diagnostic->diagnostic_id}}]
                                </label>
                            </div>
                            <div class="col-lg-3 mh-3">
                                <div class="row m-0 modal-select s{{$x}} rounded-0">
                                    <div class="col-6 p-0">
                                        <select name="" id="" class="form-control form-control-sm rounded-0 qty" sub="{{$x}}">
                                            <option value="0">select</option>
                                            <option value="one">1</option>
                                            <option value="two">2</option>
                                            <option value="three">3</option>
                                            <option value="four">4</option>
                                            <option value="five">5</option>
                                        </select>
                                    </div>
                                    <div class="col-6 p-0">
                                        <input type="text" name="" class="form-control form-control-sm rounded-0 qty{{$x}} text-data" sub_id="{{$x}}" sub_text="Test 0{{$x}}" ps="1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 mh-3">
                                <div class="row m-0 modal-select s{{$x}} rounded-0">
                                    <div class="col-6 p-0">
                                        <select name="" id="" class="form-control form-control-sm size" sub="{{$x}}">
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
                                        <input type="text" name="" class="form-control form-control-sm rounded-0 size{{$x}} text-data" sub_id="{{$x}}" sub_text="size" ps="2">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 mh-3">
                                <div class="row m-0 modal-select s{{$x}} rounded-0">
                                    <div class="col-6 p-0">
                                        <select name="" id="" class="form-control form-control-sm region" sub="{{$x}}">
                                            <option value="0">select</option>
                                            <option value="upper _cm. form incisor">upper _cm. form incisor</option>
                                            <option value="middle _cm. form incisor">middle _cm. form incisor</option>
                                            <option value="lower _cm. form incisor">upper _cm. form incisor</option>
                                        </select>
                                    </div>
                                    <div class="col-6 p-0">
                                        <input type="text" name="" class="form-control form-control-sm rounded-0 region{{$x}} text-data" sub_id="{{$x}}" sub_text="At" ps="2">
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
                                <textarea name="detail_text" id="detail_text" class="form-control" rows="10"></textarea>
                            </div>
                            <div class="col-lg-6 mt-3">
                            <h3>Copy this selected to</h3>
                            <div class="box-check checkbox-list">
                                @foreach ($mainpartsub as $copy)
                                <label class="checkbox">
                                    <input type="checkbox" name="Checkboxes1"/>
                                    <span></span>
                                    {{$copy->mainpartsub_name}}
                                </label>
                                @endforeach
                            </div>
                            </div>
                            <div class="col-lg-6 mt-3">
                                <button class="btn btn-success h-100 w-100">Save</button>
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

    function gen_image(){
        var mp_img_count = $(".selectmainsub").length
        setTimeout(function(){
            $(".img_s").remove();
            for(i=0;i<mp_img_count;i++){
                var name_sub =  $($(".selectmainsub")[i]).val();
                var save_image_mp = $($(".selectmainsub")[i]).attr('photo_id');
                var image_mp = $("#photoselect"+save_image_mp).attr("src");
                // console.log("\nMain ID : "+name_sub+" URL ภาพ :"+image_mp)
                var img_src = "<div class='img_s'><img src='"+image_mp+"' class='img_modal'></div>"
                $("#image_mp_"+name_sub).append(img_src)
            }
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
        if($(this).prop("checked") == true){
            $(".s"+id).addClass('active')
                // console.log("Checkbox is checked.");
        }
        else if($(this).prop("checked") == false){
            $(".s"+id).removeClass('active')
            // console.log("Checkbox is unchecked.");
        }
        call_data()
    })
    $(".qty").change(function(){
        var qty = $(this).attr('sub')
        var value = $(this).val()
        if(value!=0){
            $('.qty'+qty).val(value);
        }else{
            $('.qty'+qty).val(null);
        }
        call_data()
    })
    $(".size").change(function(){
        var size = $(this).attr('sub');
        var value = $(this).val()
        if(value!=0){
            $('.size'+size).val(value);
        }else{
            $('.size'+size).val(null);
        }
        call_data()
    })
    $(".region").change(function(){
        var region = $(this).attr('sub');
        var value = $(this).val()
        if(value!=0){
            $('.region'+region).val(value);
        }else{
            $('.region'+region).val(null);
        }
        call_data()
    })
    $(".text-data").on('change keyup',function(){
        call_data()
    })
    function call_data(){
        var ct = $(".text-data").length
        console.log(ct)
        var text = '';
        var save_val = '';
        var save_text = '';
        var ps = '';
        var line = '';
        var sub_id = '';
        for(i=0;i<ct;i++){
            save_val = $($(".text-data")[i]).val()
            save_text = $($(".text-data")[i]).attr('sub_text')
            ps = $($(".text-data")[i]).attr('ps')
            sub_id = $($(".text-data")[i]).attr('sub_id')

            if(save_val!=undefined){
                if($('.modal-menu-check[sub_id="'+sub_id+'"]').prop("checked") == true){
                    if(save_text=='At'){
                        line = "\n"
                    }else{
                        line = ""
                    }
                    if(ps==1){
                        text += save_val+" "+save_text+line
                    }else{
                        text += " "+save_text+" "+save_val+line
                    }
                }
            }
        }
        console.log(text)

        $("#detail_text").val(text)
    }
</script>
