    {!!editcard('percutaneous','percutaneous.blade.php')!!}
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12" style="margin-top: 10px;"><font size="4">ASA CLASS</font></div>
                        <div class="col-12">
                        <input type="text" name="" class="form-control savejson autotext" autocomplete="off" id="asa_class" value="{{@$case->asa_class}}">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-12" style="margin-top: 10px;"><font size="4">DATE OF INTUBATION</font></div>
                        <div class="col-12">
                        <input type="text" name="" class="form-control savejson autotext" autocomplete="off" id="date_of" value="{{@$case->date_of}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
