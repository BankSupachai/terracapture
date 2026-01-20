<div class="card">
    <div class="card-body">
        <h5>Colposcopic Finding</h5>

        <div class="row">

            @php
                $arrcolpo[] = 'Totally seen';
                $arrcolpo[] = 'Partially seen';
                $arrcolpo[] = 'Not seen';

            @endphp
            <div class="col-12 mt-3">

                <select class="form-select savejson" id="colpo_select" name="colpo_select">
                    <option value="">Select</option>
                    @foreach ($arrcolpo as $data)
                        @if ($data != @$case->colpo_select)
                            <option value="{{ $data }}">{{ $data }}</option>
                        @else
                            <option value="{{ $data }}" selected>{{ $data }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="col-12 mt-3">
                <textarea type="text" rows="3" class="form-control autotext savejson" name="colpo_text" id="colpo_text"
                    placeholder="Freetext" type="text" autocomplete="off" value="">{{ @$case->colpo_text }}</textarea>
            </div>

        </div>
    </div>
</div>
