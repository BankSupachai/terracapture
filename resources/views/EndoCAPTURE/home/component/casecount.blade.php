@php
    // use App\Models\Mongo;
    $department = uget("department");
    $total      = check_count_cases('', true, $department);
    $operation  = check_count_cases('operation', false, $department)+ check_count_cases('Operation', false, $department);
    $pending    = check_count_cases('holding', false, $department)  + check_count_cases('Holding', false, $department);
    $completed  = check_count_cases('recovery', false, $department) + check_count_cases('discharged', false, $department)+check_count_cases('Recovery', false, $department) + check_count_cases('Discharged', false, $department);
    $cancel     = check_count_cases('delete', false, $department);

    // $tb_case = Mongo::table("tb_case")->where("appointment_date",date("Y-m-d"))->select("statusjob")->get()->toArray();
    // dd($tb_case);


@endphp
<div class="row m-0">
    <div class="col-lg">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2 class=" ff-secondary "><span class="counter-value" data-target="{{@$total}}">{{@$total}}</span></h2>
                        <p class="fw-medium text-muted mt-2 mb-0">Total Cases (Today)</p>
                    </div>
                    <div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-soft-primary rounded-circle fs-2">
                                <i class="ri-list-check icon-text text-primary"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2 class=" ff-secondary   "><span class="counter-value" data-target="{{@$pending}}">{{@$pending}}</span></h2>
                        <p class="fw-medium text-muted mt-2 mb-0">Pending Cases </p>
                    </div>
                    <div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-soft-secondary rounded-circle fs-2">
                                <i class="ri-calendar-event-fill icon-text"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2 class="ff-secondary  mb-0"><span class="counter-value" data-target="{{@$operation}}">{{@$operation}}</span></h2>
                        <p class="fw-medium text-muted mt-2 mb-0  ">On Process Cases</p>
                    </div>
                    <div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-soft-warning rounded-circle fs-2">
                                <i class="ri-camera-lens-fill text-warning "></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2 class=" ff-secondary mb-0"><span class="counter-value" data-target="{{@$completed}}">{{@$completed}}</span></h2>
                        <p class="fw-medium text-muted mt-2 mb-0 ">Completed Cases</p>
                    </div>
                    <div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-soft-success rounded-circle fs-2">
                                <i class="ri-check-double-fill text-success"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2 class=" ff-secondary mb-0 "><span class="counter-value" data-target="{{@$cancel}}">{{@$cancel}}</span></h2>
                        <p class="fw-medium text-muted mt-2 mb-0">Cancel Cases</p>
                    </div>
                    <div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-soft-danger rounded-circle fs-2">
                                <i class="ri-forbid-line text-danger"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
