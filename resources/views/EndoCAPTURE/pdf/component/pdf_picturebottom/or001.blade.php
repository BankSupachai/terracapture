<style>
    .page-break {
        page-break-after: always;
    }

    .row{
       position: relative;
    }




</style>
{{-- @dd($showprocedure) --}}
{{-- @include('EndoCAPTURE.pdf.component.left_section.0001_colposcopy01') --}}
            @php
                $image_position = [];
                $x = 0;
                foreach ($photoselect as $p) {
                    if ($x < $num1) {
                        $image_position[$x]['name'] = mePHOTO($casedata->hn, $p['na'],$folderdate);
                        $image_position[$x]['tx'] = $p['tx'];
                        $image_position[$x]['sc'] = $p['sc'];
                    }
                    $x++;
                }
            @endphp




<table border="0" height="600px;" width="100%">
    <tr>
        <td>
            <img src="{{@$image_position[0]['name']}}" width="100%" height="380px" alt="" style="margin-top: 1.5em;">

           <br> {{ @$image_position[0]['sc']}}
            {{ @$image_position[0]['tx']}}
        </td>
        <td> &nbsp;</td>
    </tr>

        <tr>
            <td>
                <img src="{{@$image_position[1]['name']}}" width="100%" height="380px" alt="" style="margin-top: 1.5em;">
                <br>{{ @$image_position[1]['sc']}}
                {{ @$image_position[1]['tx']}}
            </td>
        {{-- <td>
            <img src="{{@$image_position[2]['name']}}" width="320px" height="240px" alt="">
            <br>{{ @$image_position[2]['sc']}}
            {{ @$image_position[2]['tx']}}

        </td>
        <td> &nbsp;</td>
        <td>
            <img src="{{@$image_position[3]['name']}}" width="320px" height="240px" alt="">

            <br>{{ @$image_position[3]['sc']}}
            {{ @$image_position[3]['tx']}}
        </td> --}}

    </tr>


</table>

{{-- @include('EndoCAPTURE.pdf.component.left_section.0001_colposcopy02') --}}


@if(count($photoselect)>4)
    <div class="page-break"></div>
@endif



    @php
    $imagenewpage = [];
    $x = 0;
    foreach ($photoselect as $p) {


        if ($x > 3) {
            $imagenewpage[$x]['name'] = mePHOTO($casedata->hn, $p['na'],$folderdate);
            $imagenewpage[$x]['tx'] = $p['tx'];
            $imagenewpage[$x]['sc'] = $p['sc'];
        }


        $x++;
    }
    @endphp



    {{-- {!! tablefixnumberstart(2, $imagenewpage, "width='320px' height='240px'", 5)  !!} --}}
    {!! tablefixnumberstart(2, $imagenewpage, "width='100%' height='320px'", 5)  !!}


