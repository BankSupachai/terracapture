
    @php
        $acc        = jsonDecode(@$json->icd9);
        $dino       = jsonDecode(@$json->proicd9);
        $dino_other = jsonDecode(@$json->proicd9_other);
        $proicd9count = 0;
    @endphp


    @php
        foreach($dino as $di => $value){
            $variebletype =  gettype($value);

            if($variebletype=="string"){
                if(@$json->proicd9!=""){
                    $proicd9count++;
                }
            }

            if($variebletype=="object"){
                foreach($value as $v){
                    if($v!=null){
                        $proicd9count++;
                    }
                }
            }
        }
    @endphp


    @if(@$json->proicd9_other!=""
    || $proicd9count>0
    || @$json->overall_procedure!="")
    <span>

    @php
        $dval = "";
        $i=100;
    @endphp

    @if(@$json->proicd9_other!="" || $proicd9count>0)

    @php
        $old="";
    @endphp



    <table>
        @forelse($dino as $di => $value)
            @php
            $variebletype = gettype($value);
            if($variebletype=="object"){
                $i--;
                foreach ($value as $key=>$v) {
                    $table = DB::table('tb_procedureicd9')->where('proicd9_name','=',$old)->first();
                    if($v!=""){
                        $val[$i] = "<tr class='set-font-family'><td style='color:red;'>".$table->icd9."</td><td>&nbsp;&nbsp;&nbsp;</td><td style='color:red;'>".$old." ".$v." ".$table->extra_text."</td></tr>";
                    }
                }
                $i++;
            }else{
                if($value!=""){
                    $table = DB::table('tb_procedureicd9')->where('proicd9_name','=',$value)->first();
                    $val[$i] = "<tr class='set-font-family'><td style='color:red;'>".$table->icd9."</td><td>&nbsp;&nbsp;&nbsp;</td><td style='color:red;'>".$value."</td></tr>";
                    $old = $value;
                    $i++;
                }
            }
            @endphp
        @empty

        @endforelse


        @if(isset($val))
            @forelse($val as $v)
                {!!$v!!}
            @empty
            @endforelse
        @endif


        @forelse($dino_other as $di)
            @if($di!="")

                <tr><td></td><td>&nbsp;&nbsp;&nbsp;</td><td>{{$di}}</td></tr>

            @endif
        @empty
        @endforelse

        @foreach ($acc as $a)
            @if($a!="")
                @php
                $icd = explode("     ", $a);
                @endphp
                <tr class="set-font-family">
                <td valign="top">{{$icd[0]}}</td><td>&nbsp;&nbsp;&nbsp;</td>
                <td>{{$icd[1]}}</td>
                </tr>
            @endif
        @endforeach
        </table>
        @endif


    </span>






    @else


    @php
        $acc        = jsonDecode(@$json->icd9);
        $dino       = jsonDecode(@$json->proicd9);
        $dino_other = jsonDecode(@$json->proicd9_other);
        $proicd9count = 0;
    @endphp


    @php
        foreach($dino as $di => $value){
            $variebletype =  gettype($value);

            if($variebletype=="string"){
                if(@$json->proicd9!=""){
                    $proicd9count++;
                }
            }

            if($variebletype=="object"){
                foreach($value as $v){
                    if($v!=null){
                        $proicd9count++;
                    }
                }
            }
        }
    @endphp


    @if(@$json->proicd9_other!=""
    || $proicd9count>0
    || @$json->overall_procedure!="")
    <span>

    @php
        $dval = "";
        $i=100;
    @endphp

    @if(@$json->proicd9_other!="" || $proicd9count>0)


    <table>
        @forelse($dino as $di => $value)
            @php
            $variebletype = gettype($value);
            if($variebletype=="object"){
                $i--;
                foreach ($value as $key=>$v) {
                    $table = DB::table('tb_procedureicd9')->where('proicd9_name','=',$old)->first();
                    if($v!=""){
                        $val[$i] = "<tr class='set-font-family'><td>".$table->icd9."</td><td>&nbsp;&nbsp;&nbsp;</td><td>".$old." ".$v." ".$table->extra_text."</td></tr>";
                    }
                }
                $i++;
            }else{
                if($value!=""){
                    $table = DB::table('tb_procedureicd9')->where('proicd9_name','=',$value)->first();
                    $val[$i] = "<tr class='set-font-family'><td>".$table->icd9."</td><td>&nbsp;&nbsp;&nbsp;</td><td>".$value."</td></tr>";
                    $old = $value;
                    $i++;
                }
            }
            @endphp
        @empty

        @endforelse


        @if(isset($val))
            @forelse($val as $v)
                {!!$v!!}
            @empty
            @endforelse
        @endif


        @forelse($dino_other as $di)
            @if($di!="")

                <tr class="set-font-family"><td></td><td>&nbsp;&nbsp;&nbsp;</td><td>{{$di}}</td></tr>

            @endif
        @empty
        @endforelse

        @foreach ($acc as $a)
            @if($a!="")
                @php
                $icd = explode("     ", $a);
                @endphp
                <tr class="set-font-family">
                <td valign="top">{{$icd[0]}}</td><td>&nbsp;&nbsp;&nbsp;</td>
                <td>{{$icd[1]}}</td>
                </tr>
            @endif
        @endforeach
        </table>
        @endif


    </span>

        <span>{!!@@$json->overall_procedure!!}</span>
        @else
            None
        @endif






        <br>
        @if(@$json->Bronchial_Washing_site!="")
        <span class="icd10text">Bronchial Washing site   :</span>
            {{@$json->Bronchial_Washing_site}}<br>
        @endif

        @if(@$json->Bronchoalveolar_Lavage_site!="")
        <span class="icd10text">Bronchoalveolar Lavage site   :</span>
            {{@$json->Bronchoalveolar_Lavage_site}}<br>
                [
                    @if(@$json->Instilled_volume!="")
                    <span class="icd10text">Instilled vol.  :</span>{{@$json->Instilled_volume}}
                    @endif

                    @if(@$json->Retrived_volume!="")
                    <span class="icd10text">Retrived vol.   :</span>{{@$json->Retrived_volume}}
                    @endif

                    @if(@$json->AM!="")
                    <span class="icd10text">AM   :</span>{{@$json->AM}}%
                    @endif

                    @if(@$json->N!="")
                    <span class="icd10text">N   :</span>{{@$json->N}}%
                    @endif

                    @if(@$json->L!="")
                    <span class="icd10text">L   :</span>{{@$json->L}}%
                    @endif

                    @if(@$json->E!="")
                    <span class="icd10text">E   :</span>{{@$json->E}}%
                    @endif
                ]<br>
        @endif


        @if(@$json->Bronchial_Biopsy_site!="" && @$json->Bronchial_Biopsy_site!=null)
        <span class="icd10text">Bronchial Biopsy site   :</span>
            {{@$json->Bronchial_Biopsy_site}}<br>
        @endif

        @if(@$json->Transbronchial_lung_Biopsy_site!="" && @$json->Transbronchial_lung_Biopsy_site!=null)
        <span class="icd10text">Transbronchial lung Biopsy site   :</span>
            {{@$json->Transbronchial_lung_Biopsy_site}}<br>
        @endif

        @if(@$json->Transbronchial_Needle_Aspiration_for_Cytology_site!="" && @$json->Transbronchial_Needle_Aspiration_for_Cytology_site!=null)
        <span class="icd10text">TBNA for Cytology site   :</span>
            {{@$json->Transbronchial_Needle_Aspiration_for_Cytology_site}}<br>
        @endif

        @if(@$json->Transbronchial_Needle_Aspiration_for_Histology_site!="" && @$json->Transbronchial_Needle_Aspiration_for_Histology_site!=null)
        <span class="icd10text">TBNA for Histology site   :</span>
            {{@$json->Transbronchial_Needle_Aspiration_for_Histology_site}}<br>
        @endif

        @if(@$json->Bronchial_Brushing_site!="" && @$json->Bronchial_Brushing_site!=null)
        <span class="icd10text">Bronchial Brushing site   :</span>
            {{@$json->Bronchial_Brushing_site}}<br>
        @endif

        @if(@$json->Laser_Bronchoscopy_energy!="" && @$json->Laser_Bronchoscopy_energy!=null)
        <span class="icd10text">Laser Bronchoscopy energy   :</span>
            {{@$json->Laser_Bronchoscopy_energy}}<br>
        @endif

