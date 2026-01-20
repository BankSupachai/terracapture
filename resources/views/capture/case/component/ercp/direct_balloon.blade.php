<div class="col-12 p-0">
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <h5>Direct balloon tamponade/compression at apex</h5>
            <div class="row mt-3">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-6 pe-6 align-self-center">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input radiosave_edit ck-no" type="radio" {{ checkradio($case, 'direct_ballon_apex', 'No') }}  id="{{md5('no Direct balloon')}}"
                                        datagroup="direct_ballon_apex" subgroup="direct_ballon_apex" name="direct_ballon_apex" value="No"
                                        >
                                        <label class="form-check-label" for="{{md5('no Direct balloon')}}">
                                            No
                                        </label>
                                    </div>

                                </div>
                                <div class="col-auto">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input  radiosave_edit ck-direct_ballon_apex" type="radio" {{ checkradio($case, 'direct_ballon_apex', 'Yes') }}  id="{{md5('yes Direct balloon')}}"
                                        datagroup="direct_ballon_apex" subgroup="direct_ballon_apex" name="direct_ballon_apex" value="Yes">
                                        <label class="form-check-label" for="{{md5('yes Direct balloon')}}">
                                            Yes
                                        </label>
                                    </div>

                                </div>
                                <div class="col-5">
                                    <select class="form-select form-select-sm w-100 savejson_edit ck-radio ck-direct_ballon_apex-input"
                                    datagroup="direct_ballon_apex" subgroup="direct_ballon_apex" name="direct_ballon_apex_select"
                                    aria-label="Default select example" id="{{md5("")}}">
                                        <option value="">Select</option>
                                        <option value="No active bleeding" @if(@$case->direct_ballon_apex_select == 'No active bleeding') selected @endif>No active bleeding</option>
                                        <option value="Bleeding was stopped" @if(@$case->direct_ballon_apex_select == 'Bleeding was stopped') selected @endif>Bleeding was stopped</option>
                                        <option value="Continue oozing" @if(@$case->direct_ballon_apex_select == 'Continue oozing') selected @endif>Continue oozing</option>
                                        <option value="Active bleeding" @if(@$case->direct_ballon_apex_select == 'Active bleeding') selected @endif>Active bleeding</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        {{-- <div class="col-1"></div> --}}
                        <div class="col-6">
                            <div class="row">
                            <div class="col-12">
                                <textarea id="direct_ballon_apex_other" class="form-control savejson" name="direct_ballon_apex_other" rows="3" cols="50" placeholder="Free text">{{@$case->direct_ballon_apex_other}}</textarea>
                            </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
