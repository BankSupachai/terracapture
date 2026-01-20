
@extends('layouts.layouts_index.main')
@section('title', 'EndoINDEX')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  @section('style')
  <style>
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
  #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
  #sortable li span { position: absolute; margin-left: -1.3em; }



    .form-select{
        background: #F3F6F9;
        border: 0px;
        }
    .text-gray{color: #9599ad;}
    span{color: #212529}
    .border-cn{
        border: 1px solid #CED4DA;
    }
    .height-componant
    {
        height: 20vh;
        overflow: auto;
    }

    .text-delete{color: #d3d3d4}
    ::-webkit-scrollbar {
        width: 10px !important;
        height: 10px !important;
    }
    ::-webkit-scrollbar-track {
        background: #ffffff !important;
        border-radius: 4px;

    }
    ::-webkit-scrollbar-thumb {
        border-radius: 4px;

        background: #D3D3D4 !important;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: #a5a5a5 !important;
    }

</style>
@endsection

@section('modal')

@endsection

@section('title-left')
    <h4 class="mb-sm-0">DATA SETTING</h4>
@endsection
@section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Procedure Setting</a></li>
        <li class="breadcrumb-item active">Data Setting</li>
    </ol>
@endsection
@section('content')
<div class="row">
    <div class="col-3">
        <div class="card p-3">
            <h5>Procedure</h5>
            <select class="form-select mb-3" aria-label="Default select example">
                <option selected>EGD</option>
                <option value="1">Colonoscopy</option>

            </select>
            <small class="text-gray">Please select component to setting detail and then click “confirm”</small>
            <div class="col-12 mt-2 ">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link mb-2 active" id="v-brief-tab" data-bs-toggle="pill" href="#v-brief" role="tab" aria-controls="v-pills-home" aria-selected="true">Brief History</a>
                    <a class="nav-link mb-2" id="v-pre-tab" data-bs-toggle="pill" href="#v-pre" role="tab" aria-controls="v-pre-profile" aria-selected="false">Pre-Diagnosis</a>
                    <a class="nav-link mb-2" id="v-anes-tab" data-bs-toggle="pill" href="#v-anes" role="tab" aria-controls="v-anes-messages" aria-selected="false">Anesthesia</a>
                    <a class="nav-link" id="v-medi-tab" data-bs-toggle="pill" href="#v-medi" role="tab" aria-controls="v-medi" aria-selected="false">Medication</a>
                    <a class="nav-link mb-2" id="v-fiding-tab" data-bs-toggle="pill" href="#v-fiding" role="tab" aria-controls="v-fiding-tab" aria-selected="false">Finding</a>
                    <a class="nav-link mb-2" id="v-post-tab" data-bs-toggle="pill" href="#v-post" role="tab" aria-controls="v-post-tab" aria-selected="false">Post-Diagnosis</a>
                    <a class="nav-link mb-2" id="v-procedure-tab" data-bs-toggle="pill" href="#v-procedure" role="tab" aria-controls="v-procedure-tab" aria-selected="false">Procedure</a>
                    <a class="nav-link" id="v-gastic-tab" data-bs-toggle="pill" href="#v-gastic" role="tab" aria-controls="v-gastic-tab" aria-selected="false">Gastric Content</a>
                    <a class="nav-link mb-2" id="v-rapid-tab" data-bs-toggle="pill" href="#v-rapid" role="tab" aria-controls="v-rapid-tab" aria-selected="false">Rapid Urease Test</a>
                    <a class="nav-link mb-2" id="v-complication-tab" data-bs-toggle="pill" href="#v-complication" role="tab" aria-controls="v-complication-tab" aria-selected="false">Complication</a>
                    <a class="nav-link mb-2" id="v-estimate-tab" data-bs-toggle="pill" href="#v-estimate" role="tab" aria-controls="v-Estimate-tab" aria-selected="false">Estimate Blood Loss</a>
                    <a class="nav-link" id="v-blood-tab" data-bs-toggle="pill" href="#v-blood" role="tab" aria-controls="v-blood-tab" aria-selected="false">Blood Transfusion</a>
                    <a class="nav-link mb-2" id="v-specimen-tab" data-bs-toggle="pill" href="#v-specimen" role="tab" aria-controls="v-specimen-tab" aria-selected="false">Specimen</a>
                    <a class="nav-link mb-2" id="v-follow-tab" data-bs-toggle="pill" href="#v-follow" role="tab" aria-controls="v-follow-tab" aria-selected="false">Follow Up</a>
                    <a class="nav-link mb-2" id="v-comment-tab" data-bs-toggle="pill" href="#v-comment" role="tab" aria-controls="v-comment-tab" aria-selected="false">Comment</a>

                </div>

            </div>
        </div>
    </div>
    <div class="col-9">
        <div class="card">
            <div class="col-md-12">
                <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                    @include('componantsetting.brief_history')
                    @include('componantsetting.pre-diagnosis')
                    @include('componantsetting.anesthesia')
                    @include('componantsetting.medication')
                    @include('componantsetting.finding')
                <div class="tab-pane fade" id="v-post" role="tabpanel" aria-labelledby="v-pre-tab">
                    @include('componantsetting.post-diagnosis')
                </div>
                    @include('componantsetting.procedure')
                    @include('componantsetting.gastric-content')
                    @include('componantsetting.rapid-urease-test')
                    @include('componantsetting.complication')
                    @include('componantsetting.estimate-blood-loss')
                    @include('componantsetting.blood-transfusion')
                    @include('componantsetting.specimen')
                    @include('componantsetting.followup')
                    @include('componantsetting.comment')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
@endsection
