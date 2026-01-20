@extends('terra.layouts.main')
@section('title', 'Class Me')

@section('style')
<style>
.html, body{
  margin:0;
  padding:0;
  height:100%;
}
.a-terralink
{
    font-size: 12px;
}
section {
  position: relative;
  padding-top: 37px;
  background: rgb(255, 255, 255);
}
section.positioned {
  position: absolute;
  top:100px;
  left:100px;
  width:800px;
  box-shadow: 0 0 15px #333;
}
.table-terralink {
  overflow-y: auto;
  height: 80vh;
}
table {
  border-spacing: 0;
  width:100%;
}
td, th {
  border-bottom:1px solid #eee;
  background: #EEF0F8;
  color: #000;
  padding: 10px 25px;
}
th {
  height: 0;
  line-height: 0;
  padding-top: 0;
  padding-bottom: 0;
  color: transparent;
  border: none;
  white-space: nowrap;
}
th div{
  position: absolute;
  background: white;
  color: #1b5368;
  padding: 9px 25px;
  top: 0;
  margin-left: -25px;
  line-height: normal;
  font-weight: normal;

}
th:first-child div{
  border: none;
}





    .nav.nav-pills .nav-item{
        margin-right: 0;
    }
    .nav.nav-pills .nav-link:hover .nav-text{color: #1b5368;}
    .nav.nav-pills .nav-link:hover{background: #1b546849;}
    .nav.nav-pills .nav-link.active:hover .nav-text{color: #fff;}
    .nav.nav-pills .nav-link{
        background: #fff;
        color: black;
        padding: 0px 5px;
        width: 3em;
        text-align: center;

    }
    .nav.nav-pills .show > .nav-link, .nav.nav-pills .nav-link.active{
        background: #1b5368;
        color: #fff;
    }
    #search-1-d{border-radius: 5px 0px 0px 5px;}
    #search-all-d{border-radius: 0px 5px 5px 0px}
    .input-group-text {border: none;}
    .menu-data{
        height: 100vh;
    }
    .data-overflow{

        position: relative;
    }
    .set-page{
        height: 3.5em;
        position: fixed;
        bottom: 0;
    }
    .header-table{
        position: fixed;
        width: 91.7%;
    }
    .table-body{
        position: fixed;
        width: 91.7%;
        margin-top: 4em;
        overflow-y: scroll;
        height: 70vh;
        padding-bottom: 1em;
    }
    .table tr > td:nth-child(1),.table tr > td:nth-child(11),.table tr > td:nth-child(12){width: 5%;}
    .table tr > td:nth-child(3),.table tr > td:nth-child(4),.table tr > td:nth-child(5),.table tr > td:nth-child(9){width: 8%;}
    .table tr > td:nth-child(6),.table tr > td:nth-child(7),.table tr > td:nth-child(8),.table tr > td:nth-child(10){width: 13%;}

    .tera-MoBileicon
        {
            display: none;
        }

        @media (max-width:1493px){
            .TapPreview
        {
            display: none !important;
        }
        }
        @media (max-width:1117px){
            .HeightForRes
            {
                height: 0% !important;
            }
        }
    @media (max-width:991px){

        .header-respondsive
        {
            margin-top: 9em;
        }
       .content
       {
        padding-top: 0%;
       }
       .text-terralink
            {
                display: none;
            }
            .cb
            {
                align-items: center;
            }
            .btn-hide{
                display: none;
            }

            .tera-MoBileicon{
                display: block;
                align-items: center;
            }
            .col-terralink
            {
                margin-top: 1em;
            }
    } */

</style>
@endsection

@section('modal')
    @include("terra.home.modal.edit_study")
    @include("terra.home.modal.export")
    @include("terra.home.modal.note")
    @include("terra.home.modal.share")
@endsection
@section('tab')
    <b class="text-light ml-5">Detail</b>
    <b class="text-light">List</b>
@endsection
@section('menu-header')
<div class="row header-respondsive">
    <div class="col-6 TopLeftMenuBar">
        <div class="row cn">
            <div class="col-lg-6">
                <div class="row">

                    <div id="moss">

                    </div>

                    <div class="col text-nowrap">
                        <a class="viewer   btn btn-warning" href="{{url("mmm")}}">viewer</a>
                        Number of studies : 4
                    </div>
                    <div class="col-auto">
                        <ul class="nav nav-pills" id="myTab1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="search-1-d" data-toggle="tab" href="#home-1">
                                    <span class="nav-text">1 D</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="search-all-d" data-toggle="tab" href="#profile-1" aria-controls="profile">
                                    <span class="nav-text">All</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row pt-2">
                    <div class="col-12">
                        <div class="form-group">
                            <div class="input-group input-group-terralink">
                                <input type="text" class="form-control border-0" placeholder="Patient ID"/>
                                <div class="input-group-prepend p-0">
                                    <span class="input-group-text bg-white m-0">....</span>
                                </div>
                                <button class="input-group-text btn btn-terralink">
                                    <i class="mdi mdi-magnify text-light"></i>
                                </button>
                            </div>
                            <div id="div_test">
                                <input type="hidden" id="link_cid" name="link_cid[]">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-terralink">
                <div class="row">
                    <a href="{{url("")}}" class="col-auto a-terralink">
                        <i class="bx bx-refresh h2"></i>
                        <br>
                        <font class="text-terralink">Refresh</font>
                    </a>
                    <a href="{{url("case/create")}}" class="col-auto a-terralink">
                        <i class="bx bxs-plus-circle h2"></i>
                        <br>
                        <font class="text-terralink">New</font>
                    </a>
                    <a href="{{url("import/create")}}" class="col-auto a-terralink">
                        <i class=" bx bx-download h2"></i>
                        <br>
                        <font class="text-terralink">Import</font>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 left-menubar">
        <input type="hidden" name="" class="form-control form-control-sm">
        <div class="row h-100 cn">
            <div class="col"></div>
            <div class="col-auto">
                <div class="row">

                    <a href="{{('viewer/18')}}" id="icon_viewer" class="col-auto a-terralink">
                        <i class="mdi mdi-view-carousel h2"></i>
                        <br>
                        <font class="text-terralink">Viewer</font>
                    </a>
                    <a href="{{url('series/18')}}" id="icon_report" class="col-auto a-terralink">
                        <i class=" mdi mdi-clipboard-text-outline h2"></i>
                        <br>
                        <font class="text-terralink">Report</font>
                    </a>
                    <a class="col-auto a-terralink" href="javascript:;" data-bs-toggle="modal" data-bs-target="#edit_study" onclick="open_modal()">
                        <i class="mdi mdi-pencil h2"></i>
                        <br>
                        <font class="text-terralink">Edit</font>
                    </a>
                    <a class="col-auto a-terralink">
                        <i class="mdi mdi-delete h2"></i>
                        <br>
                        <font class="text-terralink">Delete</font>
                    </a>
                    <a class="col-auto a-terralink" onclick="open_export()">
                        <i class="mdi mdi-tray-arrow-up h2"></i>
                        <br>
                        <font class="text-terralink">Export</font>
                    </a>
                    <a class="col-auto a-terralink" onclick="open_note()">
                        <i class="mdi mdi-note-outline h2"></i>
                        <br>
                        <font class="text-terralink">Note</font>
                    </a>
                    <a class="col-auto a-terralink" onclick="open_share()">
                        <i class="mdi mdi-share-variant-outline h2"></i>
                        <br>
                        <font class="text-terralink">Share</font>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row mt-3">
    <div class="col-lg p-0 table-terralink ">
    <section class="">
        <div class="">
        <table class="table-borderless ">
            @php $index = 1; @endphp
            @foreach ($tb_case as $data)


            <thead class="">
                <tr class="bg-white">
                    <th>
                        <div></div>
                    </th>
                <th>
                    checkbox
                    <div><input type="checkbox" name="Checkboxes{{$index}}"/></div>
                </th>
                <th>
                    aaaaa
                <div class="table-borderless">Status</div>
                </th>
                <th>
                    Shared
                <div>Shared</div>
                </th>
                <th>
                    Study ID
                <div>Study ID</div>
                </th>
                <th>
                Patient ID
                <div>Patient ID</div>
                </th>
                <th>
                    Name
                    <div>Name</div>
                </th>
                <th>
                    Study Date
                    <div>Study Date</div>
                </th>
                    <th>
                    Modality
                    <div>Modality</div>
                    </th>
                    <th>
                    DOB (Age)
                    <div>DOB (Age)</div>
                    </th>
                    <th>
                    Sex
                    <div>Sex</div>
                    </th>
                    <th>
                    Object
                    <div>Object</div>
                    </th>
                    <th>
                    Note
                    <div>Note</div>
                    </th>
            </tr>
            </thead>
            <tbody>

            {{-- <tr class="study_list"
                data-bs-toggle="collapse"
                href="#collapseOne_{{$index}}"
                role="button"
                aria-expanded="false"
                aria-controls="collapseOne_{{$index}}"
                hn="{{$data['case_hn']}}"
                tableID="table_append{{$index}}"
            > --}}
            <tr>
                <td class="text-center">
                    <i class="far fa-star mr-4"></i>
                    <i class="fas fa-angle-right"></i>
                </td>
                <td><input type="checkbox" name="Checkboxes{{$index}}"/></td>
                <td><span class="label label-inline label-sm label-rounded">Incomplete</span></td>
                <td><span class="label label-inline label-sm label-rounded">Shared</span></td>
                <td>1312</td>
                <td>{{$data['case_hn']}}</td>
                <td>{{@$data->case_patientname}}</td>
                <td>{{@$case_datecreate[0]}}</td>
                <td>ES</td>
                <td>1950-04-24 (72)</td>
                <td>M</td>
                <td>10</td>
                <td>
                    <a class="case     btn btn-success" href="{{url("case/$index")}}">Report 123</a>
                    <a class="record   btn btn-primary" href="{{url("record/$index")}}">Record</a>
                    <a class="viewer   btn btn-warning" href="{{url("viewer/$index")}}">viewer</a>
                </td>
            </tr>
            <tr id="collapseOne_{{$index}}" class="collapse">
                <td colspan="13" class="p-0">
                    <div class="row">
                        <div class="col"></div>
                        <div  class="col-11">
                            <table id="table_append{{$index}}" class="border-light">
                            </table>
                        </div>
                        <div class="col"></div>
                    </div>
                </td>
            </tr>
            @php $index += 1; @endphp
            @endforeach
            </tbody>
        </table>
        </div>
    </section>
     </div>
        <div class="TapPreview col-lg-1 p-0 bg-white">
            <div class="row h-100 d-block">
                <div class="col-12 py-2 text-center">Preview</div>
                <div class="col-12 p-0"><img src="{{url('public/images/1.png')}}" alt="" srcset="" class="img-fluid"></div>
                <div class="col-12 p-0"><img src="{{url('public/images/2.png')}}" alt="" srcset="" class="img-fluid"></div>
            </div>
        </div>
 </div>
@endsection

@section('script')


<script src="{{url("public/js/jquery.min.js")}}"></script>
<script src='{{url('resources/box/js/box.js')}}'></script>
<script>
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });
</script>






<script>

    var num_arr = []
    function send_cid(val) {
        let find = num_arr.indexOf(val)
        if(find == -1){
            num_arr.push(val)
        } else {
            num_arr.splice(find, 1)
        }
        console.log(find, num_arr);
        $('#link_cid').val(num_arr)
    }

    $("#icon_viewer").click(function(){
        var cid = $("#link_cid").val();
        if(cid!=""){
            window.location.replace("{{url("viewer")}}/"+cid);
        }
    });


    $("#icon_report").click(function(){
        var cid = $("#link_cid").val();
        if(cid!=""){
            window.location.replace("{{url('reportob')}}/"+cid);
        }
    });

    function open_modal(){
        $('#edit_study').modal('show')
    }

    function open_export(){
        $('#export').modal('show')
    }

    function open_note(){
        $('#note').modal('show')
    }

    function open_share(){
        $('#share').modal('show')
    }

</script>

<script>

    $(".study_list").click(function(){
        var tableID = $(this).attr("tableID");
        var hn      = $(this).attr('hn');

        console.log(tableID);

        $.post("{{url("api/home")}}",{
            event   : "testbox",
            hn      : hn
        },function(data,status){
            console.log(data);

            var obj = JSON.parse(data);
            console.log(obj);
            if(obj.status){
                $(".border-light").html("");
                box("#"+tableID,obj.caseall,'{{url("resources/views/home/box/table_study.blade.php")}}');
            }

        });
    });

</script>
@endsection
