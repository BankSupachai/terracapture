@if (isset($feature->emr) && @$feature->emr)
    @php
        function print_alldrives($disk)
        {
            $alphabet = str_split($disk);
            $i = 0;
            $arr = [];
            $GB = 1073741824;
            foreach ($alphabet as $drive) {
                try {
                    if (!file_exists("$drive:")) {
                        throw new \Exception('This drive does not exist');
                    }
                    $disk_total_space = disk_total_space("$drive:");
                    $disk_free_space = disk_free_space("$drive:");
                    $arr[$i]['drive'] = "$drive:\\";
                    $arr[$i]['department'] = $this->departmentdrive($drive);
                    $arr[$i]['total'] = number_format($disk_total_space / $GB, 1);
                    $arr[$i]['free'] = number_format($disk_free_space / $GB, 1);
                    $arr[$i]['used'] = number_format(($disk_total_space - $disk_free_space) / $GB, 1);
                    $arr[$i]['status'] = 'true';
                } catch (\Throwable $th) {
                    $arr[$i]['drive'] = "$drive:\\";
                    $arr[$i]['department'] = '';
                    $arr[$i]['total'] = 0;
                    $arr[$i]['free'] = 0;
                    $arr[$i]['used'] = 0;
                    $arr[$i]['status'] = 'false';
                }
                $i++;
            }
            $new_arr = [];
            foreach ($arr as $index => $disk_data) {
                $new_arr[] = $disk_data;
            }
            return $new_arr;
        }

        $emrdrive = configTYPE('path', 'path_emr');
        $disk_store = print_alldrives($emrdrive);

    @endphp

    @isset($disk_store)
        @foreach ($disk_store as $index => $d)
            @php
                $disk = $d;
                $drivename = isset($disk['drive']) ? str_replace('\\', '', $disk['drive']) : '';
                $dri = str_replace(':', '', $drivename);
                $no_accessno = false;
            @endphp
            @if ($drivename == '')
                @php continue;  @endphp
            @endif
            <input type="hidden" id="disk_name" value="{{ @$drivename }}">
            <div class="col-8 mt-3" style="@if (@$disk['status'] == 'false') pointer-events: none @endif">
                <input class="form-check-input disk-name @if (str_contains(strtolower(@$lumina->pdf_path . ''), strtolower(@$drivename . ''))) disk-sap @endif" name="send_to"
                    type="checkbox" value="pdf" id="{{ @$drivename }}"
                    @if (!@$pacs->accessionnumberrequest) @if (@$disk['department'] == uget('department'))
                        checked @endif
                @if (@$config->com_type == 'client') checked @endif @else
                    @if (empty($casedata->accessionno)) @php
                            $no_accessno = true;
                        @endphp
                        disabled
                    @else
                        @if (@$disk['status'] != 'false')
                            @if (@$disk['department'] == uget('department'))
                                checked @endif
                    @if (@$config->com_type == 'client') checked @endif @endif
        @endif
    @endif

    data-disk="{{ @$drivename }}">

    @if (@$disk['status'] == 'false')
        <label class="form-check-label" for="{{ @$drivename }}">
            &ensp; {{ @$disk['department'] }} ({{ @$drivename }})
            <span class="d-block text-danger"> &ensp; This drive does not exist </span>
        </label>
    @else
        <label class="form-check-label" for="{{ @$drivename }}">
            @if (str_contains(strtolower(@$lumina->pdf_path . ''), strtolower(@$drivename . '')))
                &ensp; SAP ({{ @$drivename }})
            @elseif(str_contains(strtolower(@$lumina->pdf_video_path . ''), strtolower(@$drivename . '')))
                &ensp; Drive ({{ @$drivename }})
            @else
                &ensp; {{ @$disk['department'] }} ({{ @$drivename }})
            @endif
            @if (
                !str_contains(strtolower(@$lumina->pdf_path . ''), strtolower(@$drivename . '')) &&
                    !str_contains(strtolower(@$lumina->pdf_video_path . ''), strtolower(@$drivename . ''))) <span class="d-block text-muted"> &ensp;
                    Report only </span> @endif
        </label>
    @endif
    </div>

    <div class="col-4 mt-3">
        <button class="btn btn-status-pacs btn-sm fw-bold status-badge" id="pdf_success{{ @$dri }}"
            style="display: none">Success</button>
        <span class="badge badge-soft-warning status-badge" id="pdf_pending{{ @$dri }}"
            style="display: none">PENDING</span>
        @php
            $display = $no_accessno ? 'block' : 'none';
        @endphp
        <span class="badge badge-soft-danger status-badge" id="pdf_noaccess{{ @$dri }}"
            style="display: {{ $display }}">NO ACCESSION NUMBER</span>
    </div>
    @endforeach
@endisset

@endif
