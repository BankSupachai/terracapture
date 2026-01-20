@extends('layouts.layouts_index.main')
@section('style')
    <link href="{{url("public/css/home/photomove.css")}}" rel="stylesheet" type="text/css" />


    <link rel="stylesheet" href="{{url('public/extra/photomove/bootstrap.min.css')}}">
@endsection

@section('content')

        <div class="row m-0 mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0 border-0 p-2 mt-2">
                        <div class="row">
                            <div class="col-lg-8"><a class="btn btn-warning" href="{{ url()->previous() }}" ><i class="fas fa-angle-double-left"></i>&nbsp; ย้อนกลับ</a></div>
                            <div class="col-lg-2"><a id="photo_select_all" class="btn btn-primary w-100"><i class="fas fa-check-double"></i> Select ALL</a></div>
                            <div class="col-lg-2"><a id="photo_unselect_all" class="btn btn-danger w-100"><i class="fas fa-ban"></i> Deselect ALL</a></div>
                        </div>
                    </div>
                    <div class="card-body pb-0 pt-0 mt-1">
                        <div class="m-0 draggable-zone">

                            <form id="form_photo_move" action="{{url('api/photomove')}}" class="row" method="post">
                                @csrf
                                <input type="hidden" name="cid"         value="{{$cid}}">
                                <input id="cid_new" type="hidden"       name="cid_new" value="">
                                <input type="hidden" name="hn"          value="{{@$case->hn}}">
                                <input type="hidden" name="folderdate"  value="{{$folderdate}}">
                                <input type="hidden" name="event"       value="photo_move_case">
                                <input type="hidden" name="edit_event" id="copy_text">
                                <ul class="row m-0 r-border p-0 w-100 ui-img">
                                @foreach($photo_all as $photo)
                                    <li class="col-lg-2 card card-custom gutter-b li-img draggable p-2" style="">
                                        <input name="photoname[]" type="checkbox" id="check0{{$photo['nu']}}" class="checkbox_select" value="{{$photo['na']}}">
                                        <label for="check0{{$photo['nu']}}" class="m-0 photo-hover">
                                            <img
                                            photo_id="{{$photo['nu']}}"
                                            class="photo_select w-100 h-100"
                                            photo="{{$photo['na']}}"
                                            {{-- style="width:100%;box-shadow: 1px 1px 5px skyblue" --}}
                                            src="{{mePHOTO($case->hn,$photo['na'],$folderdate)}}?a={{RandomString()}}"
                                            >
                                        </label>
                                    </li>
                                @endforeach
                                </ul>
                            </form>

                            <div class="col-12 mb-2 mt-4">
                                <input type="text" name="" id="search" class="form-control " placeholder="Search HN Patient Procedure" onkeyup="search_data()">
                            </div>
                            <div class="col-12 mb-4">
                            <table class="table" id="set_table">
                                <tr>
                                    <th>H.N.</th>
                                    <th>Patient Name</th>
                                    <th>Procedure</th>
                                    <th>Select</th>
                                </tr>

                                @foreach($tb_case as $c)
                                    @php
                                        // $json = jsonDecode($c->case_json);
                                        $c = (object) $c;
                                    @endphp
                                <tr>
                                    <td>{{$c->hn}}</td>
                                    <td>{{$c->patientname}}</td>
                                    <td>{{$c->procedurename}}</td>
                                    <td>
                                        <a
                                        class="btn btn-info select_case btn-sm"
                                        cid="{{$c->_id}}"
                                        hn="{{$c->hn}}"
                                        patientname="{{$c->patientname}}"
                                        procedurename="{{$c->procedurename}}"
                                        doctorname="{{$c->doctorname}}"
                                        ><i class="fab fa-buffer"></i> Select</a></td>
                                </tr>


                                @endforeach


                            </table>
                            </div>

                        </div>
                    </div>



                </div>
            </div>
        </div>

        <div class="modal fade" id="modal_photo_move">
            <div class="modal-dialog  modal-xl">
                <div class="modal-content">
                    <div class="modal-header p-0" style="border:none;height:1em;">
                        <h5 class="modal-title">&emsp;</h5>
                        <button type="button" class="btn btn-outline-danger btn-sm p-2" style="    margin-top: 2.2em;right: 2px;position: absolute;z-index: 1;" data-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times p-0"></i>
                        </button>
                      </div>
                        <div class="modal-body row">
                            <div class="col-12">ยืนยันการย้ายรูป</div>
                            <div class="col-12" style="color:red;">* รูปภาพจาก Report เดิมจะถูกย้ายไปยัง</div>
                            <div class="col-12 mt-3">
                                ผู้ทำการย้าย : {{uget("name")}}
                            </div>
                            <div class="col-12 border-bottom pb-4 mt-2 mb-4">
                                <textarea name="" id="edit_event" class="form-control" rows="3"></textarea>
                            </div>
                            @php
                                $otp = rand(1000,9999);
                            @endphp
                            <div class="col-7" style="align-content: right"><h3>OTP : {{$otp}}</h3></div>
                            <div class="col-3 p-0">
                                <input id="otp_photo_move" class="form-control" placeholder="OTP" autocomplete="off">
                            </div>
                            <div class="col-2 pr-0 pb-2">
                                <a id="btn_photo_move" class="btn btn-success w-100"><i class="fas fa-check"></i> ยืนยัน</a></div>

                            <div class="col-5 border border-secondary p-3" style="align-self: center;">
                                <div>Case ID            : <b class="h5 m-0">{{$cid}}</b></div>
                                <div>H.N.               : <b class="h5 m-0">{{$case->hn}}</b></div>
                                <div>Patient name       : <b class="h5 m-0">{{$case->patientname}}</b></div>
                                <div>Procedure          : <b class="h5 m-0">{{$case->procedurename}}</b></div>
                            </div>
                            <div class="col-2 center">
                                <span class="svg-icon svg-icon-primary svg-icon-4x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Forward.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M12.6571817,10 L12.6571817,5.67013288 C12.6571817,5.25591932 12.3213953,4.92013288 11.9071817,4.92013288 C11.7234961,4.92013288 11.5461972,4.98754181 11.4089088,5.10957589 L4.25168161,11.4715556 C3.94209454,11.7467441 3.91420899,12.2207984 4.1893975,12.5303855 C4.19915701,12.541365 4.209237,12.5520553 4.21962441,12.5624427 L11.3768516,19.7196699 C11.6697448,20.0125631 12.1446186,20.0125631 12.4375118,19.7196699 C12.5781641,19.5790176 12.6571817,19.3882522 12.6571817,19.1893398 L12.6571817,15 C14.004369,14.9188289 16.83481,14.9157978 21.1485046,14.9909069 L21.1485051,14.9908794 C21.4245904,14.9956866 21.6522988,14.7757721 21.6571059,14.4996868 C21.6571564,14.4967857 21.6571817,14.4938842 21.6571817,14.4909827 L21.6572352,10.5050185 C21.6572352,10.2288465 21.4333536,10.0049649 21.1571817,10.0049649 C21.1555649,10.0049649 21.1539481,10.0049728 21.1523314,10.0049884 C16.0215539,10.0547574 13.1898373,10.0530946 12.6571817,10 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.828591, 12.429736) scale(-1, 1) translate(-12.828591, -12.429736) "/>
                                    </g>
                                </svg><!--end::Svg Icon--></span>
                            </div>
                            <div class="col-5 border border-secondary p-3" style="align-self: center;">
                                <div>Case ID        : <b class="h5 m-0" id="new_cid"></b></div>
                                <div>H.N.           : <b class="h5 m-0" id="new_hn"></b></div>
                                <div>Patient name   : <b class="h5 m-0" id="new_patient"></b></div>
                                <div>Procedure      : <b class="h5 m-0" id="new_procedure"></b></div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
