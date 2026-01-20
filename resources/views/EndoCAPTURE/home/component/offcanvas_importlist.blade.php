<link href="{{ asset('public/css/select/select2canvas.css') }}" rel="stylesheet" type="text/css" />

<style>
    .offcanvas.offcanvas-end {
        border: 0
    }
    .border-bottom-solid{
        border-bottom: 1px solid #fff;
        opacity: 20%;
    }
    .box {
        width: 225px;
        height: 41px;
        border-radius: 16px;
    }

    .dotted {
        border: dotted 2px #E9EBEC;
    }
    .offcanvas-body tbody, .offcanvas-body td, .offcanvas-body tfoot, .offcanvas-body th, .offcanvas-body thead, .offcanvas-body tr {
        border-style: none !important;
    }


</style>

<div class="offcanvas offcanvas-end w-75" style="background: #245788;" tabindex="-1" id="importlist" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header p-3">
        <h5 id="offcanvasRightLabel" class="text-white"> <i class=" ri-download-2-fill"></i>&ensp; Import Case (Excel)</h5>
        <button type="button" class="btn btn-ghost-light" data-bs-dismiss="offcanvas" aria-label="Close">X</button>
    </div>
    <div class="border-bottom-solid"></div>
    <div class="offcanvas-body p-0">
        <div class="row p-3 ">
            <div class="col-auto m-0">
                <a href="{{url('public/excel/Import_example.xlsx')}}" class="btn btn-danger btn-label waves-effect waves-light mt-1" download="import_example"><i class="ri-save-line label-icon align-middle fs-16 me-2"></i> Download Template</a>
            </div>
            <div class="col-auto" id="file_inputs_div" style="display: none">
                <form action="{{ url('api') }}/home" method="POST" id="file_inputs_form" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="event" value="upload_file_excel">

                </form>
            </div>
            <div class="col-3 m-0">
                <div class="box dotted" id="upload_div">
                    {{-- <label for="files" class="btn text-white text-center">Drag & Drop your files or Browse</label> --}}
                    <div class="filepond filepond-input-multiple"></div>
                </div>

            </div>
            <div class="col-1">
                <div class="spinner-border text-light ms-3" role="status" id="loading" style="display: none">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div class="col-3" id="file_names_div" >
            </div>
            <div class="col-2">
                <button type="button" id="clear_btn" class="btn btn-danger  waves-effect waves-light p-1 w-100 " style="margin-right: 9px;margin-top:3px; display: none"><i class=" ri-delete-bin-2-fill me-2"></i> Clear All</button>
            </div>
        </div>
        <div class="border-bottom-solid"></div>
        <div class="row p-2" >
            <div class="col-2">
                <button type="button" id="update_btn" class="btn btn-success  waves-effect waves-light p-1 w-100 " style="margin-left: 9px;"><i class="ri-refresh-line me-2"></i> Update List</button>
            </div>

            <div class="col-12">
                <table class="table table-nowrap  " id="upload_table">
                    <thead>
                        <tr class="text-white fw-normal">
                            <td class="text-center">HN</td>
                            <td class="text-center">Name</td>
                            <td class="text-center">Age</td>
                            <td class="text-center">Physician</td>
                            <td class="text-center">Procedure</td>
                            <td class="text-center">Date</td>
                            <td class="text-center">Time</td>
                            <td class="text-center" >Pre-diagnosis</td>
                            <td class="text-end" style="width: 40%;">Import</td>
                        </tr>
                    </thead>
                    <tbody class="text-white fw-light" style="height: 565px; overflow:auto;"  id="tbody_case">
                    </tbody>
                </table>
            </div>
            <div class="col-12 text-end me-4">

                <button type="button" id="upload_all_btn" class="btn btn-success  waves-effect me-3 waves-light p-1 w-lg " onclick="upload_row('', 'all')" ><i class="ri-check-double-fill me-2"></i>Confirm</button>

            </div>
        </div>

    </div>
