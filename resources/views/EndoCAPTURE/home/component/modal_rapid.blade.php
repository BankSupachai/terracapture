<div class="modal fade" id="modalrapid" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{url("api/case")}}" method="post">
        <input type="hidden" name="cid" id="modalrapid_cid">
        <input type="hidden" name="event" value="update_rapid">
        @csrf
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bg-fff rounded">
            <div class="modal-body p-0">
                <div class="row m-0 bg-primarycapture text-light p-5">
                    <div class="col-12 h3 m-0">
                        Post-Procedure update
                    </div>
                </div>
                <div class="row m-0 pb-5">
                    <div class="col-12">
                        <table class="table table-borderless h5">
                            <tr>
                                <td>HN :</td>
                                <td id="modalrapid_hn"></td>
                                <td>Procedure :</td>
                                <td id="modalrapid_procedure"></td>
                            </tr>
                            <tr>
                                <td>Name :</td>
                                <td id="modalrapid_patientname"></td>
                                <td>Doctor :</td>
                                <td id="modalrapid_doctorname"></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row m-0 mt-2 cn h5">
                    <div class="col-4">
                        Rapid Urease Test
                    </div>
                    <div class="col-4">
                        <select name="rapid" id="modalrapid_rapid" class="form-control form-control-sm">
                            <option value="" selected="selected">Select</option>
                            <option value="1">Positive</option>
                            <option value="2">Negative</option>
                            <option value="3">Pending</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <input type="text" name="rapid_other" id="modalrapid_rapid_other" class="form-control form-control-sm" placeholder="Freetext">
                    </div>
                </div>
                {{-- <div class="row m-0 mt-2 cn h5">
                    <div class="col-4">Follow up</div>
                    <div class="col-4"><input type="text" name="" class="form-control form-control-sm" placeholder="Freetext"></div>
                    <div class="col-4"></div>
                </div>
                <div class="row m-0 mt-2 cn h5">
                    <div class="col-4">Comment</div>
                    <div class="col-8"><input type="text" name="" class="form-control form-control-sm" placeholder="Freetext"></div>
                </div> --}}
                <div class="row m-0 mt-2 mb-5 cn h5">
                    <div class="col-4"></div>
                    <div class="col-4"></div>
                    {{-- <div class="col-4">
                        <div class="row m-0">
                            <div class="col">OTP :  3253</div>
                            <div class="col"><input type="text" name="" class="form-control form-control-sm" placeholder="XXXX"></div>
                        </div>
                    </div> --}}
                    <div class="col-4">
                        <button class="btn btn-success btn-sm w-100">Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
