<div class="col-lg-12 mt-2 respondsive_dashboard">
    <div class="card h-right2">
        <div class="card-body p-0 m-0 text-center ">
            <div style="margin-top: 4.5em;">

                @php
                    $total_room = isset($rooms) ? count($rooms) : 0;
                @endphp
                <span class="h1 t-chartprocedure">Total Room</span>
                <br>
                <span class="h1 counter-value t-chartprocedure" data-target="{{@$total_room}}">0</span>
                <br>
            </div>
        </div>
    </div>
</div>


