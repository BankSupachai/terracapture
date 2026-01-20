<div class="col-lg-12 mt-2 respondsive_dashboard">
    <div class="card h-right2">
        <div class="card-body p-0 m-0 text-center mt-3">
            <div style="margin-top: 4.5em;">
                <div class="mt-3">
                    @php
                        $total_scope = isset($scopes) ? count($scopes) : 0;
                    @endphp
                    <span class="h1 t-chartprocedure">Total Scope</span>
                    <br>
                    <span class="h1 counter-value t-chartprocedure" data-target="{{@$total_scope}}">0</span>

                </div>
            </div>
        </div>
    </div>
</div>


