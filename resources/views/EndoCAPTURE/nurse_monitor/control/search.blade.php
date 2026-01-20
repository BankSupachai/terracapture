<div class="row">
    <div class="col-4">
        <input type="text" id="search_input" class="form-control bg-gray-input" placeholder="Search for HN, Name…">
    </div>
    <div class="col-auto mt-2" id="count_div" style="display: none ">
        <span id="current_found" hidden></span>/<span id="max_found" hidden></span>
    </div>
    <div class="col-auto">
        <button id="search_text" type="button" class="btn btn-secondary w-lg btn-label waves-effect waves-light">
            <i class="ri-search-line label-icon"></i>
            Search
        </button>
    </div>


        <div class="col-auto p-0">
            <a href="{{url("casemonitor/createcase")}}"   data-container="body" data-toggle="popover" data-placement="top" data-content="Create New Case"
                 class="btn btn-danger btn-label h5 text-white btn-load">
            <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i>&nbsp;Create Case
        </a>
    </div>

    {{-- <button type="button" class="btn btn-success btn-label waves-effect waves-light"><i class="ri-check-double-line label-icon align-middle fs-16 me-2"></i> Search</button> --}}
    {{-- <button id="prev_text" type="button" class="btn btn-light btn-icon waves-effect" disabled><i
                class="ri-arrow-up-line"></i></button>
        <button id="next_text" type="button" class="btn btn-light btn-icon waves-effect" disabled><i
                class="ri-arrow-down-line"></i></button>
        <button id="clear_text" type="button" class="btn btn-light btn-icon waves-effect" disabled><i
                class="ri-close-line"></i></button> --}}

</div>
