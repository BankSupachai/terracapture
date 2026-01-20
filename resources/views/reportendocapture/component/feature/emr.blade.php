@for ($i = 1; $i < 5; $i++)
    @php
        $path = 'path' . $i;
        $label = 'label' . $i;
        $checked = 'checked' . $i;
    @endphp
    @isset($emr->$path)
        <div class="col-8 mt-3">
            <input class="emr form-check-input" id="emr{{ $i }}" group="{{ $i }}"
                @checked(@$emr->$checked) type="checkbox">
            &emsp;
            <label for="emr{{ $i }}">{!! @$emr->$label !!}</label>
        </div>
        <div class="col-4 mt-3 emrsuccess" id="emrsuccess{{ $i }}" style="display: none">
            <button class="btn btn-success btn-status-vna btn-sm fw-bold">Success</button>
        </div>
        <div class="col-4 mt-3 emrunsuccess" id="emrunsuccess{{ $i }}" style="display: none">
            <button class="btn btn-danger btn-sm fw-bold">Not success</button>
        </div>
    @endisset
@endfor

<script>
    $(document).ready(function() {
        $("#confirm_sendto").click(function() {
            $(".emrsuccess").hide();
            $(".emrunsuccess").hide();
            $(".emr:checked").each(function() {
                var group = $(this).attr("group");
                $.post("{{ url('api/sendto') }}", {
                    event: "emr2dir",
                    cid: "{{ $cid }}",
                    group: group,
                }, function(d, s) {
                    let obj = JSON.parse(d);
                    if (obj.status == "success") {
                        $("#emrsuccess" + group).show();
                    } else {
                        $("#emrunsuccess" + group).show();
                    }
                    console.log(d);
                });
            });
        });
    });
</script>
