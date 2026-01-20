<script>
function hn_form_hisconnect(hn){
    //โรงพยาบาล มหาราชโคราช
    @php
        $ip_hisconnect = "192.168.124.242";
        if(getCONFIG('admin')->com_name!="endocapture"){
            $ip_hisconnect = "192.168.87.200";
        }
    @endphp

    $.post("http://{{$ip_hisconnect}}/hisconnect/public/api/patient",{
        event   : "check_hn",
        hn      : hn,
    },function(data, status){
        var check_hn = JSON.parse(data);
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
            if(check_hn.sex=="ญ"){gender = 2;}
            $("select[name=gender]").val(gender).change();
            $("#birthday").val(check_hn.day).change();
            $("#birthmonth").val(check_hn.month).change();
            $("#birthyear").val(check_hn.year).change();
            $("#agenew").val(check_hn.age);
            setTimeout(() => {$("#agenew").val(check_hn.age);}, 1000);
        }
    });
}

</script>
