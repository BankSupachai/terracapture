<div class="card" id="tasksList">
    <div class="card-header border-0">
        {{-- <div class="d-flex align-items-center"> --}}
            <div class="row flex-grow-1 cn">
                <div class="col-auto border-end">
                    <h5 class="card-title mb-0">Today Cases</h5>
                </div>
                <div class="col-auto">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions1" id="inlineRadio1" value="option1">
                        <label class="form-check-label" for="inlineRadio1">Registered</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions2" id="inlineRadio2" value="option2">
                        <label class="form-check-label" for="inlineRadio2">Operation</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions3" id="inlineRadio3" value="option3">
                        <label class="form-check-label" for="inlineRadio3">Reported</label>
                    </div>
                </div>
                <div class="col"></div>
                <div class="col-auto">
                    <div class="flex-shrink-0">
                        <button class="btn btn-primary"><i class="bx bx-export"></i> Import from Hospital</button>
                        <button class="btn btn-primary"><i class="ri-add-line align-bottom me-1"></i> Create Case</button>
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
                        <input type="text" class="form-control search bg-light border-light" onkeyup="function_search()" placeholder="Search for Patient ID, Name…" id="text_search">
                        <i class="ri-search-line search-icon"></i>
                    </div>
                </div>
                <!--end col-->


                <div class="col-xxl-2 col-sm-4">
                    <div class="input-light">
                        <select class="form-control bg-light border-light" data-choices data-choices-search-false name="choices-single-default" id="idStatus">
                            <option value="">Doctor</option>
                            <option value="all" selected>All</option>
                            <option value="New">New</option>
                            <option value="Pending">Pending</option>
                            <option value="Inprogress">Inprogress</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                </div>
                <div class="col-xxl-2 col-sm-4">
                    <div class="input-light">
                        <select class="form-control bg-light border-light" data-choices data-choices-search-false name="choices-single-default" id="idStatus">
                            <option value="">Procedure</option>
                            <option value="all" selected>All</option>
                            <option value="New">New</option>
                            <option value="Pending">Pending</option>
                            <option value="Inprogress">Inprogress</option>
                            <option value="Completed">Completed</option>
                        </select>
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
        </form>
    </div>
    <!--end card-body-->
    <div class="card-body">
        <div class="table-responsive table-card mb-4">
            <table class="table align-middle table-nowrap mb-0" id="tasksTable">
                <thead class="table-light text-muted">
                    <tr>
                        <th data-sort="id">HN</th>
                        <th data-sort="project_name">Name</th>
                        <th data-sort="tasks_name">Doctor</th>
                        <th data-sort="client_name">Procedure</th>
                        <th data-sort="assignedto">Remark</th>
                        <th data-sort="priority" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="list form-check-all">
                    @for($i=0;$i<=7;$i++)
                    <tr>
                        <td class="id">{{@$data_hn[$i]}}</td>
                        <td class="project_name">{{@$data_name[$i]}}</td>
                        <td class="client_name">Suratchanut Chitrat (235235)</td>
                        <td class="due_date">{!!str_replace(' ',"<br>",@$data_procedure[$i])!!}</td>
                        <td class="status">{{@$data_remark[$i]}}</td>
                        <td class="priority">
                            <a href="{{url("case")}}/{{@$data->case_id}}1" class="btn btn-primary2"><i class="ri-folder-open-fill"></i></a>
                            <a href="{{url("camera")}}/{{@$data->case_id}}1" class="btn btn-success2"><i class="mdi mdi-camera"></i></a>
                            <a href="{{url("report")}}/{{@$data->case_id}}1" class="btn btn-danger2"><i class="mdi mdi-cancel"></i></a>
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>

        </div>
    </div>
    <!--end card-body-->
</div>

