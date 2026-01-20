@extends('layouts.layout_capture')



@section('title', 'EndoINDEX')

@section('style')
<style>
    iframe{
        width: 100%;
        height: 75vh;
    }
    .card-check{
        border: 1px solid #E9EBEC;
        border-radius: 4px;
        width: 100%;
        padding: 1em;
    }
    .border-pdf{
        border-bottom: 1px solid #E9EBEC;
    }
    .text-date{color: #9599AD;}
    #back_to_list table tr td{
        vertical-align: middle;
    }
</style>
@endsection

@section('modal')
<div class="modal fade" id="back_to_list" tabindex="-1" aria-labelledby="back_to_listLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom pb-2">
                <h5 class="modal-title" id="back_to_listLabel">You have another operation that haven’t report.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-2">
                <span class="text-date">Select your operation</span>
                <table class="table">
                      <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Operation</th>
                          <th class="text-center">Action</th>
                      </tr>
                      @for($i=0;$i<rand(1,6);$i++)
                      <tr>
                          <td>Caseuniq</td>
                          <td>Suratchanut Chitrat</td>
                          <td>EGD</td>
                          <td class="text-center">
                              <button type="button" class="btn btn-primary btn-icon waves-effect"><i class="ri-folder-open-fill"></i></button>
                          </td>
                      </tr>
                      @endfor
                </table>
            </div>
            <div class="modal-footer">
                <div class="row w-100">
                    <div class="col-2"></div>
                    <div class="col">
                        <button type="button" class="btn btn-danger w-100">Back to list</button>
                    </div>
                    <div class="col-2"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('content')


{{-- @include('terra.components.patient_create') --}}
<div class="row">
    <div class="col-9">
        <div class="card">
            <div class="card-body">
                <iframe src="{{url('terra/pdf')}}/{{$cid}}" frameborder="0"></iframe>
            </div>
        </div>
    </div>
    <!-- Primary Alert -->

    <div class="col-3">
        <div class="card">
            <div class="card-body p-0">
                <div class="row m-0">
                    <div class="col-12 p-3 border-pdf">
                        <div class="row">
                            <div class="col-auto"><b>Report</b></div>
                            <div class="col text-danger text-end"><b>Patient ID : 1243534</b></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="card-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                                    <label class="form-check-label" for="flexRadioDefault1">&nbsp;
                                        Doctor Report
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="card-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">&nbsp;
                                        Nurse Report
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="card-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                                    <label class="form-check-label" for="flexRadioDefault3">&nbsp;
                                        Billing Report
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col p-1"><button type="button" class="btn btn-success" id="complete"data-toast data-toast-text="Successfully Save" data-toast-gravity="top" data-toast-position="center" data-toast-className="success" data-toast-duration="3000"><i class="bx bx-check"></i> Complete Report</button></div>
                            <div class="col-auto p-1"><a href="{{url('procedure')}}/{{$id}}" class="btn btn-warning"><i class="bx bxs-edit"></i> Edit</a></div>
                            <div class="col-auto p-1"><button type="button" class="btn btn-secondary"><i class="bx bx-edit-alt"></i> Create E-Sign</button></div>
                        </div>
                    </div>
                    <div class="col-12 p-3 border-pdf">
                        <div class="row cn">
                            <div class="col-4"><b>Send to</b></div>
                            <div class="col-8">
                                <select name="" id="" class="form-control">
                                    <option value="">PDF + Selected Photo</option>
                                </select>
                            </div>
                        </div>
                        <div class="row cn mt-3">
                            <div class="col-4"><button class="btn btn-primary w-100 text-start"><i class="bx bx-slider"></i> PACs</button></div>
                            <div class="col-8"><b class="text-date">Last Send {{date('d/m/Y H:i')}}</b></div>
                        </div>
                        <div class="row cn mt-1">
                            <div class="col-4"><button class="btn btn-primary w-100 text-start"><i class="bx bx-slider"></i> VNA</button></div>
                            <div class="col-8"><b class="text-danger">Not Send</b></div>
                        </div>
                    </div>
                    <div class="col-12 p-3 border-pdf">
                        <div class="row">
                            <div class="col-12">
                                <b>Edit Version</b>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col text-date">Endocapture</div>
                            <div class="col text-center text-date text-nowrap">{{date('d/m/Y H:i')}}</div>
                            <div class="col text-end"><a href="javascript:;">View</a> &emsp;</div>
                        </div>
                    </div>
                    <div class="col-12 p-3"></div>
                </div>
            </div>
        </div>
        {{-- <button type="button" data-bs-toggle="modal" data-bs-target="#back_to_list" class="btn btn-success w-100"><i class="ri-list-check"></i> Back to list</button> --}}
        <a href="{{url("")}}" class="btn btn-success w-100"><i class="ri-list-check"></i> Back to list</a>
    </div>
</div>
@endsection






@section('lpage')
Report
@endsection
@section('rpage')
Report
@endsection
@section('rppage')
Cases List
@endsection


@section('script')
<script src="{{asset('public/js/jquery.min.js')}}"></script>
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $("#complete").click(function(){
        $.post("{{url('jquery')}}",
        {
        event       : 'update_report',
        status      : 2,
        case_id     : "{{@$cid}}",
        },
        function(data, status) {
        })
    })
</script>

<!-- Toast -->

@endsection
