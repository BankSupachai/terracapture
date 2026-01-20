@extends('layouts.layout_capture')


@section('title', 'EndoINDEX')

@section('style')
<link rel="stylesheet" href="{{url("public/assets5/libs/@simonwep/pickr/themes/classic.min.css")}}" /> <!-- 'classic' theme -->
<link rel="stylesheet" href="{{url("public/assets5/libs/@simonwep/pickr/themes/monolith.min.css")}}" /> <!-- 'monolith' theme -->
<link rel="stylesheet" href="{{url("public/assets5/libs/@simonwep/pickr/themes/nano.min.css")}}" /> <!-- 'nano' theme -->

<style>
    .table-card{
        height: 52vh;
    }
    @media (max-height: 1200px) {
        .table-card{
            height: 62vh;
        }
    }
    @media (max-height: 1477px) {
        .table-card{
            height: 61vh;
        }
    }
    @media (max-height: 1147px) {
        .table-card{
            height: 60vh;
        }
    }
    @media (max-height: 1147px) {
        .table-card{
            height: 58vh;
        }
    }
    @media (max-height: 1065px) {
        .table-card{
            height: 56vh;
        }
    }
    @media (max-height: 1017px) {
        .table-card{
            height: 54vh;
        }
    }
    @media (max-height: 972px) {
        .table-card{
            height: 52vh;
        }
    }
    @media (max-height: 935px) {
        .table-card{
            height: 50vh;
        }
    }
    @media (max-height: 895px) {
        .table-card{
            height: 48vh;
        }
    }
    @media (max-height: 860px) {
        .table-card{
            height: 46vh;
        }
    }
    @media (max-height: 830px) {
        .table-card{
            height: 44vh;
        }
    }
    @media (max-height: 800px) {
        .table-card{
            height: 42vh;
        }
    }
    @media (max-height: 770px) {
        .table-card{
            height: 40vh;
        }
    }
    @media (max-height: 745px) {
        .table-card{
            height: 38vh;
        }
    }
    @media (max-height: 721px) {
        .table-card{
            height: 36vh;
        }
    }
    @media (max-height: 700px) {
        .table-card{
            height: 34vh;
        }
    }
    @media (max-width: 767px) {
        .footer {
            left: 0;
        }
    }
    #tasksTable tr td:last-child,#tasksTable tr th:last-child{
        width: 1%;
        white-space: nowrap;
    }
    .btn-primary{
        background: #3577F1 !important;
        border-color: #3577F1;
    }
    .btn-primary:hover{
        background: #0856e9 !important;
        border-color: #0856e9 !important;
    }
    .btn-primary2 {
        color: #ffff;
        background: #435085 !important;
        border-color: #435085;
    }
    .btn-primary2:hover{
        color: #ffff;
        background: #313b61 !important;
        border-color: #435085 !important;
    }
    .btn-filters{
        background: #405189;
        color: #fff;
    }
    .btn-filters:hover{
        background: #303d66;
        color: #fff;
    }
    .btn-success2{
        background: #0AB39C;
        color: #fff;
    }
    .btn-success2:hover{
        background: #088474;
        color: #fff;
    }
    .btn-danger2{
        background: #F06548;
        color: #fff;
    }
    .btn-danger2:hover{
        background: #ee4827;
        color: #fff;
    }
    .btn-group-vertical>.btn, .btn-group>.btn{margin: 0;}
    .lh25{
        line-height: 2.5em !important;
    }
</style>

@endsection

@section('modal')

@endsection


@section('content')


@include('terra.components.list_head')
@include('terra.components.list_main')



@endsection






@section('lpage')
Cases List
@endsection
@section('rpage')
Cases List
@endsection
@section('rppage')
Study List
@endsection

@section('script')
<script src="{{url("public/assets5/js/pages/form-pickers.init.js")}}"></script>
{{-- <script src="{{url("public/assets5/libs/list.js/list.min.js")}}"></script> --}}
<script src="{{url("public/assets5/libs/list.pagination.js/list.pagination.min.js")}}"></script>
{{-- <script src="{{url("public/assets5/js/pages/tasks-list.init.js")}}"></script> --}}
<script src="{{url("public/assets5/js/pages/form-pickers.init.js")}}"></script>
<script src="{{asset('public/js/jquery.min.js')}}"></script>
{{-- <script src="{{asset('public/js/moment.min.js')}}"></script> --}}

<script src="{{url("public/assets5/libs/@simonwep/pickr/pickr.min.js")}}"></script>
<script src="{{url("public/assets5/js/pages/form-pickers.init.js")}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
{{-- <script src="{{url("public/assets5/js/app.js")}}"></script> --}}

