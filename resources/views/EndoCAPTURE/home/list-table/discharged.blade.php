<div class="list-table pt-0" id="Discharged">
    <div class="row m-0 mb-3">
        <div class="col-lg">
            <div class="input-icon">
                <input type="text" class="form-control search_name_discharged bg-gray-input"
                    placeholder="Search for HN, Name…" onchange="function_search('discharged')" />
                <span><i class="flaticon2-search-1 icon-md"></i></span>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="row mt-res">
                <div class="col-6 ">
                    <select name="" class="form-control search_doctor_discharged " data-choices
                        onchange="function_search('discharged')">
                        <option value="">Physician</option>
                        @foreach ($doctor as $d)
                            <option value="{{ @$d['user_firstname'] }} {{ @$d['user_lastname'] }}">
                                {{ @$d['user_prefix'] }} {{ @$d['user_firstname'] }}
                                {{ @$d['user_lastname'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6">
                    <select name="" class="form-control search_procedure_discharged " data-choices
                        onchange="function_search('discharged')">
                        <option value="">Procedure</option>
                        @foreach ($procedure as $p)
                            <option value="{{ @$p['name'] }}">{{ @$p['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-3"></div>
    </div>

    <div class="allcase-header">
        <table class="table ">
            <thead>
                <tr class="bg-light TextTable-header">
                    {{-- <td>ID</td>
<td>HN</td>
<td>Name</td>
<td>Physician</td>
<td>Procedure</td>
<td>Diagnosis</td>
<td>Complication</td>
<td>Discharge to</td>
<td class="text-center">Action</td> --}}
                    <td class="text-center">Action</td>
                    <td>HN</td>
                    <td>Name</td>
                    <td>Status</td>
                    <td>Physician</td>
                    <td>Procedure</td>
                    <td>Room</td>
                    <td>Urease Test</td>
                    <td>Pre - Diagnosis</td>
                    <td>Complication</td>
                    <td>Description</td>
                </tr>
            </thead>
            <tbody id="discharged_tbody">
                @include('EndoCAPTURE.home.table.06discharged')
            </tbody>
        </table>
    </div>

</div>
