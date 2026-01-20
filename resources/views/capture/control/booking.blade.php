@php
    use App\Models\Mongo;
    use App\Models\Patient;
@endphp

<style>
    .select2-container--default .select2-selection--multiple {
        background: #f3f6f9 !important;
    }

    .center {
        text-align: center;
    }
</style>



<div class="col-lg-12 p-0 m-0">
    <div class="card mb-0 mt-2 ">
        <div class="card-body m-0 px-0">
            <div class="row m-0 ">
                <div class="h5 fw-head-dark ms-4 mb-3">Booking
                    ({{ isset($tb_booking) ? count($tb_booking) : 0 }})
                </div>
                <div class="col-lg-12 p-0 m-0">
                    <div class="table-responsive p-0">
                        <table class="table table-borderless booking">
                            <tr class="bg-light" style="color: #9599AD;">
                                {{-- <td></td>
                                <td></td>
                                <td>HN</td>
                                <td>Patient name</td>
                                <td>Endoscopist</td>
                                <td>Procedure</td>
                                <td>Description</td>
                                <td></td> --}}

                                <td></td>
                                <td></td>
                                <td>HN</td>
                                <td>Patient name</td>
                                <td>Endoscopist</td>
                                <td>Procedure</td>
                                <td></td>
                                <td></td>
                                <td>Description</td>
                                <td></td>
                            </tr>

                            @php
                                $i = 0;
                                $all_procs = [];
                            @endphp
                            @isset($tb_booking)
                                @foreach ($tb_booking as $data)
                                    @php
                                        $data = (object) $data;
                                        $_id = $data->id;
                                        $bk_date = $data->date;
                                        $procs = [];
                                        $new_id = (array) $_id;
                                        $ids = [$new_id['oid']];
                                        $all_procs[] = $data->procedure ?? [];
                                        $patientname = Patient::fullname_patient($data->hn);
                                    @endphp
                                    <tr style="border-bottom: 1px solid #E9EBEC;">

                                        <td colspan="2" class="center">
                                            <form method="post" action="{{ url('book/createcase') }}">
                                                <button type="submit" class="btn btn-success w-md btn-sm">Check in</button>

                                        </td>

                                        <td class="can-search">{{ @$data->hn }}</td>
                                        <td style="color: #245788" class="can-search">{{ @$patientname }}</td>
                                        {{-- <td></td> --}}
                                        <td class="can-search">{{ @$data->physician_name }}</td>
                                        <td class="can-search">


                                            @csrf
                                            <input type="hidden" name="event" value="createcasebook">
                                            <input type="hidden" name="noteid" value="{{ @$id }}">
                                            <input type="hidden" name="date" value="{{ $data->date }}">
                                            <input type="hidden" name="hn" value="{{ $data->hn }}">
                                            <input type="hidden" name="physician" value="{{ @$data->physician }}">

                                            {{-- <input type="text" name="procedure[]" required> --}}

                                            <select name="procedure[]" class="sel_procedure" multiple="multiple" required>
                                                @foreach ($procedure as $pro)
                                                    <option value="{{ $pro['code'] }}">{{ $pro['name'] }}</option>
                                                @endforeach
                                            </select>


                                            </form>



                                            {{-- @foreach ($data->procedure as $val)
                                                @php
                                                    $tb_procedure = (object) Mongo::table('tb_procedure')
                                                        ->where('code', $val)
                                                        ->first();
                                                    $procs[]      = @$tb_procedure->name;
                                                @endphp
                                                {{@$tb_procedure->name}}
                                                @if (count($data->procedure) > 1)
                                                    <br>
                                                @endif
                                            @endforeach --}}
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div class="need-hidden">
                                                <input class="need-hidden" type="text" id="Booking_{{ $i }}"
                                                    value="{{ $data->hn }}" hidden>
                                                <input class="need-hidden" type="text"
                                                    id="Booking_{{ $i }}app" value="{{ @$bk_date }}"
                                                    hidden>
                                            </div>
                                            {{-- @dd($data);
                                            {{$data->desciption}} --}}
                                            <input type="text" class="form form-control"
                                                onchange="save_description('Booking', '{{ $i }}', this.value, '{{ $i }}', '{{ $_id }}')"
                                                value="{{ @$data->description }}">
                                        </td>
                                        <td></td>
                                        {{-- <td class="text-end">
                                            <i class="ri-close-fill ri-2x text-danger" style="visibility: hidden;" onclick="cancel_case('{{ @$i }}', '{{json_encode($procs)}}', '{{json_encode($ids)}}', true, 'Booking')"></i>
                                        </td> --}}
                                    </tr>
                                    @php
                                        $i += 1;
                                    @endphp
                                @endforeach
                            @endisset
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $(".sel_procedure").select2({
            placeholder: "Select Procedure",
            allowClear: true
        });

        let all_procs = @json($all_procs);

        for (let i = 0; i < $('.sel_procedure').length; i++) {
            $($('.sel_procedure')[i]).val(all_procs[i]).trigger('change')
            console.log(all_procs[i]);

        }


        // $(".sel_procedure").on("select2:unselect", function(e) {
        //    $(this).val(null).trigger('change');
        // });




    })
</script>
