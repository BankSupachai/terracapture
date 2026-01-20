





   {!! editcard('pleuroscopy', 'pleuroscopy.blade.php') !!}
    <div class="card p-1">
        <div class="card-body">
            <div class="col-12">
                <span class="h5">PLEUROSCOPIC FINDING</span>
            </div>
            <div class="col-12">
                {!! pleurotext($case, 'Pleural effusion', 'pleural_effusion', 'pleural_effusion') !!}

                <div class="row  mb-2" >
                    <div class="col-2">
                        <input type="checkbox" id="loculation_pleural" name="loculation_pleural" class="form-check-input savejson"
                            {{ box(@$case->loculation_pleural) }}>
                        <label class="form-check-label" for="loculation_pleural"
                            style="margin: 0;padding: 0;">Loculation
                    </div>
                    <div class="col-9"><input type="text" name=""
                            class="form-control form-control-sm mr5 savejson autotext" autocomplete="off"
                            id="loculation_pleural_txt" value="{{ @$case->loculation_pleural_txt }}"></div>
                </div>
                <div class="row  mb-2" >
                    <div class="col-2">
                        <input type="checkbox" id="adhesion_pleural" name="adhesion_pleural" class="form-check-input savejson"
                            {{ box(@$case->adhesion_pleural) }}>
                        <label class="form-check-label" for="adhesion_pleural" style="margin: 0;padding: 0;">Adhesion
                    </div>
                    <div class="col-9"><input type="text" name=""
                    class="form-control form-control-sm mr5 savejson autotext" autocomplete="off"
                    id="adhesion_pleural_txt" value="{{ @$case->adhesion_pleural_txt }}"></div>
                </div>

             {!! pleurotext($case, 'Anterior part of Parietal Pleura', 'anterior_part', 'anterior_part') !!}
             {!! pleurotext($case, 'Posterior part of Parietal Pleura', 'posterior_part', 'posterior_part') !!}
             {!! pleurotext($case, 'Medial part of Parietal Pleura', 'medial_part', 'medial_part') !!}
             {!! pleurotext($case, 'Lateral part of Parietal Pleura', 'lateral_part', 'lateral_part') !!}
             {!! pleurotext($case, 'Diaphragmatic parietal Pleura', 'diaphragmatic', 'diaphragmatic') !!}
             {!! pleurotext($case, 'Visceral part of Parietal Pleura', 'visceral', 'visceral') !!}
            </div>
            <div class="col-12">
                <div class="row" >
                    <div class="col-2">Duration Of Procedure</div>
                    <div class="col-9"><input type="text"
                            name="" class="form-control form-control-sm mr5 savejson autotext"
                            autocomplete="off" id="duration_of" value="{{ @$case->duration_of }}"></div>
                </div>
            </div>
        </div>
    </div>
