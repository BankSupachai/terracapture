<div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
aria-labelledby="v-pills-profile-tab">
<div class="d-flex mb-2">
    <div class="kanban-board">


        <div class="kanban-column">
            <h3>In Progress</h3>
            <div class="kanban-items" id="inprogress"
                style="height: 500px; overflow-y: auto;">
                @foreach ($left_section as $show)
                    <div class="kanban-item" draggable="true">{{ $show }}</div>
                @endforeach
            </div>
        </div>
        <form action="{{ url('pdfcustom') }}" method="post">
            @csrf
            <div class="kanban-column">
                <h3>Done</h3>
                <div class="kanban-items" id="done">
                    <input type="hidden" name="code" value="{{ $tb_procedure->code }}">
                    <input type="hidden" name="event" value="custom_body">
                    @foreach ($tb_procedure->pdf['show'] as $body)
                        <div class="kanban-item" draggable="true">
                            {{ $body }}
                            <input type="hidden" class="form-control" name="pdf_show[]"
                                id="pdf-{{ $body }}" value="{{ $body }}">
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

</div>
