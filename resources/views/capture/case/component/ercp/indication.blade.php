@php

    /*
GROUP >> TYPE >> sub
*/

    $arr['Ascending Cholangitis']['text'] = 'Ascending Cholangitis';
    $arr['Post-LC bile leakage']['text'] = 'Post-LC bile leakage';
    $arr['Subside cholangitis due to CBD']['text'] = 'Subside cholangitis due to CBD';
    $arr['Multiple CBDS']['text'] = 'Multiple CBDS';
    $arr['Silence CBDS']['text'] = 'Silence CBDS';
    $arr['Difficult CBDS']['text'] = 'Difficult CBDS';
    $arr['IHDS']['text'] = 'IHDS';
    $arr['IHDS']['select'][] = 'Lt.IHD';
    $arr['IHDS']['select'][] = 'Rt.IHD';

    $arr['Acute GS pancreatitis with concomitant cholangitis']['text'] = 'Acute GS pancreatitis with concomitant cholangitis';
    $arr['Hilar cholangiocarcinoma']['text'] = 'Hilar cholangiocarcinoma';
    $arr['Malignant high grade biliary obstruction']['text'] = 'Malignant high grade biliary obstruction';
    $arr['Distal biliary obstruction']['text'] = 'Distal biliary obstruction';


    $arr['Periampullary carcinoma']['text'] = 'Periampullary carcinoma';
    $arr['Periampullary carcinoma']['group'][] = 'Ampulla';
    $arr['Periampullary carcinoma']['group'][] = 'CA head of pancreas';
    $arr['Periampullary carcinoma']['group'][] = '2nd part of duodenum';
    $arr['Periampullary carcinoma']['group'][] = 'Distal CBD Cholangiocarcinoma';

    $arr['Advanced pancreatic cancer']['text'] = 'Advanced pancreatic cancer';
    $arr['Advanced pancreatic cancer']['group'][] = 'Locally advanced';
    $arr['Advanced pancreatic cancer']['group'][] = 'Distance Metastasis';

    $arr['Advanced Gallbladder cancer']['text'] = 'Advanced Gallbladder cancer';
    $arr['Hepatocellular carcinoma']['text'] = 'Hepatocellular carcinoma';

    // --------------------------------
    $arr['Post-LC bile leakage']['text'] = 'Post-LC bile leakage';
    $arr['Post Hepatectomy bile leakage']['text'] = 'Post Hepatectomy bile leakage';
    $arr['CBD injury : Starsberg classification']['text'] = 'CBD injury : Starberg classification';
    $arr['CBD injury : Starsberg classification']['select'][] = 'A';
    $arr['CBD injury : Starsberg classification']['select'][] = 'B';
    $arr['CBD injury : Starsberg classification']['select'][] = 'C';
    $arr['CBD injury : Starsberg classification']['select'][] = 'D';
    $arr['CBD injury : Starsberg classification']['select'][] = 'E1';
    $arr['CBD injury : Starsberg classification']['select'][] = 'E2';
    $arr['CBD injury : Starsberg classification']['select'][] = 'E3';
    $arr['CBD injury : Starsberg classification']['select'][] = 'E4';
    $arr['CBD injury : Starsberg classification']['select'][] = 'E5';

    $arr['Choledochal']['text'] = 'Choledochal';
    $arr['Choledochal']['select'][] = 'cyst';
    $arr['Choledochal']['select'][] = 'APBDJ';
    $arr['Choledochal']['select'][] = 'PBM';

    $arr['Bilio-enteric anastomosis stricture']['text'] = 'Bilio-enteric anastomosis stricture';
    $arr['Bilio-enteric anastomosis stricture']['group'][] = 'Hepaticojejunostomy (HJ)';
    $arr['Bilio-enteric anastomosis stricture']['group'][] = 'Cholangiojejunostomy';
    $arr['Bilio-enteric anastomosis stricture']['group'][] = 'Hepatoduodenostomy (HD)';

    $arr['Traumatic pancreatic injury']['text'] = 'Traumatic pancreatic injury';
    $arr['Chronic pancreatitis with distal CBD stricture']['text'] = 'Chronic pancreatitis with distal CBD stricture';
    $arr['MPD stricture with MPD stone']['text'] = 'MPD stricture with MPD stone';
    $arr['Ampullary adenoma']['text'] = 'Ampullary adenoma';
    $arr['Pre-Operative biliary drainage']['text'] = 'Pre-Operative biliary drainage';
    $arr['Pancreatic divisum']['text'] = 'Pancreatic divisum';
    $arr['Acute calculous cholecystitis']['text'] = 'Acute calculous cholecystitis';
    $arr['Retained cystic duct stone']['text'] = 'Retained cystic duct stone';
    $arr['Recurrent/Retained CBDS']['text'] = 'Recurrent/Retained CBDS';
    ksort($arr);
@endphp


<div class="col-2">
    Indication&nbsp;&nbsp;
</div>
<div class="col-12"></div>


@foreach ($arr as $k1 => $k2)
    @php
        $indicationid = md5($k1);
        $hasgroup = isset($arr[$k1]['group']) ? 'true' : 'false';
        $hasselect = isset($arr[$k1]['select']) ? 'true' : 'false';
    @endphp

    {{-- @dd($case) --}}
    <div class="col-6">
        <div class="row">
            <div class="col-12">
                @php

                    $case_array = (array) $case;
                    // dd($case_array);
                @endphp
                <div class="row">
                    <div class="col-auto">
                        <input id="{{ $indicationid }}" datagroup="indicationGroup" type="checkbox" name=""
                            hasgroup="{{@$hasgroup}}" hasselect="{{@$hasselect}}"
                            group="{{ $k1 }}" class="form-check-input checkboxgroupmain checkboxgroupsave indication-group"
                            value="{{ $k1 }}" {{ checkinarray($case, 'indicationGroup', $k1) }}>
                        <label class="ms-4" for="{{ $indicationid }}">&nbsp;{{ $k1 }}</label>
                    </div>
                    @foreach ($k2 as $k3 => $k4)
                        @if ($k3 == 'select')
                            <div class="col-4">
                                <select data-id="{{ $indicationid }}" name="{{$k1}}_select" subgroup="" class="form-select sel-indication-group savejson_edit">
                                    <option value="">Select</option>
                                    @foreach ($k4 as $k5 => $k6)
                                        <option data-value="{{ $k6 }}" value="{{ $k5 }}" @if(@$case_array[$k1."_select"]."" == $k5) selected  @endif>{{ $k6 }}
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="checkboxgroupsub indication-group" group="{{ $k1 }}"
                style="display: @if (checkinarray($case, 'indicationGroup', $k1) == '') none @endif">
                @foreach ($k2 as $k3 => $k4)
                    @if ($k3 == 'group')
                        @foreach ($k4 as $k5 => $k6)
                            @php
                                $indicationsubid = md5($k1 . $k6);
                            @endphp
                            <div class="col-12">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input id="{{ $indicationsubid }}" datagroup="indicationGroup" type="checkbox"
                                    class="form-check-input checkboxgroupsave indication-group" group="{{ $k1 }}"
                                    value="{{ "$k1 $k6" }}" {{ checkinarray($case, 'indicationGroup', "$k1 $k6") }}>
                                &nbsp;&nbsp;&nbsp;
                                <label class="ms-4" for="{{ $indicationsubid }}">&nbsp;{{ $k6 }}</label>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endforeach
