<div class="row scroll-content my-3">
    @forelse ($branch_all ?? [] as $name => $data)
        @php
            if ($name == '') {
                continue;
            }


        @endphp
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <span class="fw-21 fw-bold text-uppercase">{{ $name }}</span>
                    <div class="row mt-2">
                        <div class="col-6">
                            Total booking : {{ @$data['count_booking'] }}
                        </div>
                        <div class="col-6">
                            Total registered : {{ @$data['count_totalregis'] }}
                        </div>
                        <div class="col-6">
                            Regist w/o book : {{@$data['count_w_regis']}}
                        </div>
                        <div class="col-6">
                            Cancel case : {{ @$data['count_cancel'] }}
                        </div>
                    </div>
                    <div class="row mt-3">
                        <span class="fw-bold fw-18 mb-1">Realtime Status</span>

                        <div class="col-6">
                            <div class="row align-items-center ">
                                <div class="col-1">
                                    <div class="rectangle_holding"></div>
                                </div>
                                <div class="col-10">
                                    <span>Holding : {{ @$data['count_holding'] }}<span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row align-items-center">
                                <div class="col-1">
                                    <div class="rectangle_operation"></div>
                                </div>
                                <div class="col-10">
                                    <span>Operation : {{ @$data['count_operation'] }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row align-items-center">
                                <div class="col-1">
                                    <div class="rectangle_recovery"></div>
                                </div>
                                <div class="col-10">
                                    <span>Recovery : {{ @$data['count_recovery'] }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row align-items-center">
                                <div class="col-1">
                                    <div class="rectangle_discharged"></div>
                                </div>
                                <div class="col-10">
                                    <span>Discharged : {{ @$data['count_discharged'] }} </span>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="progress">
                                    {{-- @dd(@$data) --}}
                                    <div class="progress-bar bg-warning" role="progressbar"
                                        style="width: {{ @$data['count_holding_percentage'] }}%"
                                        aria-valuenow="{{ @$data['count_holding_percentage'] }}" aria-valuemin="0"
                                        aria-valuemax="{{ @$data['count_totalregis'] }}"></div>
                                    <div class="progress-bar bg-danger" role="progressbar"
                                        style="width: {{ @$data['count_operation_percentage'] }}%"
                                        aria-valuenow=" {{ @$data['count_operation_percentage'] }}" aria-valuemin="0"
                                        aria-valuemax="{{ @$data['count_totalregis'] }}"></div>
                                    <div class="progress-bar bg-secondary" role="progressbar"
                                        style="width: {{ @$data['count_recovery_percentage'] }}%"
                                        aria-valuenow="{{ @$data['count_recovery_percentage'] }}" aria-valuemin="0"
                                        aria-valuemax="{{ @$data['count_totalregis'] }}"></div>
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{ @$data['count_discharged_percentage'] }}%"
                                        aria-valuenow="{{ @$data['count_discharged_percentage'] }}" aria-valuemin="0"
                                        aria-valuemax="{{ @$data['count_totalregis'] }}"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @empty
        <h2 class="text-center mt-3"></h2>
    @endforelse
</div>
