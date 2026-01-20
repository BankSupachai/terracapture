<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-12">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group mb-1">
                                <label for="exampleInputEmail1" class="m-0">Year</label>
                                <div id="column_distributed"
                                    data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-dark", "--vz-info"]'
                                    class="apex-charts" dir="ltr"></div>

                                <select name="" id="filter_year" class="form-control form-control-sm">
                                    <option value="">Select Year</option>
                                    @foreach (yearall() as $year)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-1">
                                <label for="exampleInputEmail1" class="m-0">Month</label>
                                <select name="" id="filter_month" class="form-control form-control-sm">
                                    <option value="">Select Month</option>
                                    @foreach ($month_all as $mon)
                                        <option value="{{ $mon }}">{{ $mon }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="form-group mb-1">
                                <label for="exampleInputEmail1" class="m-0">Procedure</label>
                                <select name="filter_procedure" id="filter_procedure"
                                    class="form-control form-control-sm">
                                    <option value="">Select Procedure</option>
                                    @foreach ($filter_procedure as $data)
                                        <option value="{{ $data['name'] }}">{{ $data['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group mb-1">
                                <label for="exampleInputEmail1" class="m-0">Age</label>
                                <input type="number" id="filter_age" value=""
                                    class="form-control form-control-sm" placeholder="Enter Age..">
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="form-group mb-1">
                                <label for="exampleInputEmail1" class="m-0">Room</label>
                                <select name="" id="filter_room" class="form-control form-control-sm">
                                    <option value="">Select Room</option>
                                    @foreach ($filter_room as $data)
                                        <option value="{{ $data['room_name'] }}">{{ $data['room_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-1">
                                <label for="exampleInputEmail1" class="m-0">ICD - 10</label>
                                <input type="number" id="filter_icd10" value=""
                                    class="form-control form-control-sm" placeholder="ICD-10..">
                            </div>
                        </div>


                        <div class="col-lg-2">
                            <div class="form-group mb-1">
                                <label for="exampleInputEmail1" class="m-0">ICD - 9</label>
                                <input type="number" id="filter_icd9" value=""
                                    class="form-control form-control-sm" placeholder="Enter ICD-9..">
                            </div>

                            <div class="form-group mb-1">
                                <label for="exampleInputEmail1" class="m-0">Scope</label>
                                <select name="" id="filter_scope" class="form-control form-control-sm">
                                    <option value="">Select Scope</option>
                                    @foreach ($filter_scope as $data)
                                        <option value="{{ $data['scope_id'] }}">{{ $data['scope_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="form-group mb-1">
                                <label for="exampleInputEmail1" class="m-0">Prediagnostic</label>
                                <select name="" id="filter_prediagnostic" class="form-control form-control-sm">
                                    <option value="">Select Prediagnostic</option>
                                    @foreach ($filter_prediagnostic as $fpdnt)
                                        @php
                                            $fpdnt = (object) $fpdnt;
                                        @endphp
                                        <option value="{{ $fpdnt->prediagnostic_id }}">
                                            {{ $fpdnt->prediagnostic_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-1">
                                <label for="exampleInputEmail1" class="m-0">Medication</label>
                                <select name="" id="filter_medication" class="form-control form-control-sm">
                                    <option value="">Select Medication</option>
                                    @foreach ($filter_medication as $md)
                                        <option value="{{ $md }}">{{ $md }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <a id="filter" class="btn btn-outline-light w-100 h-100 pt-5">
                                <img src="{{ url('public/image/presentation.png') }}" style="width: 4em;">
                                <br>
                                กรองข้อมูล
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
