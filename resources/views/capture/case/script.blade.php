{{-- <script src="{{ url('public/sample/assets/plugins/global/plugins.bundle.js') }}"></script> --}}

<script>
    $(".saveradio").click(function() {
        let name = $(this).attr("name");
        let value = $(this).attr("value");
        let cid = "{{ $cid }}";
        $.post('{{ url('api/procedure') }}', {
            event: "saveradio",
            name: name,
            value: value,
            cid: cid
        }, function(d, s) {});
    });
</script>

<script>
    $('.savejsongroup').on('focusout', function() {
        // alert(1);
        var name = $(this).attr('group_name');
        var html_id = $(this).attr('id');
        var group_val = [];
        var group_key = [];
        $('[group_name=' + name + ']').each(function() {
            group_val.push($(this).val());
            group_key.push($(this).attr('group_key'));
        });
        $.post('{{ url('api/procedure') }}', {
            event: 'savejsongroup',
            cid: '{{ $cid }}',
            name: name,
            html_id: html_id,
            val: JSON.stringify(group_val),
            key: JSON.stringify(group_key),
            procedure: '{{ $procedure->code }}',
        }, function(d, s) {});
    });
</script>


<script>
    $('.autosave2').bind('focusout', function() {
        var this_id = $(this).attr('id');
        var this_table = $(this).attr('table');
        if (typeof this_table === 'undefined') {
            this_table = "tb_case";
        }
        setTimeout(function() {
            $.post('{{ url('api/procedure') }}', {
                event: 'focusout3',
                name: this_id,
                value: $('#' + this_id).val(),
                table: this_table,
                case_id: '{{ $cid }}',
                comcreate: '{{ $case->comcreate }}',
                procedure: '{{ $procedure->code }}',
            }, function(data, status) {
                if (data == "thai") {}
            });
        }, 1000);
    });
</script>

<script>
    $('.autosave').bind('focusout', function() {
        var this_id = $(this).attr('id');
        var this_table = $(this).attr('table');
        if (typeof this_table === 'undefined') {
            this_table = "tb_case";
        }
        setTimeout(function() {
            $.post('{{ url('api/procedure') }}', {
                event: 'focusout',
                name: this_id,
                value: $('#' + this_id).val(),
                table: this_table,
                case_id: '{{ $cid }}',
                comcreate: '{{ $case->comcreate }}',
                procedure: '{{ @$procedure->code }}',
            }, function(data, status) {
                if (data == "thai") {}
            });
        }, 1000);
    });
</script>


<script>
    $('.savejson').bind('focusout', function() {
        let this_id = $(this).attr('id');
        let this_name = $(this).attr('name')
        let this_type = $(this).attr('type');
        let this_table = $(this).attr('table');
        let value = $('#' + this_id).val();
        let retString = localStorage.getItem("{{ $cid }}")
        let obj = {}

        if (this_type != "checkbox" && value != "") {
            if (retString == null) {
                obj[this_id] = value;
                let text = JSON.stringify(obj);
                localStorage.setItem("{{ $cid }}", text);
            } else {
                obj = JSON.parse(retString)
                obj[this_id] = value;
                console.log('obj: ', obj);
                let text = JSON.stringify(obj);
                localStorage.setItem("{{ $cid }}", text);
            }
        } else {
            if (retString != null) {
                obj = JSON.parse(retString)
            }
            existed_value = []
            $('[name=' + this_name + ']:checked').each(function() {
                existed_value.push($(this).val());
            });
            obj[this_name] = existed_value
            let text = JSON.stringify(obj);
            localStorage.setItem("{{ $cid }}", text);
        }

        if (typeof this_table === 'undefined') {
            this_table = "tb_case";
        }
        if (this_type == "checkbox") {
            $.post('{{ url('api/procedure') }}', {
                event: 'savejson',
                name: this_id,
                value: $(this).prop('checked'),
                table: this_table,
                field: 'case_json',
                id: '{{ $cid }}',
                comcreate: '{{ $case->comcreate }}',
                procedure: '{{ $procedure->code }}',
            }, function(data, status) {});
        } else {
            $.post('{{ url('api/procedure') }}', {
                event: 'savejson',
                name: this_id,
                value: value,
                table: this_table,
                field: 'case_json',
                id: '{{ $cid }}',
                comcreate: '{{ $case->comcreate }}',
                procedure: '{{ $procedure->code }}',
            }, function(data, status) {});
        }
    });
