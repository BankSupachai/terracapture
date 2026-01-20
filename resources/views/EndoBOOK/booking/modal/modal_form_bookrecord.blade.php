<div class="modal fade" id="modal_form_bookrecord" tabindex="-1" role="dialog" aria-labelledby="modal_date_text"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_date_text">Confirm Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ url('book/bookrecord') }}" method="post" class="modal-body">
                @csrf
                <input type="hidden" name="event"               value="period_select">
                <input type="hidden" name="form_doctor"         value="{{ @$form_doctor }}">
                <input type="hidden" name="form_patient_type"   value="{{ @$form_patient_type }}">
                <input type="hidden" name="form_urgent"         value="{{ @$form_urgent }}">
                <input type="hidden" name="form_date"           value="" id="form_date">
                <input type="hidden" name="form_period"         value="{{ @$form_period }}">

                @isset($procedure_select)
                    @foreach ($procedure_select as $data)
                        @if ($data != '')
                            <input type="hidden" name="procedure[]" value="{{ $data }}">
                        @endif
                    @endforeach
                @endisset

                @isset($procedure_ex_select)
                    @foreach ($procedure_ex_select as $data)
                        <input type="hidden" name="procedure[]" value="{{ $data }}">
                    @endforeach
                @endisset



                <div class="row m-0">
                    <span class="text-dark-50">Booking Detail</span>
                </div>
                <table class="table table-borderless">
                    <tr>
                        <th>Date :</th>
                        <td><span id="text_date"></span></td>
                        <th>Physician :</th>
                        <td><span>
                                {{ @$physician_select->user_prefix }}
                                {{ @$physician_select->user_firstname }}&nbsp;
                                {{ @$physician_select->user_lastname }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Period :</th>
                        <td><span>{{ @$form_period }}</span></td>
                        <th>Patient Type :</th>
                        <td><span>{{ @$form_patient_type }}</span></td>
                    </tr>
                    <tr>
                        <th>Procedure :</th>
                        <td>
                            @isset($procedure_select_name)
                                @foreach ($procedure_select_name as $data)
                                    <span>{{ $data->procedure_name }}</span>
                                @endforeach
                            @endisset
                        </td>
                        <th></th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Anesthesia :</th>
                        <td>
                            <span>
                                @isset($procedure_ex_select)
                                    @foreach ($procedure_ex_select as $data)
                                        @if ($data == 'anes01')
                                            ga
                                        @endif
                                        @if ($data == 'anes02')
                                            sedation
                                        @endif
                                        @if ($data == 'anes03')
                                            la
                                        @endif
                                    @endforeach
                                @endisset
                            </span>
                        </td>
                        <th></th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Special :</th>
                        <td>
                            <span>
                                @isset($procedure_ex_select)
                                    @foreach ($procedure_ex_select as $data)
                                        @if ($data == 'equ01')
                                            flu
                                        @endif
                                        @if ($data == 'equ02')
                                            spyglass
                                        @endif
                                        @if ($data == 'equ03')
                                            laser
                                        @endif
                                    @endforeach
                                @endisset
                            </span>
                        </td>
                        <th></th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Urgent :</th>
                        <td><span>{{ @$form_urgent }}</span></td>
                        <th></th>
                        <td></td>
                    </tr>
                </table>
                <div class="row m-0">
                    <div class="col-2"></div>
                    <div class="col"><button type="submit" class="btn btn-danger w-100" id="continue">Continue
                            Booking</button></div>
                    <div class="col-2"></div>
                </div>
            </form>
        </div>
    </div>
</div>
