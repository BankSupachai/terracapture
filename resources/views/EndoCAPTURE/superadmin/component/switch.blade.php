<div class="col-3"><h3>{{$name}}</h3></div>
<div class="col-9">
    <div class="form-check form-switch">
        <input class="form-check-input form-switch-md config_option {{@$otherclass}}" role="switch" type="checkbox" config_type="{{$type}}" @if(configTYPE($type,$id)) checked @endif id="{{$id}}">

    </div>
    {{-- <span class="switch switch-icon">
    <label class="switch">
        <input type="checkbox" config_type="{{$type}}" class="config_option" @if(configTYPE($type,$id)) checked @endif id="{{$id}}">
        <span></span>
    </label> --}}
</div>
