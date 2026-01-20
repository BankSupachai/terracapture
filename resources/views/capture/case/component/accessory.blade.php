
<link rel="stylesheet" href="{{url('public/css/component/accessory.css')}}">
<div class="col-12">
    {!! editcard('accessory', 'accessory.blade.php') !!}
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <div class="row">
                <div class="col-auto">
                    <u>
                        <h3>BILLING</h3>
                    </u>
                </div>
                <div class="col-3">
                    <select name="" id="ck_accessory" class="form-control form-control-sm">
                        <option value="">ไม่มีข้อมูล</option>
                        @isset($righttotreatment)
                            @foreach ($righttotreatment as $rtm)
                            <option value="{{$rtm->name}}" @if(@$case->righttotreatment == $rtm->name) select @endif>{{$rtm->name}}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-5 border-right">
                    <table class="table table-borderless table-striped">
                        <thead>
                            <tr>
                                <th class="">Code</th>
                                <th>ICD-9</th>
                                <th class="tb_number">ราคาเบิกจ่าย</th>
                                <th class="tb_number">ราคา</th>
                            </tr>
                        </thead>

                        @php
                            if(isset($case->billingicd9)){
                                $bill = DB::table('tb_procedureicd9')->wherein('proicd9_id',$case->billingicd9)->get();
                            }
                        @endphp


                        <tbody id="change_icd9">
                            @isset($bill)
                                @foreach($bill as $icd9)
                                    <tr id="acc{{$icd9->proicd9_id}}">
                                    <td class='tb_code' style="display: none">{{$icd9->proicd9_id}}</td>
                                    <td>{{$icd9->icd9}}</td>
                                    <td>{{$icd9->icd9_billname}}</td>
                                    <td class='tb_number'>-</td>
                                    <td class='tb_number sum_price'>{{$icd9->icd9_billprice}}</td>
                                    </tr>
                                @endforeach
                            @endisset
                        </tbody>

                    </table>
                </div>
                <div class="col-7">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>Accessory</th>
                                <th class="tb_number">จำนวน</th>
                                <th class="tb_number">ราคา</th>
                                <th class="tb_select"></th>
                            </tr>
                        </thead>

                        @php
                            $count_acc  = 0;
                            if(isset($case->billing_accessory)){
                                $count_acc++;
                            }
                        @endphp

                        <tbody id="change_accessory">

                            @isset($case->billing_accessory)
                                @foreach($case->billing_accessory as $acc)
                                    <tr class='tr_accessory' id='tr_acc{{$count_acc}}'>
                                    <td>
                                    <select name='' id='select_id_acc{{$count_acc}}' class='form-control form-control-sm billaccessoryname' onchange='change_val_acc("{{$count_acc}}")'>
                                    <option>select</option>
                                        @foreach ($accessory as $acs)

                                            @if($acs->accessory_id==$acc[0])
                                                <option selected="selected" value='{{$acs->accessory_id}}' price='{{$acs->accessory_price}}'>{{$acs->accessory_name}}</option>
                                            @else
                                                <option value='{{$acs->accessory_id}}' price='{{$acs->accessory_price}}'>{{$acs->accessory_name}}</option>
                                            @endif





                                        @endforeach
                                    </select>
                                    </td>
                                    <td class='tb_number'><input type='number' name=''  onchange='sum_prices()' id='' value='{{$acc[1]}}' class='form-control form-control-sm billaccessorynum'></td>
                                    <td class='tb_number'><input type='number' name='' id='acc_price{{$count_acc}}' value='{{$acc[2]}}' class='form-control form-control-sm price_of billaccessoryprice'></td>
                                    <td class='tb_select'><button type='button' class='btn btn-danger btn-sm' onclick='del_acce("{{$count_acc}}")'><i class='fas fa-trash p-0'></i></button></td>
                                    </tr>

                                    @php
                                        $count_acc++;
                                    @endphp
                                @endforeach
                            @endisset




                        </tbody>
                        <tbody>
                            <tr>
                                <td colspan="3"><button type="button" class="btn btn-success" id="add_accessory"><i class="fas fa-plus p-0"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12">
                    <div class="input-group">
                        <input type="number" class="form-control text-right" id="sum_accessory" placeholder="0.00" aria-describedby="basic-addon2"/>
                        <div class="input-group-append"><span class="input-group-text">ราคารวม</span></div>
                    </div>
                </div>
            </div>
        </div>
     </div>
</div>


