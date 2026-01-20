@extends('layouts.app')
@section('title', 'EndoINDEX')
@section('style')
@php
    header('HTTP/1.1 500 Internal Server Error');
@endphp
<link href="{{asset('public/css/pacs/index.css')}}"     rel="stylesheet" type="text/css"/>
@endsection

@section('modal')

@endsection

@section('content')

<div class="row m-0">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                                <tr>
                                    <th scope="col">HN</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Procedure</th>
                                    <th scope="col">Date</th>
                                    <th scope="col" class="text-center">PACs Send</th>
                                </tr>
                          </thead>
                          <tbody>
                              @foreach ($case as $c)
                              <tr class="tr_on" this_id="{{@$c->case_id}}">
                                  <th>{{@$c->case_hn}}</th>
                                  <td>{{@$c->firstname}} &emsp; {{@$c->lastname}}</td>
                                  <td>{{@$c->procedure_name}}</td>
                                  <td>{{@$c->case_dateappointment}}</td>
                                  <td class="text-center" style="width: 10%;">
                                    @if(isset($c->pacs_id))
                                    <i class="fas fa-check-circle text-success icon-lg" data-container="body" data-offset="20px 20px" data-toggle="popover" data-placement="top"
                                    data-content="send finished"></i>
                                    @else
                                    <i class="fas fa-minus-circle text-warning icon-lg" data-container="body" data-offset="20px 20px" data-toggle="popover" data-placement="top"
                                    data-content="not send"></i>
                                    @endif
                                  </td>
                              </tr>
                              @endforeach
                          </tbody>
                    </table>
                  </div>
                  <div class="row">
                      <div class="col-lg-12 text-center">{{ $case->links() }}</div>
                  </div>

            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td style="width: 40%;" scope="col">HN :</td>
                                <td><k id="this_hn"></k></td>
                            </tr>
                            <tr>
                                <td scope="col">Name :</td>
                                <td><k id="this_name"></k></td>
                            </tr>
                            <tr>
                                <td scope="col">Procedure :</td>
                                <td><k id="this_procedure"></k></td>
                            </tr>
                            <tr>
                                <td scope="col">Date :</td>
                                <td><k id="this_date"></k></td>
                            </tr>
                            <tr>
                                <td scope="col">PACs Send :</td>
                                <td><k id="this_send"></k></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <table class="table table-borderless">
                    <tr>
                        <td scope="col">Photo</td>
                    </tr>
                </table>
                <div class="table-responsive" style="height: 15.5em;">
                    <div class="row m-0" id="show_photo">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tr>
                            <td scope="col">PDF :</td>
                        </tr>
                    </table>
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td><img src="{{url('public/image/test/PDF1.png')}}" class="img-thumbnail"></td>
                                <td><img src="{{url('public/image/test/PDF1.png')}}" class="img-thumbnail"></td>
                                <td><img src="{{url('public/image/test/PDF1.png')}}" class="img-thumbnail"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row mt-8">
                    <div class="col-lg-12 text-right">
                        <button class="btn btn-success"> Send to PACs</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="{{asset('public/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
@endsection
@section('script')


<script src="{{asset('public/js/pacs/index.js')}}"></script>

<script>

    var number = 0;
    var num_save = 1;
    var num_new = 1;
    $(".tr_on").click(function(){
        $('.tr_on').removeClass('table-active');
        $(this).addClass('table-active');
        var case_id = $(this).attr('this_id');
        $.post("{{ url('jquery') }}", {
                event:   "select_pacs",
                case_id: case_id,
            },
            function(data, status) {
                var img = '';
                var objJSON = JSON.parse(data);
                var status_pacs = "<i class='fas fa-minus-circle text-warning icon-lg'></i>";
                var date_send = objJSON.pacs_updatetime;
                $("#this_hn").html(objJSON.case_hn);
                $("#this_name").html(objJSON.firstname+" "+objJSON.lastname);
                $("#this_procedure").html(objJSON.procedure_name);
                $("#this_date").html(objJSON.case_dateappointment);
                if(objJSON.pacs_id != null){
                    status_pacs = "<i class='fas fa-check-circle text-success icon-lg'></i>";
                }else{
                    date_send = '  ';
                }
                $("#this_send").html(date_send+" "+status_pacs);
                var photo_select = JSON.parse(objJSON.case_photo);
                console.log(photo_select);
                photo_select.forEach(show_photo);
                function show_photo(item, index) {
                    if(item.ns!=0){
                        img +="<div class='col-lg-4'><img src='"+"http://{{request()->getHost()}}/store/"+objJSON.case_hn+"/"+item.na+"' class='img-thumbnail count_img'></div>";
                    }
                    $("#show_photo").html(img);
                    click_it();
                }
        });
    });


</script>


@endsection
