<style>
    .pe-6{
        padding-right: 5rem;
    }
    .btn-create-custom{
        color: #ffffff;
        background: #0AB39C;
        width: 1619px;
        height: 66px;

    }
    .btn-create-custom:hover{
        color: #ffffff;
        background: #088574;
        width: 1619px;
        height: 66px;

    }
</style>
{{-- @include("case.component.ercp.pre_procedure") --}}

@include("case.component.ercp.cannulation")

@include("case.component.ercp.Cholangiogram")


@include("case.component.ercp.stent")
@include("case.component.ercp.direct_balloon")
@include('case.component.other_advance')
@include('case.component.post_procedure_icd9')
@include('case.component.ercp-btnsubmit')
