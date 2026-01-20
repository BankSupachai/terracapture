@php
    foreach($doctor_select as $doctorid){
        $temp = $doctorid->uid;
    }
@endphp


<script src="{{ url('assets/extra/shortcuts/shortcut.js') }}"></script>
<script>
    let esc_count = 0;
    shortcut.add("esc", function() {
        esc_count++;
        if (esc_count == 3) {
            $('#sel_procedure').val(['gi001']).trigger('change');
            $('#sel_endoscopist').val("{{@$temp}}").trigger('change');
            $('#submit_btn').click();
        }
    });

    setInterval(() => {
        esc_count = 0;
    }, 1000);
</script>
