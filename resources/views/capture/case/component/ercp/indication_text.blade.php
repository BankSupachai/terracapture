<div class="col-12">
    <button type="button" class="btn btn-checkbox btn-label waves-effect waves-light btn-sm none-indicationGroup" id="{{md5('none indication')}}">
        <i class="mdi mdi-checkbox-outline label-icon align-middle fs-16 me-2 text-light"></i>
        None Indication
    </button>
</div>

@php
    // $arr = array(1,2,3,4,5,6,7,8,9,10);
    $indicationGroup = isset($case->indicationGroup_other) ? $case->indicationGroup_other : [];
@endphp

<div class="col-12">
    {{-- @foreach ($arr as $data)
        <input type="text" name="indicationtext[]" class="form-control mt-2 indication-group-text" placeholder="indication">
    @endforeach --}}
    @for ($i = 0; $i < 9; $i++)
        <input type="text" name="indicationtext[]" class="form-control mt-2 indication-group-text" placeholder="indication" value="{{@$indicationGroup[$i]}}">
    @endfor
</div>

<script>
    // indication //
    let indiation_index = []
    $('.indication-group').on('change', function (e) {
        let is_checked = $(e.target).is(':checked')
        let hasgroup = $(e.target).attr('hasgroup')
        let hasselect = $(e.target).attr('hasselect')

        if($($('.indication-group-text')[0]).val() == 'None indication'){
            $($('.indication-group-text')[0]).val('')
        }

        if(hasgroup == 'true'){
            if(!is_checked) remove_indicationgroup(e.target)
            return;
        }

        if(hasselect == 'true') {
            if(!is_checked){
                $(`.sel-indication-group[data-id="${$(e.target).attr('id')}"]`).val('').focusout()
                remove_indicationgroup(e.target)
                return
            }
        }

        if(is_checked){
            set_indicationgroup(e.target)
        } else {
            remove_indicationgroup(e.target)
        }
    })

    $(".sel-indication-group").on('change', function (e) {
        let id = $(this).data('id')
        let val = $(this).val()
        let head = $(`#${id}`).val()
        if(val != ''){
            $(`#${id}`).prop('checked', true).change()
            // อัปเดตค่าในช่อง indicationtext[] เมื่อมีการเลือก select
            updateIndicationTextFromSelect(id, val)
        } else{
            $(`#${id}`).prop('checked', false).change()
        }
        save_checkbox($(`#${id}`))

        let current_texts = []
        current_texts = get_indicationgrouptext(current_texts)
        save_textarea('indicationGroup', false, current_texts)
    })

    $('.indication-group-text').on('change', function(e){
        let current_texts = []
        current_texts = get_indicationgrouptext(current_texts)
        save_textarea('indicationGroup', false, current_texts)
    })

    $('.none-indicationGroup').on('click', function(){
        // clear checkbox
        let checkboxes = document.querySelectorAll(`.checkboxgroupsave:checked[datagroup="indicationGroup"]`);
        for (let i = 0; i < checkboxes.length; i++) {
            let status = $($(checkboxes)[i]).is(':checked')
            if(status){
                $($(checkboxes)[i]).click()
            }
        }
        // clear all inputs
        for (let k = 0; k < $('.indication-group-text').length; k++) {
            let text = $($('.indication-group-text')[k]).val('').change()
        }
        // clear select
        for (let k = 0; k < $('.sel-indication-group').length; k++) {
            $($('.sel-indication-group')[k]).val('').change()
        }
        $($('.indication-group-text')[0]).val('None indication').change()
    })

    function get_indicationgroup(elem){
        let id = $(elem).attr('id')
        let hasgroup = $(elem).attr('hasgroup')
        let hasselect = $(elem).attr('hasselect')
        let val = $(elem).val()
        if(hasselect == 'true'){
            let select = $(`.sel-indication-group[data-id="${id}"]`).find(":selected").data('value')
            if(select == undefined){
                select = ''
            }
            val = `${val} ${select}`
        } else if(hasgroup == 'true'){
            val = ''
        }
        return val
    }

    function get_indicationgrouptext(current_texts){
        for (let k = 0; k < $('.indication-group-text').length; k++) {
            let text = $($('.indication-group-text')[k]).val()
            current_texts.push(text)
        }
        return current_texts
    }

        function set_indicationgroup(e){
        let is_write = false
        let is_found = false
        let current_texts = []
        let hasselect = $(e).attr('hasselect')
        let checkboxValue = $(e).val()

        // ถ้ามี select ให้ตรวจสอบว่ามีการเลือกหรือไม่
        if(hasselect == 'true'){
            let id = $(e).attr('id')
            let selectElement = $(`.sel-indication-group[data-id="${id}"]`)
            let selectedValue = selectElement.val()

            // ถ้าไม่ได้เลือก select ให้แสดงแค่คำหัวข้อ
            if(selectedValue == ''){
                this_text = checkboxValue
            } else {
                // ถ้าเลือก select แล้ว ให้ใช้ฟังก์ชัน get_indicationgroup
                this_text = get_indicationgroup(e)
            }
        } else {
            this_text = get_indicationgroup(e)
        }

        split = this_text.split(' ')
        for (let k = 0; k < $('.indication-group-text').length; k++) {
            let exist_text = $($('.indication-group-text')[k]).val()
            let split_text = exist_text.split(' ')
            if(hasselect == 'true'){
                if(split_text[0] == split[0]){
                    $($('.indication-group-text')[k]).val(this_text)
                    is_found = true
                }
            } else {
                if(exist_text.includes(this_text)) is_found = true
            }
        }

        for (let i = 0; i < $('.indication-group-text').length; i++) {
            let text = $($('.indication-group-text')[i]).val()
            if(text == '' && is_write == false && is_found == false){
                $($('.indication-group-text')[i]).val(this_text)
                is_write = true
            }
            let current_text = $($('.indication-group-text')[i]).val()
            current_texts.push(current_text)
        }

        save_textarea('indicationGroup', false, current_texts)
    }

    function remove_indicationgroup(elem){
        let val = $(elem).val()
        let id  = $(elem).attr('id')
        let split_val = val.split(' ')
        let current_texts = []
        let is_remove = false
        let hasselect = $(elem).attr('hasselect')

        for (let k = 0; k < $('.indication-group-text').length; k++) {
            let text = $($('.indication-group-text')[k]).val()
            let split = text.split(' ')
            // if(text.includes(val) ){
                // console.log(split_val , split);

            if(split_val[0] == 'Bilio-enteric'){
                if(split_val[3] == split[3]){
                    $($('.indication-group-text')[k]).val('')
                    is_remove = true
                    continue;
                } else if (split_val.length == 3){
                    if(split_val[0] == split[0] && split_val[1] == split[1] && split_val[02] == split[2]){
                        $($('.indication-group-text')[k]).val('')
                    }
                    is_remove = true
                    continue
                }
            }
            else if(split_val[0] == split[0]){
                $($('.indication-group-text')[k]).val('')
                is_remove = true
                continue;
            }
            current_texts.push(text)
        }
        save_textarea('indicationGroup', false, current_texts)
    }

        function updateIndicationTextFromSelect(checkboxId, selectValue) {
        let checkbox = $(`#${checkboxId}`)
        let checkboxValue = checkbox.val()
        let selectElement = $(`.sel-indication-group[data-id="${checkboxId}"]`)
        let selectedText = selectElement.find(":selected").data('value')

        if (selectedText) {
            let fullText = `${checkboxValue} ${selectedText}`
            let isUpdated = false

            // หาช่อง indicationtext[] ที่มีค่าเดิมของ checkbox นี้อยู่แล้ว
            for (let k = 0; k < $('.indication-group-text').length; k++) {
                let text = $($('.indication-group-text')[k]).val()

                // ตรวจสอบว่าข้อความในช่องนี้เริ่มต้นด้วย checkbox value หรือไม่
                if (text.startsWith(checkboxValue)) {
                    $($('.indication-group-text')[k]).val(fullText)
                    isUpdated = true
                    break
                }
            }

            // ถ้าไม่เจอช่องที่มีค่าเดิม ให้ใส่ในช่องว่างแรก
            if (!isUpdated) {
                for (let i = 0; i < $('.indication-group-text').length; i++) {
                    let text = $($('.indication-group-text')[i]).val()
                    if (text === '') {
                        $($('.indication-group-text')[i]).val(fullText)
                        break
                    }
                }
            }
        }
    }
</script>