</script>


<script>
    $('.savedoctor').bind('focusout blur', function() {
        $.post('{{ url('api/procedure') }}', {
            event: 'savedoctor',
            value: $('#case_physicians01').val(),
            id: '{{ $cid }}',
        }, function(data, status) {});
    });
</script>


{{-- 333333333333333333333333333333333333333333333333333 --}}


<script>
    $('.edittreatment').bind('focusout blur', function() {
        var treatment_code = $(this).val();
        setTimeout(function() {
            $.post('{{ url('api/procedure') }}', {
                event: 'edittreatment',
                code: treatment_code,
                cid: '{{ $cid }}',
                noteid: '{{ @$case->noteid }}',
                noteidstr: '{{ @$noteid }}'
            }, function(data, status) {});
        }, 1000);
    }).focusout();
</script>

<script>
    $('.savejson_checkbox').focusout(function() {
        var this_name = $(this).attr('name');
        var value = [];
        $('[name=' + this_name + ']:checked').each(function() {
            value.push($(this).val());
        });
        if (this_name != undefined) {
            $.post('{{ url('api/jquery') }}', {
                event: 'savejson_checkbox2',
                idhtml: this_name,
                value: value,
                table: 'tb_case',
                idname: 'case_id',
                id: '{{ $cid }}',
                procedure: '{{ $procedure->code }}',
            }, function(data, status) {});
        }
    });
</script>

<script>
    $('.autosave_checkbox').focusout(function() {
        var this_name = $(this).attr('name');
        var allVals = [];
        $('[name=' + this_name + ']:checked').each(function() {
            allVals.push($(this).val());
        });
        var val = JSON.stringify(allVals);
        $.post('{{ url('api/photomove') }}', {
            event: 'focusout',
            idhtml: this_name,
            value: val,
            table: 'tb_case',
            idname: 'case_id',
            id: '{{ $cid }}',
            procedure: '{{ $procedure->code }}',
        }, function(data, status) {});
    });
</script>


<script>
    let autotextcountpress = 0;
    let autotexttempid = "";
    let autotextsystem = "{{ @$admin->system_autotext }}";
    $('.autotext').on('click keyup', function() {
        // alert();
        var this_id = $(this).attr('id');
        var this_value = $(this).val();

        if (this_id == autotexttempid) {
            autotextcountpress++;
        } else {
            autotexttempid = this_id;
            autotextcountpress = 0;
        }

        if (autotextcountpress >= 0 && autotextcountpress < 10 && autotextsystem == "true") {
            $.post("{{ url('api/photo') }}", {
                event: 'jqinputdropdown',
                textid: this_id,
                value: this_value,
                procedure: "{{ @$procedure->code }}",
            }, function(data, status) {
                dataList = [];
                dataList = JSON.parse(data);
                $('#' + this_id).inputDropdown(dataList, {
                    formatter: data => {
                        return `<li language="${data.value}">` + data.name + '</li>'
                    },
                    valueKey: 'language'
                });
                var wi = $('#' + this_id).css('width');
                $('.jq-input-dropdown').css({
                    'min-width': wi
                });
                $('#jq-input-dropdown_' + this_id).show();
                var html_li = "";
                dataList.forEach(obj => {
                    html_li += '<li language="' + obj['value'] + '">' + obj['value'] + '</li>';
                });
                $('#jq-input-dropdown_' + this_id).html(html_li);
                $('li').on('click', function() {
                    $('#' + this_id).focus();
                });
            });
        } else {
            // alert('คุณพิมพ์เกิน ห้าตัวอักษร');
        }
    });
</script>


