<script>
    function set_time(key) {
        var data = $("#" + key).val()
        var today = new Date();
        var time = ('0' + today.getHours()).slice(-2) + ":" + ('0' + today.getMinutes()).slice(-2) + ":" + ('0' + today
            .getSeconds()).slice(-2);
        $("#" + key).val(time).keyup()
        update_case_time(key, time);
    }

    function update_case_time(key, value) {
        $.post('{{ url('api/procedure') }}', {
            event: "caseupdate",
            cid: cid,
            key: key,
            value: value
        }, function(d, s) {});
    }
</script>
