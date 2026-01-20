<script src="{{ url('assets/capture/bootstrap-select.min.js') }}"></script>
<script>
    $(".ac_reload_btn").click(function() {
        socket.emit('endonode', '{"event":"callother","path":"D:/allindex/socket5/socket5.pyw","code":""}');
        $("#modal_socket5restart").modal("show");
        vdo_check_stop();
    });
</script>
<script>
    async function scope_force_select() {
        try {
            // ใช้ config ที่โหลดไว้แล้วตอนเข้าหน้าเว็บ
            const config = window.appConfig;
            if (config && config.camera && config.camera.force_select) {
                let change_camera = $("#source1_obs").val();
                if (change_camera == "" || change_camera == 0) {
                    $("#modal_scope_alert").modal("show");
                }
            }
        } catch (error) {
            console.error('Error checking force_select:', error);
        }
    }

    function check_null(id) {
        var val = $(`#${id}`).val();
        return (val == '' || val == undefined);
    }


    // Utility Functions
    function edit_time(time) {
        return time.split(':').join(':');
    }

    function get_img_num() {
        return $('.box-capture-list').length;
    }

    function scopecheck(source) {
        let scope = $("#source1_obs").val();
        return (scope == null || scope == "") ? "0" : scope;
    }

    function clear_warning_alert(clear_interval = true) {
        if (clear_interval) clearInterval(vdo_file_interval);
        time_alert = 0;
        new_vdosize = 0;
        old_vdosize = 0;
    }

    // Image Functions
    function testImage(URL) {
        var tester = new Image();
        tester.onload = function() {};
        tester.onerror = function() {
            if (typeof audio_signal_lost !== 'undefined') {
                audio_signal_lost.play();
            }
        };
        tester.style.visibility = 'hidden';
        tester.id = 'testimg';
        tester.src = URL;
    }

    // Event Handlers
    $(document).ready(function() {
        // initSelectpicker();

        // Input styling
        $('input[type=text], input[type=number]').each(function() {
            if ($(this).val() != '' && $(this).val() != null) {
                $(this).css({
                    'color': '#CFD4D9',
                    'border': '1px solid #bbbbbb80'
                });
            }
        });

        $('.form-control').focusout(function() {
            var text_val = $(this).val();
            if (text_val != null && text_val != '') {
                $(this).css({
                    'color': '#CFD4D9',
                    'border': '1px solid #bbbbbb80'
                });
            } else {
                $(this).css('background', 'none');
            }
        });

        // UI Controls
        $("#cick-hide").click(function() {
            $('.box-data').hide();
            $('#full_screen1').css();
        });

        $("#cick-show").click(function() {
            $('#hide-screen').show();
            $('#fullscreen_card').hide();
            $('#bottom-bar').hide();
        });

        $("#change_camera").click(function() {
            $("#modal_select_camera").modal("show");
        });

        $("#change_icon").click(function() {
            $(this).find($(".ri-arrow-down-s-line")).toggleClass("ri-arrow-up-s-line");
        });

        $("#select_camera_nurse").click(function() {
            this.focus();
        });

        // Search case
        $("#search_case").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".list-cases").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });

        // Case button
        $('#case_btn').on('click', function() {
            $("#modal_new_case").modal('show');
        });

        // Reload button
        $(".ac_reload_btn").click(function() {
            if (typeof socket !== 'undefined') {
                socket.emit('endonode', '{"event":"reload"}');
            }
        });

        // Second source initialization
        var is_secondsource = localStorage.getItem("second_source");
        if (is_secondsource == 'open') {
            $('#camera_2').val('2').trigger('change');
            localStorage.setItem("second_source", 'close');
            $($('.vdo-source')[1]).addClass('active');
            $($('.vdo-shows')[1]).addClass('active');
            $('#full_screendiv2, #source2_div, #reload2_div').css('display', 'block');
        }
    });

    // Window before unload
    window.onbeforeunload = function() {
        if (typeof timer1Seconds !== 'undefined' && timer1Seconds > 0) {
            if (typeof socket !== 'undefined') {
                socket.emit('endonode', '{"event":"vdo_stop","sound":false}');
            }
        }
    };
</script>
