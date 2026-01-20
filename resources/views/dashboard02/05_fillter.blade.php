<div class="col-12 respondsive_dashboard">
    <div class="card pb-3">
        <div class="mt-3">
            <form action="{{ url('chdashboard') }}" method="POST">
                @csrf
                <input type="hidden" name="event" value="filter_search">
                <div class="row d-flex align-items-center p-0 m-0">
                    <div class="col-2 ms-1">
                        <h5>Date</h5>
                    </div>
                    <div class="col-2 ">
                        <h5>Physician</h5>
                    </div>
                    <div class="col-2 ">
                        <h5>Procedure</h5>
                    </div>
                    <div class="col-2 ">
                        <h5>Department</h5>
                    </div>

                </div>
                <div class="row d-flex align-items-center p-0 m-0">
                    {{-- <div class="col-1 text-center">
                        <h5>Date</h5>
                    </div> --}}
                    <div class="col-1">
                        @php
                            if(isset($filter_datefrom)){
                                $datefrom = explode(' ', $filter_datefrom);
                                if(isset($datefrom[0])){
                                    $filter_datefrom = $datefrom[0];
                                }
                            }
                        @endphp
                        <div>
                           <input id="date_from" name="date_from" type="date" class="form-control" value="{{@$filter_datefrom}}">
                        </div>
                    </div>
                    -
                    <div class="col-1">
                        @php
                            if(isset($filter_dateto)){
                                $dateto = explode(' ', $filter_dateto);
                                if(isset($filter_dateto[0])){
                                    $filter_dateto = $dateto[0];
                                }
                            }
                        @endphp
                        <div>
                            <input id="date_to" name="date_to" type="date" class="form-control" value="{{@$filter_dateto}}">
                        </div>
                    </div>
                    {{-- <div class="col-1 text-center">
                        <h5>Physician</h5>
                    </div> --}}
                    <div class="col-2">
                        <div>
                            <select class="form-select bg-light" aria-label="Default select example" id="physician" name="physician">
                                <option value="">All Physician</option>
                                @foreach (isset($filter_doctor)?$filter_doctor:[] as $doctor)
                                    @php
                                        $doctor = (object) $doctor;
                                        $doctorname = @$doctor->user_prefix.@$doctor->user_firstname.' '.@$doctor->user_lastname;
                                    @endphp
                                    <option value="{{@$doctorname}}" @isset($filter_physician) @if($filter_physician == $doctorname) selected  @endif  @endisset>{{@$doctorname}}</option>
                                @endforeach
                                {{-- <option value="อาจารย์มอส">อาจารย์มอส</option> --}}
                            </select>
                        </div>
                    </div>
                    {{-- <div class="col-1 text-center">
                        <h5>Procedure</h5>
                    </div> --}}
                    <div class="col-2">
                        <div>
                            <select class="form-select bg-light" aria-label="Default select example" id="procedure" name="procedure">
                                <option value="">All Procedure</option>
                                @foreach (isset($filter_procedure)?$filter_procedure:[] as $proc)
                                    @php
                                        $proc = (object) $proc;
                                    @endphp
                                    <option value="{{@$proc->name}}" @isset($filter_procedurename)  @if($filter_procedurename == $proc->name) selected  @endif  @endisset>{{@$proc->name}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    {{-- <div class="col-1 text-center">
                        <h5>Department</h5>
                    </div> --}}
                    <div class="col-2">
                        <div>
                            <select class="form-select bg-light" aria-label="Default select example" id="department" name="department">
                                <option value="">All department</option>
                                @foreach (isset($filter_department)?$filter_department:[] as $dep)
                                    @php
                                        $dep = (object) $dep;
                                    @endphp
                                    <option value="{{@$dep->department_name}}" @isset($department)  @if($department == @$dep->department_name) selected  @endif  @endisset>{{@$dep->department_name}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="col-1">
                        <button type="submit" name="submit" value="1" class="btn btn-primary w-100">Filter</button>
                    </div>
                    <div class="col-1">
                        <button type="submit" name="clear" value="1" class="btn btn-primary w-100">Clear</button>
                    </div>
                </form>
                </div>
        </div>
    </div>
</div>
