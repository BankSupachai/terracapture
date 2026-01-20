@extends('layouts.layoutsManagePhoto')
<link href="{{ url('public/css/home/photomove.css') }}" rel="stylesheet" type="text/css" />

@section('Title')
Upload Photo
@endsection
@section('style')
<style>

    .text-sort-blue {
        color: #325684;
    }

    .bg-sortphoto {
        background: #ffffffa6;
        /* background-image:url({{ url('public/image/bg-sortphoto.png') }}) */
    }

    .tbl-width thead th:nth-child(1),
    .tbl-width thead th:nth-child(2) {
        width: 10%
    }

    .tbl-width thead th:nth-child(3),
    .tbl-width thead th:nth-child(4),
    .tbl-width thead th:nth-child(5) {
        width: 20%
    }

    .tbl-width thead th:nth-child(6) {
        width: 10%
    }

    .text-blue-table {
        color: #405189;
    }

    .btn-dark-primary {
        background: #245788;
        color: #ffffff;
    }

    .btn-dark-primary:hover {
        background: #1a3d5e;
        color: #ffffff;
    }
</style>
@endsection
@section('content')
@include('Endocapture.imagesort.confirm_modal')
<div class="row m-0 p-3">
    <div class="bg-sortphoto">
        <div class="col-12 d-flex justify-content-between py-3">
            <div>
                <span class="text-sort-blue h3">Move Photo </span>
                <p class="text-sort-blue">Select photo by “click” into photo and then select case by click “Select”
                </p>
            </div>
            <div>
                <button type="button" class="btn btn-primary btn-label waves-effect right w-lg waves-light" id="photo_select_all"><i
                        class="ri-check-double-line label-icon align-middle fs-16 ms-2" ></i> Select All</button>
                        <button type="button" class="btn btn-warning btn-label waves-effect right w-lg waves-light" id="photo_unselect_all"><i
                            class=" ri-checkbox-blank-line label-icon align-middle fs-16 ms-2" ></i> Deselect All</button>
                <a type="button" class="btn btn-danger btn-label waves-effect right w-lg waves-light" href="{{url()->previous()}}" >
                    <i class="ri-delete-bin-5-line label-icon align-middle fs-16 ms-2"></i> Cancel</a>
            </div>
        </div>
        <div class="row">
            {{-- <div style="overflow: auto; height:80vh;"> --}}
            <div>
                <div class="row draggable-zone">
                    <div class="col-12">
                        <div class="row text-center">
                            <form id="form_photo_move" action="{{ url('api/photomove') }}" class="row"
                                method="post">
                                @csrf
                                <input type="hidden" name="cid" value="{{ $cid }}">
                                <input id="cid_new" type="hidden" name="cid_new" value="">
                                <input type="hidden" name="hn" value="{{ @$case->hn }}">
                                <input type="hidden" name="folderdate" value="{{ $folderdate }}">
                                <input type="hidden" name="event" value="photo_move_case">
                                <input type="hidden" name="edit_event" id="copy_text">
                                <input type="hidden" name="user_id" id="{{ @$user_id }}">
                                <ul class="row  ui-img">
                                    @foreach ($photo_all as $photo)
                                        <li class="col-lg-2 card card-custom gutter-b li-img draggable p-2"
                                            style="background: transparent;">
                                            <input name="photoname[]" type="checkbox"
                                                id="check0{{ $photo['nu'] }}" class="checkbox_selected"
                                                value="{{ $photo['na'] }}">
                                            <label for="check0{{ $photo['nu'] }}" class="m-0 photo-hover">
                                                <img photo_id="{{ $photo['nu'] }}"
                                                    class="photo_select w-100 h-100" photo="{{ $photo['na'] }}"
                                                    {{-- style="width:100%;box-shadow: 1px 1px 5px skyblue" --}}
                                                    src="{{ mePHOTO($case->hn, $photo['na'], $folderdate) }}?a={{ RandomString() }}">
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-1">
                            <span class="h4">Case list</span>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-nowrap table-bordered tbl-width" id="set_table">
                        <thead>
                            <tr style="background: #F6F8FB;">
                                <th scope="col">Date</th>
                                <th scope="col">HN</th>
                                <th scope="col">Name</th>
                                <th scope="col">Endoscopist</th>
                                <th scope="col">Procedure</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" class="form-control " hidden>
                                </td>
                                <td> <input type="text" class="form-control" id="search_hn" oninput="filter_text()"></td>
                                <td><input type="text" class="form-control" id="search_name" oninput="filter_text()"></td>
                                <td>
                                    <select class="form-select " id="search_physician" data-choices name="choices-single-default"
                                        id="choices-single-default" onchange="filter_text()">
                                        <option value=""></option>
                                        @foreach (isset($doctors)?$doctors:[] as $doc)
                                            <option value="{{@$doc}}">{{@$doc}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select " id="search_procedure" data-choices name="choices-single-default"
                                        id="choices-single-default" onchange="filter_text()">
                                        <option value=""></option>
                                        @foreach (isset($procedures)?$procedures:[] as $proc)
                                            <option value="{{@$proc}}">{{@$proc}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            @foreach ($tb_case as $c)
                                @php
                                    // $json = jsonDecode($c->case_json);
                                    $c = (object) $c;
                                @endphp
                                <tr class="filter-data">
                                    <td class="text-blue-table">{{@$c->appointment_date}}</td>
                                    <td class="text-blue-table filter-hn">{{ @$c->case_hn }}</td>
                                    <td class="filter-name">{{ @$c->patientname }}</td>
                                    <td class="filter-physician">{{ @$c->doctorname }}</td>
                                    <td class="filter-procedure">{{ @$c->procedurename }}</td>
                                    <td><button class="btn btn-light select_case" data-bs-toggle="modal"
                                            data-bs-target="#cf_imageModal" cid="{{ @$c->id }}"
                                            hn="{{ @$c->hn }}" patientname="{{ @$c->patientname }}"
                                            procedurename="{{ @$c->procedurename }}"
                                            doctorname="{{ @$c->doctorname }}">Select</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
<div class="col-12 text-center" style="position: absolute; bottom: px; color: #ffffff80;">
    © 2023 EndoINDEX 6.0 by Medica Healthcare Co.,Ltd.
</div>

@endsection
@section('script')
<script src="{{ url('public/extra/photomove/jquery.min.js') }}"></script>
    <script src="{{ url('public/extra/photomove/bootstrap.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var submit_status = true

        $('#btn_photo_move').click(function() {
            // alert(1)
            var otp = '{{ $otp }}';
            var txt_otp = $('#otp_photo_move').val();
            var ck_text = $("#edit_event").val();
            if (ck_text.length > 3) {
                if (otp == txt_otp && submit_status) {
                    $('#form_photo_move').submit();
                    submit_status = false
                } else if(otp != txt_otp) {
                    alert('OTP ไม่ตรงกัน');
                }
            } else {
                alert('กรุณากรอก เหตุผล');
            }
        })

        $("#edit_event").keyup(function() {
            var edit_event = $(this).val()
            $("#copy_text").val(edit_event)
        })


        $('.photo_select').click(function() {
            var photo_id = $(this).attr('photo_id');
            $('#check' + photo_id).trigger('click');
        });

        $('#photo_select_all').click(function() {
            // alert(1);
            $('.checkbox_selected').prop("checked", true);
        })

        $('#photo_unselect_all').click(function() {
            $('.checkbox_selected').prop("checked", false);
        })

        $('.select_case').click(function() {
            // alert(1);
            $('#cid_new').val($(this).attr('cid'));
            $('#new_cid').html($(this).attr('cid'));
            $('#new_hn').html($(this).attr('hn'));
            $('#new_patient').html($(this).attr('patientname'));
            $('#new_procedure').html($(this).attr('procedurename'));
            $('#new_doctor').html($(this).attr('doctorname'))
            $('#modal_photo_move').modal('show');
        });
    </script>
    <script>
        function search_data() {
            // Declare variables
            var input, filter, table, tr, td1, td2, td3, i, txtValue1, txtValue2, txtValue3;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.getElementById("set_table");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td1 = tr[i].getElementsByTagName("td")[0];
                td2 = tr[i].getElementsByTagName("td")[1];
                td3 = tr[i].getElementsByTagName("td")[2];
                if (td1 || td2 || td3) {
                    txtValue1 = td1.textContent || td1.innerText;
                    txtValue2 = td2.textContent || td2.innerText;
                    txtValue3 = td3.textContent || td3.innerText;
                    if ((txtValue1.toUpperCase().indexOf(filter) > -1) || (txtValue2.toUpperCase().indexOf(filter) > -1) ||
                        (txtValue3.toUpperCase().indexOf(filter) > -1)) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        function filter_text(){
            let hn          = $('#search_hn').val()
            let name        = $('#search_name').val()
            let procedure   = $(`#search_procedure`).find(":selected").val().toLowerCase()
            let doctor      = $(`#search_physician`).find(':selected').val().toLowerCase()
            console.log(hn, name, doctor, procedure);
            $('.filter-data').show()
            $(`.filter-data`).each(function(index, element) {
                let e = $(element).find('td')
                let hn_td = $(e[1]).text().toLowerCase().trim()
                let name_td = $(e[2]).text().toLowerCase().trim()
                let physician_td = $(e[3]).text().toLowerCase().trim()
                let procedure_td = $(e[4]).text().toLowerCase().trim()
                console.log(hn_td, name_td, physician_td, procedure_td, );

                if(name != '' && name != undefined){
                    if((name_td.includes(name)) ){} else {
                        $(this).hide()
                    }
                }

                if(hn != '' && hn != undefined){
                    if((hn_td.includes(hn)) ){} else {
                        $(this).hide()
                    }
                }

                if(doctor != '' && doctor != undefined){
                    if((physician_td.includes(doctor)) ){} else {
                        $(this).hide()
                    }
                }

                if(procedure != '' && procedure != undefined){
                    if((procedure_td.includes(procedure)) ){} else {
                        $(this).hide()
                    }
                }

            })
        }
    </script>

@endsection
    {{-- <link rel="stylesheet" href="{{url('public/extra/photomove/bootstrap.min.css')}}"> --}}



