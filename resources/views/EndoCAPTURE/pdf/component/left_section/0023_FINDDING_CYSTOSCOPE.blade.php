<tr class="lh-6 set-font-family">
    <td colspan="2">
        @if(@$json->prostatic_length!="")
        <br> Prostatic length <span class="findtitle">{{@$json->prostatic_length}}</span> cm.<br>
        @endif

        @if(@$json->prostate_cysto!="" && @$json->obstruction_cysto!="")
        Prostate <span class="findtitle">{{@$json->prostate_cysto}} {{@$json->obstruction_cysto}}<br></span>
        @endif

        @if(@$json->prostate_cysto!="" && @$json->obstruction_cysto=="")
        Prostate <span class="findtitle">{{@$json->prostate_cysto}}</span><br>
        @endif

        @if(@$json->prostate_cysto=="" && @$json->obstruction_cysto!="")
        Prostate <span class="findtitle">{{@$json->obstruction_cysto}}</span><br>
        @endif

        @if(@$json->vc_size_cysto!="")
        VC size <span class="findtitle">{{@$json->vc_size_cysto}}</span> cm.<br>
        @endif

        @if(@$json->intravesical_pressure_cysto!="")
        Intravesical pressure <span class="findtitle">{{@$json->intravesical_pressure_cysto}}</span> cm.H2O<br>
        @endif

        @if(@$json->trabeculac_cysto!="")
        Trabeculac <span class="findtitle">{{@$json->trabeculac_cysto}}</span><br>
        @endif

        @if(@$json->bladder_mass_cysto!="" && @$json->size_cysto!="" && @$json->at_cysto!="")
        Bladder mass <span class="findtitle">{{@$json->bladder_mass_cysto}}</span> size <span class="findtitle">{{@$json->size_cysto}}</span> cm.  at <span class="findtitle">{{@$json->at_cysto}}</span><br>
        @endif

        @if(@$json->bladder_mass_cysto!="" && @$json->size_cysto=="" && @$json->at_cysto=="")
        Bladder mass <span class="findtitle">{{@$json->bladder_mass_cysto}}</span><br>
        @endif

        @if(@$json->bladder_mass_cysto!="" && @$json->size_cysto!="" && @$json->at_cysto=="")
        Bladder mass <span class="findtitle">{{@$json->bladder_mass_cysto}}</span> size <span class="findtitle">{{@$json->size_cysto}}</span> cm.<br>
        @endif

        @if(@$json->bladder_mass_cysto!="" && @$json->size_cysto=="" && @$json->at_cysto!="")
        Bladder mass <span class="findtitle">{{@$json->bladder_mass_cysto}}</span> at <span class="findtitle">{{@$json->at_cysto}}</span><br>
        @endif

        @if(@$json->stricture_urethra_cysto!="" && @$json->length_cysto!="")
        Stricture urethra at <span class="findtitle">{{@$json->stricture_urethra_cysto}}</span> length <span class="findtitle">{{@$json-> length_cysto}}</span> cm.<br>
        @endif

        @if(@$json->stricture_urethra_cysto!="" && @$json->length_cysto=="")
        Stricture urethra at <span class="findtitle">{{@$json->stricture_urethra_cysto}}</span> <br>
        @endif

        @if(@$json->overall_cysto!="")
        Overall finding :<span class="findtitle"><br>{!!@$json->overall_cysto!!}</span>
        @endif
    </td>
</tr>
