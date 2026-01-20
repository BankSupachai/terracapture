<div class="col-12">
    {!! editcard('percutaneous', 'percutaneous.blade.php') !!}
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <div class="row">
                <div class="col-5">
                    <div class="row">
                        <div class="col-12" style="margin-top: 10px;">
                            <font size="4">TRACHEAL POSITION</font>
                        </div>
                        <div class="col-12">
                            <input type="text" name="" class="form-control savejson autotext"
                                autocomplete="off" id="tracheal_position" value="{{ @$case->tracheal_position }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" style="margin-top: 10px;">
                            <font size="4">SIZE OF ET TUBE</font>
                        </div>
                        <div class="col-12">
                            <input type="text" name="" class="form-control savejson autotext"
                                autocomplete="off" id="et_tube" value="{{ @$case->et_tube }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" style="margin-top: 10px;">
                            <font size="4">SIZE OF TRACHEOSTOMY TUBE</font>
                        </div>
                        <div class="col-12">
                            <input type="text" name="" class="form-control savejson autotext"
                                autocomplete="off" id="tracheostomy_tube" value="{{ @$case->tracheostomy_tube }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" style="margin-top: 10px;">
                            <font size="4">EARLY COMPLICATION (FIRST 72 HOURS)</font>
                        </div>
                        <div class="col-12">
                            <input type="text" name="" class="form-control savejson autotext"
                                autocomplete="off" id="early_complication" value="{{ @$case->early_complication }}">
                        </div>
                    </div>
                </div>
                <div class="col-1"></div>
                <div class="col-5">
                    <div class="row">
                        <div class="col-12" style="margin-top: 10px;">
                            <font size="4">PROCEDURE TIME</font>
                        </div>
                        <div class="col-12">
                            <input type="text" name="" class="form-control savejson autotext"
                                autocomplete="off" id="procedure_time" value="{{ @$case->procedure_time }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" style="margin-top: 10px;">
                            <font size="4">BLEEDING</font>
                        </div>
                        <div class="col-12">
                            <input type="text" name="" class="form-control savejson autotext"
                                autocomplete="off" id="bleeding" value="{{ @$case->bleeding }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" style="margin-top: 10px;">
                            <font size="4">INTRAOPERATIVE COMPLICATION</font>
                        </div>
                        <div class="col-12">
                            <input type="text" name="" class="form-control savejson autotext"
                                autocomplete="off" id="intraoperative_complication"
                                value="{{ @$case->intraoperative_complication }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" style="margin-top: 10px;">
                            <font size="4">LATE COMPLCATION</font>
                        </div>
                        <div class="col-12">
                            <input type="text" name="" class="form-control savejson autotext"
                                autocomplete="off" id="late_complcation" value="{{ @$case->late_complcation }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
