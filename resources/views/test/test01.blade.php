@extends('layouts.app')
@section('title', 'EndoINDEX')
@section('style')

@endsection

@section('modal')
@endsection

@section('content')



<style>
    #tb_invert tr td{
        vertical-align:middle;
    }
    #card_invert .row{
        align-items: center;
    }
    #card_invert .row .col-lg,.card_invert .row .col-3{
        margin-top: 0.5em;

    }
</style>
<div class="row m-0">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body" id="card_invert">
                <table class="table table-borderless" id="tb_invert">
                    <tr>
                        <th colspan="4" class="text-center"><h3>Procedural Intervention</h3></th>
                    </tr>
                    <tr>
                        <td>Inverventionist Fellow</td>
                        <td><input type="text" name="" id="" class="form-control"></td>
                        <td class="text-right">Staff</td>
                        <td><input type="text" name="" id="" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>Diagnosis</td>
                        <td colspan="3"><input type="text" name="" id="" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>Planed Procedure</td>
                        <td colspan="3"><input type="text" name="" id="" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>Actual Procedure</td>
                        <td colspan="3"><input type="text" name="" id="" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>Side</td>
                        <td><input type="text" name="" id="" class="form-control"></td>
                        <td class="text-right">Level</td>
                        <td><input type="text" name="" id="" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>Safety Pause by</td>
                        <td colspan="3"><input type="text" name="" id="" class="form-control"></td>
                    </tr>
                </table>

                <div class="row m-0">
                    <div class="col-lg-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                ผู้ป่วยพูดชื่อ - นามสกุล
                            </label>
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="row m-0">
                            <div class="col-lg-auto">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        ตำแหน่ง, ข้างที่มีอาการปวด แพทย์
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg">
                                <input type="text" name="" id="" class="form-control">
                            </div>
                            <div class="col-auto p-0">mark side</div>
                        </div>
                    </div>


                </div>
                <div class="row m-0">
                    <div class="col-lg-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                Consent
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="row m-0">
                            <div class="col-lg-auto">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Allergy
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg">
                                <input type="text" name="" id="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="row m-0">
                            <div class="col-lg-auto">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Anticoagulant N/Y ชื่อยา
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg">
                                <input type="text" name="" id="" class="form-control">
                            </div>
                        </div>
                    </div>


                </div>

                <div class="row m-0">
                    <div class="col-lg-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                ตั้งครรภ์ Y/N
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="row m-0">
                            <div class="col-lg-auto">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        NPO
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg">
                                <input type="text" name="" id="" class="form-control">
                            </div>
                            <div class="col-lg-auto">
                                hr.
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="row m-0">
                            <div class="col-lg-auto">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        หยุดยา N/Y เมื่อ
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg">
                                <input type="text" name="" id="" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row m-0">
                    <div class="col-lg-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                มีคนพากลับบ้าน
                            </label>
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="row m-0">
                            <div class="col-lg-auto">
                                <div class="form-check">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Specific concern
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg">
                                <input type="text" name="" id="" class="form-control">
                            </div>
                        </div>
                    </div>

                </div>
                <br><br><br>
                <div class="row m-0">
                    <div class="col-lg-12 text-center h3">Technique and Procedure</div>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@endsection
