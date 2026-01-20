@extends('layouts.layouts_ipad.layouts_Newipad')

@section('style')
<style>
    .bg-input-dark{
        background: #2B2F34;
        border: 0px;
    }
    .bg-input-dark:focus{
        background: #2B2F34;
        color: #fff;
    }

    .badge-outline-dark{
        background: transparent;
        border: 1px solid #BBBBBB;
        color: #BBBBBB;
        font-size: 12px;
    }
    .table>:not(caption)>*>*{
        padding: 3px 3px !important;
    }
    .booking tr td:nth-child(1) {width: 5%;}
    .booking tr td:nth-child(2) {width: 10%;}
    .booking tr td:nth-child(3) {width: 10%;}
    .booking tr td:nth-child(4) {width: 10%;}
    .booking tr td:nth-child(5) {width: 10%;}


    .holding tr td:nth-child(1) {width: 5%;}
    .holding tr td:nth-child(2) {width: 10%;}
    .holding tr td:nth-child(3) {width: 10%;}
    .holding tr td:nth-child(4) {width: 10%;}
    .holding tr td:nth-child(5) {width: 10%;}
    .holding tr td:nth-child(6) {width: 10%;}

    .operation tr td:nth-child(1) {width: 5%;}
    .operation tr td:nth-child(2) {width: 10%;}
    .operation tr td:nth-child(3) {width: 10%;}
    .operation tr td:nth-child(4) {width: 10%;}
    .operation tr td:nth-child(5) {width: 10%;}
    .operation tr td:nth-child(6) {width: 10%;}

    .recovery tr td:nth-child(1) {width: 5%;}
    .recovery tr td:nth-child(2) {width: 10%;}
    .recovery tr td:nth-child(3) {width: 10%;}
    .recovery tr td:nth-child(4) {width: 10%;}
    .recovery tr td:nth-child(5) {width: 10%;}
    .recovery tr td:nth-child(6) {width: 10%;}

</style>
@endsection

@section('tophead')
Cases Monitor
@endsection



