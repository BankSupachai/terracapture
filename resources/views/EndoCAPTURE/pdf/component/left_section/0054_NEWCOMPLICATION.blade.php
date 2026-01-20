<style>
    .lh-custom{line-height: 10px !important;}

    .lh_head{line-height: 10px !important;}
</style>
<tr class="lh_head ">
    <td colspan="2">
        <span class="casetitle">COMPLICATION :</span>
        <span class="casetext">
            @php
            $nonecheck_complication = 0;
            $noneother_complication = 0;
        @endphp
             @if (checknullblank($casedata, 'perforation_at_other'))
             @if (@$casedata->perforation_at_other != '')
                 Perforation at {{ @$casedata->perforation_at_other }}
                 @if (@$casedata->managecomplication0)
                        Manage With {{ @$casedata->managecomplication0 }}
                 @endif
                 @php
                     $nonecheck_complication++;
                 @endphp
             @endif

         @endif
         {{-- @dd($casedata->bleeding_at_other , $casedata->managecomplication1) --}}
         @if (checknullblank($casedata, 'bleeding_at_other'))
             Bleeding at {{ @$casedata->bleeding_at_other }}
             @if (@$casedata->managecomplication1)
             Manage With {{ @$casedata->managecomplication1 }}
      @endif
             @php
                 $nonecheck_complication++;
             @endphp
         @endif
         @if (checknullblank($casedata, 'complication_other'))
             {{-- {{ @$casedata->complication_other }} --}}
             @php
                 $noneother_complication++;
             @endphp
         @endif

         @if ($nonecheck_complication == 0 && $noneother_complication == 0)
             N/A
         @endif

            {{@$casedata->complication_other}}
            {{-- @dd($casedata->complication_other); --}}
            @php
            $noneother_complication++;
                @endphp
                   @if ($nonecheck_complication == 0 && $noneother_complication == 0)

               @endif

        </span>
    </td>
</tr>




<tr class="lh_head">
    <td colspan="2">
        <span class="casetitle">ESTIMATE BLOOD LOSS :</span>
        <span class="casetext">
            @if (checknullblank($casedata, 'blood_loss'))
            {{ @$casedata->blood_loss }} ml.
        @else
            N/A
        @endif

        </span>
    </td>
</tr>

<tr class="lh_head">
    <td colspan="2">
        <span class="casetitle">BLOOD TRANSFUSION :</span>
        <span class="casetext">
            @if (checknullblank($casedata, 'blood_transfusion'))
            {{ @$casedata->blood_transfusion }} ml.
            @else
                N/A
            @endif

        </span>

        </span>
    </td>
</tr>



<tr class="lh_head">
    <td colspan="2">
        <span class="casetitle">SPECIMEN :</span>
        <span class="casetext lh-custom">

            @for ($i = 1; $i < 10; $i++)
            @php
                if (!isset($casedata->{"specimen$i"})) {
                    continue;
                }
            @endphp

            {{ @$casedata->{"specimen$i"} }} {{ @$casedata->{"specimenbottle$i"} }} Bottle <br>
        @endfor
        </span>


        </span>
    </td>
</tr>



<tr class="lh_head">
    <td colspan="2">
        <span class="casetitle">FOLLOW UP :</span>
        <span class="casetext">
            @if (checknullblank($casedata, 'followup_other'))
            {{ @$casedata->followup_other }} {{ @$casedata->followup_date }} Days
        @else
            N/A
        @endif
        </span>


        </span>
    </td>
</tr>


<tr class="lh_head ">
    <td colspan="2">
        <span class="casetitle">COMMENT :</span>
        <span class="casetext">
            @if (checknullblank($casedata, 'case_comment'))
            {{ @$casedata->case_comment }}
        @else
            N/A
        @endif
        </span>


        </span>
    </td>
</tr>
