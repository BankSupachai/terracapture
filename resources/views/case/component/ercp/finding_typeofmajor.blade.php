<div class="col-4">
    Type of Major Ampulla&nbsp;&nbsp; <i class="ri-equalizer-line"></i>
</div>
<div class="row mt-2">
    <div class="col-3">
        <input type="radio" {{ checkradio($case, 'Type of Major Ampulla', 'Villous') }} name="Type of Major Ampulla" class="form-check-input radiosave radioother" other="fidingmajor_other" datagroup="Type of Major Ampulla" id="{{md5("Type of Major Ampulla Villous")}}"
        value="Villous">
        <label class="ms-4" for="{{md5("Type of Major Ampulla Villous")}}">&nbsp;Villous</label>
    </div>
    <div class="col-3">
        <input type="radio" {{ checkradio($case, 'Type of Major Ampulla', 'Nodular') }}  name="Type of Major Ampulla" class="form-check-input radiosave radioother" other="fidingmajor_other" datagroup="Type of Major Ampulla" id="{{md5("Type of Major Ampulla Nodular")}}" value="Nodular">
        <label class="ms-4" for="{{md5("Type of Major Ampulla Nodular")}}">&nbsp;Nodular</label>
    </div>
    <div class="col-3">
        <input type="radio" {{ checkradio($case, 'Type of Major Ampulla', 'Onion') }}  name="Type of Major Ampulla" class="form-check-input radiosave radioother" other="fidingmajor_other" datagroup="Type of Major Ampulla" id="{{md5("Type of Major Ampulla Onion")}}" value="Onion">
        <label class="ms-4" for="{{md5("Type of Major Ampulla Onion")}}">&nbsp;Onion</label>
    </div>
    <div class="col-3">
        <input type="radio" {{ checkradio($case, 'Type of Major Ampulla', 'Separate') }}  name="Type of Major Ampulla" class="form-check-input radiosave radioother" other="fidingmajor_other" datagroup="Type of Major Ampulla" id="{{md5("Type of Major Ampulla Separate")}}" value="Separate">
        <label class="ms-4" for="{{md5("Type of Major Ampulla Separate")}}">&nbsp;Separate</label>
    </div>

    <div class="col-12">
        <input class="form-control autotext savejson" id="fidingmajor_other"
            placeholder="Detail" type="text" autocomplete="off"
            value="{{ @$case->fidingmajor_other }}" />
    </div>
    <div class="col-12">&nbsp;</div>
</div>


