@extends('layouts.layouts_ipad.layouts_Newipad')

@section('tophead')
    Data Analyze
@endsection

@section('style')
    <style>
        .text-header-chart-ipad {
            text-align: center;
            margin-top: 0.5rem;
            font-size: 16px !important;
            color: #BBBBBB;
        }

        .mw-60 {
            max-width: 60%;
        }

        .card {
            margin: 0;
        }

        #chart_scope_all,
        #chart_icd10_modal,
        #chart_icd9_modal {
            width: 100%;
            height: 39em;
        }

        .fs-50 {
            font-size: 50px;
        }

        .row {
            --vz-gutter-x: 1rem !important;

        }



        .circle {
            height: 20px;
            width: 20px;
            background: #245788;
            border-radius: 50%;
        }

        /* .apexcharts-gridline {
    stroke-width: 2px;
    border-color: aqua
} */


        .apexcharts-legend-text {
            font-family: 'Anuphan' !important;
        }

        .apexcharts-xaxis text,
        .apexcharts-yaxis text {
            fill: #BBBBBB !important;

        }

        .apexcharts-legend-text {
            color: #BBBBBB !important;
        }

         {
            color: #BBBBBB;
        }

        .text-muted-ipad {
            color: #BBBBBB;
        }
        .h-right-ipad {
            height: 300px;
        }
        .h-left{
            height: 273px;
        }
    </style>
@endsection
@section('offcanvas')
@include('EndoCAPTURE.home.Mockup.dashboardipad.offcanvasDashboard.treatment')
@include('EndoCAPTURE.home.Mockup.dashboardipad.offcanvasDashboard.Diagnosis')
@include('EndoCAPTURE.home.Mockup.dashboardipad.offcanvasDashboard.intervention')
@include('EndoCAPTURE.home.Mockup.dashboardipad.offcanvasDashboard.complication')

@endsection

