<div class="row">
    <div class="col-12">
        <div class="card ms-2 pb-2" style="margin-top:-15px;">
            <div class="mt-2">
                <form action="">
                    <div class="row d-flex align-items-center p-0 m-0">
                        <div class="col-3 ms-3">
                            <div>
                                <select class="form-select bg-light" aria-label="Default select example" name="date" style="color:#9599AD;">
                                    <option value="Select data range">Select data range</option>
                                    <option value="2024-10-04">2024-10-04</option>
                                    <option value="2023-05-20">2023-05-20</option>
                                    <option value="2023-05-21">2023-05-21</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-auto">
                            <!-- Custom Radio Color -->
                            <div class="form-check form-radio-primary mb-3 pt-2">
                                <input class="form-check-input" type="radio" name="formradiocolor1"
                                    id="formradioRight5" checked>
                                <label class="form-check-label" for="formradioRight5">
                                    All
                                </label>
                            </div>
                        </div>
                        <div class="col-3 text-center">
                            <button type="submit" name="submit" class="btn w-lg btn-primary">
                                <i class="ri-search-line  fs-10"></i> &nbsp;&nbsp;Search
                            </button>
                </form>
                <a href="{{ url('analysis') }}" class="btn w-lg btn-warning">Clear</a>
            </div>
            <div class="col text-end">
                <span id="countdown_dashboard"></span>
            </div>
        </div>
    </div>
</div>

