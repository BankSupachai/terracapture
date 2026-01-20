@php
$head = configTYPE('pdf', 'pdf_folder_head');
$pathhispatient = $_SERVER['DOCUMENT_ROOT'] . "/config/views/his/$head/patient_get_detail.blade.php";
@endphp
@if (is_file($pathhispatient))
@include("his.$head.patient_get_detail")
@else
@include('endo.patient.his.00000')
@endif
