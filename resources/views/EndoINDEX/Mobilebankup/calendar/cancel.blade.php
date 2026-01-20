@extends('EndoINDEX.Mobile.layouts_mobile')

@section('style')

<style>
    *{
            color: #878a99;

    }
.btn-addcase{
    background: #495057;
    color: #ffffff;
    border-radius: 50%;
     font-size: 16px;
}
.badge-soft-primary {
    color: #245788;
    background-color: rgba(64, 81, 137, .1);
}
</style>
@endsection
@section('modal')
@endsection


@section('content')
<div class="card p-2">
    <div class="row p-3" style="border-bottom: 1px solid #E9EBEC">
        <div class="col-1">
            <a href="{{url("previous")}}">
                <i class="ri-arrow-go-back-line"></i>
            </a>
        </div>
        <div class="col-11">
            <h4>
                Wednesday, 11 March
            </h4>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-4 align-self-center">
                Event Category
            </div>
            <div class="col-2 align-self-center text-danger">
                Leave
            </div>

        </div>

        <div class="row mt-2" style="border-left: 3px solid #F06548">
            <div class="col-2 ">
                All day
            </div>
            <div class="col-3 ">
                Leave
            </div>
            <div class="col-4 "></div>
            <div class="col-3 ">
                <span class="badge badge-soft-danger">Cancel</span>

            </div>
        </div>
    </div>
</div>
@endsection






@section('script')

@endsection
