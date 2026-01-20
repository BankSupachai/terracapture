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
    background-color: #24578826;
    font-weight: normal;

}
</style>
@endsection
@section('modal')
@endsection


@section('content')
<div class="card h-100 p-2">
    <div class="row p-3" style="border-bottom: 1px solid #E9EBEC">
        <div class="col-1">
            <a href="{{url("mobile/calendar")}}">
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
            <div class="col-2 align-self-center">
                <span class="badge badge-soft-primary">Case List</span>
            </div>
            <div class="col-6 text-end">
                <a href="{{url("mobile/event")}}" type="button" class="btn "><i class=" ri-add-circle-fill ri-xl text-dark "></i></a>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-4 align-self-center">
                Density Status
            </div>
            <div class="col-2 align-self-center">
                <span class="badge badge-soft-warning fw-normal ">Available</span>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-4 align-self-center">
                Cases : 5
            </div>

        </div>

        <div class="row mt-2 text-nowrap" style="border-left: 2px solid  #245788">
            <div class="col-2 ">
                09:30
            </div>
            <div class="col-3 ">
                151232532
            </div>
            <div class="col-4 ">
                สุรัชณัฏฐ์ จิตรัตน์
            </div>
            <div class="col-3 ">
                Colonoscopy
            </div>
        </div>
    </div>
</div>
@endsection






@section('script')

@endsection
