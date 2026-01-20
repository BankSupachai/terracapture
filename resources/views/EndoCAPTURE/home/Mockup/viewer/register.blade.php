@extends('layouts.layouts_ipad.layouts_Newipad')

@section('tophead')
Viewer History
@endsection
@section('style')
<style>
 .bd-radius{
    border-radius: 10px;
 }
</style>
@endsection

@section('modal')
<div id="modal_hn" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content card-body">
            <div class="modal-header">
                <h5 class="modal-title text-terralink" id="myModalLabel"></h5>
                {{-- <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"> </button> --}}
            </div>
            <div class="modal-body">
                <p class="text-terralink text-center"> This HN was not found in the system. Please try again.</p>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
    <div class="row p-3 d-flex align-items-center " style="height: 85vh;">
        <div class="col-2"></div>
        <div class="col-8 card-ipad bd-radius p-3 ">
            <div class="col-12 mb-3">
               <h3 class="text-white text-center ">Patient ID</h3>
            </div>
            <div class="row ">
                <div class="col-2"></div>
                <div class="col-8 text-center">
                    <input type="text" id="hn" class="form-control form-control-dark" placeholder="Enter Patient ID here">
                </div>
                <div class="col-2"></div>
            </div>
            <div class="col-12 text-center mt-3">
                <a href="javascript:;" class="btn btn-dark-primary w-lg" onclick="check_hn()">Confirm</a>
            </div>
        </div>
        <div class="col-2"></div>
    </div>

@endsection


@section('script')
    <script>
        var modal_hn = new bootstrap.Modal(document.getElementById("modal_hn"), {});

        $('#hn').on('keypress', function (event) {
            if(event.key == 'Enter'){
                event.preventDefault()
                check_hn()
            }
        })
        function check_hn(){
            var hn = $('#hn').val()
            if(hn != '' && hn != undefined){
                $.post('{{url("api")}}/jquery', {
                    event : 'check_hn_viewer',
                    hn    : hn,
                }, function (data, status) {
                    console.log(data);
                    if(data == 'none'){
                        modal_hn.show()
                    } else {
                        window.location.href = `{{url('terra')}}/case/${hn}`
                    }
                })
            }
        }
    </script>
@endsection
