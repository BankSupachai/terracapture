<div class="row m-0 mt-3">
    <div class="col-lg-12 pt-4">
        <div class="form-check mb-2">
            <input class="form-check-input save-json set-menu-checked" data-id="menu_graphs" type="checkbox" name="ck_graphs" id="ck_graphs" @if(@$json->ck_graphs!='false') checked @endif>
            <label class="form-check-label label-underline" for="ck_graphs">
                Graph
            </label>
        </div>
        <div class="w-100 set-menu-change {{data_check_active(@$json->ck_graphs,'auto')}}" id="menu_graphs">
            <div class="col-lg-12 card-graph">
                <ul class="row mt-5 m-0">
                    @for ($i=0;$i<count($chart);$i++)

                    <li class="col-3">
                        <div class="text-center w-100 mt-5"><b>{{$chart_name[$chart[$i]]}}</b></div>

                        <input type="checkbox" id="myCheckbox{{$i}}" name="charts[]" value="{{$chart[$i]}}" class="ck-json"
                            @if(isset($charts[$i]))
                                @if(in_array($chart[$i],$charts))
                                    checked
                                @endif
                            @endif
                        />
                        <label for="myCheckbox{{$i}}">
                            <img src="{{url("public/images/chart/$chart[$i].jpg")}}" class="img-fluid">
                        </label>
                    </li>
                    @endfor
                </ul>
            </div>
        </div>
    </div>
</div>
