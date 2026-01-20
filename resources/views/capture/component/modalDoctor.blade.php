<div class="modal fade " id="modal_doctor">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-2">
            <div class="modal-header p-0">
                <h2 class="text-center text-dark">Select Doctor</h2>
                <button type="button" class="btn btn-danger btn-sm btn-close p-1" data-dismiss="modal"
                    aria-label="Close">
                    X
                </button>
            </div>
            <div class="modal-body pb-0">
                <form action="{{ url('casemonitor') }}" method="post">
                    @csrf
                    <input type="hidden" name="event" value="doctor_select">
                    <div class="row">
                        <div class="col-12">
                            <input id="room_inmodaldoctor" type="hidden" name="room">
                        </div>
                        @foreach ($doctor as $user)
                            <div class="col-4 text-dark mt-3">
                                <input name="doctor[]" value="{{ $user['id'] }}" type="checkbox"
                                    class="form-check-input doctor" id="doctor{{ $user['id'] }}">
                                <label for="doctor{{ $user['id'] }}">&nbsp;
                                    {{ $user['user_prefix'] }}{{ $user['user_firstname'] }}
                                    {{ $user['user_lastname'] }}</label>
                            </div>
                        @endforeach
                        <div class="col-12 p-0 mt-4 text-end">
                            <button type="submit" class="btn btn-success btn-block btn-save w-lg">บันทึก</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- <script>
       $(window).on('load', function() {
        $('#modal_doctor').modal('show');
    });
</script> --}}
