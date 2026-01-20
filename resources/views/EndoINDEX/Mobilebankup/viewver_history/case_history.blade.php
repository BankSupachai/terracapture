@extends('EndoINDEX.Mobile.layouts_mobile')

@section('style')
<style>
    body{
        background: #193D61 !important;
        color: #ffffff;
        font-weight: normal !important;
    }
    .form-select , .form-control{
        background: #193D61;
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
        <table style="line-height: 3rem;">
            <tr >
                <td>11224523423</td>
                <td>Suratchanut Chitrat (M)</td>
                <td>29y 3m 10d</td>
            </tr>
        </table>

    </div>
</div>
<div class="row m-0 px-3">
    <table>
        <tr>
            <td>
                Operation Date
            </td>
            <td>
                Operation
            </td>
            <td>
                Hospital
            </td>
        </tr>
        <tr>
            <td>01 Oct, 2022 09:00</td>
            <td>Colonoscopy</td>
            <td>รพ.กระทรวงสาธารณสุข</td>

        </tr>
    </table>
</div>



@endsection






@section('script')

@endsection
