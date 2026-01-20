@php
    $admin = getCONFIG('admin');
@endphp

<div class="col-12 p-0">
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <div class="row">
                <div class="col-12 d-flex justify-content-between" style="display: none;">
                    <div class="">
                        <div class="h5"> <b>Pre-Diagnosis</b> &nbsp;&nbsp; <i class="ri-equalizer-line"></i></div>
                        <p class="text-gray">Please fill in the field then click “Create Report”</p>
                    </div>
                    @if (@$project->name != 'capture')
                        <div class="">
                        @else
                            <div class="">
                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                    <label class="form-check-label" for="system_autotext">Auto memorise</label>
                                    @if (@$admin->system_autotext == 'true')
                                        <input type="checkbox" class="form-check-input" id="system_autotext"
                                            checked="checked">
                                    @else
                                        <input type="checkbox" class="form-check-input" id="system_autotext">
                                    @endif
                                    <button type="button" id="btn_gettempdata"
                                        class="btn btn-primary btn-icon waves-effect waves-light hide-btn-function">
                                        <i class="ri-refresh-line ri-lg"></i>
                                    </button>
                                </div>
                            </div>
                    @endif
                </div>
            </div>
            <div class="row mt-3">
                {!! editcard('pre-diagnostic', 'pre-diagnostic.blade.php') !!}
                <div class="row">
                    <div class="col-6">
                        @include('case.component.sub.brief_history')
                    </div>
                    <div class="col-6">
                        @include('case.component.sub.indication')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var count_ck = $(".ck-val").length;
    var ck = 0;
    $(".ck-val").click(function() {
        // alert(1);
        var num_count = 0;
        for (i = 0; i < count_ck; i++) {
            if ($($(".ck-val")[i]).is(':checked')) {
                ck = 1;
            } else {
                num_count++
            }
        }
        if (ck == 0 || num_count == count_ck) {
            $(".ck-none").prop('checked', true);
            $(".ck-none")[i].css("background-color", "red");
        } else {
            $(".ck-none").prop('checked', false);
        }

        let name = $(this).attr('name')
        if (name == 'anesthesia') {
            let other = $(`#${name}other`).val()
            if (other.includes('No')) {
                $(`#${name}other`).val('')
            }
        }

    })
    $(".ck-none").click(function() {
        if ($(".ck-none").is(':checked')) {
            for (i = 0; i < count_ck; i++) {
                $($(".ck-val")[i]).prop('checked', false);
            }
        }
    })



    var ck_mi = $(".ck-mi").length;
    var cks = 0;
    $(".ck-mi").click(function() {
        var num_counts = 0;
        for (i = 0; i < ck_mi; i++) {
            if ($($(".ck-mi")[i]).is(':checked')) {
                cks = 1;
            } else {
                num_counts++
            }
        }
        if (cks == 0 || num_counts == ck_mi) {
            $(".ck-nmi").prop('checked', true);
        } else {
            $(".ck-nmi").prop('checked', false);
        }
    })
    $(".ck-nmi").click(function() {
        if ($(".ck-nmi").is(':checked')) {
            for (i = 0; i < ck_mi; i++) {
                $($(".ck-mi")[i]).prop('checked', false);
                $($(".inp_mi")[i]).val('')
            }
        }
    })
</script>
