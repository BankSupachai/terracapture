@extends('layouts.layout_capture')


@section('title', 'EndoINDEX')

@section('style')
@endsection

@section('modal')

@endsection


@section('content')
<link href="{{url("public/assets5/css/layout_home_pt.css")}}" rel="stylesheet" type="text/css" />
    @if(Request::segment(1)=='patient')
        @include('terra.components.patient_create')
    @else
        @include('terra.components.patient_register')
    @endif
@endsection






@section('lpage')
Patient
@endsection
@section('rpage')
Patient
@endsection
@section('rppage')
Create
@endsection


@section('script')
<script src="{{url("public/assets5/libs/prismjs/prism.js")}}"></script>
<script src="{{asset('public/js/jquery.min.js')}}"></script>
<script src="{{asset('public/js/sweetalert2@11.js')}}"></script>
<script src="{{asset('public/js/moment.min.js')}}"></script>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script> --}}

<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

    function back_tab(){
        $("#create_study, #num_study").removeClass('active')
        $("#create_patient, #num_patient").addClass('active')
    }
    function next_tab(){

        $("#create_patient, #num_patient").removeClass('active')
        $("#create_study, #num_study").addClass('active')
    }

    function check_id(id){
        $.post("{{url("terra/import")}}",
            {
                event   : "check_patient_id",
                id      : id,
            },
            function(data, status)
            {
                let is_match = data
                if(is_match != 0){
                    let parse = JSON.parse(is_match)
                    console.log(parse);
                    Swal.fire({
                        title: `กรุณายืนยันชื่อผู้ป่วยว่าใช่คุณ${parse.firstname} ${parse.lastname}หรือไม่`,
                        showDenyButton: true,
                        showCancelButton: false,
                        confirmButtonText: 'ยืนยัน',
                        denyButtonText: `ยกเลิก`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let id = (parse.hn!=null && parse.hn!='') ? parse.hn : ''
                            let prefix = (parse.prefix!=null && parse.prefix!='') ? parse.prefix : ''
                            let firstname = (parse.firstname!=null && parse.firstname!='') ? parse.firstname : ''
                            let middlename = (parse.middlename!=null && parse.middlename!='') ? parse.middlename : ''
                            let lastname =  (parse.lastname!=null && parse.lastname!='') ? parse.lastname : ''
                            let dob = (parse.birthdate!=null && parse.birthdate!='') ? moment(parse.birthdate).format("YYYY-MM-DD") : ''
                            let gender = (parse.gender!=null && parse.gender!='') ? parse.gender : ''
                            gender = gender!='' && gender==1 ? 'ชาย' : 'หญิง'
                            let phone = (parse.phone!=null && parse.phone!='') ? parse.phone : ''
                            let email = (parse.email!=null && parse.email!='') ? parse.email : ''
                            let age = dob != '' ? moment().diff(dob, 'years', false) : ''

                            let patient_json = parse.patient_json != null ? JSON.parse(parse.patient_json) : ''
                            $('input:radio[name=patient_allergy]').filter('[value=no]').prop('checked', true)
                            $('input:radio[name=patient_disease]').filter('[value=no]').prop('checked', true)

                            if(patient_json != ''){
                                if(patient_json.allergic != '-' && patient_json.allergic != '' && patient_json.allergic != null){
                                    $('input:radio[name=patient_allergy]').filter('[value=yes]').prop('checked', true)
                                    $('#allergy_detail').val(patient_json.allergic)
                                }

                                if(patient_json.congenital_disease != '-' && patient_json.congenital_disease != '' && patient_json.congenital_disease != null){
                                    $('input:radio[name=patient_disease]').filter('[value=yes]').prop('checked', true)
                                    $('#disease_detail').val(patient_json.congenital_disease)
                                }
                            }

                            if(id!=''){
                                let url = "{{url('registration')}}"
                                $('#next').prop('href', `${url}/${id}`)
                            }

                            $('#patient_id').val(id)
                            $('#patient_prefix').val(prefix)
                            $('#patient_firstname').val(firstname)
                            $('#patient_lastname').val(lastname)
                            $('#patient_middlename').val(middlename)
                            $('#patient_gender').val(gender)
                            $('#patient_dob').val(dob)
                            $('#patient_age').val(age)
                            $('#patient_phone').val(phone)
                            $('#patient_email').val(email)

                        } else if (result.isDenied) {
                            $('#patient_id').val('')
                        }
                    })
                }
            });
    }
</script>
@endsection
