<div class="col-lg-12">
    <div class="card ">
        <div class="card-body text-center p-3">
            @php
                $total_case    = isset($cases) ? count($cases) : 0;
                $total_patient = isset($patients) ? count($patients) : 0;
            @endphp
        <img src="{{ domainname("config/$hospital->hospital_pic") }}" class="logo-hos" width="100" height="100">

            <br><br>
            <div class="">
                <span class="text-header-chart ">Total Case</span>
                <br>
                <span class="text-centerh1 h2 text-danger mt-1 counter-value" data-target="{{@$total_case}}">0</span>

            </div>
            <div class="mt-3">
                <span class="text-header-chart mt-1">Total Patient</span>
                <br>
                <span class="text-center h2 text-muted  counter-value" data-target="{{@$total_patient}}">0</span>
            </div>
        </div>
    </div>
</div>


