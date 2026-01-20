

    @foreach($procedure as $data)
        @php
            $procedure_code = $data[0];
            $procedure_name = $data[1];
        @endphp




    <div class="row m-0 mt-2 cn">
        <div class="col-3">{{$procedure_name}}</div>
        <div class="col">
            <input  id      = "min_{{$procedure_code}}"
            class           = "procedure form-control form-control-sm text-center"
            value           = "{{@$dep->procedure->$procedure_code->min}}"
            procedure_code  = "{{$procedure_code}}"
            procedure_name  = "{{$procedure_name}}"
            type            = "text">
        </div>
        <div class="col">
            <input  id      = "rooms_{{$procedure_code}}"
            class           = "procedure form-control form-control-sm text-center"
            value           = "{{@$dep->procedure->$procedure_code->rooms}}"
            procedure_code  = "{{$procedure_code}}"
            procedure_name  = "{{$procedure_name}}"
            type            = "number">
        </div>
        <div class="col">
            <label class="checkbox  text-dark-50">
                <input type="checkbox" name="Checkboxes1"/>
                <span></span>
                &emsp;Default
            </label>
        </div>
        <div class="col">
            <input  id      = "times_{{$procedure_code}}"
            class           = "procedure form-control form-control-sm text-center"
            value           = "{{@$dep->procedure->$procedure_code->times}}"
            procedure_code  = "{{$procedure_code}}"
            procedure_name  = "{{$procedure_name}}"
            type            = "number">
        </div>
    </div>
    @endforeach
</table>
