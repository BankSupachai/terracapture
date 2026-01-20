@extends('capture.layoutv6')
@section('title', 'EndoINDEX')
@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ url('') }}/public/css/patient/create.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('') }}/public/css/nurse/show.css" rel="stylesheet" type="text/css" />
    <style>
        .fs-18 {
            font-size: 18px;
        }
    </style>
@endsection
{{-- @section('title-left')
    <h4 class="mb-sm-0">Request Booking</h4>
@endsection --}}
@section('content')

    <div class="row">
        <div class="col-xxl-12">
            <div class="card">
                <div class="row ps-5 pt-3">
                    <div class="col-12">
                        <span><b style="font-size: 16px;">Endoscopic Request Form</b></span>
                    </div>
                    <div class="col-auto p-4 ps-5">
                        <span><b>Procedure</b></span>
                    </div>
                    <div class="col-3 pt-3">
                        <select id="cal_Procedure" class="form-select calbook" name="Procedure" required>
                            <option value="">Procedure</option>
                        </select>
                    </div>
                    <div class="col-auto p-4 ps-5">
                        <span><b>Indication</b></span>
                    </div>
                    <div class="col-3 pt-3">
                        <input type="text" class="form-control" name="indication" placeholder="indication" required>
                    </div>
                    <div class="col-auto p-4 ps-5">
                        <span><b>Staff</b></span>
                    </div>
                    <div class="col-3 pt-3 ">
                        <select id="cal_users" class="form-select calbook" name="users" required>
                            <option value="">Select Users</option>
                        </select>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-auto pt-2">
                        <input type="radio" id="ugib" name="UGIB" value="UGIB">
                        <label for="ugib">UGIB</label>
                    </div>
                    <div class="col-auto ps-4 pt-2">
                        <input type="radio" id="other" name="Other" value="other">
                        <label for="other">Other</label>
                    </div>
                    <div class="col-2" style="width: 285px;">
                        <input type="text" class="form-control" name="freetextother" placeholder="Enter text here">
                    </div>
                </div>
                <div class="row p-3">
                    <div class="col-12 ps-5">
                        <span><b style="font-size: 16px;">Patient's Profile</b></span>
                    </div>

                    <div class="col-1 pt-4" style="padding-left: 86px;">
                        <span><b>HN</b></span>
                    </div>
                    <div class="col-3 pt-3" style="width: 397px; padding-left:37px;">
                        <input type="text" class="form-control" name="HN" placeholder="HN">
                    </div>
                    <div class="col-2"></div>
                    <div class="col-1 pt-4" style="padding-left: 54px;">
                        <span><b>Gender</b></span>
                    </div>
                    <div class="col-auto pt-4">
                        <input type="radio" id="ugib" name="gender" value="Male">
                        <label for="male">Male</label>
                    </div>
                    <div class="col-auto ps-4 pt-4">
                        <input type="radio" id="other" name="gender" value="Female">
                        <label for="female">Female</label>
                    </div>
                    <div class="col-auto ps-4 pt-4">
                        <input type="radio" id="other" name="gender" value="None">
                        <label for="none">Prefer not to say</label>
                    </div>
                </div>
                <div class="row p-2 ps-3">
                    <div class="col-1 pt-2" style="padding-left: 86px;">
                        <span><b>Name</b></span>
                    </div>
                    <div class="col-1 " style=" padding-left: 36px;">
                        <input type="text" class="form-control" name="prefix" placeholder="Prefix">
                    </div>
                    <div class="col-2" style="width: 250px;">
                        <input type="text" class="form-control" name="first name" placeholder="First Name">
                    </div>
                    <div class="col-2" style="width: 250px; ">
                        <input type="text" class="form-control" name="last name" placeholder="Last Name">
                    </div>
                    <div class="col-2 pt-2 " style="padding-left: 97px;">
                        <span><b>Treatment Coverage</b></span>
                    </div>
                    <div class="col-3">
                        <select id="cal_treatment" class="form-select calbook" name="treatment" required>
                            <option value="">Select</option>
                        </select>
                    </div>
                </div>
                <div class="row p-2 ps-3">
                    <div class="col-1 pt-2" style="padding-left: 86px;">
                        <span><b>Date of birth</b></span>
                    </div>
                    <div class="col-1 " style=" padding-left: 36px;">
                        <input type="text" class="form-control" name="date" placeholder="Date">
                    </div>
                    <div class="col-1" style="width:138px;">
                        <input type="text" class="form-control" name="mouth" placeholder="Mouth">
                    </div>
                    <div class="col-1 " style="width:138px;">
                        <input type="text" class="form-control" name="year" placeholder=" Year">
                    </div>
                    <div class="col-1" style="padding-left: 36px; ">
                        <input type="text" class="form-control" name="age" placeholder=" Age">
                    </div>

                    <div class="col-2 pt-2 " style="padding-left: 176px;">
                        <span><b>Admit Date</b></span>
                    </div>

                    <div class="col-2" style="padding-left: 87px; width: 374px;">
                        <input type="text" class="form-control" name="admitdate" placeholder=" Date">
                    </div>
                    <div class="col-1">
                        <input type="text" class="form-control" name="admittime" placeholder=" Time">
                    </div>
                </div>
                <div class="row p-2 ps-3">
                    <div class="col-1 pt-2" style="padding-left: 86px;">
                        <span><b>Location</b></span>
                    </div>
                    <div class="col-2" style=" padding-left: 36px; width: 370px;">
                        <input type="text" class="form-control" name="location" placeholder="Ward">
                    </div>
                </div>
                <div class="row p-2 ps-3">
                    <div class="col-auto pt-2" style="padding-left: 86px;">
                        <span><b>Set Procedure at Date</b></span>
                    </div>
                    <div class="col-2" style=" padding-left: 36px; width: 320px;">
                        <input type="text" class="form-control" name="procedureatdate" placeholder="Date">
                    </div>
                    <div class="col-auto pt-2">
                        <input type="radio" id="ugib" name="gender" value="Male">
                        <label for="morning">Morning</label>
                    </div>
                    <div class="col-auto ps-4 pt-2">
                        <input type="radio" id="other" name="gender" value="Female">
                        <label for="afternoon">Afternoon</label>
                    </div>
                </div>
                <div class=" pt-3" style="border-bottom: 1px solid #E9EBEC;"></div>
                <div class="row">
                    <div class="col-12 ps-5 pt-3">
                        <span><b style="font-size: 16px;">Status Pre-endoscope assessment</b></span>
                    </div>
                </div>
                <div class="row p-2 pt-3 ps-3">
                    <div class="col-auto pt-2" style="padding-left: 86px;">
                        <span><b>Hemodynamic :</b></span>
                    </div>
                    <div class="col-auto pt-2" style="padding-left: 80px;">
                        <input type="checkbox" id="stable" name="hemodynamic[]" value="Stable">
                        <label for="stable">Stable</label>
                    </div>
                    <div class="col-auto pt-2" style="padding-left: 72px;">
                        <input type="checkbox" id="hypotension" name="hemodynamic[]"
                            value="Hypotension/shock required inotropic agent">
                        <label for="hypotension">Hypotension/shock required inotropic agent</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-3 pt-2 " style="padding-left: px; color:#9599AD;">
                        <span>(please stabilized patient or consult endoscopist before transfer)</span>
                    </div>
                </div>
                <div class="row p-2 pt-3 ps-3">
                    <div class="col-auto pt-2" style="padding-left: 86px;">
                        <span><b>Oxygenation :</b></span>
                    </div>
                    <div class="col-auto pt-2 " style="padding-left: 90px;">
                        <input type="checkbox" id="room_air" name="oxygenation[]" value="Room air">
                        <label for="room_air">Room air</label>
                    </div>
                    <div class="col-auto pt-2" style="padding-left: 58px;">
                        <input type="checkbox" id="nasal_canula" name="oxygenation[]" value="Nasal canula">
                        <label for="nasal_canula">Nasal canula</label>
                    </div>
                    <div class="col-auto ps-4 pt-2">
                        <input type="checkbox" id="mask_with_bag" name="oxygenation[]" value="Mask with bag">
                        <label for="mask_with_bag">Mask with bag</label>
                    </div>
                    <div class="col-auto ps-4 pt-2">
                        <input type="checkbox" id="on_hfnc" name="oxygenation[]" value="On HFNC">
                        <label for="on_hfnc">On HFNC</label>
                    </div>
                    <div class="col-auto ps-4 pt-2">
                        <input type="checkbox" id="on_ett" name="oxygenation[]" value="On ETT">
                        <label for="on_ett">On ETT</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-4 pt-2 " style="padding-left: px; color:#9599AD;">
                        <span>(If on mask with bag, HFNC, ETT → please stabilized patient or consult endoscopist before
                            transfer)</span>
                    </div>
                </div>
                <div class="row p-2 pt-3 ps-3">
                    <div class="col-auto pt-2" style="padding-left: 86px;">
                        <span><b>Conscious :</b></span>
                    </div>
                    <div class="col-auto pt-2" style="padding-left:104px;">
                        <input type="checkbox" id="alert" name="conscious[]" value="Alert">
                        <label for="alert">Alert</label>
                    </div>
                    <div class="col-auto pt-2" style="padding-left:84px;">
                        <input type="checkbox" id="not_cooperate" name="conscious[]" value="Not co-operate">
                        <label for="not_cooperate">Not co-operate</label>
                    </div>
                    <div class="col-auto ps-4 pt-2">
                        <input type="checkbox" id="drowsy" name="conscious[]" value="Drowsy">
                        <label for="drowsy">Drowsy</label>
                    </div>
                    <div class="col-auto ps-4 pt-2">
                        <input type="checkbox" id="lethargy_coma" name="conscious[]" value="Lethargy/COMA">
                        <label for="lethargy_coma">Lethargy/COMA</label>
                    </div>
                    <div class="col-auto ps-4 pt-2">
                        <input type="checkbox" id="confused" name="conscious[]" value="Confused">
                        <label for="confused">Confused</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-5 pt-2 " style="padding-left: px; color:#9599AD;">
                        <span>(If not co-operate, drowsy, lethargy, COMA, confused → please stabilized patient or consult
                            endoscopist before transfer)</span>
                    </div>
                </div>
                <div class="row p-2 pt-3 ps-3">
                    <div class="col-1 pt-2" style="padding-left: 86px;">
                        <span><b>Ascites if cirrhosis :</b></span>
                    </div>
                    <div class="col-1 pt-2" style="padding-left:134px;">
                        <input type="checkbox" id="none_unknown_ascites" name="ascites[]" value="None/unknown">
                        <label for="none_unknown_ascites">None/unknown</label>
                    </div>
                    <div class="col-1 pt-2" style="padding-left:126px;">
                        <input type="checkbox" id="minimal_ascites" name="ascites[]" value="Minimal">
                        <label for="minimal_ascites">Minimal</label>
                    </div>
                    <div class="col-1 pt-2" style="padding-left:83px;">
                        <input type="checkbox" id="moderate_large_ascites" name="ascites[]" value="Moderate to large">
                        <label for="moderate_large_ascites">Moderate to large</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-5 pt-2 " style="padding-left: px; color:#9599AD;">
                        <span>(If moderate to large ascites → please paracentesis for release ascites or consult endoscopist
                            before transfer) </span>
                    </div>
                </div>
                <div class="row p-2 pt-3 ps-3">
                    <div class="col-auto pt-2" style="padding-left: 86px;">
                        <span><b>Hepatic encephalopathy <br>
                                if cirrhosis : </b></span>
                    </div>
                    <div class="col-auto pt-2 ps-4">
                        <input type="checkbox" id="none_unknown_hepatic" name="hepatic_encephalopathy[]"
                            value="None/unknown">
                        <label for="none_unknown_hepatic">None/unknown</label>
                    </div>
                    <div class="col-auto ps-4 pt-2">
                        <input type="checkbox" id="minimal_hepatic" name="hepatic_encephalopathy[]" value="Minimal">
                        <label for="minimal_hepatic">Grade1-2</label>
                    </div>
                    <div class="col-auto ps-4 pt-2">
                        <input type="checkbox" id="moderate_large_hepatic" name="hepatic_encephalopathy[]"
                            value="Moderate to large">
                        <label for="moderate_large_hepatic">Grade 3-4</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-5 pt-2 " style="padding-left: px; color:#9599AD;">
                        <span>(If not co-operate, drowsy, lethargy, COMA, confused → please stabilized patient or consult
                            endoscopist before transfer) </span>
                    </div>
                </div>
                <div class="row ps-5 pt-3">
                    <span><b style="font-size: 16px;"> History</b></span>
                </div>
                <div class="row p-2 pt-3 ps-3">
                    <div class="col-2 pt-2" style="padding-left: 86px;">
                        <span><b>Cirrhosis :</b></span>
                    </div>
                    <div class="col-1 pt-2 ps-4">
                        <input type="checkbox" id="cirrhosis_no" name="cirrhosis"
                            value="No">
                        <label for="cirrhosis_no">No</label>
                    </div>
                    <div class="col-1 ps-4 pt-2">
                        <input type="checkbox" id="cirrhosis_yes" name="cirrhosis" value="Yes">
                        <label for="cirrhosis_yes">Yes</label>
                    </div

                </div>
                <div class="row p-2 pt-3 ps-3">
                    <div class="col-2 pt-2" style="padding-left: 86px;">
                        <span><b>Octreotide :</b></span>
                    </div>
                    <div class="col-1 pt-2 ps-4">
                        <input type="checkbox" id="octreotide_no" name="octreotide" value="No">
                        <label for="octreotide_no">No</label>
                    </div>
                    <div class="col-1 ps-4 pt-2">
                        <input type="checkbox" id="octreotide_yes" name="octreotide" value="Yes">
                        <label for="octreotide_yes">Yes</label>
                    </div>
                </div>
                <div class="row p-2 pt-3 ps-3">
                    <div class="col-2 pt-2" style="padding-left: 86px;">
                        <span><b>PPI :</b></span>
                    </div>
                    <div class="col-1 pt-2 ps-4">
                        <input type="checkbox" id="ppi_no" name="ppi" value="No">
                        <label for="ppi_no">No</label>
                    </div>
                    <div class="col-1 ps-4 pt-2">
                        <input type="checkbox" id="ppi_yes" name="ppi" value="Yes">
                        <label for="ppi_yes">Yes</label>
                    </div>
                </div>
                <div class="row p-2 pt-3 ps-3">
                    <div class="col-2 pt-2" style="padding-left: 86px;">
                        <span><b>Underlying disease :</b></span>
                    </div>
                    <div class="col-1 pt-2 ps-4">
                        <input type="checkbox" id="underlying_disease_no" name="underlying_disease" value="No">
                        <label for="underlying_disease_no">No</label>
                    </div>
                    <div class="col-1 ps-4 pt-2">
                        <input type="checkbox" id="underlying_disease_yes" name="underlying_disease" value="Yes">
                        <label for="underlying_disease_yes">Yes</label>
                    </div>
                </div>
                <div class="row p-2 pt-3 ps-3">
                    <div class="col-2 pt-2" style="padding-left: 86px;">
                        <span><b>NSAID/Herbal :</b></span>
                    </div>
                    <div class="col-1 pt-2 ps-4">
                        <input type="checkbox" id="nsaid_herbal_no" name="nsaid_herbal" value="No">
                        <label for="nsaid_herbal_no">No</label>
                    </div>
                    <div class="col-1 ps-4 pt-2">
                        <input type="checkbox" id="nsaid_herbal_yes" name="nsaid_herbal" value="Yes">
                        <label for="nsaid_herbal_yes">Yes</label>
                    </div>
                </div>
                <div class="row p-2 pt-3 ps-3">
                    <div class="col-2 pt-2" style="padding-left: 86px;">
                        <span><b>Anti-platelet :</b></span>
                    </div>
                    <div class="col-1 pt-2 ps-4">
                        <input type="checkbox" id="anti_platelet_no" name="anti_platelet" value="No">
                        <label for="anti_platelet_no">No</label>
                    </div>
                    <div class="col-1 ps-4 pt-2">
                        <input type="checkbox" id="anti_platelet_yes" name="anti_platelet" value="Yes">
                        <label for="anti_platelet_yes">Yes</label>
                    </div>
                </div>
                <div class="row p-2 pt-3 ps-3">
                    <div class="col-2 pt-2" style="padding-left: 86px;">
                        <span><b>Beta blocker :</b></span>
                    </div>
                    <div class="col-1 pt-2 ps-4">
                        <input type="checkbox" id="beta_blocker_no" name="beta_blocker" value="No">
                        <label for="beta_blocker_no">No</label>
                    </div>
                    <div class="col-1 ps-4 pt-2">
                        <input type="checkbox" id="beta_blocker_yes" name="beta_blocker" value="Yes">
                        <label for="beta_blocker_yes">Yes</label>
                    </div>
                </div>
                <div class="row p-2 pt-3 ps-3">
                    <div class="col-2 pt-2" style="padding-left: 86px;">
                        <span><b>Alcohol :</b></span>
                    </div>
                    <div class="col-1 pt-2 ps-4">
                        <input type="checkbox" id="beta_blocker_no" name="beta_blocker" value="No">
                        <label for="beta_blocker_no">No</label>
                    </div>
                    <div class="col-1 ps-4 pt-2">
                        <input type="checkbox" id="beta_blocker_yes" name="beta_blocker" value="Yes">
                        <label for="beta_blocker_yes">Yes</label>
                    </div>
                </div>
                <div class="row p-2 pt-3 ps-3">
                    <div class="col-2 pt-2" style="padding-left: 86px;">
                        <span><b>Hx GI Endoscopy :</b></span>
                    </div>
                    <div class="col-1 pt-2 ps-4">
                        <input type="checkbox" id="beta_blocker_no" name="beta_blocker" value="No">
                        <label for="beta_blocker_no">No</label>
                    </div>
                    <div class="col-1 ps-4 pt-2">
                        <input type="checkbox" id="beta_blocker_yes" name="beta_blocker" value="Yes">
                        <label for="beta_blocker_yes">Yes</label>
                    </div>
                </div>
                <div class="row p-2 pt-3 ps-3">
                    <div class="col-2 pt-2" style="padding-left: 86px;">
                        <span><b>PRC before EGD :</b></span>
                    </div>
                    <div class="col-1 pt-2 ps-4">
                        <input type="checkbox" id="beta_blocker_no" name="beta_blocker" value="No">
                        <label for="beta_blocker_no">No</label>
                    </div>
                    <div class="col-1 ps-4 pt-2">
                        <input type="checkbox" id="beta_blocker_yes" name="beta_blocker" value="Yes">
                        <label for="beta_blocker_yes">Yes</label>
                    </div>
                </div>
                <div class="row p-2 pt-3 ps-3">
                    <div class="col-2 pt-2" style="padding-left: 86px;">
                        <span><b>ATB in Cirrhosis :</b></span>
                    </div>
                    <div class="col-1 pt-2 ps-4">
                        <input type="checkbox" id="beta_blocker_no" name="beta_blocker" value="No">
                        <label for="beta_blocker_no">No</label>
                    </div>
                    <div class="col-1 ps-4 pt-2">
                        <input type="checkbox" id="beta_blocker_yes" name="beta_blocker" value="Yes">
                        <label for="beta_blocker_yes">Yes</label>
                    </div>
                </div>
                <div class="row p-2 pt-3 ps-3">
                    <div class="col-2 pt-2" style="padding-left: 86px;">
                        <span><b>Hx Dialysis last 1 week :</b></span>
                    </div>
                    <div class="col-1 pt-2 ps-4">
                        <input type="checkbox" id="beta_blocker_no" name="beta_blocker" value="No">
                        <label for="beta_blocker_no">No</label>
                    </div>
                    <div class="col-1 ps-4 pt-2">
                        <input type="checkbox" id="beta_blocker_yes" name="beta_blocker" value="Yes">
                        <label for="beta_blocker_yes">Yes</label>
                    </div>
                </div>

                <div class="row ps-5 pt-4">
                    <span><b style="font-size: 16px;"> Physical Examination(แรกรับที่ ER)</b></span>
                </div>
                <div class="row p-2 ps-3">
                    <div class="col-1 pt-2" style="padding-left: 86px;">
                        <span><b>BP</b></span>
                    </div>
                    <div class="col-2" style=" padding-left: 36px; width: 370px;">
                        <input type="text" class="form-control" name="bp" placeholder="">
                    </div>
                    <div class="col-2 pt-2">
                        <span>mmHg</span>
                    </div>

                    <div class="col-1 pt-2">
                        <span><b>Hx of Shock</b></span>
                    </div>
                    <div class="col-1 pt-2 ps-4">
                        <input type="checkbox" id="beta_blocker_no" name="Hx of Shock" value="No">
                        <label for="beta_blocker_no">No</label>
                    </div>
                    <div class="col-1 ps-4 pt-2">
                        <input type="checkbox" id="beta_blocker_yes" name="Hx of Shock" value="Yes">
                        <label for="beta_blocker_yes">Yes</label>
                    </div>
                </div>
                <div class="row p-2 ps-3">
                    <div class="col-1 pt-2" style="padding-left: 86px;">
                        <span><b>HR</b></span>
                    </div>
                    <div class="col-2" style=" padding-left: 36px; width: 370px;">
                        <input type="text" class="form-control" name="hr" placeholder="">
                    </div>
                    <div class="col-2 pt-2">
                        <span>/min</span>
                    </div>

                    <div class="col-1 pt-2">
                        <span><b>O2 Sat</b></span>
                    </div>
                    <div class="col-2">
                        <input type="text" class="form-control" name="o2sat" placeholder="">
                    </div>
                    <div class="col-2 pt-2">
                        <span>%</span>
                    </div>
                </div>
                <div class="row pt-2">
                    <div class="col-auto pt-1" style="padding-left: 103px;">
                        Sign of Chronic liver disease/portal hypertension
                    </div>
                    <div class="col-1 pt-2 ps-4">
                        <input type="checkbox" id="beta_blocker_no" name="Hx of Shock" value="No">
                        <label for="beta_blocker_no">No</label>
                    </div>
                    <div class="col-1 ps-4 pt-2">
                        <input type="checkbox" id="beta_blocker_yes" name="Hx of Shock" value="Yes">
                        <label for="beta_blocker_yes">Yes</label>
                    </div>

                </div>
                <div class="row ps-5 pt-4">
                    <span><b style="font-size: 16px;">Laboratory</b></span>
                </div>
                <div class="row p-2 ps-3">
                    <div class="col-1 pt-2" style="padding-left: 86px;">
                        <span><b>Hct แรกรับ</b></span>
                    </div>
                    <div class="col-1" style=" padding-left: 36px; width: 370px;">
                        <input type="text" class="form-control" name="hctแรก" placeholder="">
                    </div>
                    <div class="col-2 pt-2">
                        <span>%</span>
                    </div>
                    <div class="col-1 pt-2">
                        <span><b>TB แรกรับ</b></span>
                    </div>
                    <div class="col-2">
                        <input type="text" class="form-control" name="tbแรก" placeholder="">
                    </div>
                    <div class="col-2 pt-2">
                        <span>%</span>
                    </div>
                </div>
                <div class="row p-2 ps-3">
                    <div class="col-1 pt-2" style="padding-left: 86px;">
                        <span><b>Hct baseline</b></span>
                    </div>
                    <div class="col-1" style=" padding-left: 36px; width: 370px;">
                        <input type="text" class="form-control" name="hctbaseline" placeholder="">
                    </div>
                    <div class="col-2 pt-2">
                        <span>%</span>
                    </div>
                    <div class="col-1 pt-2">
                        <span><b>DB แรกรับ</b></span>
                    </div>
                    <div class="col-2">
                        <input type="text" class="form-control" name="dbแรก" placeholder="">
                    </div>
                    <div class="col-2 pt-2">
                        <span>%</span>
                    </div>
                </div>
                <div class="row p-2 ps-3">
                    <div class="col-1 pt-2" style="padding-left: 86px;">
                        <span><b>Hct ล่าสุด</b></span>
                    </div>
                    <div class="col-1" style=" padding-left: 36px; width: 370px;">
                        <input type="text" class="form-control" name="hctล่าสุด" placeholder="">
                    </div>
                    <div class="col-2 pt-2">
                        <span>%</span>
                    </div>
                    <div class="col-1 pt-2">
                        <span><b>AST แรกรับ</b></span>
                    </div>
                    <div class="col-2">
                        <input type="text" class="form-control" name="astแรก" placeholder="">
                    </div>
                    <div class="col-2 pt-2">
                        <span>%</span>
                    </div>
                </div>
                <div class="row p-2 ps-3">
                    <div class="col-1 pt-2" style="padding-left: 86px;">
                        <span><b>Plt แรกรับ</b></span>
                    </div>
                    <div class="col-1" style=" padding-left: 36px; width: 370px;">
                        <input type="text" class="form-control" name="pltแรก" placeholder="">
                    </div>
                    <div class="col-2 pt-2">
                        <span>%</span>
                    </div>
                    <div class="col-1 pt-2">
                        <span><b>ALT แรกรับ</b></span>
                    </div>
                    <div class="col-2">
                        <input type="text" class="form-control" name="altแรก" placeholder="">
                    </div>
                    <div class="col-2 pt-2">
                        <span>%</span>
                    </div>
                </div>
                <div class="row p-2 ps-3">
                    <div class="col-1 pt-2" style="padding-left: 86px;">
                        <span><b>Plt ล่าสุด</b></span>
                    </div>
                    <div class="col-1" style=" padding-left: 36px; width: 370px;">
                        <input type="text" class="form-control" name="pltล่าสุด" placeholder="">
                    </div>
                    <div class="col-2 pt-2">
                        <span>%</span>
                    </div>
                    <div class="col-1 pt-2">
                        <span><b>ALT แรกรับ</b></span>
                    </div>
                    <div class="col-2">
                        <input type="text" class="form-control" name="altแรก" placeholder="">
                    </div>
                    <div class="col-2 pt-2">
                        <span>%</span>
                    </div>
                </div>
                <div class="row p-2 ps-3">
                    <div class="col-1 pt-2" style="padding-left: 86px;">
                        <span><b>INR แรกรับ</b></span>
                    </div>
                    <div class="col-1" style=" padding-left: 36px; width: 370px;">
                        <input type="text" class="form-control" name="inrแรก" placeholder="">
                    </div>
                    <div class="col-2 pt-2">
                        <span>%</span>
                    </div>
                    <div class="col-1 pt-2">
                        <span><b>BUN แรกรับ</b></span>
                    </div>
                    <div class="col-2">
                        <input type="text" class="form-control" name="bunแรก" placeholder="">
                    </div>
                    <div class="col-2 pt-2">
                        <span>%</span>
                    </div>
                </div>
                <div class="row p-2 ps-3">
                    <div class="col-1 pt-2" style="padding-left: 86px;">
                        <span><b>INR ล่าสุด</b></span>
                    </div>
                    <div class="col-1" style=" padding-left: 36px; width: 370px;">
                        <input type="text" class="form-control" name="inrล่าสุด" placeholder="">
                    </div>
                    <div class="col-2 pt-2">
                        <span>%</span>
                    </div>
                    <div class="col-1 pt-2">
                        <span><b>Cr แรกรับ</b></span>
                    </div>
                    <div class="col-2">
                        <input type="text" class="form-control" name="crแรก" placeholder="">
                    </div>
                    <div class="col-2 pt-2">
                        <span>%</span>
                    </div>
                </div>
                <div class="row p-2 ps-3">
                    <div class="col-1 pt-2" style="padding-left: 86px;">
                        <span><b>Alb แรกรับ</b></span>
                    </div>
                    <div class="col-1" style=" padding-left: 36px; width: 370px;">
                        <input type="text" class="form-control" name="albแรก" placeholder="">
                    </div>
                    <div class="col-2 pt-2">
                        <span>%</span>
                    </div>
                    <div class="col-1 pt-2">
                        <span><b>Na แรกรับ</b></span>
                    </div>
                    <div class="col-2">
                        <input type="text" class="form-control" name="naแรก" placeholder="">
                    </div>
                    <div class="col-2 pt-2">
                        <span>%</span>
                    </div>
                </div>
                <div class="row ps-5 pt-4">
                    <span><b style="font-size: 16px;"> Indication for Endoscopy</b></span>
                </div>
                <div class="row pt-4">
                    <div class="col-2 " style="margin-left: 86px;">
                        <input type="checkbox" id="hematemesis" name="hematemesis" value="hematemesis">
                        <label for="underlying_disease_no" class="ps-3">Hematemesis</label>
                    </div>
                    <div class="col-2">
                        <input type="checkbox" id="passed" name="passed" value="passed">
                        <label for="passed" class="ps-3">Passed melena</label>
                    </div>
                    <div class="col-2">
                        <input type="checkbox" id="NG" name="NG" value="NG">
                        <label for="NG" class="ps-3">NG coffee ground</label>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-2 " style="margin-left: 86px;">
                        <input type="checkbox" id="maroon" name="maroon" value="maroon">
                        <label for="maroon" class="ps-3">Passed maroon stool</label>
                    </div>
                    <div class="col-2">
                        <input type="checkbox" id="hematochezia" name="hematochezia" value="hematochezia">
                        <label for="hematochezia" class="ps-3"> Hematochezia</label>
                    </div>
                    <div class="col-2">
                        <input type="checkbox" id="anemia" name="anemia" value="anemia">
                        <label for="anemia" class="ps-3">Anemia</label>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-2 " style="margin-left: 86px;">
                        <input type="checkbox" id="bloodloss" name="bloodloss" value="bloodloss">
                        <label for="bloodloss" class="ps-3">Hypotension/shock from blood loss</label>
                    </div>
                    <div class="col-2">
                        <input type="checkbox" id="abdominalpain" name="abdominalpain" value="abdominalpain">
                        <label for="abdominalpain" class="ps-3"> Abdominal pain</label>
                    </div>
                    <div class="col-2">
                        <input type="checkbox" id="dysphagia" name="dysphagia" value="dysphagia">
                        <label for="dysphagia" class="ps-3">Dysphagia</label>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-2 " style="margin-left: 86px;">
                        <input type="checkbox" id="dyspepsia" name="dyspepsia" value="dyspepsia">
                        <label for="dyspepsia" class="ps-3">Dyspepsia</label>
                    </div>
                    <div class="col-2">
                        <input type="checkbox" id="abdominalmass" name="abdominalmass" value="abdominalmass">
                        <label for="abdominalmass" class="ps-3"> Abdominal mass</label>
                    </div>
                    <div class="col-2">
                        <input type="checkbox" id="CBD" name="CBD" value="CBD">
                        <label for="CBD" class="ps-3"> CBD stone</label>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-2 " style="margin-left: 86px;">
                        <input type="checkbox" id="CBDcholangitis" name="CBDcholangitis" value="CBDcholangitis">
                        <label for="CBDcholangitis" class="ps-3">CBD stone with Cholangitis</label>
                    </div>
                </div>
                <div class="row ps-5 pt-4">
                    <span><b style="font-size: 16px;">Other Remark</b></span>
                </div>
                <div class="row pt-3 pb-4">
                    <div class="col-5" style="margin-left: 78px;">
                        <textarea class="form-control" name="other_remark" rows="7" placeholder="Enter your remarks here"></textarea>
                    </div>
                </div>
                <div class="row ps-5 pt-2 pb-4">
                    <div class="col-10"></div>
                    <div class="col-1" style="margin-left: 100px;">
                    <button type="button" class="btn btn-primary w-lg btn-label waves-effect right waves-light"><i
                            class="ri-check-double-line label-icon align-middle fs-16 ms-2"></i> Confirm</button>
                        </div>
                </div>


            </div>
        </div>
    </div>


@endsection


@section('script')
    <script src="{{ url('public/assets5/js/pages/invoicedetails.js') }}"></script>
@endsection
