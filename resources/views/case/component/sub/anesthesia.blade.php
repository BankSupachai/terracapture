<div class="row">
    <div class="col-2">
       <b>Anesthesia</b> &nbsp;&nbsp;
    </div>
    <div class="col-2 text-nowrap">
        @php
            $anes = isset($case->anesthesia) ? $case->anesthesia : [];

            // ถ้าเป็น string (เช่น JSON string หรือ single value) ให้แปลงเป็น array
            if (!is_array($anes)) {
                // ลองแปลงจาก JSON string ก่อน
                $decoded = json_decode($anes, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $anes = $decoded;
                } elseif (!empty($anes)) {
                    // ถ้าไม่ใช่ JSON ให้ใส่เป็น array element เดียว
                    $anes = [$anes];
                } else {
                    $anes = [];
                }
            }

            // Trim whitespace ในทุกค่าของ array
            $anes = array_map('trim', $anes);

            $is_na = '';
            if (count($anes) == 0 && (empty(@$case->anesthesia) || @$case->anesthesia == '')) {
                $is_na = 'checked';
        }
        @endphp
        <button type="button" class="btn btn-checkbox btn-label waves-effect waves-light btn-sm" id="btn_anesthesia">
            <i class="ri-checkbox-blank-line label-icon align-middle fs-16 me-2 text-light"></i>
            None Anesthesia
        </button>
    </div>
   <div class="row">

       @foreach (isset($procedure->anesthesia) ? $procedure->anesthesia : [] as $box)
           @php
               // Trim $box และเตรียมสำหรับการเปรียบเทียบ
               $boxTrimmed = trim($box);

               // เปรียบเทียบแบบไม่สนใจช่องว่าง (normalize ทั้งสองฝั่ง)
               $checked = '';
               foreach($anes as $aneValue) {
                   // เปรียบเทียบโดยลบช่องว่างทั้งหมดออก
                   if (str_replace(' ', '', strtolower($boxTrimmed)) === str_replace(' ', '', strtolower($aneValue))) {
                       $checked = 'checked';
                       break;
                   }
               }
           @endphp
           <div class="col-4">
               <input type="checkbox"
                   name="anesthesia"
                   class="form-check-input savejson_checkbox ck-val savejson"
                   id="anesthesia{{ str_replace(' ', '', $boxTrimmed) }}"
                   value="{{ $boxTrimmed }}"
                   {{ $checked }}>
               <label class="ms-3" for="anesthesia{{ str_replace(' ', '', $boxTrimmed) }}">&nbsp;{{ $box }}</label>
           </div>
       @endforeach
   </div>
    <div class="col-12">
        <input class="form-control autotext savejson" id="anesthesiaother" placeholder="Other Anesthesia" type="text"
            autocomplete="off" value="{{ @$case->anesthesiaother }}" />
    </div>
    <div class="col-12">&nbsp;</div>
</div>

<script type="text/javascript">
    $("#btn_anesthesia").click(function() {
        $("input[name='anesthesia']").prop("checked", false);
        $("#anesthesiaother").val("None Anesthesia");
        $("#anesthesiaother").focus();
        $.post('{{ url('api/jquery') }}', {
            event: 'savejson_checkbox2',
            idhtml: 'anesthesia',
            value: [],
            table: 'tb_case',
            idname: 'case_id',
            id: '{{ $cid }}',
            procedure: '{{ $procedure->code }}',
        }, function(data, status) {});
    });

    $('.ck-val').on('click', function () {
        let name = $(this).attr('name')
        if(name == 'anesthesia'){
            let other = $(`#${name}other`).val()
            if(other.includes('No')){
                $(`#${name}other`).val('')
            }
        }
    })
</script>
