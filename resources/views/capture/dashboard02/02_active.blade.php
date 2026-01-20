

<div class="col-lg-12 mt-2 respondsive_dashboard" >
    <div class="card h-right">
        <div class="card-body text-center">
            <span class="text-header-chart">Active Staff</span>
            <div class="row text-muted">
                @php
                    $total_doctor   = isset($doctors) ? $doctors : 0;
                    $total_nurse    = isset($nurses) ? $nurses : 0;
                    $total_nanes    = isset($nurses_anes) ? $nurses_anes : 0;
                    $total_anes     = isset($anes) ? $anes : 0;
                    $total_nasist   = isset($nurses_assit) ? $nurses_assit : 0;

                    $total_doctor_active   = isset($doctor_active) ? $doctor_active : 0;
                    $total_nurse_active    = isset($nurse_active) ? $nurse_active : 0;
                    $total_nanes_active    = isset($nurse_anes_active) ? $nurse_anes_active : 0;
                    $total_anes_active     = isset($anes_active) ? $anes_active : 0;
                    $total_nasist_active   = isset($nurses_assit_active) ? $nurses_assit_active : 0;

                    $total_user     = $total_doctor + $total_nurse + $total_nanes + $total_anes + $total_nasist;
                @endphp
                <div class="col-6 text-start mt-2">
                    <span>Physician</span>
                </div>
                <div class="col-6 text-end mt-2">
                    <span class="text-center d-inline h3 text-danger  counter-value" data-target="{{@$total_doctor_active}}" >0</span> /
                    <span class="text-center d-inline counter-value" data-target="{{@$total_doctor}}">0</span>
                </div>
                <div class="col-6 text-start  mt-2">
                    <span>Nurse</span>
                </div>
                <div class="col-6 text-end mt-2">
                    <span class="text-center d-inline h3 text-danger  counter-value" data-target="{{@$total_nurse_active}}" >0</span> /
                    <span class="text-center d-inline counter-value" data-target="{{@$total_nurse}}">0</span>
                </div>
                <div class="col-6 text-start mt-2">
                    <span>Nurse Asist.</span>
                </div>
                <div class="col-6 text-end mt-2">
                    <span class="text-center d-inline h3 text-danger  counter-value" data-target="{{@$total_nasist_active}}" >0</span> /
                    <span class="text-center d-inline counter-value" data-target="{{@$total_nasist}}">0</span>
                </div>
                <div class="col-6 text-start  mt-2">
                    <span>Anesthesia</span>
                </div>
                <div class="col-6 text-end mt-2">
                    <span class="text-center d-inline h3 text-danger  counter-value" data-target="{{@$total_anes_active}}" >0</span> /
                    <span class="text-center d-inline counter-value" data-target="{{@$total_anes}}">0</span>
                </div>
                <div class="col-6 text-start  mt-2">
                    <span>Nurse Anes.</span>
                </div>
                <div class="col-6 text-end mt-2">
                    <span class="text-center d-inline h3 text-danger  counter-value" data-target="{{@$total_nasist_active}}" >0</span> /
                    <span class="text-center d-inline counter-value" data-target="{{@$total_nasist}}">0</span>
                </div>
            </div>
            {{-- <div class="row text-muted ">
                <div class="col-6 text-start mt-3">
                    <span>Cases</span>
                </div>
                <div class="col-6 text-end mt-3">
                    <span class="d-inline h3 text-danger"></span>
                    <span class="d-inline"></span>
                </div>
                <div class="col-6 text-start mt-3 ">
                    <span>Cancer</span>
                </div>
                <div class="col-6 text-end mt-3">
                    <span class="d-inline h3 text-danger"></span>
                </div>
            </div> --}}
        </div>
    </div>
</div>
