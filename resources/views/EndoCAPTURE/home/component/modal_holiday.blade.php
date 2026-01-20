<div class="modal fade" id="modal_holiday" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <form action="{{url('holiday')}}" method="POST" class="modal-content" autocomplete="off">
                @csrf
                @method('POST')
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">&emsp;<i class="fa fa-map-marker-alt text-danger"></i>&emsp; Holiday Setting &emsp;</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Y-M-D</th>
                            <th>Tittle</th>
                            <th>Detail</th>
                            <th></th>
                        </tr>
                    </thead>
                    @if(isset($holiday))
                    <tbody>
                        @foreach ($holiday as $hld)
                            <tr>
                                <input type="hidden" name="holiday_id_old[]" value="{{@$hld->holiday_id}}">
                                <td><input type="text" name="holiday_day_off_old[{{@$hld->holiday_id}}]" value="{{@$hld->holiday_day_off}}" class="form-control date_holiday"></td>
                                <td><input type="text" name="holiday_tittle_old[{{@$hld->holiday_id}}]" value="{{@$hld->holiday_tittle}}" class="form-control"></td>
                                <td><input type="text" name="holiday_detail_old[{{@$hld->holiday_id}}]" value="{{@$hld->holiday_detail}}" class="form-control"></td>
                                <td><input data-switch="true" name="holiday_ck_old[{{@$hld->holiday_id}}]" type="checkbox" checked="checked" data-on-text="Holiday" data-off-text="Cancel" data-on-color="danger" data-off-color="secondary"/></td>
                            </tr>
                        @endforeach
                    </tbody>
                    @endif
                    <tbody id="add_holiday">
                        {{-- <tr>
                            <td><input type="text" name="holiday_day_off[]" class="form-control date_holiday"></td>
                            <td><input type="text" name="holiday_tittle[]" class="form-control"></td>
                            <td><input type="text" name="holiday_detail[]" class="form-control"></td>
                            <td><input data-switch="true" type="checkbox"  checked="checked" data-on-text="Holiday" data-off-text="Cancel" data-on-color="danger" data-off-color="secondary"/></td>
                        </tr> --}}
                    </tbody>
                    <tbody>
                        <tr>
                            <td colspan="4"><button type="button" class="btn btn-success" id="btn_holiday">Add Holiday</button></td>
                        </tr>
                    </tbody>
                </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