<script>

    $('.autotextgroup').on('click keyup', function() {
        var this_id     = $(this).attr('id');
        var this_value  = $(this).val();
        let group       = $(this).attr("group");

        if (this_id == autotexttempid) {
            autotextcountpress++;
        } else {
            autotexttempid = this_id;
            autotextcountpress = 0;
        }

        if (autotextcountpress > 1 && autotextcountpress < 10 && autotextsystem == "true") {
            $.post("{{ url('api/photo') }}", {
                event: 'jqinputdropdown',
                textid: group,
                value: this_value,
                procedure: "{{ @$procedure->code }}",
            }, function(data, status) {
                dataList = [];
                dataList = JSON.parse(data);
                $('#' + this_id).inputDropdown(dataList, {
                    formatter: data => {
                        return `<li language="${data.value}">` + data.name + '</li>'
                    },
                    valueKey: 'language'
                });
                var wi = $('#' + this_id).css('width');
                $('.jq-input-dropdown').css({
                    'min-width': wi
                });
                $('#jq-input-dropdown_' + this_id).show();
                var html_li = "";
                dataList.forEach(obj => {
                    html_li += '<li language="' + obj['value'] + '">' + obj['value'] + '</li>';
                });
                $('#jq-input-dropdown_' + this_id).html(html_li);
                $('li').on('click', function() {
                    $('#' + this_id).focus();
                });
            });
        } else {
            // alert('คุณพิมพ์เกิน ห้าตัวอักษร');
        }
    });
</script>




<script>
    $('.medicationsave').on('input', function() {
        var id = $(this).attr('id')
        var val = $(this).val()
        $.post('{{ url('api/jquery') }}', {
            event: 'save_medicationother',
            key: id,
            value: val,
            id: '{{ @$tb_casemedication->_id }}'
        }, function(data, status) {});
    });
</script>

<script>
    $('#btn_save').click(function() {
        $.post('{{ url('api/photomove') }}', {
            event: 'check-esign',
            cid: '{{ $cid }}',
            hn: '{{ $case->hn }}',
            folderdate: '{{ $folderdate }}',
        }, function(data, status) {
            var json = JSON.parse(data);
            if (json.status == "edit_have") {
                $('#modal_esign').appendTo("body").modal('show');
            } else {
                setTimeout(() => {
                    $('#formviewreport').submit();
                }, 1000);
            }
        });
    });
</script>

<script>
    $('#btn_checksign').click(function() {
        $.post('{{ url('api/photomove') }}', {
            event: 'btn-check-esign',
            cid: '{{ $cid }}',
            folderdate: '{{ $folderdate }}',
            hn: '{{ $case->hn }}'
        }, function(data, status) {
            var json = JSON.parse(data);
            if (json.status == "edit_have") {
                setTimeout(() => {
                    $('#formviewreport').submit();
                }, 1000);
            } else {
                alert('คุณยังไม่ได้ทำการเซ็นชื่อ');
            }
        });
    });
</script>

<script>
    $('#btn_save_hide').click(function() {
        let doctor = $('#case_physicians01').val()
        if (doctor != undefined && doctor != '') {
            setTimeout(() => {
                $('#formviewreport').submit();
            }, 1000);
        } else {

            $('#case_physicians01').focus()
        }
    });



</script>

<script>
    document.addEventListener("keydown", function(event) {
        var ctrlkey = event.ctrlKey;
        let groups  = ['icd9', 'diagnostic', 'mainsub']
        if (ctrlkey && event.keyCode == 46) {
            $(":focus").each(function() {
                var text = $(this).val();
                let group = $(this).attr('group')
                let textid = groups.includes(group) ? group : this.id
                if(group == 'mainsub'){
                    let photoid = $(this).attr('photoid')
                    textid = 'mainsub' + $(`select[photo_id="${photoid}"]`).val() ?? ""
                }
                $(this).val('');
                $.post('{{ url('api/photomove') }}', {
                    event: 'delautotext',
                    text: text,
                    // textid: this.id,
                    textid: textid,
                    procedure: "{{ @$procedure->code }}",
                }, function(data, status) {});
            });
        }
    });
</script>