<script>
    function function_search() {

        let range      = $('input[name="btnradio"]:checked').val() // day, week, all
        let hn_or_name = $('#text_search').val().toLowerCase()
        let procedure  = $('#procedure').find(":selected").val().toLowerCase()
        let modality   = $('#modality').find(':selected').val().toLowerCase()
        let table = document.getElementById("tasksTable")
        let tr = table.getElementsByTagName("tr")

        for(x=0;x<tr.length;x++){
            tr[x].style.display = "";
        }

        if(hn_or_name != ''){
            for(i=0;i<tr.length;i++){
                td_hn   = tr[i].getElementsByTagName("td")[0];
                td_name = tr[i].getElementsByTagName("td")[1];

                hn_text = (td_hn != undefined) ? td_hn.innerText.toLowerCase()  : ''
                name_text = (td_name != undefined) ? td_name.innerText.toLowerCase()  : ''

                if(td_hn != undefined && td_name != undefined){
                    if(!hn_text.includes(hn_or_name) && !name_text.includes(hn_or_name)){
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        if(modality != '' && modality != 0){
            for(k=0;k<tr.length;k++){
                td_mod   = tr[k].getElementsByTagName("td")[3];

                mod_text = (td_mod != undefined) ? td_mod.innerText.toLowerCase()  : ''

                if(td_mod != undefined){
                    if(!mod_text.includes(modality)){
                        tr[k].style.display = "none";
                    }
                }
            }
            console.log(modality);
            let pcd = get_procedure(modality)
            set_procedure(pcd)
        }

        if(procedure != ''){
            for(j=0;j<tr.length;j++){
                td_proc   = tr[j].getElementsByTagName("td")[2];

                proc_text = (td_proc != undefined) ? td_proc.innerText.toLowerCase()  : ''

                if(td_proc != undefined){
                    if(!proc_text.includes(procedure)){
                        tr[j].style.display = "none";
                    }
                }
            }
        }

        if(range != 'all'){
            let range_arr = []
            if(range == 'day'){
                let today = moment().format('DD-MM-YYYY')
                range_arr.push(today)
            } else if(range == 'week') {
                range_arr = get_current_week()
            }

            for(y=0;y<tr.length;y++){
                td_date   = tr[y].getElementsByTagName("td")[4]
                date_text = (td_date != undefined) ? td_date.innerText : ''
                if(td_date != undefined){
                    if(!(range_arr.indexOf(date_text) > -1)){
                        tr[y].style.display = "none";
                    }
                }
            }
        }

        let num = 0
        for(z=0;z<tr.length;z++){
            let display = tr[z].style.display
            if(display == ''){
                num += 1
            }
        }
        $('#num_study').text(num-1)

    }

    function get_procedure(modality){
        let pcd = []
        pcd['es'] = ['EGD', 'colonoscopy', 'ERCP', 'Bronchoscope', 'Cystoscopy', 'Esophagoscopy',
                    'Enteroscopy', 'Nasal Endoscopy', 'Ear Endoscopy', 'Change PEG',
                    'Push Enteroscope', 'Rigid Bronchoscopy', 'Pleuroscopy', 'PEG insertion',
                    'Sigmoidscopy', 'Esophagoscopy', 'PM', 'Pain', 'Enteroscopy', 'Laparoscopic']
        pcd['us'] = ['EUS', 'Liver Biopsy', 'Kidney Biopsy', 'Cysto with DJ stent', 'Cystostomy',
                    'Ultrasound-Guided (TTNB/IPC)', 'ENT']
        pcd['ot'] = ['Percutaneous Dilatational Tracheostomy', 'Manometryม Trust with Bx.',
                    'BCG', 'Change DS stent, Change PCN', 'Cysto with RP', 'RP']
        pcd['ct'] = ['PCN', 'Cysto with DJ stent', 'ENT']
        pcd['mr'] = ['ENT']
        pcd['rf'] = ['Cystogram']
        pcd['0']  = 'all'
        return pcd[`${modality}`] ? pcd[`${modality}`]  : []
    }

    function set_procedure(pcd_array){
        let pcd_num = $('#procedure option').length
        console.log('ggg',pcd_num, pcd_array, $('.pdc-opt').length, );
        for(i=0;i<pcd_num;i++){
            if(pcd_array == 'all'){
                $($('#procedure option')[i]).show()
            } else {
                let opt_text = $($('#procedure option')[i]).text()
                $($('#procedure option')[i]).show()
                if(pcd_array.indexOf(opt_text) < 0){
                    $($('#procedure option')[i]).hide()
                }
            }
        }
    }

    function get_current_week(){
        let current_date = moment()
        let week_start = current_date.clone().startOf('isoWeek')
        let week_end = current_date.clone().endOf('isoWeek')
        let this_week = []
        for (var i = 0; i <= 6; i++) {
            this_week.push(moment(week_start).add(i, 'days').format("DD-MM-YYYY"));
        }
        return this_week
    }



</script>
@endsection
