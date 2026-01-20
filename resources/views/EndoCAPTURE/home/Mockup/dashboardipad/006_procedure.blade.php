<div class="col-6 mt-2" id="procedure_div">
    <div class="card card-ipad h-left">
        <div class="border-bottom-solid  p-4" style="background: #222529;">
            <span class="text-header-chart-ipad  h3">Procedure</span>
        </div>
        <div class="card-body pt-1">
            <div class="row text-muted-ipad pb-3 px-3 ">
                @php
                    $k = 0;
                @endphp
                @foreach (isset($procedure)?$procedure:[] as $key=>$proc)
                    @php
                        if($k > 6){
                            continue;
                        }
                    @endphp     
                    <div class="col-10 text-start mt-2">
                        <span>{{@$key}}</span>
                    </div>          
                    <div class="col-2 text-end mt-2">
                        <span class="text-center t-chartprocedure">{{@$proc}}</span>
                    </div>
                    @php
                        $k++;
                    @endphp
                @endforeach
            </div>
        </div>
    </div>
</div>
