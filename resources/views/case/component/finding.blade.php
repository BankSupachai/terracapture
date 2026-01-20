@if (@$feature->fidingsidephoto)
    @if (count($photoselect) == 0)
        <div class="col-12 p-0">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    @include('case.component.findingincard')
                </div>
            </div>
        </div>
    @endif
    @elseif($procedure->code == 'gi111')
    <div class="col-12 p-0">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                @include('case.component.findingincardlapa')
            </div>
        </div>
    </div>
@else
    <div class="col-12 p-0">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                @include('case.component.findingincard')
            </div>
        </div>
    </div>
@endif
