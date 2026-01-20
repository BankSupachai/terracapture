<style>
    .bold {
            font-weight: bold;
        }
</style>
<div class="col-lg-12">
    <div class="card" style="margin-top:-8px; height:580px;">
        <div class="card-body text-center p-3 pt-5">
            <img src="{{ url('public/images/medicalogo.png') }}" class="img-fluid" style="width: 30%; height: auto;">
            <br><br>
            <span class="text-header-chart bold h1 pt-4" style="color:#F06548;">Total Case</span>
            <br><br>
            <span class="text-centerh1 h2 text-danger mt-1 counter-value" data-target="{{@$total_case}}">{{@$total_case}}</span>
        </div>
        <div class="card-body text-center p-3">

            <br><br>
            <span class="text-header-chart bold h1" style="color: #878A99;">Total Patient</span>
            <br><br>
            <span class="text-center h2 text-muted-ipad  counter-value" data-target="{{@$total_patient}}">{{@$total_patient}}</span>

        </div>
        <br><br>
        <br><br>
        <br><br>
        <br><br>



    </div>
</div>
