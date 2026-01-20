{{-- @extends('layouts.layouts_index.main') --}}
@extends('capture.layoutv6')
<link rel="stylesheet" type="text/css" href="{{ url('resources/css/multi.min.css') }}">

@section('style')
    <style>
        .kanban-board {
            display: flex;
            gap: 1rem;
            padding: 1rem;
        }

        .kanban-column {
            background: #f4f5f7;
            border-radius: 5px;
            width: 300px;
            padding: 1rem;
        }

        .kanban-column h3 {
            margin-top: 0;
            margin-bottom: 1rem;
            font-size: 1rem;
            font-weight: 600;
        }

        .kanban-items {
            min-height: 100px;
        }

        .kanban-item {
            background: white;
            padding: 0.8rem;
            border-radius: 3px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12);
            margin-bottom: 0.8rem;
            cursor: move;
        }

        .kanban-item:hover {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
    </style>
@endsection
<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">

@section('title-left')

@endsection
@section('title-right')

@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="mb-sm-0" style="margin-left: 70px;">PDF Custom</h4>
            <div class="row mt-2">
                <div class="col-md-2">

                    <div class="nav flex-column nav-pills text-center" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">
                        <a class="nav-link mb-2 active" id="v-pills-home-tab" data-bs-toggle="pill" href="#v-pills-home"
                            role="tab" aria-controls="v-pills-home" aria-selected="true">PDF Head</a>
                        <a class="nav-link mb-2" id="v-pills-profile-tab" data-bs-toggle="pill" href="#v-pills-profile"
                            role="tab" aria-controls="v-pills-profile" aria-selected="false">PDF Body</a>
                        <a class="nav-link mb-2" id="v-pills-messages-tab" data-bs-toggle="pill" href="#v-pills-messages"
                            role="tab" aria-controls="v-pills-messages" aria-selected="false">PDF Footer</a>
                    </div>
                </div><!-- end col -->
                <div class="col-md-10">
                    <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                        <img style="width: 729px; height: 150px; margin-top:-6px;" src="{{url("public/image/pdf-grid5.png")}}" alt="">
                        @include('PDFCustom.component.pdf_head')
                        @include('PDFCustom.component.pdf_body')
                        @include('PDFCustom.component.pdf_footer')


                    </div>
                </div><!--  end col -->
            </div>



        </div>
    </div>


@endsection

@section('script')


    <script>
        $(".fs_setting").on('change', function() {
            var attr  = $(this).attr('attr');
            var value = $(this).val();
            var name = $(this).attr('name');
            console.log(attr,value,name);

            $.post('{{ url('admin/procedure') }}', {
                event: 'update_font_size',
                department: '{{ $department->department_name }}',
                value: value,
                attr: attr,
                name: name
            }, function(d, s) {

            });
        });
    </script>


<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
<script>
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".draggable").draggable({
            start: function() {
                // counts[0]++;
                // updateCounterStatus($start_counter, counts[0]);
            },
            drag: function() {
                // counts[1]++;
                // updateCounterStatus($drag_counter, counts[1]);
            },
            stop: function() {
                var name = $(this).attr('name');
                var position = $(this).position();
                console.log('Drop - X: ' + position.left + ' Y: ' + position.top);
                $('#possition_x').val(position.left);
                $('#possition_y').val(position.top);
                $('#possition_name').val(name);

                $.post('{{ url('admin/procedure') }}', {
                    event: 'updateposition',
                    department: '{{ $department->department_name }}',
                    name: name,
                    x: position.left,
                    y: position.top
                }, function(d, s) {

                });
            }
        });




        $('.draggable').on('drop', function(event, ui) {

        });




    });
</script>




<script>
    document.addEventListener('DOMContentLoaded', function() {
        const items = document.querySelectorAll('.kanban-item');
        const columns = document.querySelectorAll('.kanban-items');

        items.forEach(item => {
            item.addEventListener('dragstart', dragStart);
            item.addEventListener('dragend', dragEnd);
        });

        columns.forEach(column => {
            column.addEventListener('dragover', dragOver);
            column.addEventListener('drop', drop);
        });

        function dragStart(e) {
            e.target.classList.add('dragging');
        }

        function dragEnd(e) {
            e.target.classList.remove('dragging');
        }

        function dragOver(e) {
            e.preventDefault();
            const draggingItem = document.querySelector('.dragging');
            const afterElement = getDragAfterElement(e.target.closest('.kanban-items'), e.clientY);
            if (afterElement == null) {
                e.target.closest('.kanban-items').appendChild(draggingItem);
            } else {
                e.target.closest('.kanban-items').insertBefore(draggingItem, afterElement);
            }
        }

        function getDragAfterElement(container, y) {
            const draggableElements = [...container.querySelectorAll('.kanban-item:not(.dragging)')];

            return draggableElements.reduce((closest, child) => {
                const box = child.getBoundingClientRect();
                const offset = y - box.top - box.height / 2;
                if (offset < 0 && offset > closest.offset) {
                    return {
                        offset: offset,
                        element: child
                    };
                } else {
                    return closest;
                }
            }, {
                offset: Number.NEGATIVE_INFINITY
            }).element;
        }

        function drop(e) {
            e.preventDefault();
        }
    });
</script>
@endsection
