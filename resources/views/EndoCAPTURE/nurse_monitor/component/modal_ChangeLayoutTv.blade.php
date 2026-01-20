<style>
    .box-change-layout{
        height: 222px;
        background: #9599ad33;
        padding: 22px;
        cursor: pointer;
        border-radius: 4px;
    }
    .box-change-layout:hover{
        border: 2px solid #245788;
        border-radius: 4px;

    }
    .box-change-inside-layout{
        height: 181px;
        background: #ffffff;
    }
    .box-change-inside-layout-2{
        height: 85px;
        background: #ffffff;
    }
    .modal-lg, .modal-xl {
    --vz-modal-width: 1307px;
    height: 637px;
}
</style>

@php
    $layout = getCONFIG('layout');
@endphp
<!-- Default Modals -->
<button type="button" class="btn btn-primary " >Standard Modal</button>
<div id="changely_TV" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header pt-1">
                    <span class="modal-title h5 mb-2" id="myModalLabel">Layout Monitor</span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="row justify-content-end" >
                <div class="col-2 text-center align-self-center">Font size</div>
                <div class="col-3" >
                    <select class="form-select " name="" id="">
                        <option value="">16 px</option>
                    </select>
                </div>
                <div class="col-1">

                </div>
            </div>
            <div class="modal-body">
                <div class="row" >
                    <div class="col-4">
                        <div class="box-change-layout" @if(@$layout->casemonitor == '1') style="background: #0ab39c;" @endif  config_type="layout" layouts_id="1">
                            <div class="box-change-inside-layout"></div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="box-change-layout " @if(@$layout->casemonitor == '2') style="background: #0ab39c;" @endif config_type="layout" layouts_id="2">
                            <div class="row">
                                <div class="col-6 ">
                                    <div class="box-change-inside-layout"></div>
                                </div>
                                <div class="col-6">
                                    <div class="box-change-inside-layout"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="box-change-layout "  @if(@$layout->casemonitor == '3') style="background: #0ab39c;" @endif config_type="layout" layouts_id="3">
                            <div class="row">
                                <div class="col-4 ">
                                    <div class="box-change-inside-layout"></div>
                                </div>
                                <div class="col-4">
                                    <div class="box-change-inside-layout"></div>
                                </div>
                                <div class="col-4">
                                    <div class="box-change-inside-layout"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4" >

                    <div class="col-4">
                        <div class="box-change-layout "@if(@$layout->casemonitor == '4') style="background: #0ab39c;" @endif  config_type="layout" layouts_id="4">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="box-change-inside-layout-2"></div>
                                    </div>
                                    <div class="col-6">
                                        <div class="box-change-inside-layout-2"></div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="box-change-inside-layout-2"></div>
                                    </div>
                                    <div class="col-6">
                                        <div class="box-change-inside-layout-2"></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="box-change-layout "@if(@$layout->casemonitor == '5') style="background: #0ab39c;" @endif  config_type="layout" layouts_id="5">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="box-change-inside-layout-2"></div>
                                    </div>
                                    <div class="col-4">
                                        <div class="box-change-inside-layout-2"></div>
                                    </div>
                                    <div class="col-4">
                                        <div class="box-change-inside-layout-2"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="box-change-inside-layout-2"></div>
                                    </div>
                                    <div class="col-4">
                                        <div class="box-change-inside-layout-2"></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="box-change-layout"@if(@$layout->casemonitor == '6') style="background: #0ab39c;" @endif config_type="layout" layouts_id="6">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="box-change-inside-layout-2"></div>
                                    </div>
                                    <div class="col-4">
                                        <div class="box-change-inside-layout-2"></div>
                                    </div>
                                    <div class="col-4">
                                        <div class="box-change-inside-layout-2"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="box-change-inside-layout-2"></div>
                                    </div>
                                    <div class="col-4">
                                        <div class="box-change-inside-layout-2"></div>
                                    </div>
                                    <div class="col-4">
                                        <div class="box-change-inside-layout-2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 mb-3 text-center">
                <button type="button" class="btn btn-danger w-75">Confirm</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $(".box-change-layout").on("click", function(){
        let value = $(this).attr('layouts_id');

        $(".box-change-layout").css("background" , "#9599ad33");
        $(this).css("background" , "#0ab39c");

        var id          = "casemonitor";
        var config_type = $(this).attr('config_type');
        $.post("{{url('superadmin')}}",{
            event       : "config_type",
            config_type : config_type,
            id          : id,
            value       : value,
        },function(data, status){});


    })
</script>
