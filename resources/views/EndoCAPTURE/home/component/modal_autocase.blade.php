<!-- Default Modals -->
{{-- <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#myModal">Standard Modal</button> --}}

<style>
    .modal-xl {
        --vz-modal-width: 90%;
    }
</style>


<div id="modal_autocase" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Modal Createmuticase</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <form action="{{ url('home') }}" method="POST">
                @csrf
                <input type="hidden" name="event" value="auto_gencase">

                <div class="modal-body">
                    <h5 class="fs-15">
                        Create Muticase
                    </h5>
                    <div class="row mt-2">

                        <div class="col-1"></div>
                        <div class="col-4">
                            <div class="row">
                                <div class="col-4">

                                </div>
                                <div class="col-4">

                                </div>
                                <div class="col-4">

                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="row">
                                <div class="col-7 ">

                                </div>
                                <div class="col-5">

                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="row">
                                <div class="col-4">
                                    <select class="form-select mb-3 fix-procedure" name="">
                                        <option selected>Procedure</option>
                                        @foreach ($procedure as $data)
                                            <option value="{{ $data->code }}">{{ $data->name }}</option>
                                        @endforeach

                                    </select>

                                </div>
                                <div class="col-4">
                                    <select name="physician[]" class="form-select fix-doctor " id="">
                                        <option value="">Physician</option>
                                        <option value=""></option>

                                        @foreach ($doctor as $d)
                                            <option value="{{ $d->uid }}">
                                                {{ $d->user_prefix }} {{ $d->user_firstname }}
                                                {{ $d->user_lastname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <div class="col-12">
                                        <input type="date" class="form-control" name="appointment_date" value=""
                                            data-provider="flatpickr" data-date-format="Y-m-d" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 p-0 mt-2" style="border: 1px solid #e9ebec"></div>

                    <div class="row mt-2">

                        <div class="col-1">HN</div>
                        <div class="col-4">
                            <div class="row">
                                <div class="col-4">
                                    Prefix:
                                </div>
                                <div class="col-4">
                                    Firstname:
                                </div>
                                <div class="col-4">
                                    Lastname:
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="row">
                                <div class="col-7 ">
                                    Gender :
                                </div>
                                <div class="col-5">
                                    Age :
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="row">
                                <div class="col-6">Procedure :</div>
                                <div class="col-6">Physician</div>

                            </div>
                        </div>
                    </div>


                    @for ($i = 1; $i <= 5; $i++)

                        <div class="row mt-2">
                            <div class="col-1">
                                <input type="text" placeholder="Hn" class="form-control " name="hn[]"
                                    id="auto_hn" value="">
                            </div>
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-4">
                                        <input type="text" placeholder="Prefix" class="form-control " name="prefix[]"
                                            id="auto_pf" value="">

                                    </div>
                                    <div class="col-4">
                                        <input type="text" placeholder="FirstName" class="form-control "
                                            name="firstname[]" id="auto_fn" value="">
                                    </div>
                                    <div class="col-4">
                                        <input type="text" placeholder="LastName" class="form-control "
                                            name="lastname[]" id="auto_ln" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="row">
                                    <div class="col-7 ">
                                        <select class="form-select " name="gender[]" id="gender">
                                            <option value="1">Male</option>
                                            <option value="2">FeMale</option>
                                        </select>
                                    </div>
                                    <div class="col-5">
                                        <input type="text" placeholder="AGE" class="form-control " name="age[]"
                                            id="auto_age" value="">

                                    </div>
                                </div>

                            </div>
                            <div class="col-5">
                                <div class="row">
                                    <div class="col-6">
                                        <select class="form-select mb-3 auto_procedure" name="procedure[]" required>
                                            <option selected>Procedure</option>
                                            @foreach ($procedure as $data)

                                                <option value="{{ $data->code }}">{{ $data->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                    <div class="col-6">
                                        <select name="physician[]" class="form-select auto_doctor" id="">
                                            <option value="">Physician</option>
                                            <option value="" selected></option>
                                            @foreach ($doctor as $d)
                                                <option value="{{ $d->id }}">
                                                    {{ $d->user_prefix }} {{ $d->user_firstname }}
                                                    {{ $d->user_lastname }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>

                                </div>
                            </div>


                        </div>
                    @endfor
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary ">Save Changes</button>
                </div>
            </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

{{-- <script type="text/javascript">
    $(window).on('load', function() {
        $('#modal_autocase').modal('show');
    });
</script> --}}
<script>
    // var selectedText = $(".fix-doctor option:selected").html();
    // var value = $(".selected-procedure").find(":selected").text();
    // var value = $(".selected-procedure").find(":selected").val();




    $(".fix-doctor").on("change", function() {
        var SelectedText = $(".fix-doctor option:selected").val();
        console.log($(".fix-doctor option:selected").text());
        $(" .auto_doctor").val(SelectedText);
    });


    $(".fix-procedure").on("change", function() {
        var SelectedText = $(".fix-procedure option:selected").val();
        console.log($(".fix-procedure option:selected").text());
        $(" .auto_procedure").val(SelectedText);
    });



    // $(document).ready(function(){
    //     $("#physician_autocase").select2({
    //         placeholder: "Select Physician",
    //         allowClear: true
    //     })

    // })
</script>
