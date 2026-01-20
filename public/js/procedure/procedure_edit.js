$("#name_procedure_edit").change(function(){
    var sp_id_edit = $(this).val();
    var sp_name_edit = $(".pcd"+sp_id_edit).attr('this_name');
    var sp_file_edit = $(".pcd"+sp_id_edit).attr('this_file');
    $("#sp_name_edit").val(sp_name_edit);
    $("#sp_file_edit").val(sp_file_edit);
});
