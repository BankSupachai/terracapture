
@extends('layouts.app')


@section('title', 'EndoINDEX')

@section('style')


@endsection

@section('modal')

@endsection


@section('content')
<div class="row m-0">
    <div class="col-12">
        <div class="card">
                <form action="{{url('endosmart')}}" method="post" class="card-body">
                    @csrf
                    <h2 class="text-center">ถ่ายโอนข้อมูลจาก EndoSmart</h2>
                    <div class="row m-0 cn">
                        <div class="col-auto">
                            <select id="kt_dual_listbox_2" class="dual-listbox" name="select[]" multiple data-available-title="Source Options" data-selected-title="Destination Options" data-add="<i class='flaticon2-next'></i>" data-remove="<i class='flaticon2-back'></i>" data-add-all="<i class='flaticon2-fast-next'></i>" data-remove-all="<i class='flaticon2-fast-back'></i>">
                                @foreach ($smart as $s)
                                <option value="{{$s->TABLE_NAME}}">{{$s->TABLE_NAME}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-auto">
                            <div class="card card-custom gutter-b bg-diagonal bg-diagonal-light-primary">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between p-4 flex-lg-wrap flex-xl-nowrap">
                                        <div class="d-flex flex-column mr-5">
                                            <a href="#" class="h4 text-dark text-hover-primary mb-5">
                                                จำนวนข้อมูลที่มีในระบบ ปัจจุบัน <span class="label label-square h3">{{@$have}}</span> ข้อมูล
                                            </a>
                                        </div>
                                        <div class="ml-6 ml-lg-0 ml-xxl-6 flex-shrink-0">
                                            <button type="submit" class="btn font-weight-bolder text-uppercase btn-primary py-4 px-6">
                                                ยืนยันถ่ายโอนข้อมูล
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


@endsection


@section('lpage')
    TODAY LIST
@endsection

@section('rpage')
    Cases List
@endsection

@section('rppage')
    Today List
@endsection


@section('script')
<script>
    var KTDualListbox = function() {
            var demo2 = function () {
                var $this = $('#kt_dual_listbox_2');
                var options = [];
                $this.children('option').each(function () {
                var value = $(this).val();
                // var label = $(this).text();
                options.push({
                // text: label,
                value: value
            });
        });

        var dualListBox = new DualListbox($this.get(0), {
            addEvent: function (value) {
                console.log(value);
            },
            removeEvent: function (value) {
                console.log(value);
            },
                availableTitle: "Table ในระบบ",
                selectedTitle: "Table ที่เลือกโอน",
                addButtonText: "<i class='flaticon2-next'></i>",
                removeButtonText: "<i class='flaticon2-back'></i>",
                addAllButtonText: "<i class='flaticon2-fast-next'></i>",
                removeAllButtonText: "<i class='flaticon2-fast-back'></i>",
                options: options,
            });
        };

        return {
            init: function() {
                demo2();
            },
        };
    }();

jQuery(document).ready(function() {
    KTDualListbox.init();
});

</script>
@endsection
