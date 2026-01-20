<div class="col-12">
    {!! editcard('manometry', 'manometry.blade.php') !!}
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <div class="row">
                <div class="col-12" align="center">

                    @if (@$case->manometry_file != '')
                        @php
                            $moti = jsonDecode($case->manometry_file);
                        @endphp
                        <div class="row">
                            @foreach ($moti as $mo)
                                <iframe id="iframepdf" src="{{ url('store/' . $case->hn . '/' . $mo) }}" width="100%"
                                    height="1200"></iframe>
                            @endforeach
                            <div class="col-12">
                                <br>
                                <a href="{{ url('reportendocapture/' . $case->case_id) }}"
                                    class="btn btn-success btn-block">Report</a>
                                <br>
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <input name="hn" type="hidden" value="{{ $case->hn }}">
                        <input id="file-1" name="manometry_file[]" type="file" class="file" multiple=true
                            data-preview-file-type="any">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
