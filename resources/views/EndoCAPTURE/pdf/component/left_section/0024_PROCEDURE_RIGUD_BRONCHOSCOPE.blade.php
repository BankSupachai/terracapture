<tr class="set-font-family">
    <td>
        @if((@$casedata->tracheal_position)!=null)<br>
        <span class="casetitle">TRACHEAL POSITION :</span>
            {{@$casedata->tracheal_position}}<br>
        @endif
        @if((@$casedata->et_tube)!=null)
        <span class="casetitle">SIZE OF ET TUBE :</span>
            {{@$casedata->et_tube}}<br>
        @endif
        @if((@$casedata->tracheostomy_tube)!=null)
        <span class="casetitle">SIZE OF TRACHEOSTOMY TUBE :</span>
            {{@$casedata->tracheostomy_tube}}<br>
        @endif
        @if((@$casedata->early_complication)!=null)
        <span class="casetitle">EARLY COMPLICATION (FIRST 72 HOURS) :</span>
            {{@$casedata->early_complication}}<br>
        @endif
        @if((@$casedata->procedure_time)!=null)
        <span class="casetitle">PROCEDURE TIME :</span>
            {{@$casedata->procedure_time}}<br>
        @endif
        @if((@$casedata->bleeding)!=null)
        <span class="casetitle">BLEEDING :</span>
            {{@$casedata->bleeding}}<br>
        @endif
        @if((@$casedata->intraoperative_complication)!=null)
        <span class="casetitle">INTRAOPERATIVE COMPLICATION :</span>
            {{@$casedata->intraoperative_complication}}<br>
        @endif
        @if((@$casedata->late_complcation)!=null)
        <span class="casetitle">LATE COMPLCATION :</span>
            {{@$casedata->late_complcation}}<br>
        @endif


        @if(@$casedata->flexible_bronchoscopy   =="true"||  @$casedata->rigid_bronchoscope=="true")

            <br><span class="casetitle">Initial bronchoscopy :</span><br>
            {!!box2text(@$casedata->flexible_bronchoscopy,'<font color="#E4310B">Flexible bronchoscopy was done to evaluation of tracheobronchial tree</font>')!!}
            {!!box2text(@$casedata->rigid_bronchoscope,'<font color="#E4310B">Rigid bronchoscope ,size</font>')!!}
            @if((@$casedata->rigid_txt_01)!=null)
                <span class="casetitle">&nbsp;{{@$casedata->rigid_txt_01}} mm. </span>
            @endif
            @if((@$casedata->rigid_txt_02)!=null)
                <span class="casetitle"> , was placed at {{@$casedata->rigid_txt_02}}</span>
            @endif
            <br>

        @endif

        <br><span class="casetitle">Procedure :</span><br>

        @if(@$casedata->dilatation== "true"||@$casedata->elctrocauterrization=="true"||  @$casedata->laser=="true"||  @$casedata->balloon=="true"||  @$casedata->others_01=="true")
            {!!box2text(@$casedata->dilatation,'<font color="red">Dilatation at :</font>')!!}

            @if((@$casedata->dilatation_txt)!=null)
            &nbsp;&nbsp;<span class="icd10text">{{@$casedata->dilatation_txt}}</span>
            @endif

            {!!box2text(@$casedata->elctrocauterrization,'<font color="#E4310B">Electrocauterrization</font>')!!}
            {!!box2text(@$casedata->laser,'<font color="#E4310B">Laser</font>')!!}
            {!!box2text(@$casedata->balloon,'<font color="#E4310B">Balloon to</font>')!!}
            @if((@$casedata->balloon_txt)!=null)
            <span class="icd10text">&nbsp;&nbsp;{{@$casedata->balloon_txt}} mm.</span>
            @endif

            {!!box2text(@$casedata->others_01,'<font color="#E4310B">Others</font>')!!}
            @if((@$casedata->others_01_txt)!=null)
            &nbsp;&nbsp;<span class="icd10text">{{@$casedata->others_01_txt}}</span>
            @endif
            <br>
        @endif
        @if(@$casedata->dilatation_at=="true"||  @$casedata->electrocauterrization=="true"||  @$casedata->laser_=="true"||  @$casedata->ballon_to=="true"||  @$casedata->rigid_bronchosope_to=="true"||  @$casedata->rigid_others=="true")
            {!!box2text(@$casedata->dilatation_at,'<font color="red">Dilatation at :</font>')!!}
            @if((@$casedata->dilatation_at_txt)!=null)
            &nbsp;&nbsp;<span class="icd10text">{{@$casedata->dilatation_at_txt}}</span>
            @endif

            {!!box2text(@$casedata->electrocauterrization,'<font color="#E4310B">Electrocauterrization</font>')!!}
            {!!box2text(@$casedata->laser_,'<font color="#E4310B">Laser</font>')!!}
            {!!box2text(@$casedata->ballon_to,'<font color="#E4310B">Balloon to</font>')!!}
            @if((@$casedata->ballon_to_txt)!=null)
            &nbsp;&nbsp;<span class="icd10text">{{@$casedata->ballon_to_txt}} mm.</span>
            @endif

            {!!box2text(@$casedata->rigid_bronchosope_to,'<font co lor="#E4310B">Rigid bronchoscope to</font>')!!}
            @if((@$casedata->rigid_bronchosope_to_txt)!=null)
            <span class="icd10text">&nbsp;&nbsp;{{@$casedata->rigid_bronchosope_to_txt}} mm.</span>
            @endif
            {!!box2text(@$casedata->rigid_others,'<font color="#E4310B">Others</font>')!!}
            @if((@$casedata->rigid_others_txt)!=null)
            &nbsp;&nbsp;<span class="icd10text">{{@$casedata->rigid_others_txt}}</span>
            @endif
            <br>
        @endif
        @if(@$casedata->dilatation_at_02=="true"||  @$casedata->electrocauterrization_01=="true"||  @$casedata->laser_02=="true"||  @$casedata->balloon_to_02=="true"||  @$casedata->rigid_bronchoscope_to=="true"||  @$casedata->others_03=="true")
            {!!box2text(@$casedata->dilatation_at_02,'<font color="red">Dilatation at :</font>')!!}
            @if((@$casedata->dilatation_at_02_txt)!=null)
            &nbsp;&nbsp;<span class="icd10text">{{@$casedata->dilatation_at_02_txt}}</span>
            @endif

            {!!box2text(@$casedata->electrocauterrization_01,'<font color="#E4310B">Electrocauterrization</font>')!!}
            {!!box2text(@$casedata->laser_02,'<font color="#E4310B">Laser</font>')!!}
            {!!box2text(@$casedata->balloon_to_02,'<font color="#E4310B">Balloon to</font>')!!}
            @if((@$casedata->balloon_to_02_txt)!=null)
            <span class="icd10text">&nbsp;&nbsp;{{@$casedata->balloon_to_02_txt}}mm.</span>
            @endif

            {!!box2text(@$casedata->rigid_bronchoscope_to,'<font color="#E4310B">Rigid bronchoscope to</font>')!!}
            @if((@$casedata->rigid_bronchoscope_to_txt)!=null)
            <span class="icd10text">&nbsp;&nbsp;{{@$casedata->rigid_bronchoscope_to_txt}} mm.</span>
            @endif

            {!!box2text(@$casedata->others_03,'<font color="#E4310B">Others</font>')!!}
            @if((@$casedata->others_03_txt)!=null)
            &nbsp;&nbsp;<span class="icd10text">{{@$casedata->others_03_txt}}</span>
            @endif
            <br>
        @endif
        @if(@$casedata->tumor_removal_at=="true"||  @$casedata->electrocauterrization_03=="true"||  @$casedata->lazer_03=="true"||  @$casedata->rigid_bronchoscope_03=="true"||  @$casedata->body_removal_at=="true"||  @$casedata->cryotherapy_01=="true"||  @$casedata->electrocauterization=="true"||  @$casedata->laser_03=="true"||  @$casedata->others_04=="true")
            {!!box2text(@$casedata->tumor_removal_at,'<font color="red">Tumor removal at : </font>')!!}
            @if((@$casedata->others_03_txt)!=null)
            &nbsp;&nbsp;<span class="icd10text">{{@$casedata->others_03_txt}}</span>
            @endif

            {!!box2text(@$casedata->electrocauterrization_03,'<font color="#E4310B">Electrocauterrization</font>')!!}
            {!!box2text(@$casedata->lazer_03,'<font color="#E4310B">Laser</font>')!!}
            {!!box2text(@$casedata->rigid_bronchoscope_03,'<font color="#E4310B">Rigid bronchoscope</font>')!!}
            @if((@$casedata->rigid_bronchoscope_03_txt)!=null)
            <span class="icd10text">&nbsp;&nbsp;{{@$casedata->rigid_bronchoscope_03_txt}} mm.</span>
            @endif

            {!!box2text(@$casedata->body_removal_at,'<font color="#E4310B">Foreign body removal at</font>')!!}
            @if((@$casedata->body_removal_at_txt)!=null)
            &nbsp;&nbsp;<span class="icd10text">{{@$casedata->body_removal_at_txt}}</span>
            @endif
            {!!box2text(@$casedata->cryotherapy_01,'<font color="#E4310B">Cryotherapy</font>')!!}
            {!!box2text(@$casedata->electrocauterization,'<font color="#E4310B">Electrocauterization</font>')!!}
            {!!box2text(@$casedata->laser_03,'<font color="#E4310B">laser</font>')!!}
            {!!box2text(@$casedata->others_04,'<font color="#E4310B">Others</font>')!!}
            @if((@$casedata->others_04_txt)!=null)
            &nbsp;&nbsp;<span class="icd10text">{{@$casedata->others_04_txt}}</span>
            @endif
            <br>
        @endif
        @if(@$casedata->stent_placement == "true"||  @$casedata->smetal_stent    == "true"||  @$casedata->silicone_stent  == "true"||  @$casedata->y_stent         == "true")
            {!!box2text(@$casedata->stent_placement,'<font color="red">Stent placement :</font>')!!}
            {!!box2text(@$casedata->smetal_stent,'<font color="#E4310B">SMetal stent</font>')!!}
            @if((@$casedata->smetal_stent_txt)!=null)
            &nbsp;&nbsp;<span class="icd10text">{{@$casedata->smetal_stent_txt}}</span>
            @endif
            @if((@$casedata->smetal_stent_at)!=null)
            <span class="icd10text">&nbsp;At&nbsp;{{@$casedata->smetal_stent_at}}</span>
            @endif

            {!!box2text(@$casedata->silicone_stent,'<font color="#E4310B">Silicone stent</font>')!!}
            @if((@$casedata->silicone_stent_txt)!=null)
            &nbsp;&nbsp;<span class="icd10text">{{@$casedata->silicone_stent_txt}}</span>
            @endif
            @if((@$casedata->silicone_stent_at)!=null)
            <span class="icd10text">&nbsp;At&nbsp;{{@$casedata->silicone_stent_at}}</span>
            @endif

            {!!box2text(@$casedata->y_stent,'<font color="#E4310B">Y stent</font>')!!}
            @if((@$casedata->y_stent_txt)!=null)
            &nbsp;&nbsp;<span class="icd10text">{{@$casedata->y_stent_txt}}</span>
            @endif
            @if((@$casedata->y_stent_in)!=null)
            <span class="icd10text">&nbsp;Length in trachea&nbsp;{{@$casedata->y_stent_in}}cm</span>
            @endif
            @if((@$casedata->y_stent_rt)!=null)
            <span class="icd10text">&nbsp;Rt main&nbsp;{{@$casedata->y_stent_rt}}cm</span>
            @endif
            @if((@$casedata->y_stent_cm)!=null)
            <span class="icd10text">&nbsp;Lt main&nbsp;{{@$casedata->y_stent_cm}}cm</span>
            @endif
            @if((@$casedata->comment_txt)!=null)
            <br><span class="icd10text">&nbsp;&nbsp;Comment &nbsp; {{@$casedata->comment_txt}}</span>
            @endif
            <br>
            @if((@$casedata->endobronchial_bloak_at_txt)!=null)
            <br><span class="icd10text">&nbsp;&nbsp;Endobronchial Bloak at &nbsp; {{@$casedata->endobronchial_bloak_at_txt}}</span>
            @endif
            <br>
            @if((@$casedata->endobronchial_bloak_by)!=null)
            <br><span class="icd10text">&nbsp;&nbsp;by &nbsp; {{@$casedata->endobronchial_bloak_by}}</span>
            @endif
            <br>
            @if((@$casedata->other_05_txt)!=null)
            <br><span class="icd10text">&nbsp;&nbsp;by &nbsp; {{@$casedata->other_05_txt}}</span>
            @endif
            <br>
        @endif
    @if(@$casedata->histopathology_3    =="true"||  @$casedata->cytology_3=="true"||  @$casedata->culture_3=="true")
        <br><span class="findtitle">Specimen :</span>
        {!!box2text(@$casedata->histopathology_3,'  <br><font color="red">Histopathology</font>')!!}
        {!!box2text(@$casedata->cytology_3,'        <br><font color="red">Cytology</font>')!!}
        {!!box2text(@$casedata->culture_3,'         <br><font color="red">Culture</font>')!!}
        <br>
    @endif
    </td>
</tr>