</div>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#upload_div').on('click', function (){
        var init_rand     = Math.round(Math.random() * 10000 )
        var inp         =  `<input id="file_inp${init_rand}" type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel"
                            name="upload_files[]" class="files-input" onchange="get_name(${init_rand})">`
        $('#file_inputs_form').append(inp)
        $(`#file_inp${init_rand}`).click()
    })

    $('#clear_btn').on('click', function (){
        $('#file_inputs_form').not(':first').empty()
        $('#file_names_div').empty()
        $('#tbody_case').empty()
        $('#upload_all_btn').prop('disabled', false)
        $(this).css('display', 'none')
    })

    $('#update_btn').on('click', function () {
        render_row('')
    })

    function get_name(rand) {
        $('#files_name').html('')
        // var file_max_size = 5242880 // in bytes
        var file_num     = 0
        var files    = $(`#file_inp${rand}`).prop('files')
        for(var j = 0; j < files.length; j++ ){
            var rand_num    = Math.floor(Math.random() * 1000) + 1
            var name        = files[j].name
            $('#file_names_div').append( `
                <div class="col-auto m-0 file-bt" id="file_name${rand}">
                    <button type="button" class="btn btn-danger btn-label waves-effect waves-light mt-1" onclick="delete_single_file('${rand}', true)"><i id="close${rand}" class="ri-close-line label-icon align-middle fs-16 me-2"></i> ${name}</button>
                </div>`
            )
        }
        render_row(rand)
        var fileinp_lg = $('#file_inputs_form').find('input[type="file"]').length
        if(fileinp_lg > 0){
            $('#clear_btn').css('display', 'block')
        }
    }

    function delete_single_file(rand, refresh=false) {
        $(`#file_inp${rand}`).remove()
        $(`#file_name${rand}`).remove()
        var ck_last = $('.files-input').length
        if(refresh && ck_last != 0){
            render_row(rand)
        } else {
            $('#tbody_case').empty()
        }
    }

    function render_row(rand){
        var this_form = $(`#file_inputs_form`)
        var formData = new FormData(this_form[0]);
        $.ajax({
            type:"POST",
            url: "{{ url('api') }}/home",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {$('#loading').css('display', 'block')},
            complete: function() {$('#loading').css('display', 'none')},
            success: (data) => {
                // console.log(data);
                if(data != 'error'){
                    var parse = JSON.parse(data)
                    var hns   = parse['all_hn']
                    var cases = parse['all_case']
                    if(hns.length == 0 || cases.length == 0){
                        alert('ไม่พบข้อมูล กรุณาตรวจสอบอีกครั้ง')
                        delete_single_file(rand)
                        return
                    }
                    $('#tbody_case').empty()
                    console.log(hns, cases);
                    for (let i = 0; i < hns.length; i++) {
                        var rand_td   = Math.round(Math.random() * 10000 )
                        var e = cases[hns[i]]
                        var procedure = e['procedure'].join('<br>')
                        $('#tbody_case').append(`
                            <tr class="data-tr" data-hn="${e['hn']}" id="td${rand_td}">
                                <td class="text-center" id="hn${rand_td}">${e['hn']}</td>
                                <td class="text-center" id="patientname${rand_td}">${e['patientname']}</td>
                                <td class="text-center" id="age${rand_td}">${e['age']}</td>
                                <td class="text-center" id="physician${rand_td}">${e['physician']}</td>
                                <td  id="procedure${rand_td}">${procedure}</td>
                                <td class="text-center" id="date${rand_td}">${e['date']}</td>
                                <td class="text-center" id="time${rand_td}">${e['time']}</td>
                                <td class="text-center" id="prediagnosis${rand_td}">Gastritis</td>
                                <td class="text-center" class="text-end">
                                    <button id="upload_single${rand_td}" onclick="upload_row('${rand_td}', 'single')" class="btn btn-danger btn-icon upload-single"> <i class="ri-download-2-fill ri-lg"></i></button>
                                    <div class="spinner-border text-light ms-3 loading-single" role="status" id="loading${rand_td}" style="display: none">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </td>
                            </tr>
                        `)
                    }
                } else {
                    // alert('รูปแบบไฟล์ไม่ถูกต้อง กรุณาตรวจสอบอีกครั้ง')
                    delete_single_file(rand)
                }
            },
            error: (xhr, status, error) => {
                alert('รูปแบบไฟล์ไม่ถูกต้อง กรุณาตรวจสอบอีกครั้ง')
                delete_single_file(rand)
            }
        })
    }

    function upload_row(rand, type){
        var single_btn_lg = $('.upload-single').length
        var this_form = $(`#file_inputs_form`)
        var formData = new FormData(this_form[0]);
        formData.append('type', `update_${type}`)

        if(type == 'single'){
            $(`#upload_single${rand}`).css('display', 'none')
            $(`#loading${rand}`).css('display', 'block')
            formData.append('hn', $(`#hn${rand}`).text().trim())
            // $('#upload_all_btn').prop('disabled', true)
        } else {
            var hns = []
            for (let i = 0; i < single_btn_lg; i++) {
                $($('.upload-single')[i]).css('display', 'none')
                $($('.loading-single')[i]).css('display', 'block')
                hns.push($($('.data-tr')[i]).attr('data-hn'))
            }
            formData.append('hn', hns)
        }

        // ตรวจสอบ formData
        // for (var [key, value] of formData.entries()) {
        //     console.log(key, value);
        // }

        $.ajax({
            type:"POST",
            url: "{{ url('api') }}/home",
            data: formData,
            contentType: false,
            processData: false,
            success: (data) => {
                if(data == 'success'){
                    if(type == 'single'){
                        $(`#td${rand}`).remove()
                    } else {
                        $('#clear_btn').trigger('click')
                        setTimeout(() => {
                            location.reload()
                        }, 1 * 1000);
                    }
                }
            },
            error: (xhr, status, error) => {
                alert('เกิดความผิดพลาด')
                $(`#upload_single${rand}`).css('display', 'block')
                $(`#loading${rand}`).css('display', 'none')
            }
        })
    }

    function prepare_data_row(rand){
        // console.log(rand);
        var row_data        = {
            hn:           $(`#hn${rand}`).text().trim(),
            patientname:  $(`#patientname${rand}`).text().trim(),
            age:          $(`#age${rand}`).text().trim(),
            case_physicians01:    $(`#physician${rand}`).text().trim(),
            procedure:    $(`#procedure${rand}`).text().trim(),
            date:         $(`#date${rand}`).text().trim(),
            time:         $(`#time${rand}`).text().trim(),
            prediagnosis: $(`#prediagnosis${rand}`).text().trim(),
        }
        return row_data
    }



</script>