@section('content')
    <div class="card-ipad">
        <div class="row mt-5 p-2">
            <div class="col-12">
                <h4 class="text-detail">Booking (1)</h4>
                <table class="table table-nowrap table-borderless booking">
                    <thead>
                        <tr class="text-detail">
                            <td></td>
                            <td scope="col">HN</td>
                            <td scope="col">    </td>
                            <td scope="col">Endoscopist</td>
                            <td scope="col">Procedure</td>
                            <td scope="col">Description</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-detail">
                            <td><button class="btn btn-success btn-sm">Check in </button></td>
                            <td >1234152</td>
                            <td>นายสดายุ  ทองลอย</td>
                            <td>นพ.สดายุ01</td>
                            <td>EGD Colonoscopy</td>
                            <td><input type="text" class="form-control bg-input-dark" placeholder="Local Anesthesia and Oxygen include"></td>
                            <td class="text-center"><i class="ri-delete-bin-5-fill text-danger ri-2x"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card-ipad mt-2">
        <div class="row mt-5 p-2">
            <div class="col-12">
                <h4 class="text-detail">Holding (4)</h4>
                <table class="table table-nowrap table-borderless holding">
                    <thead>
                        <tr class="text-detail">
                            <td></td>
                            <td scope="col">HN</td>
                            <td scope="col">Patient name</td>
                            <td scope="col">Procedure</td>
                            <td scope="col">Room</td>
                            <td scope="col">Waiting Location</td>
                            <td scope="col">Description</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-detail">
                            <td><span class="badge badge-outline-dark">7:00</span></td>
                            <td >1234152</td>
                            <td>นายจุ๊มเหม่ง มีอะไร</td>
                            <td>EGD Colonoscopy</td>
                            <td>
                                <select name="" class="form-control bg-input-dark text-white" id="">
                                    <option value="">Room 1</option>
                                </select>
                            </td>
                            <td>
                                <select name="" class="form-control bg-input-dark text-white" id="">
                                    <option value="">Front</option>
                                </select>
                            </td>
                            <td><input type="text" class="form-control bg-input-dark" placeholder="Local Anesthesia and Oxygen include"></td>
                            <td class="text-center"><i class="ri-delete-bin-5-fill text-danger ri-2x"></i></td>
                        </tr>

                        <tr class="text-detail">
                            <td><span class="badge badge-outline-dark">7:00</span></td>
                            <td >1234152</td>
                            <td>นายจุ๊มเหม่ง มีอะไร</td>
                            <td>EGD Colonoscopy</td>
                            <td>
                                <select name="" class="form-control bg-input-dark text-white" id="">
                                    <option value="">Room 1</option>
                                </select>
                            </td>
                            <td>
                                <select name="" class="form-control bg-input-dark text-white" id="">
                                    <option value="">Front</option>
                                </select>
                            </td>
                            <td><input type="text" class="form-control bg-input-dark" placeholder="Local Anesthesia and Oxygen include"></td>
                            <td class="text-center"><i class="ri-delete-bin-5-fill text-danger ri-2x"></i></td>
                        </tr>

                        <tr class="text-detail">
                            <td><span class="badge badge-outline-dark">7:00</span></td>
                            <td >1234152</td>
                            <td>นายจุ๊มเหม่ง มีอะไร</td>
                            <td>EGD Colonoscopy</td>
                            <td>
                                <select name="" class="form-control bg-input-dark text-white" id="">
                                    <option value="">Room 1</option>
                                </select>
                            </td>
                            <td>
                                <select name="" class="form-control bg-input-dark text-white" id="">
                                    <option value="">Front</option>
                                </select>
                            </td>
                            <td><input type="text" class="form-control bg-input-dark" placeholder="Local Anesthesia and Oxygen include"></td>
                            <td class="text-center"><i class="ri-delete-bin-5-fill text-danger ri-2x"></i></td>
                        </tr>

                        <tr class="text-detail">
                            <td><span class="badge badge-outline-dark">7:00</span></td>
                            <td >1234152</td>
                            <td>นายจุ๊มเหม่ง มีอะไร</td>
                            <td>EGD Colonoscopy</td>
                            <td>
                                <select name="" class="form-control bg-input-dark text-white" id="">
                                    <option value="">Room 1</option>
                                </select>
                            </td>
                            <td>
                                <select name="" class="form-control bg-input-dark text-white" id="">
                                    <option value="">Front</option>
                                </select>
                            </td>
                            <td><input type="text" class="form-control bg-input-dark" placeholder="Local Anesthesia and Oxygen include"></td>
                            <td class="text-center"><i class="ri-delete-bin-5-fill text-danger ri-2x"></i></td>
                        </tr>

                        <tr class="text-detail">
                            <td><span class="badge badge-outline-dark">7:00</span></td>
                            <td >1234152</td>
                            <td>นายจุ๊มเหม่ง มีอะไร</td>
                            <td>EGD Colonoscopy</td>
                            <td>
                                <select name="" class="form-control bg-input-dark text-white" id="">
                                    <option value="">Room 1</option>
                                </select>
                            </td>
                            <td>
                                <select name="" class="form-control bg-input-dark text-white" id="">
                                    <option value="">Front</option>
                                </select>
                            </td>
                            <td><input type="text" class="form-control bg-input-dark" placeholder="Local Anesthesia and Oxygen include"></td>
                            <td class="text-center"><i class="ri-delete-bin-5-fill text-danger ri-2x"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card-ipad mt-2">
        <div class="row mt-5 p-2">
            <div class="col-12">
                <h4 class="text-detail">Operation and Reporting (2)</h4>
                <table class="table table-nowrap table-borderless operation">
                    <thead>
                        <tr class="text-detail">
                            <td></td>
                            <td scope="col">HN</td>
                            <td scope="col">Patient name</td>
                            <td scope="col">Endoscopist</td>
                            <td scope="col">Room</td>
                            <td scope="col">Procedure</td>
                            <td scope="col">Description</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-detail">
                            <td><span class="badge badge-outline-dark">7:00</span></td>
                            <td >1234152</td>
                            <td>นายจุ๊มเหม่ง มีอะไร</td>
                            <td>EGD Colonoscopy</td>
                            <td> Room 1</td>
                            <td>
                                <span class="badge badge-outline-danger">Colonoscopy</span>
                                <span class="badge badge-outline-success">EGD</span>
                             </td>
                            <td><input type="text" class="form-control bg-input-dark" placeholder="Local Anesthesia and Oxygen include"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card-ipad mt-2">
        <div class="row mt-5 p-2">
            <div class="col-12">
                <h4 class="text-detail">Recovery and Discharge (2)</h4>
                <table class="table table-nowrap table-borderless recovery">
                    <thead>
                        <tr class="text-detail">
                            <td></td>
                            <td scope="col">HN</td>
                            <td scope="col">Patient name</td>
                            <td scope="col">Endoscopist</td>
                            <td scope="col">Procedure</td>
                            <td></td>
                            <td scope="col">Description</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-detail">
                            <td><span class="badge badge-outline-dark">7:00</span></td>
                            <td >1234152</td>
                            <td>นายจุ๊มเหม่ง มีอะไร</td>
                            <td>EGD Colonoscopy</td>
                            <td></td>
                            <td>
                                <span class="badge badge-outline-success">EGD</span>
                             </td>
                            <td><input type="text" class="form-control bg-input-dark" placeholder="Local Anesthesia and Oxygen include"></td>
                        </tr>
                        <tr class="text-detail">
                            <td><span class="badge badge-outline-dark">7:00</span></td>
                            <td >1234152</td>
                            <td>นายจุ๊มเหม่ง มีอะไร</td>
                            <td>EGD Colonoscopy</td>
                            <td></td>
                            <td>
                                <span class="badge badge-outline-danger">Colonoscopy</span>
                             </td>
                            <td><input type="text" class="form-control bg-input-dark" placeholder="Local Anesthesia and Oxygen include"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
