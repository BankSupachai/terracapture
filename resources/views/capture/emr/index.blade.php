@php
    $view['case_data'] = $case_data;
    $view['cid'] = @$_GET['cid'];
    $layouts = 'capture.layoutv6';
@endphp


@extends($layouts)
@section('title', 'EMR')
@section('content')
@include('capture.camera.obs.js_hotkey')
    <script src="{{ url('public/camera/jquery.min.js') }}"></script>
    {{-- <script src="{{url('public/camera/bootstrap.min.js')}}"></script> --}}
    {{-- <script src="{{url('public/plugins/jquery-ui-1.12.1/jquery-ui.js')}}"></script> --}}




    <div class="modal fade" id="modal_emr" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h1 class="display-3 mt-3 text-center">กำลังส่ง EMR</h1>
                    <img src="{{ url('public/images/loading02.gif') }}" width="100%">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_pacs" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h1 id="pacstext" class="display-3 mt-3 text-center">กำลังส่ง PACs</h1>
                    <img src="{{ url('public/images/loading02.gif') }}" width="100%">
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="margin: 0; padding: 0;">
        <div class="col-lg-5">
            <div class="row">
                <div class="col-12">
                    <div class="card" style="height: 100%; margin: 0;">
                        <div class="card-body" style="padding: 0.5em;">
                            <form action="" class="row">
                                <div class="col-lg-9" style="padding-bottom: 3px;">
                                    <input name="search" class="form-control" placeholder="Search..........">
                                </div>
                                <div class="col-lg-3">
                                    <button type="submit" class="btn btn-success" style="width: 100%;"><i
                                            class="flaticon2-search-1 icon-md"></i>Search</button>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table id="tech-companies-1" border="0" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>HN</th>
                                            <th>PATIENT NAME</th>
                                            <th>PROCEDURE</th>
                                            <th>EMR</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $search = @$_GET['search'] . '';
                                        @endphp

                                        @forelse($case_list as $data)
                                            <tr>
                                                @php
                                                    $aname = str_replace(' ', '_', @$data->name);
                                                    // $json       = jsonDecode($data->case_json);
                                                    $datemeet = substr(@$data->case_dateappointment, 0, -8);
                                                    $link_bill = "?search=$search&bill=true&hn=$data->case_hn&date=$datemeet";
                                                    $link_emr = "?search=$search&emr=true&cid=$data->id";
                                                @endphp
                                                <th>{{ @$data->case_hn }}</th>
                                                <th>{{ @$data->patientname }}</th>
                                                <td>{{ @$data->procedurename }}</td>
                                                <td>
                                                    <a
                                                        href="{{ $link_emr }}"class="btn btn-icon waves-effect waves-light btn-warning">
                                                        <i class="ri-file-text-line"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10">ไม่มีข้อมูลในฐานข้อมูลปัจจุบัน</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--
        ########################################################
        ###### แบ่งส่วน
        ########################################################
        --}}




        <div class="col-lg-7">
            @isset($_GET['bill'])
                @component('EndoBilling.homc.bill', $view)
                @endcomponent
            @endisset

            @isset($_GET['emr'])
                @component('EndoBilling.homc.emr', $view)
                @endcomponent
            @endisset
        </div>





        <!-- Modal -->


    </div>



@endsection




@section('script')
    <script>
        var myModal = new bootstrap.Modal(document.getElementById("modal_emr"), {});
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    {{-- <script src="{{asset('public/js/bootstrap.min.js')}}"> </script> --}}
    <script>
        $("#call_modal_emr").click(function() {
            myModal.show();
            $.post('{{ url('emr') }}', {
                event: "emr_send",
                cid: '{{ @$_GET['cid'] }}',
            }, function(data, status) {
                console.log(data);
                setTimeout(() => {
                    myModal.hide();
                }, 1500);
            });
        });

        $("#call_modal_pacs").click(function() {
            $("#pacstext").html("กำลังสร้างไฟล์ Dicom");
            $("#modal_pacs").modal("show");
            create_dicom();
        });



        function create_dicom() {
            let dicomtype = "dicom_pdf"
            $.post("{{ url('api/pacspython') }}", {
                event: dicomtype,
                cid: "{{ $cid }}",
            }, function(data, status) {
                var json = JSON.parse(data);
                if (json.status == "success") {
                    $("#pacstext").html("กำลังส่ง Dicom ไปยัง Server PACs");
                    send_pacs();
                } else {
                    $("#pacstext").html("สร้างไฟล์ Dicom ไม่สำเร็จ");
                }
            });

        }

        function send_pacs() {
            $.post("{{ url('api/pacspython') }}", {
                event: 'send_pacs',
                cid: "{{ $cid }}",
            }, function(data, status) {
                var json = JSON.parse(data);
                if (json.status == "success") {
                    $("#pacstext").html("ส่งไฟล์สำเร็จ");
                    setTimeout(() => {
                        $("#modal_pacs").modal("hide");
                    }, 2000);
                } else {
                    $("#pacstext").html("ส่งไฟล์ไม่สำเร็จ");
                }
            });
        }

















        $("#step01").click(function() {
            $.post('{{ url('billhomc') }}', {
                event: "step01",
            }, function(data, status) {});
        })


        $("#step02").click(function() {
            $.post('{{ url('billhomc') }}', {
                event: "step02",
            }, function(data, status) {

            });
        })

        $("#step03").click(function() {
            $.post('{{ url('billhomc') }}', {
                event: "step03",
            }, function(data, status) {});
        })

        $("#med,#sur,#ped").click(function() {
            var depart = $(this).val();
            $(".depart").html(depart);
            // alert(depart);
        });
    </script>
@endsection
