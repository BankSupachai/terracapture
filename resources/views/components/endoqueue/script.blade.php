<script>
    // Socket run
    function pt_n_0()   {$.post("{{url('api/jquery')}}",{event : "pt_n_0",},    function(data, status){box('#QN01',             data,'{{url('resources/box/endoqueue/q01.html')}}');});}
    function pt_n_5()   {$.post("{{url('api/jquery')}}",{event : "pt_n_5",},    function(data, status){box('#QN02',             data,'{{url('resources/box/endoqueue/q01.html')}}');});}
    function pt_n_10()  {$.post("{{url('api/jquery')}}",{event : "pt_n_10",},   function(data, status){box('#QN03',             data,'{{url('resources/box/endoqueue/q01.html')}}');});}
    function pt_n_15()  {$.post("{{url('api/jquery')}}",{event : "pt_n_15",},   function(data, status){box('#QN04',             data,'{{url('resources/box/endoqueue/q01.html')}}');});}
    function pt_o_0()   {$.post("{{url('api/jquery')}}",{event : "pt_o_0",},    function(data, status){box('#QO01',             data,'{{url('resources/box/endoqueue/q01.html')}}');});}
    function pt_o_5()   {$.post("{{url('api/jquery')}}",{event : "pt_o_5",},    function(data, status){box('#QO02',             data,'{{url('resources/box/endoqueue/q01.html')}}');});}
    function pt_o_10()  {$.post("{{url('api/jquery')}}",{event : "pt_o_10",},   function(data, status){box('#QO03',             data,'{{url('resources/box/endoqueue/q01.html')}}');});}
    function pt_o_15()  {$.post("{{url('api/jquery')}}",{event : "pt_o_15",},   function(data, status){box('#QO04',             data,'{{url('resources/box/endoqueue/q01.html')}}');});}
    function skip_all() {$.post("{{url('api/jquery')}}",{event : "skip_all",},  function(data, status){box('#queuepass_list',   data,'{{url('resources/box/endoqueue/q_skip.html')}}');});}
    //
    $("#hn_n_new").hide();
    // Add New HN

    $("#agenew").on('keyup keypress blur change',function(e){
        if($(this).val() >120){
                $(this).val(120);
        }

        $.post("{{url('jquery')}}",
        {
            event   : 'age_change',
            age     : $("#agenew").val(),
        },
        function(data,status){
            var obj = JSON.parse(data);
            $("#birthyear").val(obj[0]);
        });
    });

    $(".add-new-hn").click(function(){
        var data_type = $(this).attr('sub_type');
        var value = $('#text_old_hn').val();
        if(data_type==1){
            value = $('#text_new_hn').val();
        }
        if(value!=null){
            $.post("{{url("jquery")}}",
            {
                event   : "queue_add_hn",
                value   : value,
                data_type : data_type
            },
            function(data, status)
            {
                if(parseInt(data)==1){
                    Swal.fire("Success", "การเพิ่ม HN สำเร็จ", "success");
                    socket.emit('queue','add_n_hn');

                }else{
                    Swal.fire("Fail !", "การเพิ่ม HN ล้มเหลว", "error");
                }
            });
        }else{
            Swal.fire("Fail !", "การเพิ่ม HN ล้มเหลว", "error");
        }
            $('#text_new_hn').val('');
            $('#text_old_hn').val('');
    });
    //

    $(".check_null").keyup(function(){
        var check_data_null = $(this).val();
        if(check_data_null.length==0){
            $(this).addClass('border-danger');
        }else{
            $(this).removeClass('border-danger');
        }
    })
    // Add Patient
    function add_pt(){
        var hn = $("#text_new_hn").val()
        var an = $("#pt_an").val()
        var citizen = $("#pt_pass").val()
        var prefix = $("#pt_prefix").val()
        var firstname = $("#pt_firstname").val()
        var lastname = $("#pt_lastname").val()
        var gender = $("#pt_sex").val()
        var birthdate = $("#birthyear").val()+'-'+$("#birthmonth").val()+'-'+$("#birthday").val()
        var age = $("#agenew").val()
        var email = $("#pt_email").val()
        var allergic = $("#pt_medi").val()
        var congenital_disease = $("#pt_detail").val()
        var emer_name = $("#h_alert").val()
        var phone = $("#pt_phone").val()
        var check_data = 0;
        var text = '';
        var class_input = 'border-danger';
        if(hn==undefined){
            text = 'คุณยังไม่ได้กรอก HN ! <br>'
            $("#text_new_hn").addClass(class_input);
            check_data++;
        }
        if(prefix.length==0){
            $("#pt_prefix").addClass(class_input);
            text += 'คุณยังไม่ได้กรอก คำนำหน้าชื่อ ! <br>'
            check_data++;
        }
        if(firstname.length==0){
            $("#pt_firstname").addClass(class_input);
            text += 'คุณยังไม่ได้กรอก ชื่อ ! <br>'
            check_data++;
        }
        if(lastname.length==0){
            $("#pt_lastname").addClass(class_input);
            text += 'คุณยังไม่ได้กรอก นามสกุล ! <br>'
            check_data++;
        }
        if(age.length==0){
            $("#agenew").addClass(class_input);
            text += 'คุณยังไม่ได้กรอก อายุ หรือ ปีเกิด ! <br>'
            check_data++;
        }
        if(check_data==0){
            $.post("{{url("api/jquery")}}",
            {
                event               : 'add_new_pt',
                hn                  : hn,
                an                  : an,
                citizen             : citizen,
                prefix              : prefix,
                firstname           : firstname,
                lastname            : lastname,
                gender              : gender,
                birthdate           : birthdate,
                email               : email,
                allergic            : allergic,
                congenital_disease  : congenital_disease,
                emer_name           : emer_name,
                phone               : phone,
            },
            function(data,status){
                $('#new_hn').modal('hide')
                ajax_hn(hn)
            });
        }else{
            Swal.fire("Good job!", text, "error");
        }
    }

    function ajax_hn(hn){
        $.post("{{url("jquery")}}",
        {
            event   : "queue_add_hn",
            value   : hn,
            data_type : 1
        },
        function(data, status)
        {
            if(parseInt(data)==1){
                Swal.fire("Success", "การเพิ่ม HN สำเร็จ", "success");
                socket.emit('queue','add_n_hn');

            }else{
                Swal.fire("Fail !", "การเพิ่ม HN ล้มเหลว", "error");
            }
        });
    }
    //

    // Focus Text In Modal
    $('#btn_new_hn').click(function(){
        setTimeout(function(){
            $('#text_new_hn').focus();
            }, 2000);
    })
    $('#btn_old_hn').click(function(){
        setTimeout(function(){
            $('#text_old_hn').focus();
            }, 2000);
    })
    //

    // Check HN
    $("#birthyear,#birthmonth,#birthday").change(function(){
        $.post("{{url('jquery')}}",
        {
            event   : 'birth_change',
            day     : $("#birthday").val(),
            month   : $("#birthmonth").val(),
            year    : $("#birthyear").val()
        },
        function(data,status){
            var obj = JSON.parse(data);
            $("#agenew").val(obj[0]);
        });
    });
    function clear_hn(){
        $('#text_new_hn').val(null);
    }
    $("#text_new_hn").focusout(function(){
        check_hn($(this).val())
    })

    function check_hn(hn){
        $.post("{{url("api/jquery")}}",
            {
                event   : "check_hn",
                hn   : hn,
            },
            function(data, status)
            {
                var check_hn = JSON.parse(data);
                console.log(check_hn)
                if(check_hn.count==1){
                    $("#hn_return").html(check_hn.hn)
                    $("#name_return").html(check_hn.firstname+' '+check_hn.lastname)
                    $('#change_hn').modal('show')
                    $("#hn_n_new").hide();
                }else{
                    $("#hn_n_new").show();
                }
            });
    }
    //


    // Print
    function reprint_q(q_id){
        $.post("{{url("api/jquery")}}",{
                event   : "re_print",
                q_id   : q_id,
        },function(data, status){
            $.get("http://localhost:5000/?qcode="+data,function(d,s){});
            if(data.length>2){
                Swal.fire("Success", "Print สำเร็จ", "success");
            }else{
                Swal.fire("Fail !", "Print ล้มเหลว", "error");
            }
        });
    }
    //


    // Count In Process [Status:1 (Left)] [Status:2 (Right)]
    function count_data(type){
        var size1 = 0;
        var size2 = 0;
        var size3 = 0;
        var size4 = 0;
        if(type==1){
            setTimeout(function(){
                size1 = $('#QN01 tr').length;
                size2 = $('#QN02 tr').length;
                $("#count_n_0").text(size1+size2);
                size3 = $('#QN03 tr').length;
                size4 = $('#QN04 tr').length;
                $("#count_n_10").text(size3+size4);
             },2000);
        }else{
            setTimeout(function(){
                size1 = $('#QO01 tr').length;
                size2 = $('#QO02 tr').length;
                $("#count_o_0").text(size1+size2);
                size3 = $('#QO03 tr').length;
                size4 = $('#QO04 tr').length;
                $("#count_o_10").text(size3+size4);
             },2000);
        }
    }
    //

    // Count Queue Today
    function count_all(){
        $.post("{{url("api/jquery")}}",
            {
                event   : "count_all",
            },
            function(data, status)
            {
                $("#left_count").text(data.left)
                $("#right_count").text(data.right)
            });
    }
    //
    count_all()


    $("#wait_call").click(function(){
        $(".left_wait").removeClass('dp-none');
        $("#tb_wait_detail").addClass('dp-none');
    });
    $("#wait_detail").click(function(){
        $(".left_wait").removeClass('dp-none');
        $("#td_wait_call").addClass('dp-none');
    });


    // Send Data To Modal
    function callmodal(status,this_id,this_type,this_number,this_hn){
        var bg_color = 'bg-danger';
            var text_header = 'เรียกคิวซักประวัติ';
            if((status==0 || status==5) && this_type==1){
                var bg_color = 'bg-danger';
                var text_header = 'เรียกคิวซักประวัติ';
            }
            if((status==10 || status==15) && this_type==1){
                var bg_color = 'bg-warning';
                var text_header = 'เรียกคิวนัดหมาย';
            }
            if((status==0 || status==5) && this_type==2){
                var bg_color = 'bg-yellow';
                var text_header = 'เรียกคิวซักประวัติ';
            }
            if((status==10 || status==15) && this_type==2){
                var bg_color = 'bg-green';
                var text_header = 'เรียกคิวเตรียมตัวทำหัตถการ';
            }
            var this_color= ['bg-danger','bg-warning','bg-yellow','bg-green'];
            for(i=0;i<4;i++){
                $('#this_header').removeClass(this_color[i]);
            }
            $('#this_header').addClass(bg_color);
            $('#id_call').attr('call_id',this_id);
            $('#id_call').attr('call_status',status);
            $('#id_call').attr('call_type',this_type);
            $('#id_next').attr('call_id',this_id);
            $('#id_next').attr('call_status',status);
            $('#id_next').attr('call_type',this_type);
            $('#number_call').html(this_number);
            $('#hn_call').html(this_hn);
            $('#call_status_gen').html(text_header);
    }

    // Data Modal Delete
    function delmodal(status,this_id,this_type,this_number,this_hn){
        var text_header = 'เรียกคิวซักประวัติ';
        if((status==0 || status==5) && this_type==1){
            var text_header = 'เรียกคิวซักประวัติ';
        }
        if((status==10 || status==15) && this_type==1){
            var text_header = 'เรียกคิวนัดหมาย';
        }
        if((status==0 || status==5) && this_type==2){
            var text_header = 'เรียกคิวซักประวัติ';
        }
        if((status==10 || status==15) && this_type==2){
            var text_header = 'เรียกคิวเตรียมตัวทำหัตถการ';
        }
        $('#id_del').attr('del_id',this_id);
        $('#id_del').attr('del_status',status);
        $('#id_del').attr('del_type',this_type);
        $('#number_del').html(this_number);
        $('#hn_del').html(this_hn);
        $('#del_status_gen').html(text_header);
    }
    //


    $("#id_call").click(function(){
        var queue_id     = $(this).attr('call_id')
        var pt_type      = $(this).attr('call_type')
        var queue_status = 0;
        var status_temp  = $(this).attr('call_status')
        if(status_temp===0||status_temp===5){
            queue_status = 10;
        }else if(status_temp===10||status_temp===15){
            queue_status = 20;
        }else{
            queue_status = parseInt(status_temp)+10;
        }
        $.post("{{url("api/jquery")}}",
            {
                event        : "queue_update",
                q_id         : queue_id,
                queue_status : queue_status,
                pt_type      : pt_type
            },
            function(data, status)
            {
            if(parseInt(data)==1){
                Swal.fire("Success", "ส่งไปขั้นตอนถัดไป สำเร็จ", "success");
                if(pt_type==1){
                    socket.emit('queue','next_pt_new');
                }else{
                    socket.emit('queue','next_pt_old');
                }
            }else{
                Swal.fire("Fail !", "ส่งไปขั้นตอนถัดไป ล้มเหลว", "error");
            }
        });
    })


    // Delete Queue
    $('#id_del').click(function(){
        var queue_id     = $(this).attr('del_id')
        var pt_type     = $(this).attr('del_type')
        $.post("{{url("api/jquery")}}",
            {
                event        : "del_queue",
                q_id         : queue_id,
            },
            function(data, status)
            {
            if(parseInt(data)==1){
                Swal.fire("Success", "ยกเลิกคิว สำเร็จ", "success");
                if(pt_type==1){
                    socket.emit('queue','del_pt_new');
                }else{
                    socket.emit('queue','del_pt_old');
                }
            }else{
                Swal.fire("Fail !", "ยกเลิกคิว ล้มเหลว", "error");
            }
        });
    })
    //


    // Queue To Next Process
    $("#id_next").click(function(){
        var queue_id     = $(this).attr('call_id')
        var pt_type      = $(this).attr('call_type')
        var queue_status = 0;
        var status_temp  = $(this).attr('call_status')
        if(status_temp==0||status_temp==5){
            queue_status = 5;
        }else if(status_temp==10||status_temp==15){
            queue_status = 15;
        }else{
            queue_status = parseInt(status_temp)+5;
        }
        $.post("{{url("api/jquery")}}",
            {
                event        : "queue_skip",
                q_id         : queue_id,
                queue_status : queue_status,
                pt_type      : pt_type
            },
            function(data, status)
            {
            if(parseInt(data)==1){
                Swal.fire("Success", "การข้ามคิว สำเร็จ", "success");
                if(pt_type==1){
                    if(queue_status==5){
                        socket.emit('queue','n_skip_5');
                    }else if(queue_status==15){
                        socket.emit('queue','n_skip_15');
                    }
                }else{
                    if(queue_status==5){
                        socket.emit('queue','o_skip_5');
                    }else if(queue_status==15){
                        socket.emit('queue','o_skip_15');
                    }
                }

            }else{
                Swal.fire("Fail !", "การข้ามคิว ล้มเหลว", "error");
            }
        });
    })
    //



    // Function Switch Tab
    $("#wait_for_detail").click(function(){
        $(".right_wait").removeClass('dp-none');
        $("#tb_wait_procedure").addClass('dp-none');
        $("#tb_go_home").addClass('dp-none');
        $("#tb_rest_procedure").addClass('dp-none');
    });
    $("#wait_procedure").click(function(){
        $(".right_wait").removeClass('dp-none');
        $("#tb_wait_for_detail").addClass('dp-none');
        $("#tb_rest_procedure").addClass('dp-none');
        $("#tb_go_home").addClass('dp-none');
    });
    $("#go_home").click(function(){
        $(".right_wait").removeClass('dp-none');
        $("#tb_wait_procedure").addClass('dp-none');
        $("#tb_wait_for_detail").addClass('dp-none')
        $("#tb_rest_procedure").addClass('dp-none');
    });
    $("#rest_procedure").click(function(){
        $(".right_wait").removeClass('dp-none');
        $("#tb_wait_procedure").addClass('dp-none');
        $("#tb_wait_for_detail").addClass('dp-none')
        $("#tb_go_home").addClass('dp-none');
    });
    //


    document.getElementById("text_new_hn").addEventListener("keyup", function() {
        if (/^[a-zA-Z0-9-]+$/.test(this.value)) {
            // document.getElementById("show_lang_in_here").innerHTML = "English";
        } else {
            this.value = "";
        }
    });

    document.getElementById("pt_firstname").addEventListener("keyup", function() {
        if (/^[a-zA-Zกขฃคฅฆงจฉชซฌญฎฏฐฑฒณดตถทธนบปผฝพฟภมยรฤลฦวศษสหฬอฮฯะัาำิีึืฺุูเแโใไๅๆ็่้๊๋์]+$/.test(this.value)) {
                // document.getElementById("show_lang_in_here").innerHTML = "English";
        } else {
            str = this.value;
            str = str.substring(0, str.length - 1);
            this.value = str;
        }
    });

    document.getElementById("pt_lastname").addEventListener("keyup", function() {
        if (/^[a-zA-Zกขฃคฅฆงจฉชซฌญฎฏฐฑฒณดตถทธนบปผฝพฟภมยรฤลฦวศษสหฬอฮฯะัาำิีึืฺุูเแโใไๅๆ็่้๊๋์]+$/.test(this.value)) {
            // document.getElementById("show_lang_in_here").innerHTML = "English";
            } else {
                str = this.value;
                str = str.substring(0, str.length - 1);
                this.value = str;
        }
    });
</script>

