@extends('layouts.layouts_index.main')
<link rel="stylesheet" type="text/css" href="{{ url('resources/css/multi.min.css') }}">


@section('content')
    <form action="{{ url('pdfcustom') }}" method="post">
        @csrf
        <input type="text" name="code" value="{{ $tb_procedure->code }}">
        <input type="hidden" name="event" value="custom_body">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">PDF Custom (PDF HEAD)</h5>

                <h5 class="card-title">PDF Custom (PDF Body)</h5>
                <div class="row">
                    <div class="col-12">
                        <select required multiple="multiple" name="pdf_show[]" id="multiselect-basic">
                            @foreach ($left_section as $all_left_section)
                                @php
                                    $pdf_show = str_replace('.blade.php', '', $all_left_section);

                                @endphp
                                <option value="{{ $all_left_section }}" @selected(in_array($pdf_show, $tb_procedure->pdf['show']))>{{ $all_left_section }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    {{-- <link rel="stylesheet" href="{{ url('public/css/jquery-ui.css') }}">
    <script src="{{ url('public/js/jquery.min.js') }}"></script>
    <script src="{{ url('public/js/jquery-ui.js') }}"></script> --}}


    <script src="{{ url('assets/js/multi.min.js') }}"></script>
    <script src="{{ url('assets/js/autoComplete.min.js') }}"></script>

    <script>
        var multiSelectBasic = document.getElementById("multiselect-basic");
        if (multiSelectBasic) {
            multi(multiSelectBasic, {
                enable_search: false
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            function moveColumn(table, sourceIndex, targetIndex) {
                console.log("Move Col " + sourceIndex + " to " + targetIndex);
                var body = $("tbody", table);
                $("tr", body).each(function(i, row) {
                    $("td", row).eq(sourceIndex).insertAfter($("td", row).eq(targetIndex - 1));
                });
            }

            $(".mytable > thead > tr").sortable({
                items: "> th.sortme",
                start: function(event, ui) {
                    ui.item.data("source", ui.item.index());
                },
                update: function(event, ui) {
                    moveColumn($(this).closest("table"), ui.item.data("source"), ui.item.index());
                    $(".mytable > tbody").sortable("refresh");
                }
            });

            $(".mytable > tbody").sortable({
                items: "> tr.sortme",
                update: function(event, ui) {
                    var data = [];
                    $(".mytable tbody tr").each(function() {
                        data.push($(this).find('th').text());
                    });
                    // $.ajax({
                    //     url: "{{ url('pdfcustom') }}",
                    //     type: "POST",
                    //     data: {
                    //         event: "custom_body",
                    //         data: data,
                    //         _token: $('meta[name="csrf-token"]').attr('content')
                    //     },
                    // });
                }
            });
        });
    </script>

    <script>
        $("#add_pdf_show").click(function() {
            var html = $("#pdf_show_type").val();
            $("#pdf_append").append("<tr><th scope='row'>" + html +
                "</th><td><input type='hidden' name='pdf_show[]' value='" + html + "'></td></tr>");
        });
    </script>
@endsection
