<div id="modal_addequitment" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Add new equipment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <form action="{{ url('storemanage') }}" method="post">
            <div class="modal-body">
                    @csrf
                    <input type="hidden" name="event" value="equipment_add">
                    <table class="table  table-nowrap">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 80%; ">&ensp; &ensp;Equipment</th>
                                <th style="width: 20%;">Volume</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input name="equipment_name" type="text" class="form-control" required
                                        autocomplete="off">
                                </td>
                                <td>
                                    <input name="equipment_amount" type="number" class="form-control" required
                                        autocomplete="off" value="">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="col-12">
                        Add Equitment by
                        <select class="form-select mt-2" aria-label="Default select example" name="user_equitment" required>
                            <option value="">Select Edit by</option>
                                @foreach ($nurse as $n)
                                @php
                                    $n = (object)$n;
                                @endphp
                                    <option value="{{$n->uid}}" @selected(uid()==$n->uid)>{{fullname($n)}}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success ">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>
