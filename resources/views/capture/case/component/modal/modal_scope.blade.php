

<div class="modal fade" id="scope_settinng" tabindex="-1" role="dialog" aria-labelledby="scope_settinng_label"
    aria-hidden="true" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row m-0 cn">
                    <div class="col-12">
                        <h4>Scope Setting </h4>
                    </div>
                </div>
                <div class="row m-0">
                    <div class="col-4"></div>
                    <div class="col-4"><b>Name</b></div>
                    <div class="col-4"><b>SN</b></div>
                </div>
                <div class="w-100" id="scope_list">
                    @isset($case->scope)
                        @foreach ($case->scope as $scope)
                            <div class="row m-0 cn border-bottom pb-2 scope_list{{ $scope }}" id="">
                                <div class="col-4">
                                    <button type="button" onclick='del_scope("{{ $cid }}","{{ $scope }}")'
                                        class="btn btn-icon btn-light-danger btn-sm">
                                        <i
                                            class="far fa-trash-alt"></i>
                                        </button>
                                </div>
                                <div class="col-4">
                                    @php
                                        $sc = get_scope_data($scope, 'scope_name');
                                    @endphp
                                    {{ @$sc->scope_name }}
                                </div>
                                <div class="col-4">{{ @$sc->scope_serial }}</div>

                            </div>
                        @endforeach
                    @endisset
                </div>
                <div class="row m-0 mt-2 cm">
                    <div class="col-4">
                        <button type="button" class="btn btn-icon btn-soft-success btn-sm"
                            onclick='add_scope("{{ $cid }}")'><i class="ri-add-fill"></i></button>
                    </div>
                    <div class="col-8">
                        <select class="form-control select2 form-control-sm" id="scope_add">
                            <option label="Label"></option>
                            @foreach ($scopes as $data)
                                <option value="{{ $data->scope_name }}">{{ @$data->scope_name }} &nbsp;
                                    {{ @$data->scope_serial }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row m-0 mt-2">
                    <div class="col-12">
                        <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#scope_add').select2({
        placeholder: "Select an option",
        width: '100%'
    });

    $('#scope_add').select2({
        dropdownParent: $("#scope_settinng")
    });

</script>
