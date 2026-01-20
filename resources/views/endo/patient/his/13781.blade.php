<script>
    //โรงพยาบาล รามาธิบดี

    function hn_form_hisconnect(hn){
        $.post("http://10.6.85.148/endocapture5.0/api/ramaconnect",{
            event   : "check_hn",
            hn      : hn,
        },function(data, status){
            if(data!="false"){
                var check_hn = JSON.parse(data);
                console.log(check_hn);
                if(check_hn.status){
                    $("#hn_return").html(check_hn.hn)
                    $("#name_return").html(check_hn.firstname+' '+check_hn.lastname)
                    $('#patient_name').text('Name : '+check_hn.firstname+' '+check_hn.lastname);
                    $('#patient_hn').text('HN : '+check_hn.hn);
                    $('#mi_modal').modal('show');
                    $("#prefix").val(check_hn.prefix);
                    $("#first_name").val(check_hn.firstname);
                    $("#last_name").val(check_hn.lastname);
                    var gender = 1;
                    if(check_hn.gender!=1){gender = 2;}
                    $("select[name=gender]").val(gender).change();
                    $("#birthday").val(check_hn.day).change();
                    $("#birthmonth").val(check_hn.month).change();
                    $("#birthyear").val(check_hn.year).change();
                    $("#agenew").val(check_hn.age);

                    // setTimeout(() => {$("#agenew").val(check_hn.age);}, 1000);
                }
            }
        });
    }

</script>
