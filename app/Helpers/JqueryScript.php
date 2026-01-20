<?php

function textareajson($id,$case){
    $url = url('photomove');
    $str = "<script>
                CKEDITOR.replace('$id', {
                    toolbar:[],removePlugins: 'elementspath',
                    resize_enabled: false,height:'100px'});
                CKEDITOR.instances['$id'].on('blur', function() {
                var text = CKEDITOR.instances['$id'].getData();
                $.post('$url',{
                    event       : 'savejson',
                    name        : '$id',
                    value       : text,
                    table       : 'tb_case',
                    idname      : 'case_id',
                    caseuniq   : '$case->caseuniq',
                    comcreate   : '$case->comcreate',
                    procedure   : '$case->case_procedure',
                },function(data,status){});
                });
            </script>
            ";
    return $str;
}