@endsection
@section('script')
    <script src="{{url('public/extra/photomove/jquery.min.js')}}"></script>
    <script src="{{url('public/extra/photomove/bootstrap.min.js')}}"></script>
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#btn_photo_move').click(function(){
            var otp = '{{$otp}}';
            var txt_otp = $('#otp_photo_move').val();
            var ck_text = $("#edit_event").val();
            if(ck_text.length > 3){
                if(otp==txt_otp){
                    $('#form_photo_move').submit();
                }else{
                    alert('OTP ไม่ตรงกัน');
                }
            }else{
                alert('กรุณากรอก เหตุผล');
            }
        })

        $("#edit_event").keyup(function(){
            var edit_event = $(this).val()
            $("#copy_text").val(edit_event)
        })


        $('.photo_select').click(function(){
            var photo_id = $(this).attr('photo_id');
            $('#check'+photo_id).trigger('click');
        });

        $('#photo_select_all').click(function(){
            $('.checkbox_select').prop("checked", true);
        })

        $('#photo_unselect_all').click(function(){
            $('.checkbox_select').prop("checked", false);
        })

        $('.select_case').click(function(){
            $('#cid_new').val($(this).attr('cid'));
            $('#new_cid').html($(this).attr('cid'));
            $('#new_hn').html($(this).attr('hn'));
            $('#new_patient').html($(this).attr('patientname'));
            $('#new_procedure').html($(this).attr('procedurename'));
            $('#modal_photo_move').modal('show');
        });







    </script>
<script>
    function search_data() {
      // Declare variables
      var input, filter, table, tr, td1 ,td2, td3, i, txtValue1,txtValue2,txtValue3;
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
          if ((txtValue1.toUpperCase().indexOf(filter) > -1) || (txtValue2.toUpperCase().indexOf(filter) > -1) || (txtValue3.toUpperCase().indexOf(filter) > -1)) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
    </script>





@endsection
