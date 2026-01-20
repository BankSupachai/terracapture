<div class="col-12 p-0">
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <h5>Stenting</h5>
            <div class="row mt-3">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-5 pe-6">
                            <div class="row">
                                @include('case.component.ercp.stent_biliary')
                                @include('case.component.ercp.stent_pancreatic')

                            </div>
                        </div>
                        {{-- <div class="col-1"></div> --}}
                        <div class="col-7 mt-4">
                            <div class="row">
                                @include('case.component.ercp.stent_metalic')

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<script>
    $(document).ready(function () {


    //    (`$("#{{md5("Biliary Stenting Plastic Stent")}}")`).prop("checked", true);
        // $("#plastic_toggle").toggle(500);
        // $("#pancreatic_toggle").toggle(500);
        // $("#metalic_toggle").toggle(500);

        });


        // (`$("#{{md5("Biliary Stenting Plastic Stent")}}")`).click(function(){
        // $("#plastic_toggle").toggle(500);
        // $("#pancreatic_toggle").toggle(500);
        // $("#metalic_toggle").toggle(500);
        // })

        </script>

<script>

    $('.stent').on('change', function () {
        let subgroup = $(this).attr('subgroup')
        let datagroup = $(this).attr('datagroup')
        let dataindex = $(this).attr('dataindex')
        let name  = $(this).attr('name')
        let head  = $(`.ck-stent-head[datagroup="${datagroup}"]`)
        let sub   = $(`.ck-stent-sub[datagroup="${datagroup}"][subgroup="${subgroup}"]`)
        let ck    = $(`.ck-stent[datagroup="${datagroup}"][subgroup="${subgroup}"][dataindex="${dataindex}"]`)
        let ck_other = $(`.ck-stent[datagroup="${datagroup}"][subgroup="${subgroup}"]`)
        if(name != undefined && name != ''){
            let sel_val = $(this).val()
            if(sel_val != ''){
                if(!ck_other.is(':checked')) ck_other.prop('checked', true).change()
            } else ck_other.prop('checked', false)
            get_checked_ck(datagroup)
            return
        }

        let inputs = $(`.stent[datagroup="${datagroup}"][subgroup="${subgroup}"][dataindex="${dataindex}"]`)
        if(inputs){
            let is_empty = 0
            for (let i = 0; i < inputs.length; i++) {
                let val = $($(inputs)[i]).val()
                if(val == '') is_empty += 1
            }
            if(is_empty == inputs.length) ck.prop('checked', false)
            // need more if user want auto
        }
        let dm = $($(`.${subgroup}-dm`)[dataindex]).val()
        let cm = $($(`.${subgroup}-cm`)[dataindex]).val()
        let pos = $($(`.${subgroup}-pos`)[dataindex]).val()
        let type = $($(`.${subgroup}-type`)[dataindex]).val()

        if((dm != '' && dm != undefined) ||
        (cm != '' && cm != undefined) || (pos != '' && pos != undefined) || (type != '' && type != undefined)){
            if(!head.is(':checked')) head.prop('checked', true)
            if(!sub.is(':checked')) sub.prop('checked', true)
            $(`.ck-${subgroup}-${dataindex}`).prop('checked', true)
        } else {
            let checkboxes = $(`.ck-stent[datagroup="${datagroup}"][subgroup="${subgroup}"]`)
            let checked_num = 0
            for (let i = 0; i < checkboxes.length; i++) {
                if($($(checkboxes)[i]).is(':checked')) checked_num += 1
            }
            if(checked_num == 0) sub.prop('checked', false)
        }
        if(name != undefined) if(name.includes('other')) return
        save_stent(subgroup)
        get_checked_ck(datagroup)
    })

    $('.ck-stent').on('change', function () {
        let status = $(this).is(':checked')
        let datagroup = $(this).attr('datagroup')
        let subgroup = $(this).attr('subgroup')
        let dataindex = $(this).attr('dataindex')
        let head  = $(`.ck-stent-head[datagroup="${datagroup}"]`)
        let sub = $(`.ck-stent-sub[datagroup="${datagroup}"][subgroup="${subgroup}"]`)
        if(datagroup == 'pancreaticstent' ){
            let checked_num = 0
            let checkboxes = $(`.ck-stent[datagroup="${datagroup}"]`)
            for (let i = 0; i < checkboxes.length; i++) {
                if($($(checkboxes)[i]).is(':checked')) checked_num += 1
            }

            if(checked_num == 0){
                if(head.is(':checked')) head.prop('checked', false);
            } else {
                if(!head.is(':checked')) head.prop('checked', true)
            }

            if(datagroup == 'pancreaticstent' ){
                get_checked_ck(datagroup)
            }
        } else {
            let checked = $(`.ck-stent[datagroup="${datagroup}"]:checked`).map(function() { return this.value; }).get()
            if(checked.length == 0) {
                head.prop('checked', false)
                if(sub) sub.prop('checked', false)
            }
        }

        let subgroups = ['Prophylactic', "Therapeutic", "Unflanged type", "Flanged type"]
        if(subgroups.includes(subgroup)){
            if(!$(this).is(':checked')) $(`select[datagroup="${datagroup}"][subgroup="${subgroup}"]`).val("").focusout()
            get_checked_ck(datagroup)
            return
        }

        if(status == false){
            if((dataindex == 9 && subgroup == 'metallicstent') || (dataindex == 6 && subgroup == 'plasticstent')){
                $(`.${subgroup}unit_other`).val('').focusout()
            }
            $($(`.${subgroup}-dm[datagroup="${datagroup}"][subgroup="${subgroup}"]`)[dataindex]).val('').focusout()
            $($(`.${subgroup}-cm[datagroup="${datagroup}"][subgroup="${subgroup}"]`)[dataindex]).val('').focusout()
            $($(`.${subgroup}-pos[datagroup="${datagroup}"][subgroup="${subgroup}"]`)[dataindex]).val('').focusout()
            $($(`.${subgroup}-type[datagroup="${datagroup}"][subgroup="${subgroup}"]`)[dataindex]).val('')
            console.log($($(`.${subgroup}-type[datagroup="${datagroup}"][subgroup="${subgroup}"]`)[dataindex]));
            $($(`.${subgroup}-dm[datagroup="${datagroup}"][subgroup="${subgroup}"]`)[dataindex]).change()
        }
    })

    $('.stent-other').on('change', function () {
        let datagroup = $(this).attr('datagroup')
        let subgroup = $(this).attr('subgroup')
        let dataindex = $(this).attr('dataindex')
        let val = $(this).val()
        let ck = $(`.ck-stent[datagroup="${datagroup}"][subgroup="${subgroup}"][dataindex="${dataindex}"]`)
        if(val != '' && val != undefined){
            if(!ck.is(":checked")) ck.prop('checked', true)
        }
        
    })

    function save_guidewire(){
        let main_arr = []
        let lg = $('.guidewire-type').length
        for (let i = 0; i < lg; i++) {
            let sub_arr = {}
            let type = $($('.guidewire-type')[i]).val()
            let size = $($('.guidewire-size')[i]).val()
            if((type != '' || size != '') && (type != undefined || size != undefined) ){
                if(type == undefined) type = '' 
                if(size == undefined) size = ''
                sub_arr['type'] = type
                sub_arr['size'] = size
                main_arr.push(sub_arr)
            }
        }

        let to_json = {}
        to_json['cannuguidewire'] = main_arr
        call_savejsonedit('cannuguidewire', to_json, true)
    }

    function save_stent(stent_type, e=''){
        let main_arr = []
        let lg = $(`.${stent_type}-dm`).length
        for (let i = 0; i < lg; i++) {
            let sub_arr = {}
            let fr = $($(`.${stent_type}-dm`)[i]).val()
            let cm = $($(`.${stent_type}-cm`)[i]).val()
            let pos = $($(`.${stent_type}-pos`)[i]).val()
            let withtype = $($(`.${stent_type}-type`)[i]).val()
            let type = $($(`.${stent_type}-dm`)[i]).attr('datatype')
            fr = fr != '' && fr != undefined ? fr.trim() : ''
            cm = cm != '' && cm != undefined ? cm.trim() : ''
            pos = pos != '' && pos != undefined ? pos.trim() : ''
            withtype = withtype != '' && withtype != undefined ? withtype.trim() : ''
            if((fr != '' || cm != '' || pos != '' || withtype != '') && (fr != undefined || cm != undefined || pos != undefined || withtype != undefined) ){
                sub_arr['fr'] = fr
                sub_arr['cm'] = cm
                sub_arr['pos'] = pos
                sub_arr['with'] = withtype
                if(type != '' && type != undefined) sub_arr['type'] = type
                main_arr.push(sub_arr)
                console.log(sub_arr, main_arr);
            }
        }
        let to_json = {}
        to_json[stent_type] = main_arr
        call_savejsonedit(stent_type, to_json, true, true)
    }

    $('.ck-stent-head').on('change', function(){
        let is_checked = $(this).is(':checked')
        let datagroup = $(this).attr('datagroup')
        let subgroup = $(this).attr('subgroup')
        if(!is_checked){
            $(`.ck-stent-sub[datagroup="${datagroup}"]`).prop('checked', false).change()
            $(`.ck-stent[datagroup="${datagroup}"]`).prop('checked', false).change()
            $(`.stent[datagroup="${datagroup}"]`).val('').change()
            $(`select[datagroup="${datagroup}"]`).val('').focusout()
        }
    })

    $('.ck-stent-sub').on('change', function () {
        let datagroup = $(this).attr('datagroup')
        let subgroup = $(this).attr('subgroup')
        if(!$(this).is(':checked'))  {
            $(`.stent[subgroup="${subgroup}"]`).val('').change()
            $(`.stent-other[subgroup="${subgroup}"]`).val('').change().focusout()
            $(`select[subgroup="${subgroup}"]`).val('').focusout()
            $(`.ck-stent[subgroup="${subgroup}"]`).prop('checked', false).change()
            let ck_sub = $(`.ck-stent-sub[datagroup="${datagroup}"]`)
            if(ck_sub){
                let sub_ck = 0
                for (let i = 0; i < ck_sub.length; i++) {
                    if($($(ck_sub)[i]).is(':checked')) sub_ck += 1
                }

                if(sub_ck == 0) $(`.ck-stent-head[datagroup="${datagroup}"]`).prop('checked', false)
                else $(`.ck-stent-head[datagroup="${datagroup}"]`).prop('checked', true)
            }
        }
    })

    function get_checked_ck(datagroup){
        let checked = $(`.ck-stent[datagroup="${datagroup}"]:checked`).map(function() { return this.value; }).get()
        $.post('{{ url('api/procedure') }}', {
            event: "radiosave",
            cid: cid,
            datagroup: datagroup,
            value: checked // JSON.stringify(checked)
        }, function(d, s) {})
    }
</script>