@if (@$case->semi)
    <script>
        //Semi picture with FTP
        $.post("{{ url('api/procedure') }}", {
            event: "semi",
            cid: "{{ $cid }}"
        }, function(d, s) {});
    </script>
@endif

<script>
    // เฉพาะวชิระอย่างเดียว
    $("#system_autotext").click(function() {
        let val = $(this).prop('checked');
        let temp = "false";
        if (val) {
            temp = "true";
        }
        $.post('{{ url('api/jquery') }}', {
            event: "system",
            systemname: 'system_autotext',
            value: temp
        }, function(data, status) {
            window.location.reload();
        });
    });
</script>

<script>
    var init_room = $('.editroom').val();
    $.post('{{ url('api/photomove') }}', {
        event: 'editroom',
        room_name: init_room,
        cid: '{{ $cid }}',
    }, function(data, status) {})
</script>

<script>
    $(".jsonboxSAVE").click(function() {
        var ele = $(this).attr("name");
        var elements = document.querySelectorAll('input[name="' + ele + '"]:checked');
        var checkedElements = Array.prototype.map.call(elements, function(el, i) {
            return el.value;
        });
        $.post('{{ url('api/case') }}', {
            event: "jsonboxSAVE",
            ele: ele,
            val: checkedElements,
            cid: "{{ $cid }}"
        }, function(data, status) {});
    });
</script>

<script>
    $(".json_del").click(function() {
        var color = $(this).css("color");
        console.log(color)
        if (color == "rgb(73, 80, 87)") {
            $(this).css("color", "red");
        } else {
            $(this).css("color", "#495057");
        }

        var id = $(this).attr('pic_number');
        var case_id = "{{ $cid }}";
        $.post('{{ url('api/procedure') }}', {
            event: "json_del",
            id: id,
            case_id: case_id,
        }, function(data, status) {});
    });
</script>

<script>
    function del_scope(case_id, scope_id) {
        $.post('{{ url('api/jquery') }}', {
            event: 'delete_scope',
            case_id: case_id,
            scope_name: scope_id
        }, function(data, status) {
            if (data == 'success') {
                $(".scope_list" + scope_id).remove()
            }
        })
    }
</script>

<script>
    function add_scope(case_id) {
        var scope_id = $('#scope_add').val()
        if (scope_id) {
            $.post('{{ url('api/jquery') }}', {
                    event: 'add_scope',
                    case_id: case_id,
                    scope_name: scope_id
                },
                function(data, status) {
                    var scope = JSON.parse(data)
                    console.log(scope);
                    var html = `
                <div class="row m-0 cn border-bottom pb-2 scope_list${scope_id}" id="">
                    <div class="col-4">
                        <button type="button" onclick='del_scope("${case_id}","${scope_id}")' class="btn btn-icon btn-light-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                    </div>
                    <div class="col-4">
                        ${scope.scope_name}
                    </div>
                    <div class="col-4">${scope.scope_serial}</div>

                </div>`
                    $("#scope_list").append(html)
                })
        }
    }
</script>

<script>
    function save_mediother(id, val) {
        $.post('{{ url('api/procedure') }}', {
            event: 'medi_other',
            name: id,
            value: val,
            cid: '{{ $cid }}'
        }, function(data, status) {});
    }
</script>

<script>
    function save_medication() {
        var arr = [];
        var arr2 = [];
        var arr3 = [];
        $(".medigroup").each(function() {
            arr.push($(this).val());
        });
        $(".boxmedi").each(function() {
            arr2.push($(this).val());
        });
        $(".medi_unit").each(function() {
            arr3.push($(this).val());
        });

        $.post('{{ url('api/photo') }}', {
            event: "medication_update2",
            name: "medication_unit",
            dose: arr,
            key: arr2,
            unit: arr3,
            cid: "{{ $cid }}"
        }, function(data, status) {});
    }
</script>



<script></script>

<script></script>

<script></script>

<script></script>

<script></script>

<script></script>

<script></script>

<script></script>

<script></script>

<script></script>

<script></script>

<script></script>

<script></script>