<script>
    $("#ck_accessory,#righttotreatment").change(function(){
        var this_accessory = $(this).val();
        if($("#righttotreatment").val()!=this_accessory){
            $("#righttotreatment").val(this_accessory).change();
        }
        if($("#ck_accessory").val()!=this_accessory){
            $("#ck_accessory").val(this_accessory).change();
        }
    })

    $(".boxicd9").click(function(){
        var this_id_icd9    = $(this).attr('ckid');
        var this_code_icd9  = $(this).attr('icd9code');
        var this_name_icd9  = $(this).attr('icd9_billname');
        var this_price_icd9 = $(this).attr('icd9_billprice');



        if($(this).prop('checked') == true){
        var gen_tr  = '<tr id="acc'+this_id_icd9+'">';
            gen_tr += "<td class='tb_code' style='display:none'>"+this_id_icd9+"</td>";
            gen_tr += "<td>"+this_code_icd9+"</td>";
            gen_tr += "<td>"+this_name_icd9+"</td>";
            gen_tr += "<td class='tb_number'>-</td>";
            gen_tr += "<td class='tb_number sum_price'>"+this_price_icd9+"</td>";
            gen_tr += "</tr>";
            $("#change_icd9").append(gen_tr);
        }else{
            $("#acc"+this_id_icd9).remove();
        }

        var arr = new Array();
        $('.tb_code').each(function() {
            fullHtml = $(this).html();
            arr.push(fullHtml);
        });

        $.post('{{url('api/jquery')}}',{
            event       : 'savejson_checkbox2',
            idhtml      : 'billingicd9',
            value       : arr,
            table       : 'tb_case',
            idname      : 'case_id',
            id          : '{{@$cid}}',
            procedure   : '{{@$case->procedure_code}}',
        },function(data,status){});


    });


    function icd9_normal_set(){
        if($("#icd9_normal").is(':checked')){
            $("#change_icd9 tr").remove()
        }
    }




    $("#add_accessory").click(function(){
        var count_accessory = $(".tr_accessory").length+1;


        var acc_tr = "<tr class='tr_accessory' id='tr_acc"+count_accessory+"'>";
            acc_tr +="<td>";
            acc_tr +="<select name='' id='select_id_acc"+count_accessory+"' class='form-control form-control-sm billaccessoryname' onchange='change_val_acc("+count_accessory+")'>";
            acc_tr +="<option>select</option>";
            @if(isset($accessory))
                @foreach ($accessory as $acs)
                    acc_tr +="<option value='{{$acs->accessory_id}}' price='{{$acs->accessory_price}}'>{{$acs->accessory_name}}</option>";
                @endforeach
            @endif
            acc_tr +="</select>";
            acc_tr +="</td>";
            acc_tr +="<td class='tb_number'><input type='number' onchange='sum_prices()' name='' id='' value='1' class='form-control form-control-sm billaccessorynum'></td>";
            acc_tr +="<td class='tb_number'><input type='number' name='' id='acc_price"+count_accessory+"' value='0' class='form-control form-control-sm price_of billaccessoryprice'></td>";
            acc_tr +="<td class='tb_select'><button type='button' class='btn btn-danger btn-sm' onclick='del_acce("+count_accessory+")'><i class='fas fa-trash p-0'></i></button></td>";
            acc_tr +="</tr>";


        $("#change_accessory").append(acc_tr)
        $('.billaccessoryname,.billaccessorynum,.billaccessoryprice').focusout(function(){
            var acc_name    = [];
            var acc_num     = [];
            var acc_price   = [];
            var acc_all     = [];
            var i = 0;
            $('.billaccessoryname').each(function()     {acc_name.push($(this).val());});
            $('.billaccessorynum').each(function()      {acc_num.push($(this).val());});
            $('.billaccessoryprice').each(function()    {
                var temp = [];
                temp.push(acc_name[i]);
                temp.push(acc_num[i]);
                temp.push($(this).val());
                i++;
                acc_all.push(temp);
            });

            $.post('{{url('api/jquery')}}',{
            event       : 'savejson_checkbox2',
            idhtml      : 'billing_accessory',
            value       : acc_all,
            table       : 'tb_case',
            idname      : 'case_id',
            id          : '{{$cid}}',
            procedure   : '{{@$case->procedure_code}}',
            },function(data,status){});
        });




    })

    function del_acce(id){
        $("#tr_acc"+id).remove()
        sum_prices()
        var acc_name    = [];
        var acc_num     = [];
        var acc_price   = [];
        var acc_all     = [];
        var i = 0;
        $('.billaccessoryname').each(function()     {acc_name.push($(this).val());});
        $('.billaccessorynum').each(function()      {acc_num.push($(this).val());});
        $('.billaccessoryprice').each(function()    {
            var temp = [];
            temp.push(acc_name[i]);
            temp.push(acc_num[i]);
            temp.push($(this).val());
            i++;
            acc_all.push(temp);
        });

        $.post('{{url('api/jquery')}}',{
        event       : 'savejson_checkbox2',
        idhtml      : 'billing_accessory',
        value       : acc_all,
        table       : 'tb_case',
        idname      : 'case_id',
        id          : '{{$cid}}',
        procedure   : '{{@$case->procedure_code}}',
        },function(data,status){});

    }

    function change_val_acc(data){
        var this_acc_val = $("#select_id_acc"+data).val()
        var this_acc_price = $("#select_id_acc"+data+" option[value='"+this_acc_val+"']").attr('price');
        $("#acc_price"+data).val(this_acc_price)
        sum_prices()
    }

    function sum_prices(){
        var sum = 0;
        var left_sum = 0;
        var costs = 0;
        var count_prices = $(".price_of").length;
        var left_price = $(".sum_price").length;
        for(x=0;x<left_price;x++){
            var left_p = parseInt($($('.sum_price')[x]).text())
            left_sum = left_sum+left_p;
        }
        for(i=0;i<count_prices;i++){
            consts = parseInt(parseInt($($(".billaccessorynum")[i]).val()) * parseInt($($(".price_of")[i]).val()))
            sum = sum+consts;
        }
        $("#sum_accessory").val(sum+left_sum);
    }

    var check_price = $(".price_of").length;
    if(check_price>=1){
        sum_prices()
    }
</script>

