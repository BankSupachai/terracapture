<script src="{{ url('assets/extra/shortcuts/shortcut.js') }}"></script>
<script>
    let esc_count = 0;
    shortcut.add("esc", function() {
        esc_count++;
        if(esc_count == 3){
            window.location.href = "{{ url('patient/create') }}";
        }
    });

    setInterval(() => {
        esc_count = 0;
    }, 1000);
</script>
