


<tr style="line-height:{{@$between_line}};" class="set-font-family" >
        <td valign="top" colspan="2">
            @if(@$casedata->operation_cysto!="" || @$casedata->operation_cysto_other!="")
            <br><span class="casetitle">OPERATION :</span>



                @if(@$casedata->operation_cysto!="" && @$casedata->operation_cysto_other=="")
                    @php$prediag = jsonDecode(@$casedata->operation_cysto);@endphp
                    @foreach($prediag as $hv)
                    {{$hv}}<br>
                    @endforeach<br>
                @endif

                @if(@$casedata->operationcysto!="")
                    @php
                    $prediag = jsonDecode(@$casedata->operationcysto);
                    @endphp
                    @foreach($prediag as $hv)
                        {{$hv}}<br>
                    @endforeach
                @endif



                @if(@$casedata->operation_cysto=="" && @$casedata->operation_cysto_other!="")
                    {{@$casedata->operation_cysto_other}}<br>
                @endif
            @endif


                            @if(@$casedata->incision_cysto!="")
                            <span class="casetitle">INCISION :</span>
                            {{@$casedata->incision_cysto}}
                            @endif
                            @if(mevalue($casedata,[
                             'prostatic_length'
                            ,'prostate_cysto'
                            ,'obstruction_cysto'
                            ,'vc_size_cysto'
                            ,'intravesical_pressure_cysto'
                            ,'trabeculac_cysto'
                            ,'bladder_mass_cysto'
                            ,'stricture_urethra_cysto'
                            ,'overall_cysto'
                            ]))


                            <span class="casetitle">FINDING :</span>
            <br>
                                <span class="casetext">
                                        @if(@$casedata->prostatic_length!="" ||  @$casedata->prostatic_length!=null)
                                        Prostatic length <span class="findtitle">{{@$casedata->prostatic_length}}</span> cm.<br>
                                        @endif

                                        @if(@$casedata->prostate_cysto!="" && @$casedata->obstruction_cysto!="")
                                        Prostate <span class="findtitle">{{@$casedata->prostate_cysto}} {{@$casedata->obstruction_cysto}}<br></span>
                                        @endif

                                        @if(@$casedata->prostate_cysto!="" && @$casedata->obstruction_cysto=="")
                                        Prostate <span class="findtitle">{{@$casedata->prostate_cysto}}</span><br>
                                        @endif

                                        @if(@$casedata->prostate_cysto=="" && @$casedata->obstruction_cysto!="")
                                        Prostate <span class="findtitle">{{@$casedata->obstruction_cysto}}</span><br>
                                        @endif

                                        @if(@$casedata->vc_size_cysto!="")
                                        VC size <span class="findtitle">{{@$casedata->vc_size_cysto}}</span> cm.<br>
                                        @endif

                                        @if(@$casedata->intravesical_pressure_cysto!="")
                                        Intravesical pressure <span class="findtitle">{{@$casedata->intravesical_pressure_cysto}}</span> cm.H2O<br>
                                        @endif

                                        @if(@$casedata->trabeculac_cysto!="")
                                        Trabeculac <span class="findtitle">{{@$casedata->trabeculac_cysto}}</span><br>
                                        @endif

                                        @if(@$casedata->bladder_mass_cysto!="" && @$casedata->size_cysto!="" && @$casedata->at_cysto!="")
                                        Bladder mass <span class="findtitle">{{@$casedata->bladder_mass_cysto}}</span> size <span class="findtitle">{{@$casedata->size_cysto}}</span> cm.  at <span class="findtitle">{{@$casedata->at_cysto}}</span><br>
                                        @endif

                                        @if(@$casedata->bladder_mass_cysto!="" && @$casedata->size_cysto=="" && @$casedata->at_cysto=="")
                                        Bladder mass <span class="findtitle">{{@$casedata->bladder_mass_cysto}}</span><br>
                                        @endif

                                        @if(@$casedata->bladder_mass_cysto!="" && @$casedata->size_cysto!="" && @$casedata->at_cysto=="")
                                        Bladder mass <span class="findtitle">{{@$casedata->bladder_mass_cysto}}</span> size <span class="findtitle">{{@$casedata->size_cysto}}</span> cm.<br>
                                        @endif

                                        @if(@$casedata->bladder_mass_cysto!="" && @$casedata->size_cysto=="" && @$casedata->at_cysto!="")
                                        Bladder mass <span class="findtitle">{{@$casedata->bladder_mass_cysto}}</span> at <span class="findtitle">{{@$casedata->at_cysto}}</span><br>
                                        @endif

                                        @if(@$casedata->stricture_urethra_cysto!="" && @$casedata->length_cysto!="")
                                        Stricture urethra at <span class="findtitle">{{@$casedata->stricture_urethra_cysto}}</span> length <span class="findtitle">{{@$casedata-> length_cysto}}</span> cm.<br>
                                        @endif

                                        @if(@$casedata->stricture_urethra_cysto!="" && @$casedata->length_cysto=="")
                                        Stricture urethra at <span class="findtitle">{{@$casedata->stricture_urethra_cysto}}</span> <br>
                                        @endif

                                        @if(@$casedata->overall_cysto!="")
                                        {!!@$casedata->overall_cysto!!}
                                        @endif

                            @endif

                            @if(@$casedata->prostatic_length=="" && @$casedata->prostate_cysto=="" && @$casedata->obstruction_cysto=="" && @$casedata->vc_size_cysto=="" && @$casedata->intravesical_pressure_cysto==""
                            && @$casedata->trabeculac_cysto=="" && @$casedata->bladder_mass_cysto=="" && @$casedata->stricture_urethra_cysto=="" && @$casedata->overall_cysto=="")
                            {{-- Normal --}}
                            @endif
                        </span>
        </td>
</tr>

