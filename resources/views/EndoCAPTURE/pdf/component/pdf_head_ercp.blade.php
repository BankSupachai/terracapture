<style>

</style>
@php
    use App\models\Mongo;
    $user_list = [];
    $attentdant = [];
    if (isset($casedata->user_in_case)) {
        $arr = [];
        foreach ($casedata->user_in_case as $data) {
            $arr[] = (int) $data;
        }
        $user_list = Mongo::table('users')
            ->whereIn('id', $arr)
            ->get();

        foreach ($user_list as $data) {
            $attentdant[] = $data['user_prefix'] . $data['user_firstname'] . ' ' . $data['user_lastname'];
        }
    }
    $no_doctor = true;
    $no_nurse = true;
    $no_anes = true;
@endphp

{{-- <div style="z-index: 1;" > --}}

    <table width="100%" class="head02" style="line-height: 8px;" >
        <tr class="casetitle-small" width="30%">
            <td width="20%"> ENDOSCOPIST</td>
            <td width="20%">CONSULTANT</td>
            <td width="20%">ATTENDENT</td>
            <td width="20%">
                <span class="casetextdent-small"> {{ @$attentdant[2] }}</span>
            </td>
            <td width="20%">

                <span class="casetextdent-small"> {{ @$attentdant[5] }}</span>
            </td>
        </tr>
        <tr class="casetextdent-small" width="40%" style="line-height: 8px;">

            <td width="20%"> {{ @$casedata->doctorname }}</td>
            {{-- @dd($casedata); --}}
        <td width="20%" style="line-height: 8px;">
            @if (isset($casedata->consultantname))
            @foreach ($casedata->consultantname as $data)
                 {{ $data }}<br>
            @endforeach
            @else
                N/A

            @endif
            </td>
            <td>

                {{ @$attentdant[0] }} <br>
                {{ @$attentdant[1] }}

            </td>
            <td>

                {{ @$attentdant[3] }}
                {{ @$attentdant[4] }}

            </td>
            <td>

                {{ @$attentdant[6] }} <br>
                {{ @$attentdant[7] }}

            </td>
        </tr>

    </table>

    {{-- @dd($casedata->user_in_case); --}}

    {{-- <table align="center" width="100%" border="1" class="head02">
        <tr style="line-height: 8px">
            <td class="text-blue" style="padding-left: 2em; width:200px">
                @isset($procedureJSON->pdf->head->title->physician)
                    <span class="casetitle-small">{{ $procedureJSON->pdf->head->title->physician }}</span>
                @else
                    <span class="casetitle-small">ENDOSCOPIST </span>
                @endisset
            </td>

            <td class="text-blue">
                <span class="casetitle-small">CONSULTANT</span>
            </td>
            <td class="text-blue">
                @foreach ($casedata->consultantname as $data)
                  <br> {{$data}}
                @endforeach

            </td>
            <td class="text-blue">
                <span class="casetitle-small">ANES TEAM.</span>
            </td>
        </tr>
        <tr style="line-height: 10px">
            <td
                <font color="#48494b" class="pdfhead">
                    {{ @$casedata->doctorname }}
                </font>
            </td>
            <td>

                <font color="#48494b" class="pdfhead" style="line-height: 0.6em">
                    @php

                        $user_list = array();
                        if (isset($casedata->user_in_case)) {
                            $arr = array();
                            foreach ($casedata->user_in_case as $data) {
                                $arr[] = (int) $data;
                            }
                            $user_list = Mongo::table('users')
                                ->whereIn('id', $arr)
                                ->get();
                        }
                        $no_doctor = true;
                        $no_nurse = true;
                        $no_anes = true;
                    @endphp



                    @foreach ($user_list as $user)
                        @php
                            $user = (object) $user;
                        @endphp
                        @if ($user->user_type == 'doctor')
                            {{ $user->user_prefix }}{{ $user->user_firstname }} {{ $user->user_lastname }}<br>
                            @php
                                $no_doctor = false;
                            @endphp
                        @endif
                    @endforeach



                    @if (@$casedata->assistant != '')
                        {!! @$casedata->assistant !!}
                        @php
                            $no_doctor = false;
                        @endphp
                    @endif

                    @if ($no_doctor)
                        N/A
                    @endif
                </font>

            </td>



            <td>

                <font color="#48494b" class="pdfhead" style="line-height: 0.6em">
                    @foreach ($user_list as $user)
                        @php
                            $user = (object) $user;
                        @endphp

                        @if ($user->user_type == 'nurse')
                            {{ $user->user_prefix }}{{ $user->user_firstname }} {{ $user->user_lastname }}<br>
                            @php
                                $no_nurse = false;
                            @endphp
                        @endif
                    @endforeach
                    @if ($no_nurse)
                        N/A
                    @endif
                </font>

            </td>
            <td>

                <font color="#48494b" class="pdfhead" style="line-height: 0.6em">
                    @foreach ($user_list as $user)
                        @php
                            $user = (object) $user;
                        @endphp
                        @if ($user->user_type == 'anesthesia')
                            {{ $user->user_prefix }}{{ $user->user_firstname }} {{ $user->user_lastname }}<br>
                            @php
                                $no_anes = false;
                            @endphp
                        @endif
                    @endforeach


                    @foreach ($user_list as $user)
                        @php
                            $user = (object) $user;
                        @endphp
                        @if ($user->user_type == 'nurse_anes')
                            {{ $user->user_prefix }}{{ $user->user_firstname }} {{ $user->user_lastname }}<br>
                            @php
                                $no_anes = false;
                            @endphp
                        @endif
                    @endforeach

                    @if ($no_anes)
                    N/A
                    @endif
                </font>
            </td>
        </tr>
    </table> --}}
{{-- </div> --}}
