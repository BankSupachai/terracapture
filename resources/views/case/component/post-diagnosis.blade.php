<div class="col-12">
    {!! editcard('post-diagnosis', 'post-diagnosis.blade.php') !!}
    <div class="card card-custom gutter-b">
        <div class="card-body">

            <div class="row">
                <div class="col-12">
                    <font size='4'><b>POST DIAGNOSIS </b></font><br>
                </div>

                @foreach ($prediagnosis as $box)
                    @php
                        $boxid = $box->prediagnostic_name;
                    @endphp
                    <div class="col-4">
                        <input type="checkbox" {{ box(@$case->$boxid) }} class="savejson"
                            id="{{ $box->prediagnostic_name }}" name="{{ $box->prediagnostic_name }}"><b
                            for="ebus">{{ $box->prediagnostic_name }}</b>
                    </div>
                @endforeach

                <div class="col-6">
                    <br>
                    <input rows="6" class="form-control autosave" id="postdiagnostic_cysto"
                        placeholder="Other Diagnosis" type="text" autocomplete="off"
                        value="{{ @$case->postdiagnostic_cysto }}" />
                </div>
            </div>
        </div>
    </div>
</div>
