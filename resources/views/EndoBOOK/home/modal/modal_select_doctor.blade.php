<div class="modal fade" id="modal_select_doctor" tabindex="-1" role="dialog" aria-labelledby="modal_date_text"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary ">
                <h5 class="modal-title text-white" id="modal_date_text">Select Doctor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <select id="select_doctor" class="form-control form-control-lg select2">
                <option value="">Doctor</option>
                @foreach($doctor as $data)
                    <option value="{{$data->id}}">{{$data->user_prefix}}{{$data->user_firstname}} {{$data->user_lastname}}</option>
                @endforeach
            </select>
            <button id="goto_setdoctor" type="button" class="btn btn-light-primary font-weight-bold w-100 mt-3 btn-lg">
                Setting Doctor
            </button>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $("#goto_setdoctor").click(function () {
        var doctor = $("#select_doctor").val();
        if(doctor!=""){
            window.location.href = "{{url("book/setting_doctor")}}/"+doctor;
        }

    });




    // Class definition
var KTSelect2 = function() {

 var modalDemos = function() {
  $('#modal_select_doctor').on('shown.bs.modal', function () {
   $('#select_doctor').select2({
    placeholder: "Select doctor",
    allowClear: true
   });
  });
 }

 // Public functions
 return {
  init: function() {
   modalDemos();
  }
 };
}();

// Initialization
jQuery(document).ready(function() {
 KTSelect2.init();
});
</script>
