
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4>Physician Record</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="input-group">
                            <input type="text" class="form-control border border-dark" aria-label="Recipient's username" aria-describedby="add_tab">
                            <button class="btn btn-outline-dark" type="button" id="add_tab"><i class="ri-add-line"></i></button>
                        </div>
                        <div class="sc_data">
                            {{-- @php
                                $file_name_arr  = isset($dir) ? convert_file_name($dir) : [];
                                $file_value_arr = isset($dir) ? convert_file_name($dir, true) : [];
                            @endphp
                            @foreach($file_name_arr as $i=>$file)
                            <div class="row m-0 menu-phy-select" id="select_phy{{$i}}" data="{{$file_value_arr[$i]}}">
                                <div class="col">
                                    <div class="form-check" >
                                        <input class="form-check-input make-form" type="checkbox" id="case_inp{{$i}}"  value="{{$file_value_arr[$i]}}" @if(in_array($file_value_arr[$i], $procedure_cases)) checked @endif>
                                        <label class="form-check-label" for="formCheck{{$i}}" onclick="checked_checkbox({{$i}})">
                                           {{$file}}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-auto change-form" onclick="change_form({{$i}})">
                                    <i class="ri-arrow-right-s-line"></i>
                                </div>
                            </div>
                            @endforeach --}}
                            {{-- @for($i=0;$i<=10;$i++)
                            <div class="row m-0 menu-phy-select">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input make-form" type="checkbox" id="formCheck{{$i}}" value="{{$i}}">
                                        <label class="form-check-label" for="formCheck{{$i}}">
                                           Form Data {{$i}}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-auto change-form" onclick="change_form({{$i}})">
                                    <i class="ri-arrow-right-s-line"></i>
                                </div>
                            </div>
                            @endfor --}}

                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="input-group">
                                    <input type="text" class="form-control border border-dark" aria-label="Recipient's username" aria-describedby="add_field">
                                    <button class="btn btn-outline-dark" type="button" id="add_field"><i class="ri-add-line"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="sc_data">
                            <div class="row m-0" id="check_list">

                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-end mt-3">
                        <input type="hidden" id="arrow_id">
                        <button type="button" class="btn btn-primary btn-label waves-effect right waves-light" onclick="save_case()"><i class="ri-play-mini-fill label-icon align-middle fs-16 ms-2"></i> Save</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <h4>Preview</h4>
                    </div>
                </div>
                <div class="box-form ">

                    <ul class="nav nav-tabs nav-justified mb-3 sortnav" role="tablist">

                    </ul>
                    {{-- <div class="row">
                        <div class="col-lg-10">
                            <div class="tab-content text-muted tab-physician-record">


                            </div>
                        </div>
                        <div class="col-lg-2" id="menu_button" style="background: yellow; margin-top:100px; min-height:150px">
                            <button class="btn btn-success w-100 mt-2">b1</button>
                            <button class="btn btn-success w-100 mt-2">b1</button>
                        </div>
                    </div> --}}
                    <div class="tab-content text-muted tab-physician-record">


                    </div>


                    {{-- <div id="div2">2</div>
                    <div id="div0">0</div>
                    <div id="div1">1</div> --}}


                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{url("public/js/jquery-3.5.1.min.js")}}"></script>
<script src="{{url("public/js/jquery-ui.js")}}"></script>

<script>

