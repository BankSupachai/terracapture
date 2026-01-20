<style>
    .btn-soft-cancel{
        background: #F3F6F9;
        color: #878A99;
    }
    .btn-soft-cancel:hover{
        background: #e0e2e6;
        color: #FFFFFF;
    }
</style>
{{-- <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#myModal">Standard Modal</button> --}}
<div id="modal_confirm_delete" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 35%;">
        <div class="modal-content" >
            <form action="{{ url("home/$cid") }}" method="POST">
                @method('DELETE')
                @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Delete this case</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body p-5 mt-2 text-center" style="border-top: 1px solid #e9ebec">
               <span class="text-soft-gray fs-16 fs-normal"> Are you sure to delete this case ? </span>
            </div>
            <div class="row mb-5">
                <div class="col-6 text-end ">
                    <button type="button" class="btn btn-soft-cancel w-lg text-soft-gray" data-bs-dismiss="modal" >No, I don’t want to Delete </button>
                </div>
                <div class="col-6">
                    <button type="submit" class="btn btn-danger w-lg" >Yes, I want to Delete</button>
                </div>
            </div>
        </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


{{-- <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"
    id="modal_confirm_delete" style="display: none; min-width: 49%;">
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">
            <form action="{{ url("home/$cid") }}" method="POST">
                @method('DELETE')
                @csrf

                <div align="center" style="padding: 1.5em;">
                    <span class="h2" id="myModalLabel">&nbsp;&nbsp;&nbsp;Are you sure you want to delete <br/> this case?</span>
                </div>
                <div class="modal-footer" style="padding: 0;">
                    <input type="hidden" name="case_id" value="{{ $cid }}">
                    <div class="row w-100">
                        <div class="col-12 text-center pb-2">
                            <button type="submit" class="btn btn-danger w-lg" >Confirm</button>
                            <button type="button" class="btn btn-soft-warning w-lg" data-bs-dismiss="modal">Cancel
                            </button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div> --}}


<div class="modal fade" id="modal_progress_accessory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content" style="box-shadow: none; border: none;">
            <div class="modal-body">
                <div class="cssload-thecube mb-5">
                    <div class="cssload-cube cssload-c1"></div>
                    <div class="cssload-cube cssload-c2"></div>
                    <div class="cssload-cube cssload-c3"></div>
                    {{-- <div class="cssload-cube cssload-c4"></div> --}}
                </div>
                <br>
                <h2 style="text-align: -webkit-center;">รอสักครู่</h2>
            </div>
        </div>
    </div>
</div>

<style>
    .move_to_case,
    .move_to_patient {
        display: none;
    }

    .move_to_case.active,
    .move_to_patient.active {
        display: flex;
    }
</style>
<div class="modal fade" id="modal_move_case" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ url('movecase') }}" method="post" class="modal-content">
            @method('POST')
            @csrf
            <div class="modal-body p-4">
                <div class="row m-0">
                    <div class="col-lg-2 h1">HN</div>
                    <div class="col-lg"><input type="text" name="" id="text_hn_movecase" class="form-control">
                    </div>
                </div>
                <div class="row m-0 border-top mt-5 pt-5">
                    <div class="col-lg-12">
                        <h1 id="patient_hn"></h1>
                        <h1 id="patient_name"></h1>
                        <input type="hidden" name="case_id" value="{{ $cid }}">
                        <input type="hidden" name="move_hn" id="text_move_hn">
                        <input type="hidden" name="folderdate" value="{{ $folderdate }}">
                    </div>
                </div>
                <div class="row m-0 mt-5 move_to_case">
                    <div class="col-lg-6"><button class="btn w-100 btn-success" type="submit">ย้าย</button></div>
                    <div class="col-lg-6"><button class="btn w-100 btn-danger" type="button"
                            data-bs-dismiss="modal">ยกเลิก</button></div>
                </div>
                <div class="row m-0 mt-5 move_to_patient">
                    <div class="col-lg-6"><a href="{{ url('patient/create') }}"
                            class="btn w-100 btn-success">เพิ่มผู้ป่าย</a></div>
                    <div class="col-lg-6">
                        <button class="btn w-100 btn-danger" type="button"
                            data-bs-dismiss="modal">ยกเลิก</button></div>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    $("#text_hn_movecase").keyup(function() {
        var move_hn = $(this).val()
        $.post("{{ url('api/photomove') }}", {
                event: 'hn_check',
                value: move_hn,
            },
            function(data, status) {
                var n = data.search("#");
                if (n > 0) {
                    var res = data.split("#");
                    $('#patient_name').html('Name : ' + res[0]);
                    $('#patient_hn').html('HN : ' + res[1]);
                    $("#text_move_hn").val(res[1])
                    $('.move_to_case').addClass('active')
                    $('.move_to_patient').removeClass('active')
                } else {
                    $('#patient_name').html('ไม่มี HN นี้ในระบบ');
                    $('#patient_hn').html('');
                    $("#text_move_hn").val(null)
                    $('.move_to_case').removeClass('active')
                    $('.move_to_patient').addClass('active')
                }
            });
    })
</script>
