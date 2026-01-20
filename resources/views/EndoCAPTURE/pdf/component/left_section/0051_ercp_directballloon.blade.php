{{-- @if (isset($casedata->direct_ballon_apex)) --}}
    {{-- @dd($casedata); --}}
    <tr style="line-height:5px;">
        <td width="300px;">
            <span class="casetitle-small" style="white-space: nowrap;">DIRECT BALLOON TAMPONADE/COMPRESSION AT APEX : </span>
        </td>
        <td>
            <span class="casetext-small ">
            @if (checknullblank($casedata, 'direct_ballon_apex'))
                @if ($casedata->direct_ballon_apex == 'no')
                    No
                @else
                    {{ @$casedata->direct_ballon_apex }} {{ @$casedata->direct_ballon_apex_select }}
                @endif
                @else
                N/A
            @endif

            @if (checknullblank($casedata,'direct_ballon_apex_other'))
               {{ @$casedata->direct_ballon_apex_other }}
            @endif
            </span>
        </td>


    </tr>
{{-- @endif --}}