@section('content')
    <div class="row pb-2">
        <div class="col-lg-3  ">
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="card card-ipad h-right-ipad ">
                        <div class="card-body text-center p-3">
                            @php
                                $total_case    = isset($cases) ? count($cases) : 0;
                                $total_patient = isset($patients) ? count($patients) : 0;
                            @endphp
                            <img src="{{ url('public/images/medicalogo.png') }}" width="108px">
                            <br><br>
                            <div class="">
                                <span class="text-header-chart-ipad ">Total Case</span>
                                <br>
                                <span class="text-centerh1 h2 text-danger mt-1 counter-value" data-target="{{@$total_case}}">{{@$total_case}}</span>

                            </div>
                            <div class="mt-3">
                                <span class="text-header-chart-ipad mt-1">Total Patient</span>
                                <br>
                                <span class="text-center h2 text-muted-ipad  counter-value" data-target="{{@$total_patient}}">{{@$total_patient}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-2">
                    <div class="card  card-ipad h-right-ipad ">
                        <div class="card-body text-center">
                            <span class="text-header-chart-ipad">Active Staff</span>
                            @php
                                $total_doctor   = isset($doctors) ? $doctors : 0;
                                $total_nurse    = isset($nurses) ? $nurses : 0;
                                $total_nanes    = isset($nurses_anes) ? $nurses_anes : 0;
                                $total_anes     = isset($anes) ? $anes : 0;
                                $total_nasist   = isset($nurses_assit) ? $nurses_assit : 0;
                                $total_user     = $total_doctor + $total_nurse + $total_nanes + $total_anes + $total_nasist;
                            @endphp
                            <div class="row text-muted-ipad">
                                <div class="col-6 text-start mt-2">
                                    <span>Physician</span>
                                </div>
                                <div class="col-6 text-end mt-2">
                                    <span class="text-center d-inline h3 text-success  counter-value"
                                    data-target="{{@$total_doctor}}">{{@$total_doctor}}</span> /
                                    <span class="text-center d-inline counter-value" data-target="{{@$total_user}}">{{@$total_user}}</span>
                                </div>
                                <div class="col-6 text-start  mt-2">
                                    <span>Nurse</span>
                                </div>
                                <div class="col-6 text-end mt-2">
                                    <span class="text-center d-inline h3 text-success  counter-value"
                                        data-target="{{@$total_nurse}}">{{@$total_nurse}}</span> /
                                    <span class="text-center d-inline counter-value" data-target="{{@$total_user}}">{{@$total_user}}</span>
                                </div>
                                <div class="col-6 text-start mt-2">
                                    <span>Nurse Asist.</span>
                                </div>
                                <div class="col-6 text-end mt-2">
                                    <span class="text-center d-inline h3 text-success  counter-value"
                                        data-target="{{@$total_nasist}}">{{@$total_nasist}}</span> /
                                    <span class="text-center d-inline counter-value" data-target="{{@$total_user}}">{{@$total_user}}</span>
                                </div>
                                <div class="col-6 text-start  mt-2">
                                    <span>Anesthesia</span>
                                </div>
                                <div class="col-6 text-end mt-2">
                                    <span class="text-center d-inline h3 text-success  counter-value"
                                    data-target="{{@$total_anes}}">{{@$total_anes}}</span> /
                                    <span class="text-center d-inline counter-value" data-target="{{@$total_user}}">{{@$total_user}}</span>
                                </div>
                                <div class="col-6 text-start  mt-2">
                                    <span>Nurse Anes.</span>
                                </div>
                                <div class="col-6 text-end mt-2">
                                    <span class="text-center d-inline h3 text-success  counter-value"
                                    data-target="{{@$total_nanes}}">{{@$total_nanes}}</span> /
                                    <span class="text-center d-inline counter-value" data-target="{{@$total_user}}">{{@$total_user}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 h-right-ipad mt-2">
                    <div class="card card-ipad h-right-ipad ">
                        <div class="card-body  text-center ">
                            <div style="margin-top: 4em;">
                                <span class="h3 text-muted-ipad">Total Room</span>
                                @php
                                    $total_scope = isset($scopes) ? count($scopes) : 0;
                                    $total_room = isset($rooms) ? count($rooms) : 0;
                                @endphp
                                <br>
                                <span class="h3 text-muted-ipad counter-value" data-target="{{@$total_room}}">{{@$total_room}}</span>
                                <br>
                                <div class="mt-5 mb-3">
                                    <span class="h3 text-muted-ipad">Total Scope</span>
                                    <br>
                                    <span class="h3 text-muted-ipad counter-value " data-target="{{@$total_scope}}">{{@$total_scope}}</span>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 h-right-ipad mt-2">
                    <div class="card  card-ipad h-right-ipad ">
                        <div class="card-body p-3 text-center ">
                            <div style="margin-top: 1em;margin-bottom: 1em;">
                                <span class="h3 text-muted-ipad">Active Graph</span>
                                <br>
                                <div class=" p-3">
                                    <div class="form-check mb-2 text-muted-ipad">
                                        <input class="form-check-input" type="checkbox" id="formCheck1" onchange="toggle_graph('procedure')" checked>
                                        <label class="form-check-label" for="formCheck1">
                                            Procedure
                                        </label>
                                    </div>

                                    <div class="form-check mb-2 text-muted-ipad">
                                        <input class="form-check-input" type="checkbox" id="formCheck2" onchange="toggle_graph('treatment')" checked>
                                        <label class="form-check-label" for="formCheck2">
                                            Treatment Coverage
                                        </label>
                                    </div>

                                    <div class="form-check mb-2 text-muted-ipad">
                                        <input class="form-check-input" type="checkbox" id="formCheck3" onchange="toggle_graph('age')" checked>
                                        <label class="form-check-label" for="formCheck3">
                                            Age / Gender
                                        </label>
                                    </div>
                                    <div class="form-check mb-2 text-muted-ipad">
                                        <input class="form-check-input" type="checkbox" id="formCheck4" onchange="toggle_graph('diagnosis')" checked>
                                        <label class="form-check-label" for="formCheck4">
                                            Diagnosis
                                        </label>
                                    </div>
                                    <div class="form-check mb-2 text-muted-ipad">
                                        <input class="form-check-input" type="checkbox" id="formCheck5" onchange="toggle_graph('intervention')" checked>
                                        <label class="form-check-label" for="formCheck5">
                                            Intervention
                                        </label>
                                    </div>
                                    <div class="form-check mb-2 text-muted-ipad">
                                        <input class="form-check-input" type="checkbox" id="formCheck6" onchange="toggle_graph('complication')" checked>
                                        <label class="form-check-label" for="formCheck6">
                                            Complication
                                        </label>
                                    </div>
                                    <div class="form-check mb-2 text-muted-ipad">
                                        <input class="form-check-input" type="checkbox" id="formCheck7" onchange="toggle_graph('bowel')" checked>
                                        <label class="form-check-label" for="formCheck7">
                                            Bowel Preparation
                                        </label>
                                    </div>
                                    <div class="form-check mb-2 text-muted-ipad">
                                        <input class="form-check-input" type="checkbox" id="formCheck8" onchange="toggle_graph('rapid')" checked>
                                        <label class="form-check-label" for="formCheck8">
                                            Rapid Urease Test
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 ">
            <div class="col-12">
                <div class="card card-ipad  pb-3">
                    <div class="mt-3">
                        <form action="{{ url('chdashboard') }}" method="POST">
                            @csrf
                            <input type="hidden" name="event" value="filter_search">
                            <div class="row d-flex align-items-center m-0">
                                <div class="col-4 p-0">
                                    <h5 class="font-gray">&ensp; Date</h5>
                                </div>
                                <div class="col-3 p-0">
                                    <h5 class="font-gray">&ensp; Physician</h5>
                                </div>
                                <div class="col-5 p-0">
                                    <h5 class="font-gray">&ensp; Procedure</h5>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center m-0">
                                <div class="col-4">
                                    <div class="row">
                                        @php
                                            if(isset($filter_datefrom)){
                                                $datefrom = explode(' ', $filter_datefrom);
                                                if(isset($datefrom[0])){
                                                    $filter_datefrom = $datefrom[0];
                                                }
                                            }
                                        @endphp
                                        <div class="col-6">
                                            <input id="date_from" name="date_from" type="date" class="form-control form-control-dark " value="{{@$filter_datefrom}}">
                                        </div>
                                        @php
                                            if(isset($filter_dateto)){
                                                $dateto = explode(' ', $filter_dateto);
                                                if(isset($filter_dateto[0])){
                                                    $filter_dateto = $dateto[0];
                                                }
                                            }
                                        @endphp
                                        <div class="col-6">
                                            <input id="date_to" name="date_to" type="date" class="form-control form-control-dark" value="{{@$filter_dateto}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <select class="form-select" aria-label="Default select example" id="physician" name="physician">
                                        <option value="">All Physician</option>
                                        @foreach (isset($filter_doctor)?$filter_doctor:[] as $doctor)
                                            @php
                                                $doctor = (object) $doctor;
                                                $doctorname = @$doctor->user_prefix.@$doctor->user_firstname.' '.@$doctor->user_lastname;
                                            @endphp
                                            <option value="{{@$doctorname}}" @isset($filter_physician) @if($filter_physician == $doctorname) selected  @endif  @endisset>{{@$doctorname}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-5">
                                    <div class="row">
                                        <div class="col-8">
                                            <select class="form-select" aria-label="Default select example"  id="procedure" name="procedure" name="hoscode">
                                                <option value="">All Procedure</option>
                                                @foreach (isset($filter_procedure)?$filter_procedure:[] as $proc)
                                                    @php
                                                        $proc = (object) $proc;
                                                    @endphp
                                                    <option value="{{@$proc->name}}" @isset($filter_procedurename)  @if($filter_procedurename == $proc->name) selected  @endif  @endisset>{{@$proc->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-1 ps-1">
                                            <button type="submit" name="submit" value="1"  class="btn btn-primary "><i
                                                    class="ri-filter-2-fill ri-1x"></i>
                                            </button>
                                        </div>
                                        <div class="col-1"></div>
                                        <div class="col-1 ps-0">
                                            <button type="submit" name="clear" value="1"  class="btn btn-primary"><i
                                                    class="ri-delete-bin-6-line ri-1x"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                @include('EndoCAPTURE.home.Mockup.dashboardipad.006_procedure')
                @include('EndoCAPTURE.home.Mockup.dashboardipad.007_treatment')
                @include('EndoCAPTURE.home.Mockup.dashboardipad.008_age')
                @include('EndoCAPTURE.home.Mockup.dashboardipad.009_diagnosis')
                @include('EndoCAPTURE.home.Mockup.dashboardipad.010_intervention')
                @include('EndoCAPTURE.home.Mockup.dashboardipad.011_complication')
                @include('EndoCAPTURE.home.Mockup.dashboardipad.012_bowel')
                @include('EndoCAPTURE.home.Mockup.dashboardipad.013_rapid')

            </div>
        </div>
        <div class="col-12 p-3"></div>
    </div>

@endsection

@section('script')
<script>
    function toggle_graph(name){
        let display = $(`#${name}_div`).css('display')
        if(display == 'block'){
            $(`#${name}_div`).css('display', 'none')
        } else {
            $(`#${name}_div`).css('display', 'block')
        }
    }
</script>
@endsection
