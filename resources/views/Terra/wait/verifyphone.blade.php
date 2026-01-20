@extends('layouts.layout_viewer')


@section('title', 'Endocapture')

@section('style')
<style>
/* img {
    border: 2px solid black;
}

#container2 {
    position: relative;
}

#example {
   position: absolute;
   top: 10px;
   left: 10px;

   padding: 5px;
   background-color: white;
   border: 2px solid red;
} */

</style>

@endsection

@section('modal')
<div id="modal_sms" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content card-body">
            <div class="modal-header">
                <h5 class="modal-title text-terralink" id="myModalLabel">Phone number</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <input type="text" id="phone" name="" class="form-control form-control-dark2 mt-3" placeholder="Enter Phone number" autocomplete="off">
            </div>
            <div class="modal-footer">
                <a href="" id="skip_btn" class="btn btn-info">Skip</a>
                <button type="button" class="btn btn-terralink" onclick="to_url()">Send</button>
            </div>
        </div>
    </div>
</div>
@endsection



@section('content')

<div class="row m-0 h-100 ai-c">
    <div class="col-lg-3"></div>
    <div class="col-lg">
        <div class="card">
            <div class="card-body">
                <div class="row m-0">
                    <div class="col-1"></div>
                    <div class="col text-center">
                        <h3 class="text-terralink">Verify ID (REF : a13k)</h3>
                        <div class="row">
                            <div class="col-10">
                                <input type="text" id="hn" name="" class="form-control form-control-dark2 mt-3" placeholder="OTP : XXXXXX" autocomplete="off">
                            </div>
                            <div class="col-2">
                                <button class="btn btn-terralink mt-3">Resend</button>
                            </div>
                        </div>
                        <button type="button" id="btn" onclick="get_phone()"  class="btn btn-terralink mt-3 w-25"> Confirm</button>
                    </div>
                    <div class="col-1"></div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-3"></div>
</div>
@endsection




{{-- onclick="to_url() --}}




@section('script')
<script src="{{asset('public/js/sweetalert2@11.js')}}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#hn').on('keypress', function (event) {
        if(event.key == 'Enter'){
            event.preventDefault()
            $('#btn').click()
        }
    })

    function get_txt_length(value) {
        var lg = value.length
        console.log(value, lg);
        if(lg > 0){
            $('#btn').prop('disabled', false)
        } else {
            $('#btn').prop('disabled', true)
        }
    }


    var myModal = new bootstrap.Modal(document.getElementById("modal_sms"), {});
    function to_url(){
        var phone       = $("#phone").val().length;
        var phonenumber = $("#phone").val();
        let hn          = $('#hn').val();
        if(phone>9){
            $.post("{{url('sms')}}",{
                event       : 'viewer_sms',
                phone       : phonenumber,
                hn          : hn
            },
            function(data, status) {
                if(data=='success'){
                    window.location.href = `{{url('terra')}}/case/${hn}`
                }
            });
        }
    }

    function get_phone(){
        let hn  = $('#hn').val()
        $('#skip_btn').attr("href", `{{url('terra')}}/case/${hn}`);
        $.post("{{url('api/jquery')}}",
        {
        event       : 'get_phone',
        hn          : hn
        },
        function(data, status) {
            if(data!='none'){
                data = data.replace(/[^a-zA-Z0-9 ]/g, '')
                myModal.show();
                $("#phone").val(data)
            }else{
                Swal.fire('ไม่พบเลขประจำตัวผู้ป่วยนี้ในระบบ')
            }
        })
    }
</script>

@endsection
