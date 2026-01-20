@php
    $mainpart = smalltext($value);
    $text = $case->advance[$mainpart][$num]['text'] ?? [];
    $photo = $case->advance[$mainpart][$num]['photo'] ?? [];
    $checkbox = $case->advance[$mainpart][$num]['checkbox'] ?? [];


    //Component Select
    $type[] = 'Polyp';
    $type[] = 'Mucosal lesion';
    $type[] = 'Diverticulum';
    $type[] = 'Mucosites';
    $type[] = 'Parasite';
    $type[] = 'UIcer';
    $type[] = 'Mass';
    $type[] = 'Submucosal lesion';
    $type[] = 'Anastomosis nodule';
    $type[] = 'Anastomosis stricture';
    $type[] = 'Extraluminal compression';
    $type[] = 'Abnormal W';


    $diagnosis[] = 'Benign';
    $diagnosis[] = 'Malignancy';
    $diagnosis[] = 'Hyperplastic polyp';
    $diagnosis[] = 'Adenomatous polyp';
    $diagnosis[] = 'Sessile Serrated Adenoma';
    $diagnosis[] = 'Traditional Serrated Adenoma';
    $diagnosis[] = 'Malignant non invasive polyp';
    $diagnosis[] = 'Malignant invasive polyp';
    $diagnosis[] = 'Inflammatory polyp';
    $diagnosis[] = 'Pseudopolyp';
    $diagnosis[] = 'Inflammation';
    $diagnosis[] = 'Lipoma';
    $diagnosis[] = 'Radiation proctitis';
    $diagnosis[] = 'AVM';
    $diagnosis[] = 'SRUS';
    //Component Checkbox
    $serratedcharacterofpolyp[] = 'Mucous cap';
    $serratedcharacterofpolyp[] = 'Cloud like surface';
    $serratedcharacterofpolyp[] = 'Type ll-O Pitt';
    $serratedcharacterofpolyp[] = 'Dilated Branch Vessel';

    $morphology[] = '0+lp';
    $morphology[] = '0+ls';
    $morphology[] = '0+lsp';
    $morphology[] = '0+lla';
    $morphology[] = '0+llb';
    $morphology[] = '0+llc';
    $morphology[] = 'lla+lic';
    $morphology[] = 'llc +lla';
    $morphology[] = 'Is+lla';
    $morphology[] = 'LST-NG flat';
    $morphology[] = 'LST-NG PD';
    $morphology[] = 'LST-G uniform';
    $morphology[] = 'LST-G NM';

    $chromo[] = 'NBI';
    $chromo[] = 'iScan';
    $chromo[] = 'FICE';
    $chromo[] = 'Blue laser';
    $chromo[] = 'Indigocarmine';
    $chromo[] = 'Crystal Violet';


    $complication[] = 'None';
    $complication[] = 'Perforatiom';
    // aaaa
    $kudo[] =   'I';
    $kudo[] =   'II';
    $kudo[] =   'IIIL';
    $kudo[] =   'IIIS';
    $kudo[] =   'IV';
    $kudo[] =   'V';


    $sano[] =   'I';
    $sano[] =   'II';
    $sano[] =   'IIIA';
    $sano[] =   'IIIB';


    $nice[] =   'I';
    $nice[] =   'II';
    $nice[] =   'III';


    $jnet[] =   'I';
    $jnet[] =   '2a';
    $jnet[] =   '2b';
    $jnet[] =   'III';


@endphp

<style>
    .bg-green {
        background: #0AB39C1A;
    }

    .form-control {
        background: #ffffff ;
    }
</style>

<div class="row" id="{{$mainpart.$num}}">
    <div class="card bg-green">
        <div class="card-body">
            <div class="row">
                <div class="col-6 fw-bold">
                    Lesion&nbsp;{{ $num }}
                </div>
                <div class="col-6 text-end text-danger lesion_del" lesion="{{$num}}" mainpart="{{$mainpart}}">
                    @if($num!=1)
                        <i class="ri ri-close-fill ri-xl"></i>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    {!!advance_select($mainpart,$num,$text,$type,'Type')!!}
                </div>
                <div class="col-4">
                    {!!advance_select($mainpart,$num,$text,$diagnosis,'Diagnosis')!!}
                </div>
                <div class="col-3">
                    {!!advance_select($mainpart,$num,$text,$morphology,'Morphology Type')!!}
                </div>
                <div class="col-2">
                    {!! advance_text($mainpart, $num,$text, 'Size (cm.)') !!}
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-5">
                    <div class="row">
                        <div class="col-4">
                            {!! advance_text($mainpart, $num,$text, 'Treatment') !!}
                        </div>
                        <div class="col-4">
                            {!! advance_text($mainpart, $num,$text, 'By') !!}
                        </div>
                        <div class="col-4">
                            {!! advance_text($mainpart, $num,$text, 'Clip') !!}
                        </div>
                    </div>
                </div>
                <div class="col-7">
                    <div class="row">
                        <div class="col-3">
                            {!! advance_text($mainpart, $num,$text, 'Patho No.') !!}
                        </div>
                        <div class="col-3">
                            {!! advance_text($mainpart, $num,$text, 'Detect from') !!}
                        </div>
                        <div class="col-6">
                            {!!advance_checkbox($mainpart,$num,$checkbox,$chromo,4,'chromo')!!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-5">
                    <div class="row">
                        <div class="col-4">
                    {{-- {!!advance_select($mainpart,$num,$text,$diagnosis,'Diagnosis')!!} --}}

                            {!! advance_select($mainpart, $num,$text, $kudo, 'Kudo type') !!}
                        </div>
                        <div class="col-4">
                            {!! advance_select($mainpart, $num,$text, $sano, 'Sano type') !!}

                            {{-- {!! advance_text($mainpart, $num,$text, 'Sano type') !!} --}}
                        </div>
                        <div class="col-4">
                            {!! advance_select($mainpart, $num,$text, $nice, 'Nice type') !!}
                        </div>

                    </div>
                </div>

                <div class="col-7">
                    <div class="row">
                        <div class="col-3">
                            {!! advance_select($mainpart, $num,$text,$jnet, 'JNET class') !!}
                        </div>
                        <div class="col-9">
                            {!!advance_select($mainpart,$num,$text,$complication,'Complication')!!}
                        </div>
                    </div>
                </div>
                <div class="col-6 pt-2">
                    {!!advance_checkbox($mainpart,$num,$checkbox,$serratedcharacterofpolyp,3,'Serrated character of Polyp')!!}
                </div>
                <div class="col-6 pt-2">
                    {!! advance_text($mainpart, $num,$text, 'Note') !!}
                </div>
                <div class="row mt-3">

                    @foreach ($photo as $photo_key => $photo_val)
                        <div class="col-2 text-center">
                            <img src="{{ mePHOTO($case->hn, $photo_key, $case->appointment_date) }}?a={{ RandomString() }}"
                                alt="" class="img" height="200px">
                            <input type="text" class="form-control advance_phototext mt-2" placeholder="freetext"
                                value="{{ @$photo_val['text'] }}"
                                mainpart="{{ $mainpart }}"
                                lesion="{{ $num }}"
                                photo="{{ $photo_key }}">
                        </div>
                    @endforeach

                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12 text-end">
                    <a href="{{url("selectphoto/$case->id")}}?mainpart={{$value}}&lesion={{$num}}" class="btn btn-primary ">Select photo</a>
                </div>
            </div>
        </div>
    </div>
</div>
