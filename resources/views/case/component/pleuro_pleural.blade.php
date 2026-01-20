

{!! editcard('pleuroscopy', 'pleuroscopy.blade.php') !!}

<div class="col-12 p-0">
    <div class="card card-custom gutter-b">
        <div class="card-body ">
            <span class="h5">Pleural Fluid</span>
            <div class="row p-2">
                <div class="col-12">
                    <div class="row">
                        <div class="col-2 align-self-center">
                            Volume
                        </div>
                        <div class="col-2">
                            <input type="text" class="form-control savejson autotext" name="pleuro_volume_text" id="pleuro_volume_text" value="{{@$case->pleuro_volume_text}}">
                        </div>
                        <div class="col-2 align-self-center">
                            ml.
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row mt-2 align-self-center">
                        <div class="col-2 ">
                            Color
                        </div>
                        <div class="col-10">
                            <div class="row">

                                {!!pleurobox($case, 'pleuro_color_yellowBox' ,'pleuro_color_yellowBox' ,'Yellow')!!}
                                {!!pleurobox($case, 'pleuro_color_redBox' ,'pleuro_color_redBox' ,'Red')!!}
                                {!!pleurobox($case, 'pleuro_color_blackBox' ,'pleuro_color_blackBox' ,'Black')!!}
                                <div class="col-auto align-self-center">
                                    Other
                                </div>
                                <div class="col-2">
                                    <input type="text" class="form-control autotext savejson" value="{{@$case->pleru_color_othertext}}" id="pleru_color_othertext" name="pleru_color_othertext">
                                </div>


                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-2">
                    For
                </div>
                <div class="col-10 ">
                    <div class="row">
                        {!!pleurobox($case, 'pleuro_Cell_countBox' ,'pleuro_Cell_countBox' ,'Cell Count/Cell Differentiation')!!}
                        {!!pleurobox($case, 'pleuro_proteinBox' ,'pleuro_proteinBox' ,'Protein')!!}
                        {!!pleurobox($case, 'pleuro_ldhBox' ,'pleuro_ldhBox' ,'LDH')!!}
                        {!!pleurobox($case, 'pleuro_glucoseBox' ,'pleuro_glucoseBox' ,'Glucose')!!}
                        {!!pleurobox($case, 'pleuro_phBox' ,'pleuro_phBox' ,'ph')!!}
                        {!!pleurobox($case, 'pleuro_cholesterolBox' ,'pleuro_cholesterolBox' ,'Cholesterol')!!}
                        {!!pleurobox($case, 'pleuro_adaBox' ,'pleuro_adaBox' ,'ADA')!!}
                        {!!pleurobox($case, 'pleuro_genextpertBox' ,'pleuro_genextpertBox' ,'GeneXpert')!!}
                        {!!pleurobox($case, 'pleuro_pcrfortbBox' ,'pleuro_pcrfortbBox' ,'PCR for TB')!!}
                        {!!pleurobox($case, 'pleuro_TriglycerideBox' ,'pleuro_TriglycerideBox' ,'Triglyceride')!!}
                        {!!pleurobox($case, 'pleuro_culturebacteriaBox' ,'pleuro_culturebacteriaBox' ,'Culture Bacteria')!!}
                        {!!pleurobox($case, 'pleuro_culturefungusBox' ,'pleuro_culturefungusBox' ,'Culture Fungus')!!}
                        {!!pleurobox($case, 'pleuro_culturetbBox' ,'pleuro_culturetbBox' ,'Culture TB')!!}
                        {!!pleurobox($case, 'pleuro_gramstrainBox' ,'pleuro_gramstrainBox' ,'Gram stain')!!}
                        {!!pleurobox($case, 'pleuro_wrightstrainBox' ,'pleuro_wrightstrainBox' ,'Wright stain')!!}
                        {!!pleurobox($case, 'pleuro_MafbdataBox' ,'pleuro_MafbdataBox' ,'MAFB DATB')!!}

                    </div>
                </div>
                <div class="col-2">
                    Other
                </div>
                <div class="col-10">
                    <input type="text" class="form-control savejson autotext"  name="pleurofiding_other" id="pleurofiding_other" value="{{@$case->pleurofiding_other}}">
                </div>
            </div>
        </div>
    </div>
</div>
