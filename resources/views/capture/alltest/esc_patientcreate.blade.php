<script src="{{ url('assets/extra/shortcuts/shortcut.js') }}"></script>

@php
    $year_now = date('Y');
    if (@$feature->year_thai) {
        $year_custom = $year_now + 543;
    } else {
        $year_custom = $year_now;
    }
@endphp

<script>
    let esc_count = 0;
    shortcut.add("esc", function() {
        esc_count++;
        if (esc_count == 3) {
            fill_patientdata();
        }
    });

    setInterval(() => {
        esc_count = 0;
    }, 1000);

    function fill_patientdata() {
        let date = new Date();
        let timestamp = "";
        let year = date.getFullYear().toString().slice(-2);
        let month = ("0" + (date.getMonth() + 1)).slice(-2);
        let day = ("0" + date.getDate()).slice(-2);
        let hours = ("0" + date.getHours()).slice(-2);
        let minutes = ("0" + date.getMinutes()).slice(-2);
        let seconds = ("0" + date.getSeconds()).slice(-2);
        timestamp = year + month + day + hours + minutes + seconds;
        let random = Math.floor(Math.random() * 120) + 1;
        let gender = Math.floor(Math.random() * 2) + 1;
        let year_custom = {{ $year_custom }};
        let year_cal = year_custom - random;

        // alert(year_cal + " " + year_custom + " " + random);

        $("#hn").val("test" + timestamp);
        $("#first_name").val("test");
        $("#last_name").val("test");
        $("#birthyear").val(year_cal);
        $("#agenew").val(random);
        $("input[name='gender'][value='" + gender + "']").prop('checked', true);
        $("#submit_btn").click();
    }
</script>
