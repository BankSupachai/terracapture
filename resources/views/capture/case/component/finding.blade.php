@if (@$feature->fidingsidephoto)
    @if (count($photoselect) == 0)
        <div class="col-12 p-0">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    @include('capture.case.component.findingincard')
                </div>
            </div>
        </div>
    @endif
@else
    <div class="col-12 p-0">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                @include('capture.case.component.findingincard')
            </div>
        </div>
    </div>
@endif
