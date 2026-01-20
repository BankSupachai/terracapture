@extends('EndoINDEX.Mobile.layouts_mobile')

@section('style')
<style>
    body{
        background: #193D61 !important;
        color: #ffffff;
        font-weight: normal !important;
    }
    .form-select , .form-control{
        background: #245788;
        color: #ffffff;
        border: 0px ;
    }
    .card{
        background: #245788;

    }
</style>
@endsection
@section('modal')
@endsection


@section('content')
<div class="row m-0">
    <div class="card p-4 pb-0">
        <h5 class="text-white">
            Operation Date
        </h5>
        <table style="line-height: 3rem;">
            <tr >
                <td>01 OCT, 2022</td>
                <td>09:00</td>
                <td>Colonoscopy</td>
                <td>รพ. กระทรวงสาธารณสุข</td>

            </tr>
        </table>
    </div>
    <div class="col-12">
        <select name="" id="" class="form-select">
            <option value="">Physician Report</option>
        </select>
    </div>
    <div class="col-12 mt-3">
        <img src="{{url("public/image/mockupPdf.png")}}" width="400" alt="">
    </div>
</div>




@endsection






@section('script')

@endsection
