@extends('layouts.layouts_ipad.layouts_Newipad')

@section('tophead')
    Viewer History
@endsection

@section('style')
    <style>
            *{color: #ffffff;}
            .fs-14{font-size: 14px;}
            .btn-dark-terra{
                background: #2B2F34;
                color: #bbbbbb;
            }
            .btn-check+.btn:hover {
                color: #ffffff;
                background: #1e2124;
            }

    </style>
@endsection


@section('content')
<div class="row px-4">
    <div class="col-12 fs-14">
        <span>Patient Detail : </span> &ensp; &ensp;
        <u>1243534</u> &ensp; &ensp;
        <span>Suratchanut Chitrat </span> &ensp; &ensp;
        <span>Male</span> &ensp; &ensp;
        <span >24 Sep,1993 (29)</span>


    </div>
    <div class="row mt-2">
        <div class="col-3">
            <select class="form-select" name="" id="">
                <option value="">Procedure</option>
            </select>
        </div>
        <div class="col-3">
            <select class="form-select" name="" id="">
                <option value="">Physician</option>
            </select>
        </div>
        <div class="col-auto">
            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off" value="all" checked="" onchange="function_search()">
                <label class="btn btn-dark-terra waves-effect waves-light" for="btnradio3">ALL</label>
                <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" value="day" onchange="function_search()">
                <label class="btn btn-dark-terra waves-effect waves-light" for="btnradio1">0D</label>

                <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" value="week" onchange="function_search()">
                <label class="btn btn-dark-terra waves-effect waves-light" for="btnradio2">1W</label>

            </div>
        </div>
    </div>
    <table class="table table-nowrap">
        <thead>
            <tr style="background: #121212;">
                <td scope="col">Operation Date</td>
                <td scope="col">Operation</td>
                <td scope="col">Physician</td>
                <td scope="col">Photo</td>
                <td scope="col">Video</td>
                <td scope="col">Pre-Diagnosis</td>

            </tr>
        </thead>
        <tbody style="background: #25292D;">
            <tr>
                <td scope="row"><a href="#" class="fw-semibold">#VZ2110</a></td>
                <td>Bobby Davis</td>
                <td>October 15, 2021</td>
                <td>$2,300</td>
                <td>t</td>
                <td></td>
            </tr>

        </tbody>
    </table>
</div>


    </div>
@endsection

@section('script')
    @include('EndoCAPTURE.ipad.booking.calendar')
@endsection
