<h5>
    FINDING &emsp; &emsp;&emsp;&emsp;&emsp;&emsp; &nbsp;

    {{-- {{fidingtemp($case)}}


 --}}


    @if ($procedure->code != 'gi095' && $procedure->code != 'gi003S2')
        <button type="button" class="btn btn-checkbox waves-effect waves-light btn-sm mainpart_group" status="Normal">
            <i class=" ri-checkbox-blank-line ri-lg me-2" aria-hidden="true"></i>Normal All</button> &emsp;
        <button type="button" class="btn btn-checkbox waves-effect waves-light btn-sm mainpart_group mainpart_group"
            status="Unremarkable">
            <i class=" ri-checkbox-blank-line ri-lg me-2" aria-hidden="true"></i>Unremarkable All</button>
            @if ($procedure->name == 'ERCP')
            <a href="{{url("procedureadvance/$cid")}}" class="btn btn-checkbox waves-effect waves-light btn-sm" >
                <i class="ri-file-list-line ri-lg me-2" aria-hidden="true"></i>Advance</a>
                @endif
        <br />
    @endif

</h5>
<style>
    .btn-finding {
        background-color: #E0E3E5
    }

    .btn-finding:hover {
        background-color: #acaeaf
    }

    /* .textarea:nth-child(2){
        margin-top: 2em;
    } */
</style>
<div class="row">
    <div class="col-12 mt-2">
        @if ($procedure->code == 'gi003S2')
            @include('case.component.ercp.finding_typeofmajor')
            @include('case.component.ercp.finding_Infundibulum')
            @include('case.component.ercp.finding_transverse')
            @include('case.component.ercp.finding_diverticulum')
            @include('case.component.ercp.finding_periampullary')
        @else
            @foreach (@$mainpart as $key => $value)
                <div class="row" >
                    <div class="col-2 mt-2">
                        {{ $value }}
                    </div>
                    <div class="col-auto mt-2 ">
                        <a class="btn border btn-light text_delfind btn_mainpart_na"
                            group_key="{{ $value }}">N/A</a>
                        {{-- <button type="button" class="btn border btn-light btn_advance"
                            mainpart="{{ $value }}">Advance</button> --}}
                    </div>


                    {{-- @dd($procedure->name); --}}
                    <div class="col-8 mt-2">
                        <input type="hidden" name="mainpart_name[]" value="{{ $value }}">
                        <textarea id="mainpart{{ $key }}" rows="1" name="mainpart_value[]" placeholder="Free text"
                            group_name="finding" group_key="{{ $value }}" class="savejsongroup form-control autotext mainpart_text">{{ @$case->mainpart[$value] }}</textarea>
                    </div>
                    <div class="col-12 advance_mainpart px-5 my-2" text="{{ $value }}" style="display: @if (isset($case->advance[smalltext($value)])) show @else none @endif; border: 1px solid #245788; border-radius: 4px;">
                        <div class="row my-2 ">
                            <div class="col-6 align-self-center">
                                <span class="text-danger fw-bold"> Advance {{ @$value }}</span>
                            </div>
                            <div class="col-6 text-end pe-0">
                                <button class="btn btn-soft-danger">Delete all lesion</button>
                            </div>
                        </div>


                        @php
                            $temp = url("");
                            $explode = explode("/", $temp);
                            $end = end($explode);
                        @endphp

                        @if (is_file(getCONFIG('admin')->htdocs_path . "$end\\resources\\views\\mainpart\\lesion\\$value.blade.php"))
                            @include('mainpart.lesion.' . $value)
                        @else
                            @include('mainpart.lesion.blank')
                        @endif

                        <div class="col-12 text-end pe-0 mb-2">
                            <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                data-bs-target="#modal_lesion_picture">Select photo</button>
                        </div>
                    </div>
                </div>
            @endforeach

        @endif

    </div>

    @if ($procedure->code != 'gi003S2')
        <div class="row" style="padding-right: 0px;">
            <div class="col-2 " style="margin-top: 10px;">
                OVERALL FINDING
            </div>
            {{-- @dd(@$case->overall_finding) --}}
            <div class="col-10 " style="margin-top: 10px; padding-right: 0px;">
                {{-- <textarea style="overflow:hidden" id='overall_finding' name='formsubmit_overall_finding'
                    class="form-control savejson autotext w-100" type="text" placeholder="Free text">{{ @$case->overall_finding }}</textarea> --}}
                    <textarea style="overflow:hidden" id='overall_finding' name='formsubmit_overall_finding'
                    class="form-control savejson {{--autotext--}} w-100" type="text" placeholder="Free text">{{ @$case->overall_finding }}</textarea>
            </div>
        </div>
    @endif
</div>

<script>
   $(document).ready(function () {
    var text = $('#overall_finding').val();
    text = text.replace(/^\s*$(?:\r\n?|\n)/gm, "");
    $('#overall_finding').val(text);
});


</script>


<script>
    $(".btn_advance").click(function() {
        var mainpart = $(this).attr("mainpart")
        $(".advance_mainpart[text='" + mainpart + "']").toggle(300);
    })



</script>



<script>
    $(".mainpart_text").focusout(function() {
        restore_finding()
        $.post("{{ url('api/mainpart') }}", {
            event: "mainpart_update",
            group_key: $(this).attr("group_key"),
            value: $(this).val(),
            cid: "{{ $cid }}"
        }, function(data, status) {});
    });

    $(".mainpart_group").click(function() {
        const group = [];
        var value = $(this).attr("status");
        $(".mainpart_text").val(value);
        $(".mainpart_text").each(function() {
            $(this).focus();

            group.push($(this).attr("group_key"));
        });
        restore_finding()
        $.post("{{ url('api/mainpart') }}", {
            event: "mainpart_update_group",
            group: group,
            value: value,
            cid: "{{ $cid }}"
        }, function(data, status) {});
    });

    $(".btn_mainpart_na").click(function() {
        var group_key = $(this).attr("group_key");
        console.log(group_key);
        $("textarea[group_key='" + group_key + "']").val("N/A");
        restore_finding()
        // $(".mainpart_text").attr("group_key",group_key).val("N/A"););
        $.post("{{ url('api/mainpart') }}", {
            event: "mainpart_update",
            group_key: group_key,
            value: "N/A",
            cid: "{{ $cid }}"
        }, function(data, status) {});
    });

    function restore_finding() {
        let sub = []
        for (let i = 0; i < $('.mainpart_text').length; i++) {
            let inp_val = $($('.mainpart_text')[i]).val()
            inp_val = inp_val != undefined && inp_val != '' ? inp_val : ''
            sub.push(inp_val)
        }

        let retString = localStorage.getItem("{{ $cid }}")
        let obj = {}
        if (retString != null) {
            obj = JSON.parse(retString)
        }
        obj['finding'] = sub
        console.log(obj);
        let text = JSON.stringify(obj);
        localStorage.setItem("{{ $cid }}", text);

        // $(".mainpart_text").focusout()
    }
</script>
