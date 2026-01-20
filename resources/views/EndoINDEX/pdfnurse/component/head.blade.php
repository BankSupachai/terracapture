<div id="header">
    <div class="w-100">
        <table class="w-100 border-bottom host-header">
            <tr>
                <td rowspan="3">
                    <img src="{{fileconfig($hospital->hospital_pic)}}" alt="" class="w-100 mh-100">
                </td>
                <td class="vtb">
                    {{$hospital->hospital_name}}
                </td>
                <td rowspan="2"><h1 class="m-0">Nurse Report</h1></td>
            </tr>
            <tr>
                <td>{{$hospital->hospital_address}}</td>
            </tr>
            <tr>
                <td class="vtt">โทรศัพท์ : {{@$hospital->tel}}</td>
                <td class="text-right vtt">เลขที่นัดหมาย : {{rand(10000,99999)}}</td>
            </tr>
        </table>
    </div>
    <div class="w-100 border-bottom pb-05">
        <table class="w-100 tb-patient">
            <tr>
                <td><b>Patient Name : </b> &nbsp; {{$patient['prefix'].$patient['firstname']." ".@$patient['middlename']." ".$patient['lastname']}}</td>
                <td><b>HN : </b> &nbsp; {{$note['hn']}}</td>
            </tr>
            <tr>
                <td><b>Date of birth : </b> &nbsp; {{swapDATE($patient['birthdate'])}}</td>
                <td><b>Gender  : </b> &nbsp; Male</td>
            </tr>
            <tr>
                <td><b>Agุe : </b> &nbsp; {{age($patient['birthdate'])}}</td>
                <td><b>Contact  : </b> &nbsp; {{$patient['phone']}}</td>
            </tr>
            <tr>
                <td><b>Treatment Coverage : </b> &nbsp; เงินสด</td>
                <td><b></b> &nbsp; </td>
            </tr>
        </table>
    </div>

</div>
