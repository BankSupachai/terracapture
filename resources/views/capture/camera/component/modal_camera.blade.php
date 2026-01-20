<!-- Default Modals -->

<style>
    .select2-container {
    z-index: 9999 !important;
   }
</style>


<div id="modal_select_camera" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Select Camera </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body pb-5 mb-5">
            <select class="form-select sourcescope  source1"
                onchange="change_scope('1')" >
                {{-- <option value="">Select Scope</option> --}}
                <option value="">Endoscope</option>
                @isset($scope)
                    @foreach ($scope as $s)
                        @php
                            $s = (object) $s;
                        @endphp
                        <option data-id="{{ $s->scope_id }}" value="{{ @$s->scope_id }}"
                            data-serialno="{{@$s->scope_serial}}"
                            @if ($s->scope_id == $this_scope[0]) selected @endif>
                            {{ @$s->scope_name }} ({{ @$s->scope_serial }})</option>
                    @endforeach
                @endisset
            </select>
            </div>


        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

