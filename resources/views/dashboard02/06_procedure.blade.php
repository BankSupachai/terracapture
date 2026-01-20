@php
    use App\Models\Mongo;
@endphp

<div class="col-lg-4">
    <div class="card h-charts mt-2">
        <div class="card-header d-flex justify-content-between">
            <span class="text-header-chart">Procedure</span>
            <button onclick="to_url('procedure')" class="btn btn-light">Show all</button>
        </div>
        <div class="card-body">
                <div class="row text-muted pb-3">
                    {{-- @foreach (isset($filter_procedure)?$filter_procedure:[] as $proc) --}}
                    @php
                        $k = 0;
                    @endphp
                    @foreach (isset($procedure)?$procedure:[] as $key=>$proc)
                        @php
                            if($k > 6){
                                continue;
                            }

                            // dd($key, $proc);
                        @endphp
                        <div class="col-10 text-start mt-2">
                            <span class="t-chartprocedure">{{@$key}}</span>
                        </div>
                        <div class="col-2 text-end mt-2">
                            {{-- @php
                                $count = Mongo::table("tb_case")->where("procedurename",$proc['name'])->count();
                            @endphp --}}




                            <span class="text-center t-chartprocedure">{{$proc}}</span>
                        </div>
                        @php
                            $k++;
                        @endphp
                    @endforeach
                </div>
        </div>

    </div>
</div>
