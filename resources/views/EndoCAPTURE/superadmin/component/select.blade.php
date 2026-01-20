<div class="col-3"><h3>{{$name}}</h3></div>
<div class="col-1"></div>
<div class="col-8">
    <select
        config_type = "{{$type}}"
        class       = "form-control form-control-lg text-center config_type mt-2 {{@$otherclass}}"
        id          = "{{$id}}"
        style       = "border-radius: 25px;"
    >
        @foreach($options as $value => $label)
            <option value="{{$value}}" @if(configTYPE($type,$id) == $value) selected @endif>{{$label}}</option>
        @endforeach
    </select>
</div>
