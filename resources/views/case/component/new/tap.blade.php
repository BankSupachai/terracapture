{{-- @dd($tapactive) --}}
<div class="row m-0  justify-content-center">
    <ul class="nav nav-pills arrow-navtabs nav-success bg-light mb-2" role="tablist">
        @if (@$feature->health_record)
            <li class="nav-item">
                <a class="nav-link nav-size " href="{{ url('note/health') }}/{{ $cid }}"><i
                        class="fas fa-user-md"></i> Health
                    Record</a>
            </li>
        @endif
        @if (@$feature->physician_record)
            <li class="nav-item ">
                <a class="nav-link nav-size  @if (@$tapactive == 'physicianrecord') active @endif" href="{{ url('procedure') }}/{{ $cid }}">
                    <span class="d-block d-sm-none"><i class="mdi mdi-account"></i></span>
                    <span class="d-none d-sm-block">Physician Record</span>
                </a>
            </li>
        @endif
        @if (@$feature->nurse_record)
            <li class="nav-item ">
              <a class="nav-link nav-size @if (@$tapactive == 'note') active @endif" href="{{ url('note/note/') }}/{{ $cid }}">
                <span class="d-block d-sm-none"><i class="mdi mdi-email"></i></span>
                <span class="d-none d-sm-block">Nurse Record</span>
            </a>
            </li>
        @endif
        @if (@$feature->billing_record)
            <li class="nav-item ">
                <a class="nav-link nav-size  @if (@$tapactive == 'billing') active @endif" href="{{ url('note/billing') }}/{{ $cid }}">
                    <span class="d-block d-sm-none"><i class="mdi mdi-email"></i></span>
                    <span class="d-none d-sm-block">Billing Record</span>
                </a>
            </li>

        @endif

        @if (@$feature->store_management)
        <li class="nav-item ">
            <a class="nav-link nav-size  @if (@$tapactive == 'store') active @endif" href="{{ url('store') }}/{{ $cid }}">
                <span class="d-block d-sm-none"><i class="mdi mdi-email"></i></span>
                <span class="d-none d-sm-block">Store Management</span>
            </a>
        </li>
    @endif
    </ul>
</div>
