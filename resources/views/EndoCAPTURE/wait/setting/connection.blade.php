@extends('layouts.small-scale')

@section('style')

@endsection
@section('modal')

@endsection
@section('content')
<br>
<div class="row p-5 cn">
    <div class="col-12 mb-2">
        <u class="f-15 text-white">
            CONNECTION SETTING (Receive)
        </u>
    </div>
    <div class="col-10 mb-2">
        <table class="table table-borderless table-connection">
            <tr>
                <td>
                    <div class="form-check form-check-xl mb-2">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                    </div>
                </td>
                <td class="f-14" colspan="2">Hl7</td>
            </tr>
            <tr>
                <td></td>
                <td class="f-14">AE Titel</td>
                <td><input type="text" name="" id="" class="form-control input-dark text-white" value="D:/Lalagon/htdocs/video"></td>
            </tr>
            <tr>
                <td></td>
                <td class="f-14">IP Address</td>
                <td><input type="text" name="" id="" class="form-control input-dark text-white" value="D:/Lalagon/htdocs/store"></td>
            </tr>
            <tr>
                <td></td>
                <td class="f-14">Save option</td>
                <td><select name="" id="" class="form-control input-dark text-white w-50"><option value="">Internal and External</option></select></td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <div class="form-check form-check-xl mb-2">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                    </div>
                </td>
                <td class="f-14" colspan="2">Modality Worklist (DICOM)</td>
            </tr>
            <tr>
                <td></td>
                <td class="f-14">AE Titel</td>
                <td><input type="text" name="" id="" class="form-control input-dark text-white" value="D:/Lalagon/htdocs/video"></td>
            </tr>
            <tr>
                <td></td>
                <td class="f-14">IP Address</td>
                <td><input type="text" name="" id="" class="form-control input-dark text-white" value="D:/Lalagon/htdocs/store"></td>
            </tr>
            <tr>
                <td></td>
                <td class="f-14">Save option</td>
                <td><select name="" id="" class="form-control input-dark text-white w-50"><option value="">Internal and External</option></select></td>
            </tr>
        </table>
    </div>
    <div class="col-12 mb-2 mt-5">
        <u class="f-15 text-white">
            CONNECTION SETTING (Send)
        </u>
    </div>
    <div class="col-10 mb-2">
        <table class="table table-borderless table-connection">
            <tr>
                <td>
                    <div class="form-check form-check-xl mb-2">
                        <input class="form-check-input" type="checkbox" name="flexRadioDefault" id="flexRadioDefault1">
                    </div>
                </td>
                <td class="f-14" colspan="2">PACs</td>
            </tr>
            <tr>
                <td></td>
                <td class="f-14">AE Titel</td>
                <td><input type="text" name="" id="" class="form-control input-dark text-white" value="D:/Lalagon/htdocs/video"></td>
            </tr>
            <tr>
                <td></td>
                <td class="f-14">IP Address</td>
                <td><input type="text" name="" id="" class="form-control input-dark text-white" value="D:/Lalagon/htdocs/store"></td>
            </tr>
            <tr>
                <td></td>
                <td class="f-14">Save option</td>
                <td><select name="" id="" class="form-control input-dark text-white w-50"><option value="">Internal and External</option></select></td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <div class="form-check form-check-xl mb-2">
                        <input class="form-check-input" type="checkbox" name="flexRadioDefault" id="flexRadioDefault1">
                    </div>
                </td>
                <td class="f-14" colspan="2">FTP Server</td>
            </tr>
            <tr>
                <td></td>
                <td class="f-14">AE Titel</td>
                <td><input type="text" name="" id="" class="form-control input-dark text-white" value="D:/Lalagon/htdocs/video"></td>
            </tr>
            <tr>
                <td></td>
                <td class="f-14">IP Address</td>
                <td><input type="text" name="" id="" class="form-control input-dark text-white" value="D:/Lalagon/htdocs/store"></td>
            </tr>
            <tr>
                <td></td>
                <td class="f-14">Save option</td>
                <td><select name="" id="" class="form-control input-dark text-white w-50"><option value="">Internal and External</option></select></td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <div class="form-check form-check-xl mb-2">
                        <input class="form-check-input" type="checkbox" name="flexRadioDefault" id="flexRadioDefault1">
                    </div>
                </td>
                <td class="f-14" colspan="2">Nas</td>
            </tr>
            <tr>
                <td></td>
                <td class="f-14">AE Titel</td>
                <td><input type="text" name="" id="" class="form-control input-dark text-white" value="D:/Lalagon/htdocs/video"></td>
            </tr>
            <tr>
                <td></td>
                <td class="f-14">IP Address</td>
                <td><input type="text" name="" id="" class="form-control input-dark text-white" value="D:/Lalagon/htdocs/store"></td>
            </tr>
            <tr>
                <td></td>
                <td class="f-14">Save option</td>
                <td><select name="" id="" class="form-control input-dark text-white w-50"><option value="">Internal and External</option></select></td>
            </tr>
        </table>
    </div>
</div>
@endsection
@section('script')

@endsection
