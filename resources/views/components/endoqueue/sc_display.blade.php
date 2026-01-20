<script>
    function pt_0(){
        // alert()
        $.post("{{url("api/jquery")}}",
        {
            event   : "display_n_0",
            value   : 0,
            data_type : 3
        },
        function(data, status)
        {
            $("#q_n_0").html(data);
        });
    }
    function pt_n_10(){
        // alert()
        $.post("{{url("api/jquery")}}",
        {
            event   : "display_n_0",
            value   : 10,
            data_type : 2
        },
        function(data, status)
        {
            $("#q_n_10").html(data);
        });
    }
    function pt_o_10(){
        // alert()
        $.post("{{url("api/jquery")}}",
        {
            event   : "display_n_0",
            value   : 10,
            data_type : 2
        },
        function(data, status)
        {
            $("#q_o_10").html(data);
        });
    }
</script>
