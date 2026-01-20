<div class="col-12 respondsive_dashboard">
    <div class="card center pb-3 ms-5" style="width: 1759px; margin-top: 15px; margin-left: 30px;">
        <div class="mt-3">
            <form action="http://localhost/lumina/analysis" method="POST">
                <input type="hidden" name="event" value="filter_search">
                <div class="row d-flex align-items-center">
                    <div class="col-2 ms-1">
                        <h5><b>Date</b></h5>
                    </div>
                    <div class="col-2 ">
                        <h5><b>Physician</b></h5>
                    </div>
                    <div class="col-2 ">
                        <h5><b>Procedure</b></h5>
                    </div>
                </div>
                <div class="row d-flex align-items-center">
                    <div class="col-1">
                        <div>
                           <input id="date_from" name="date_from" type="text" onfocus="(this.type='date')"       onblur="(this.type='text')"  placeholder="Start-Date" class="form-control" value="">
                        </div>
                    </div>
                    -
                    <div class="col-1">
                        <div>
                            <input id="date_to" name="date_to" type="text" class="form-control" type="text" onfocus="(this.type='date')"       onblur="(this.type='text')"  placeholder="End-Date" value="">
                        </div>
                    </div>
                    <div class="col-2">
                        <div>
                            <select class="form-select bg-light" aria-label="Default select example" id="physician" name="physician">
                                <option value="">Physician</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <div>
                            <select class="form-select bg-light" aria-label="Default select example" id="procedure" name="procedure">
                                <option value="">Procedure</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-1">
                        <button type="submit" name="submit" value="1" class="btn btn-primary w-100">Filter</button>
                    </div>
                    <div class="col-1">
                        <button type="submit" name="clear" value="1" class="btn btn-warning w-100">Clear</button>
                    </div>
                </form>
                </div>
        </div>
    </div>
</div>