$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});


    case_order = JSON.parse(case_order)

    let select_num = case_order.length
    for (let k = 0; k < select_num; k++) {
        checked_checkbox(case_order[k], true)
    }

    $(`.sortnav`).sortable({
            revert: true,
            receive: function (event, ui) {
                //
            }
        }).droppable({ });

    function change_form(id){
        // check checked input before continue, if not checked fire warning to check it first
        let is_checked = $(`#case_inp${id}`).is(':checked')
        if(is_checked == true){
            $(".menu-phy-select").removeClass('active')
            $('#select_phy'+id).addClass('active')
            let case_name = $(`#case_inp${id}`).val()
            $.post("{{url('terra')}}/generate",
            {
                event   : 'physician_record',
                id      : id,
                code    : procedure_code,
                name    : case_name
            },
            function(data, status) {
                $("#check_list").html(data);
                $("#arrow_id").val(id);
                change_nav_tab('case_inp'+id)
            })
        } else {
            Swal.fire('โปรดกดเลือก checkbox ก่อน')
        }

    }

    function generate_form(id, enable_first_active=false){
        var size = $(".tab-head.active").length
        let case_name = $(`#${id}`).val()
        $.post("{{url('terra')}}/generate",
        {
            event   : 'append_form',
            id      : id,
            size    : size,
            name : case_name,
            code    : procedure_code,

        },
        function(data, status) {
            var form = JSON.parse(data)
            $(".box-form .nav-tabs").append(form.head);
            $($(".box-form .tab-content,.tab-physician-record")[0]).append(form.body);

            // remove active except first one
            let nav_lg = $($('.dragnav')).length
            for(x=0; x<nav_lg;x++){
                $($('.dragnav')[x]).find('a').removeClass('active')
                $($('.dragbody')[x]).removeClass('active')
            }

            let menulist = form.menulist
            menulist.forEach((e) => {
                $(`#row_${id}`).append(e+'<br>')
            })

            $(`#button_${id}`).empty()
            let buttonlist = form.buttonlist
            buttonlist.forEach((e) => {
                let button_name = convert_name(e)
                // let to_append = `<a href="#" id="btn_${e}" class="btn btn-success draggable mt-2">${button_name}</a>`
                // $(`#button_${id}`).append(to_append)
            })

            init_draggable()
            init_sortable()

            $( ".dragnav" ).draggable({
                connectToSortable: `.sortnav`,
                helper: "clone",
                // revert: "invalid",
                appendTo: 'body',
            });

        })

        // wait for head nav and body data (if not, nav won't rearrange themselves)
        setTimeout(() => {
            for (let x = 0; x < select_num; x++) {
                let num_bef = case_order[x]
                let num_aft = case_order[x+1]
                if(x == (select_num-1)){
                    $(`#head_case_inp${case_order[x]}`).insertAfter(`#head_case_inp${case_order[x-1]}`)
                    $(`#menushow_case_inp${case_order[x]}`).insertAfter(`#menushow_case${case_order[x-1]}`)

                } else {
                    $(`#head_case_inp${num_bef}`).insertBefore(`#head_case_inp${num_aft}`)
                    $(`#menushow_case_inp${num_bef}`).insertBefore(`#menushow_case${num_aft}`)
                    if(x == 0){
                        $(`#head_case_inp${case_order[x]}`).find('a').addClass('active')
                        $(`#menushow_case_inp${case_order[x]}`).addClass('active')
                    }
                }
            }
        }, 800);

    }

    function init_draggable() {
        $( ".draggable" ).draggable({
            connectToSortable: `.sortable`,
            helper: "clone",
            revert: "invalid",
            appendTo: 'body',
        });
    }

    function init_sortable(){
        $(`.sortable`).sortable({
            revert: true,
            receive: function (event, ui) {
                // let text = $(ui.item).text()
                // let file = $(ui.item)[0]
                // text = text.trim()
                // let parent_id = $(`#${file.id}`).parent().attr('id')
                // let case_inp  = parent_id.replace('button_', '')
                // file_name = file.id.replace('btn_', '')
                // $.post("{{url('terra')}}/generate",
                // {
                //     event   : 'get_field_file',
                //     file_name    : file_name,
                // },
                // function(data, status) {
                //     var parse = JSON.parse(data)
                //     let el = parse.form
                //     $(`#row_${case_inp}`).append(el);

                //     // delete button
                //     // let selected = $('.ui-draggable,.ui-draggable-handle').filter(function () {
                //     //     return $(this).text().toLowerCase().indexOf($(ui.item).text().toLowerCase()) >= 0
                //     // })
                //     // selected[0].remove()
                // })
            }
        }).droppable({ });

        $( "ul, li" ).disableSelection();
    }

    function remove_form(id){
        // $("#"+id).remove()
        $("#menushow_case_inp"+id).remove()
        $("#head_case_inp"+id).remove()
    }

    function checked_checkbox(num_id, generate=false) {
        if ($(`#case_inp${num_id}`).is(':checked') && generate == false){
            $(`#case_inp${num_id}`).prop('checked', false)
            remove_form(num_id)
        } else if ($(`#case_inp${num_id}`).is(':checked') && generate == true){
            generate_form(`case_inp${num_id}`, true)
        } else {
            $(`#case_inp${num_id}`).prop('checked', true)
            generate_form(`case_inp${num_id}`)
        }
    }

    function append_thisfile(element,value){
        let case_id = $("#arrow_id").val();

        if(element.checked){
            $.post("{{url('terra')}}/generate",
            {
                event   : 'get_field_file',
                file    : value,
                code    : procedure_code,
            },
            function(data, status) {
                var parse = JSON.parse(data)
                $(`#row_case_inp${case_id}`).append(parse.form)
                // let to_append = `<a href="#" id="btn_${parse.name}" class="btn btn-success draggable mt-2">${convert_name(parse.name)}</a>`
                // $(`#button_case_inp${case_id}`).append(to_append)
                init_draggable()
            })
        }else{
            let to_remove = $(`#row_case_inp${case_id}`).find(`[data-field="${value}"]`)
            // let form_id = to_remove[0].id
            // let btn_id = form_id.replace('form','btn')

            if(to_remove[0] != null && to_remove[0] != ''){
                to_remove[0].remove()
                // $(`#${btn_id}`).remove()
            }
        }
    }


    function change_nav_tab(id, change_menu_button=false) {
        let num_id = id.replace('case_inp', '')
        // check in preview then back to tick at checkbox
        let form_lg = $(`#row_${id} .field-form`).length
        let preview_num = []
        let file_arr = []
        for(i=0;i<form_lg;i++){
            let form_id = $($(`#row_${id} .field-form`)[i]).data('field')
            preview_num.push(form_id)
        }
        let check_lg = $(`.sc_data`).find('.ck-append').length
        for (let j = 0; j < check_lg; j++) {
            $($(`.sc_data`).find('.ck-append')[j]).attr('checked', false)
            // console.log($($(`.sc_data`).find('.ck-append')[j]));
        }

        preview_num.forEach((num) => {
            $($('.ck-append')[num]).prop('checked', true)
            let file_name = $($('.ck-append')[num]).val()
            file_arr.push(file_arr, file_name)
        })

        if(change_menu_button == true){
            console.log(file_arr);
        }

        init_sortable()

        let phy_lg = $('.menu-phy-select').length
        let name_id = id.split('case_inp')[1]
        for (let z = 0; z < phy_lg; z++) {
            $($('.menu-phy-select')[z]).removeClass('active')
        }
        $(`#select_phy${name_id}`).addClass('active')

    }


</script>
