<select name="" class="form-control" onchange="gen_connection(this.value)" id="ls_file">
    @for ($i=2;$i<count($file);$i++)
    @php
        $name = str_replace('.txt','',$file[$i]);
    @endphp
        <option value="{{$name}}" @if($name==$select) selected @endif>{{$name}}</option>
    @endfor
</select>
