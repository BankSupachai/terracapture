<div class="col-lg-12">
    <div class="card  mt-2" style="margin-bottom:12px;">
        <div class="card-body text-center p-3" style="margin-top:px; height:556px;">
            @php
                $total_case    = isset($cases) ? count($cases) : 0;
                $total_patient = isset($patients) ? count($patients) : 0;
            @endphp
        <img src="{{ urlConfig($hospital->hospital_pic) }}" class="img-fluid" style="width: 80%; height: auto;">
            {{-- @dd($hospital->hospital_pic) --}}
            <br><br>
            <div class="">
                <span class=" bold h2 pt-4" style="color:#F06548;">Total Case</span>
                <br><br>
                <span class="text-centerh1 h2 fw-normal text-danger mt-1 counter-value" data-target="{{@$total_case}}">0</span>
                <br><br>
            </div>
            <div class="mt-3">
                <span class=" bold h2" style="color: #878A99;">Total Patient</span>
                <br><br>
                <span class="text-center h2 fw-normal text-muted  counter-value" data-target="{{@$total_patient}}">0</span>
            </div>

        </div>
    </div>
            <br><br>
            <br><br>

</div>


