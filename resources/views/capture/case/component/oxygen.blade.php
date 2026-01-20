
<div class="col-12 p-0">
    {!! editcard('percutaneous', 'percutaneous.blade.php') !!}
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <div class="row">
                <div class="col-auto">
                    <h5>Oxygen Therapy</h5>
                </div>
                <div class="col-auto">
                    {{-- <button class="btn btn-checkbox btn-label waves-effect waves-light btn-sm" id="btn_clear_oxygen_Therapy"
                        type="button">
                        <i class="mdi mdi-checkbox-outline label-icon align-middle fs-16 me-2 text-light"></i>
                        None
                    </button> --}}
                </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input savejson oxygen_therapy_box" type="checkbox" name="oxygen_nasaicannula_box" id="oxygen_nasaicannula_box" {{box(@$case->oxygen_nasaicannula_box)}}>
                                        <label class="form-check-label" for="oxygen_nasaicannula_box">
                                            &ensp;&ensp;O<sub>2</sub> Nasal Cannula
                                        </label>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <input type="text" class="form-control form-control-sm savejson autotext oxygen_therapy_text"  autocomplete="off" name="oxygen_nasaicannula" value="{{@$case->oxygen_nasaicannula}}" id="oxygen_nasaicannula">
                                </div>
                                <div class="col-9 align-self-center">
                                    LPM
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-2 ">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input savejson oxygen_therapy_box" type="checkbox" name="oxygen_maskwithbag_box" id="oxygen_maskwithbag_box" {{box(@$case->oxygen_maskwithbag_box)}}>
                                        <label class="form-check-label" for="oxygen_maskwithbag_box">
                                            &ensp;&ensp;O<sub>2</sub> Mask With Bag
                                        </label>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <input type="text" class="form-control form-control-sm savejson autotext oxygen_therapy_text" name="oxygen_maskwithbag" id="oxygen_maskwithbag" autocomplete="off" value="{{@$case->oxygen_maskwithbag}}">
                                </div>
                                <div class="col-9 align-self-center">
                                    LPM
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="row">
                                <div class="col-6 ">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input savejson oxygen_therapy_box" type="checkbox" name="oxygen_highflownasaicannula_box" id="oxygen_highflownasaicannula_box" {{box(@$case->oxygen_highflownasaicannula_box)}}>
                                        <label class="form-check-label" for="oxygen_highflownasaicannula_box">
                                            &ensp;&ensp;High Flow Nasal  Cannula
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control form-control-sm autotext savejson oxygen_therapy_text"  autocomplete="off" name="oxygen_highflownasaicannula" id="oxygen_highflownasaicannula" value="{{@$case->oxygen_highflownasaicannula}}">
                                </div>
                                <div class="col-2">
                                    LPM
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="row">
                                <div class="col-auto ">
                                    <div class=" mb-2">
                                            And FiO<sub>2</sub>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control form-control-sm autotext savejson oxygen_therapy_text"  autocomplete="off" name="oxygen_andfio2" id="oxygen_andfio2" value="{{@$case->oxygen_andfio2}}">
                                </div>
                                <div class="col-2 align-self-center">

                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-2 ">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input savejson oxygen_therapy_box" type="checkbox" name="oxygen_thriveflow_box" id="oxygen_thriveflow_box" {{box(@$case->oxygen_thriveflow_box)}}>
                                        <label class="form-check-label" for="oxygen_thriveflow_box">
                                            &ensp;&ensp; THRIVE Flow
                                        </label>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <input type="text" class="form-control form-control-sm savejson autotext oxygen_therapy_text"  autocomplete="off" name="oxygen_thriveflow" id="oxygen_thriveflow" value="{{@$case->oxygen_thriveflow}}">
                                </div>
                                <div class="col-9 align-self-center">
                                    LPM
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="row">
                                <div class="col-12 ">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input savejson oxygen_therapy_box" type="checkbox" id="oxygen_ettube_box" name="oxygen_ettube_box" {{box(@$case->oxygen_ettube_box)}}>
                                        <label class="form-check-label" for="oxygen_ettube_box">
                                            &ensp;&ensp; ET-Tube
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12 ">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input savejson oxygen_therapy_box" type="checkbox" name="oxygen_tracheostomy_box" id="oxygen_tracheostomy_box" {{box(@$case->oxygen_tracheostomy_box)}}>
                                        <label class="form-check-label" for="oxygen_tracheostomy_box">
                                            &ensp;&ensp; Tracheostomy
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="col-12">
                            <input type="text" class="form-control autotext  savejson w-50 oxygen_therapy_text"  autocomplete="off" name="oxygen_other" id="oxygen_other" placeholder="Freetext" value="{{@$case->oxygen_other}}">
                        </div>
                    </div>

            </div>
        </div>
    </div>
</div>


<script>
    $("#btn_clear_oxygen_Therapy").click(function(){
        // $(".oxygen_therapy_box").removeAttr("checked")
        $('.oxygen_therapy_box').attr('checked','');
        $(".oxygen_therapy_text").val("")

    })

    // $('#btn_clear_oxygen_Therapy').toggle(function(){
    //     $('input:checkbox').attr('checked','checked');
    //     $(this).val('uncheck all');
    // },function(){
    //     $('input:checkbox').removeAttr('checked');
    //     $(this).val('check all');
    // })
</script>