@endif


        @if(@$json->ebus_box=="true"||
            @$json->ebus!=""||
            @$json->distance_ebus!=""||
            @$json->time_ebus!="")<br>
            {!!box2text(@$json->ebus_box,'<font color="red">EBUS</font>')!!}
            {!!text2print('',@$json->ebus,'')!!}
            {!!text2print('|&nbsp;<font color="red">Distance&nbsp;</font>',@$json->distance_ebus,'<font color="red">&nbsp;cm.</font>')!!}
            {!!text2print('|&nbsp;<font color="red">Time&nbsp;</font>',@$json->time_ebus,'<font color="red">&nbsp;min.</font>')!!}
        @endif

        @if(@$json->ebus_guide_sheath_box=="true"||
            @$json->ebus_guide_sheath!=""||
            @$json->time_ebus_guide_sheath!="")<br>
            {!!box2text(@$json->ebus_guide_sheath_box,'<font color="red">EBUS guide-sheath</font>')!!}
            {!!text2print('',@$json->ebus_guide_sheath,'')!!}
            {!!text2print('|&nbsp;<font color="red">Time&nbsp;&nbsp;</font>',@$json->time_ebus_guide_sheath,'<font color="red">&nbsp;&nbsp;min.</font>')!!}
        @endif

        @if(@$json->fluoroscopy_box=="true")
        {{-- @dd($json->fluoroscopy_box) --}}
            <br><span class="icd10text">{{box2text(@$json->fluoroscopy_box,'Fluoroscopy')}}</span>
        @endif

        @if(@$json->autofluoresence_box=="true"||
            @$json->negative_autoflu_box=="true"||
            @$json->positive_autoflu_box=="true"||
            @$json->positive_autoflu!="")<br>
            {!!box2text(@$json->autofluoresence_box,'<font color="red">Autofluoresence &nbsp;&nbsp;</font>')!!}
            {!!box2text(@$json->negative_autoflu_box,'|&nbsp;<font color="red">Negative &nbsp;&nbsp;</font>')!!}
            {!!box2text(@$json->positive_autoflu_box,'|&nbsp;<font color="red">Positive at &nbsp;&nbsp;</font>')!!}
            {!!text2print('',@$json->positive_autoflu,'')!!}
        @endif

        @if(@$json->virtual_bronchoscopy_box=="true"||
        @$json->Generation_by_CT_navigation!=""||
        @$json->Generation_by_bronchoscopy!="")<br>
            {!!box2text(@$json->virtual_bronchoscopy_box,'<font color="red">Virtual bronchoscopy</font>')!!}
            {!!text2print('|&nbsp;<font color="red">Generation by CT navigation &nbsp;&nbsp;</font>',@$json->Generation_by_CT_navigation,'&nbsp;&nbsp;')!!}
            {!!text2print('|&nbsp;<font color="red">Generation by bronchoscopy &nbsp;&nbsp;</font>',@$json->Generation_by_bronchoscopy,'&nbsp;&nbsp;')!!}
        @endif


        @if(@$json->Bronchial_Washing_site_box=="true"||
            @$json->Bronchial_Washing_site!="")<br>
            {!!box2text(@$json->Bronchial_Washing_site_box,'<font color="red">Bronchial Washing at</font>')!!}
            {!!text2print('',@$json->Bronchial_Washing_site,'')!!}
        @endif


        @if(@$json->Bronchoalveolar_Lavage_site_box=="true"||
            @$json->Bronchoalveolar_Lavage_site!=""||
            @$json->Bronchoalveolar_segment!="")<br>
            {!!box2text(@$json->Bronchoalveolar_Lavage_site_box,'<font color="red">Bronchoalveolar Lavage at</font>')!!}
            {!!text2print('',@$json->Bronchoalveolar_Lavage_site,'')!!}
            {!!text2print('|&nbsp;<font color="red">Segment&nbsp;&nbsp;</font>',@$json->Bronchoalveolar_segment,'')!!}
        @endif


        @if(@$json->Instilled_volume!=""||
            @$json->Retrived_volume!=""||
            @$json->Bronchoalveolar_appearance!="")<br>
            {!!text2print('|&nbsp;<font color="red">Instilled volume&nbsp;&nbsp;</font>',@$json->Instilled_volume,'<font color="red">&nbsp;ml.</font>')!!}
            {!!text2print('|&nbsp;<font color="red">Retrived volume&nbsp;&nbsp;</font>',@$json->Retrived_volume,'<font color="red">&nbsp;ml.</font>')!!}
            {!!text2print('|&nbsp;<font color="red">Appearance&nbsp;&nbsp;</font>',@$json->Bronchoalveolar_appearance,'')!!}
        @endif

        @if(@$json->cell_count_and_differential_count_box=="true"||
            @$json->hemosiderin_score_box=="true")<br>
            {!!box2text(@$json->cell_count_and_differential_count_box,'|&nbsp;<font color="red">Cell count and differential count</font>')!!}
            {!!box2text(@$json->hemosiderin_score_box,'|&nbsp;<font color="red">Hemosiderin score</font>')!!}
        @endif

        @if(@$json->grams_stain_and_culture_for_bacteria_box=="true"||
            @$json->modified_afb_box=="true"||
            @$json->afb_profile1_box=="true"||
            @$json->culture_for_tb_box=="true")<br>
            {!!box2text(@$json->grams_stain_and_culture_for_bacteria_box,'|&nbsp;<font color="red">Grams stain and culture for bacteria</font>')!!}
            {!!box2text(@$json->modified_afb_box,'|&nbsp;<font color="red">Modified AFB</font>')!!}
            {!!box2text(@$json->afb_profile1_box,'|&nbsp;<font color="red">AFB (Profile 1)</font>')!!}
            {!!box2text(@$json->culture_for_tb_box,'|&nbsp;<font color="red">Culture for TB</font>')!!}
        @endif

        @if(@$json->stain_and_culture_for_fungus_box=="true"||
            @$json->giemsa_stain_box=="true"||
            @$json->gms_stain_box=="true"||
            @$json->ifa_for_pcp_box=="true")
            {!!box2text(@$json->stain_and_culture_for_fungus_box,'|&nbsp;<font color="red">Stain and culture for fungus</font>')!!}
            {!!box2text(@$json->giemsa_stain_box,'|&nbsp;<font color="red">Giemsa stain</font>')!!}
            {!!box2text(@$json->gms_stain_box,'|&nbsp;<font color="red">GMS stain</font>')!!}
            {!!box2text(@$json->ifa_for_pcp_box,'|&nbsp;<font color="red">IFA for PCP</font>')!!}
        @endif

        @if(@$json->cmv_antigen_box=="true"||
            @$json->cmv_dna_detection_box=="true"||
            @$json->cmv_isolation_box=="true"||
            @$json->influenza_box=="true")
            {!!box2text(@$json->cmv_antigen_box,'|&nbsp;<font color="red">CMV antigen</font>')!!}
            {!!box2text(@$json->cmv_dna_detection_box,'|&nbsp;<font color="red">CMV DNA detection</font>')!!}
            {!!box2text(@$json->cmv_isolation_box,'|&nbsp;<font color="red">CMV isolation</font>')!!}
            {!!box2text(@$json->influenza_box,'|&nbsp;<font color="red">Influenza</font>')!!}
        @endif

        @if(@$json->HSV_box=="true"||
            @$json->Cytology_box=="true"||
            @$json->PCR_TB_box=="true"||
            @$json->Other_hsv_box=="true"||
            @$json->Other_hsv!="")<br>
            {!!box2text(@$json->HSV_box,'|&nbsp;<font color="red">HSV</font>')!!}
            {!!box2text(@$json->Cytology_box,'|&nbsp;<font color="red">Cytology</font>')!!}
            {!!box2text(@$json->PCR_TB_box,'|&nbsp;<font color="red">PCR TB</font>')!!}
            {!!box2text(@$json->Other_hsv_box,'|&nbsp;<font color="red">Other</font>')!!}
            {!!text2print('',@$json->Other_hsv,'')!!}
        @endif

        @if(@$json->TBLB_box=="true"||
            @$json->TBLB!=""||
            @$json->TBLB_segment!="")<br>
            {!!box2text(@$json->TBLB_box,'<font color="red">TBLB at</font>')!!}
            {!!text2print('',@$json->TBLB,'')!!}
            {!!text2print('|&nbsp;<font color="red">Segment</font> ',@$json->TBLB_segment,'')!!}
        @endif

        @if(@$json->Histopathology_TBLB_box=="true"||
            @$json->Tissue_culture_for_bacteria_TBLB_box=="true"||
            @$json->Mycobacteria_Profile1_TBLB_box=="true"||
            @$json->Mycobacteria_Profile2_TBLB_box=="true"||
            @$json->Tissue_culture_for_fungus_TBLB_box=="true")<br>
            {!!box2text(@$json->Histopathology_TBLB_box,'|&nbsp;<font color="red">Histopathology</font>')!!}
            {!!box2text(@$json->Tissue_culture_for_bacteria_TBLB_box,'|&nbsp;<font color="red">Tissue culture for bacteria</font>')!!}
            {!!box2text(@$json->Mycobacteria_Profile1_TBLB_box,'|&nbsp;<font color="red">Mycobacteria (Profile 1)</font>')!!}
            {!!box2text(@$json->Mycobacteria_Profile2_TBLB_box,'|&nbsp;<font color="red">Mycobacteria (Profile 2)</font>')!!}
            {!!box2text(@$json->Tissue_culture_for_fungus_TBLB_box,'|&nbsp;<font color="red">Tissue culture for fungus</font>')!!}
        @endif



        @if(@$json->Bronchial_biopsy_box=="true"||
            @$json->Bronchial_biopsy!="")<br>
            {!!box2text(@$json->Bronchial_biopsy_box,'<font color="red">Bronchial biopsy at</font>')!!}
            {!!text2print('',@$json->Bronchial_biopsy,'')!!}
        @endif

        @if(@$json->Histopathology_Bronchial_biopsy_box=="true"||
            @$json->Tissue_culture_for_bacteria_Bronchial_biopsy_box=="true"||
            @$json->Mycobacteria_Profile1_Bronchial_biopsy_box=="true"||
            @$json->Mycobacteria_Profile2_Bronchial_biopsy_box=="true"||
            @$json->Tissue_culture_for_fungus_Bronchial_biopsy_box=="true")<br>
            {!!box2text(@$json->Histopathology_Bronchial_biopsy_box,'|&nbsp;<font color="red">Histopathology</font>')!!}
            {!!box2text(@$json->Tissue_culture_for_bacteria_Bronchial_biopsy_box,'|&nbsp;<font color="red">Tissue culture for bacteria</font>')!!}
            {!!box2text(@$json->Mycobacteria_Profile1_Bronchial_biopsy_box,'|&nbsp;<font color="red">Mycobacteria (Profile 1)</font>')!!}
            {!!box2text(@$json->Mycobacteria_Profile2_Bronchial_biopsy_box,'|&nbsp;<font color="red">Mycobacteria (Profile 2)</font>')!!}
            {!!box2text(@$json->Tissue_culture_for_fungus_Bronchial_biopsy_box,'|&nbsp;<font color="red">Tissue culture for fungus</font>')!!}
        @endif

        @if(@$json->Bronchial_brush_box=="true"||
            @$json->Bronchial_brush!=""||
            @$json->Bronchial_brush_segment!=""||
            @$json->Cytology_Bronchial_brush_box=="true")<br>
            {!!box2text(@$json->Bronchial_brush_box,'<font color="red">Bronchial brush at</font>')!!}
            {!!text2print('',@$json->Bronchial_brush,'')!!}
            {!!text2print('|&nbsp;<font color="red">Segment&nbsp;&nbsp;</font>',@$json->Bronchial_brush_segment,'')!!}
            {!!box2text(@$json->Cytology_Bronchial_brush_box,'|&nbsp;<font color="red">Cytology</font>')!!}
        @endif

        @if(@$json->TBNA_box=="true"||
            @$json->TBNA!="")<br>
            {!!box2text(@$json->TBNA_box,'<font color="red">TBNA at</font>')!!}
            {!!text2print('',@$json->TBNA,'')!!}
        @endif

        @if(@$json->Histopathology_TBNA_box=="true"||
            @$json->Cytology_TBNA_box=="true"||
            @$json->Tissue_culture_for_bacteria_TBNA_box=="true"||
            @$json->Mycobacteria_Profile1_TBNA_box=="true"||
            @$json->Mycobacteria_Profile2_TBNA_box=="true"||
            @$json->Tissue_culture_for_fungus_TBNA_box)<br>
            {!!box2text(@$json->Histopathology_TBNA_box,'|&nbsp;<font color="red">Histopathology</font>')!!}
            {!!box2text(@$json->Cytology_TBNA_box,'|&nbsp;<font color="red">Cytology</font>')!!}
            {!!box2text(@$json->Tissue_culture_for_bacteria_TBNA_box,'|&nbsp;<font color="red">Tissue culture for bacteria</font>')!!}
            {!!box2text(@$json->Mycobacteria_Profile1_TBNA_box,'|&nbsp;<font color="red">Mycobacteria (Profile 1)</font>')!!}
            {!!box2text(@$json->Mycobacteria_Profile2_TBNA_box,'|&nbsp;<font color="red">Mycobacteria (Profile 2)</font>')!!}
            {!!box2text(@$json->Tissue_culture_for_fungus_TBNA_box,'|&nbsp;<font color="red">Tissue culture for fungus</font>')!!}
        @endif

        @if(@$json->EBUS_TBNA_location=="true")<br>
            {!!box2text(@$json->EBUS_TBNA_location,'<font color="red">EBUS-TBNA location</font>')!!}
        @endif


        @if(@$json->TBNA_2R!=""||
            @$json->TBNA_2L!=""||
            @$json->TBNA_4R!=""||
            @$json->TBNA_4L!=""||
            @$json->TBNA_7!=""||
            @$json->TBNA_10R!=""||
            @$json->TBNA_10L!=""||
            @$json->TBNA_11L!=""||
            @$json->TBNA_11S!="")<br>
            {!!text2print('|&nbsp;<font color="red">2R&nbsp;</font>',@$json->TBNA_2R,'<font color="red">&nbsp;cm.</font>')!!}|
            {!!text2print('|&nbsp;<font color="red">2L&nbsp;</font>',@$json->TBNA_2L,'<font color="red">&nbsp;cm.</font>')!!}|
            {!!text2print('|&nbsp;<font color="red">4R&nbsp;</font>',@$json->TBNA_4R,'<font color="red">&nbsp;cm.</font>')!!}|
            {!!text2print('|&nbsp;<font color="red">4L&nbsp;</font>',@$json->TBNA_4L,'<font color="red">&nbsp;cm.</font>')!!}|
            {!!text2print('|&nbsp;<font color="red">7&nbsp;</font>',@$json->TBNA_7,'<font color="red">&nbsp;cm.</font>')!!}|
            {!!text2print('|&nbsp;<font color="red">10R&nbsp;</font>',@$json->TBNA_10R,'<font color="red">&nbsp;cm.</font>')!!}|
            {!!text2print('|&nbsp;<font color="red">10L&nbsp;</font>',@$json->TBNA_10L,'<font color="red">&nbsp;cm.</font>')!!}|
            {!!text2print('|&nbsp;<font color="red">11L&nbsp;</font>',@$json->TBNA_11L,'<font color="red">&nbsp;cm.</font>')!!}|
            {!!text2print('|&nbsp;<font color="red">11S&nbsp;</font>',@$json->TBNA_11S,'<font color="red">&nbsp;cm.</font>')!!}
        @endif


        @if(@$json->otherprocedure!="")
        <br><span class="icd10text">Other procedure   :</span>
            {!!@$json->otherprocedure!!}
        @endif




<br>







<span class="casetext">{!!@@$json->overall_procedure!!}</span>


<br>
