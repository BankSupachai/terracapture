<script>
    //โรงพยาบาล ศิริราชปิยะ

    function hn_form_hisconnect(hn){
        $.post("{{url('api/patientget')}}",{
            event   : "sirirajpiya01",
            hn      : hn,
        },function(val, status){
            var data = JSON.parse(val);
            console.log(data);



            // if(data!="false"){
            //     console.log(check_hn);
            //     if(check_hn.status){
            //         $("#hn_return").html(check_hn.hn)
            //         $("#name_return").html(check_hn.firstname+' '+check_hn.lastname)
            //         $('#patient_name').text('Name : '+check_hn.firstname+' '+check_hn.lastname);
            //         $('#patient_hn').text('HN : '+check_hn.hn);
            //         $('#mi_modal').modal('show');
            //         $("#prefix").val(check_hn.prefix);
            //         $("#first_name").val(check_hn.firstname);
            //         $("#last_name").val(check_hn.lastname);
            //         var gender = 1;
            //         if(check_hn.gender!=1){gender = 2;}
            //         $("select[name=gender]").val(gender).change();
            //         $("#birthday").val(check_hn.day).change();
            //         $("#birthmonth").val(check_hn.month).change();
            //         $("#birthyear").val(check_hn.year).change();
            //         $("#agenew").val(check_hn.age);
            //     }
            // }
        });
    }

</script>
