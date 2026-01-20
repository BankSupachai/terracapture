<style>
    #modal_select_case table tr td{
        vertical-align: middle;
    }
</style>
<div class="card" id="tasksList">
    <div class="card-header border-0">
        {{-- <div class="d-flex align-items-center"> --}}
            <div class="row flex-grow-1 cn">
                <div class="col-auto border-end">
                    <h5 class="card-title mb-0">Number of studies : <span id="num_study" class="fs-4">{{count($tb_case)}}</span></h5>
                </div>
                <div class="col-auto">

                    {{--  --}}
                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check" name="btnradio" id="btnradio1" value="day" autocomplete="off" onchange="function_search()">
                        <label class="btn btn-outline-dark" for="btnradio1">0D</label>

                        <input type="radio" class="btn-check" name="btnradio" id="btnradio2" value="week" autocomplete="off" onchange="function_search()">
                        <label class="btn btn-outline-dark" for="btnradio2">1W</label>

                        <input type="radio" class="btn-check" name="btnradio" id="btnradio3" value="all" autocomplete="off" checked="" onchange="function_search()">
                        <label class="btn btn-outline-dark" for="btnradio3">ALL</label>
                    </div>
                    {{--  --}}

                </div>
                <div class="col-2"><input type="text" class="form-control bg-light border-light lh25 calendar" data-provider="flatpickr" data-date-format="d-m-Y" data-range-date="true" placeholder="Select date range"></div>
                <div class="col"></div>
                <div class="col-auto">
                    <div class="flex-shrink-0">
                        <a class="btn btn-primary" href="{{url('terra/w-import')}}"><i class="bx bx-export"></i> Import from Hospital</a>
                        <a class="btn btn-primary" href="{{url('patient/create')}}"><i class="ri-add-line align-bottom me-1"></i> Create Case</a>
                    </div>
                </div>
            </div>
        {{-- </div> --}}
    </div>
    <div class="card-body border border-dashed border-end-0 border-start-0">
        <form>
            <div class="row g-3">
                <div class="col-xxl-3 col-sm-12">
                    <div class="search-box">
                        {{-- <input type="text" class="form-control search bg-light border-light lh25" oninput="function_search()" placeholder="Search for Patient ID, Name…" id="text_search2"> --}}
                        <input type="text" class="form-control bg-light border-light lh25" oninput="function_search()" placeholder="Search for Patient ID, Name…" id="text_search">
                        <i class="ri-search-line search-icon"></i>
                    </div>
                </div>
                <div class="col-xxl-2 col-sm-4">
                    <div class="input-light">
                        {{-- <select name="" class="form-control bg-light border-light" id="procedure" onchange="function_search()">
                            <option value="">Procedure</option>
                            @foreach ($procedure as $pcd)
                                <option value="{{$pcd->procedure_name}}">{{$pcd->procedure_name}}</option>
                            @endforeach
                        </select> --}}
                        <select class="form-control bg-light border-light" data-choices name="choices-single-default" id="procedure" onchange="function_search()">
                            <option value="">Procedure</option>
                            @foreach ($procedure as $pcd)
                                <option class="pdc-opt" value="{{$pcd->procedure_name}}">{{$pcd->procedure_name}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="col-xxl-2 col-sm-4">
                    <div class="input-light">

                        <select class="form-control bg-light border-light" data-choices  name="choices-single-default" id="modality" onchange="function_search()">
                            <option value="0">Modality</option>
                            <option value="CR">CR</option>
                            <option value="CT">CT</option>
                            <option value="MR">MR</option>
                            <option value="US">US</option>
                            <option value="OT">OT</option>
                            <option value="BI">BI</option>
                            <option value="CD">CD</option>
                            <option value="DD">DD</option>
                            <option value="DG">DG</option>
                            <option value="ES">ES</option>
                            <option value="LS">LS</option>
                            <option value="PT">PT</option>
                            <option value="RG">RG</option>
                            <option value="ST">ST</option>
                            <option value="TG">TG</option>
                            <option value="XA">XA</option>
                            <option value="RF">RF</option>
                            <option value="RTIMAGE">RTIMAGE</option>
                            <option value="RTDOSE">RTDOSE</option>
                            <option value="RTSTRUCT">RTSTRUCT</option>
                            <option value="RTPLAN">RTPLAN</option>
                            <option value="RTRECORD">RTRECORD</option>
                            <option value="HC">HC</option>
                            <option value="DX">DX</option>
                            <option value="NM">NM</option>
                            <option value="MG">MG</option>
                            <option value="IO">IO</option>
                            <option value="PX">PX</option>
                            <option value="GM">GM</option>
                            <option value="SM">SM</option>
                            <option value="XC">XC</option>
                            <option value="PR">PR</option>
                            <option value="AU">AU</option>
                            <option value="EPS">EPS</option>
                            <option value="HD">HD</option>
                            <option value="SR">SR</option>
                            <option value="IVUS">IVUS</option>
                            <option value="OP">OP</option>
                            <option value="SMR">SMR</option>
                        </select>

                        {{-- <select name="" class="form-control bg-light border-light" id="modality" onchange="function_search()">
                            <option value="0">Modality</option>
                            <option value="CR">CR</option>
                            <option value="CT">CT</option>
                            <option value="MR">MR</option>
                            <option value="US">US</option>
                            <option value="OT">OT</option>
                            <option value="BI">BI</option>
                            <option value="CD">CD</option>
                            <option value="DD">DD</option>
                            <option value="DG">DG</option>
                            <option value="ES">ES</option>
                            <option value="LS">LS</option>
                            <option value="PT">PT</option>
                            <option value="RG">RG</option>
                            <option value="ST">ST</option>
                            <option value="TG">TG</option>
                            <option value="XA">XA</option>
                            <option value="RF">RF</option>
                            <option value="RTIMAGE">RTIMAGE</option>
                            <option value="RTDOSE">RTDOSE</option>
                            <option value="RTSTRUCT">RTSTRUCT</option>
                            <option value="RTPLAN">RTPLAN</option>
                            <option value="RTRECORD">RTRECORD</option>
                            <option value="HC">HC</option>
                            <option value="DX">DX</option>
                            <option value="NM">NM</option>
                            <option value="MG">MG</option>
                            <option value="IO">IO</option>
                            <option value="PX">PX</option>
                            <option value="GM">GM</option>
                            <option value="SM">SM</option>
                            <option value="XC">XC</option>
                            <option value="PR">PR</option>
                            <option value="AU">AU</option>
                            <option value="EPS">EPS</option>
                            <option value="HD">HD</option>
                            <option value="SR">SR</option>
                            <option value="IVUS">IVUS</option>
                            <option value="OP">OP</option>
                            <option value="SMR">SMR</option>
                        </select> --}}

                    </div>
                </div>
                <!--end col-->
                <div class="col-xxl"></div>
                <div class="col-xxl-1 col-sm-4">
                    <button type="button" class="btn btn-filters w-100" onclick="SearchData();"> <i class="ri-equalizer-fill me-1 align-bottom"></i>
                        Filters
                    </button>
                </div>
                <!--end col-->
            </div>
            <!--end row-->

            {{-- @dd($tb_case) --}}
        </form>
    </div>
    <!--end card-body-->
    <div class="card-body">
        <div class="table-responsive table-card mb-4">
            <table class="table align-middle table-nowrap mb-0" id="tasksTable">
                <thead class="table-light text-muted">
                    <tr>
                        <th class="sort" data-sort="pt_id">Patient ID</th>
                        <th class="sort" data-sort="pt_name">Name</th>
                        <th class="sort" data-sort="procedure">Procedure</th>
                        <th class="sort" data-sort="modality">Modality</th>
                        <th class="sort" data-sort="doctor">date</th>
                        <th class="sort" data-sort="time">Time</th>
                        <th class="sort" data-sort="remark">Remark</th>
                        <th class="sort" data-sort="report">Report</th>
                        <th class="sort" data-sort="action" class="text-center">Action</th>
                    </tr>
                </thead>


                <tbody class="list form-check-all">
                    {{-- @dd($tb_case) --}}
                    @foreach ($tb_case as $data)
                    <tr>
                        @php
                            $datetime = isset($data->studydate) && $data->studydate != 0 ? date('Y/m/d H:i:s', $data->studydate) : '';
                            $exp = explode(' ', $datetime);
                            $date = date_format(date_create($exp[0]),"d-m-Y");
                            $time = date_format(date_create($exp[1]),"H:i");

                        @endphp
                        <td class="pt_id">{{$data->hn}}</td>
                        <td class="pt_name">{{$data->dicomname}}</td>
                        <td class="procedure">{{procedureCODE($data->case_procedurecode)}}</td>
                        {{-- <td class="procedure">{{@$mockup[$i]['procedure']}}</td> --}}
                        <td class="modality">{{$data->modality}}</td>
                        <td class="doctor">{{@$date}}</td>
                        <td class="time">{{@$time}}</td>
                        <td class="remark">{{@$mockup[$i]['remark']}}</td>
                        <td class="report">{{change_status(@$data->case_status)}}</td>
                        <td class="priority">
                            <a href="{{url('reportendocapture')}}/{{$data->case_id}}" @if(@$data->case_status >=2) class="btn btn-primary" @else class="btn btn-light" @endif><i class="ri-article-line mdi-20px"></i></a>
                            <a href="{{url('terra/viewer')}}/{{$data->case_id}}" class="btn btn-success"><i class="mdi mdi-view-carousel mdi-20px"></i></a>
                            <a href="{{url('procedure')}}/{{$data->case_id}}" class="btn btn-primary2"><i class="ri-folder-open-fill ri-20px"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--end card-body-->
    <div class="modal fade" id="modal_select_case" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Select</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Select your operation
              <table class="table">
                    <tr>
                        <th>Accession N.</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Operation</th>
                        <th class="text-center">Action</th>
                    </tr>
                    @for($i=0;$i<rand(1,6);$i++)
                    <tr>
                        <td>Caseuniq</td>
                        <td>123456</td>
                        <td>Suratchanut Chitrat</td>
                        <td>EGD</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-light btn-icon waves-effect"><i class="ri-article-fill"></i></button>&nbsp;
                            <a href="{{url('viewer')}}" class="btn btn-success btn-icon waves-effect"><i class="mdi mdi-view-carousel"></i></a>&nbsp;
                            <button type="button" class="btn btn-primary btn-icon waves-effect"><i class="ri-folder-open-fill"></i></button>
                            <button type="button" class="btn btn-danger btn-icon waves-effect"><i class="mdi mdi-cancel"></i></button>&nbsp;
                        </td>
                    </tr>
                    @endfor
              </table>
            </div>
          </div>
        </div>
      </div>
    @php
        function change_status($status){
            if($status==0){
                echo "<span class='badge badge-soft-warning text-uppercase'>Draft</span>";
            }elseif($status==1){
                echo "<span class='badge badge-soft-success text-uppercase'>Final</span>";
            }elseif($status==2){
                echo "<span class='badge badge-soft-success text-uppercase'>Final</span><i class='las la-check-circle text-success'></i>";
            }
        }
    @endphp
<script>
    // $(".calendar").flatpickr();
</script>
</div>

