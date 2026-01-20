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
.form-select{
    border: 0px !important;
    background-color: var(--vz-input-bg);
}
</style>
@endsection
@section('modal')
@endsection


@section('content')
<div class="card p-2 h-100">
    <div class="row p-3" style="border-bottom: 1px solid #E9EBEC">
        <div class="col-1">
            <a href="{{url("mobile/book")}}">
                <i class="ri-arrow-go-back-line"></i>
            </a>
        </div>
        <div class="col-11">
            <h4>
                Event
            </h4>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
           <h4>Wednesday, 11 March</h4>
        </div>

        <div class="row mt-2">
           <select name="" id="" class="form-select">
            <option value="">Leave</option>
           </select>
        </div>
        <div class="col-12 mt-4">
            <button class="btn btn-success w-100">Confirm</button>
        </div>
    </div>
</div>
@endsection






@section('script')

@endsection
