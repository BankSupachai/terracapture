@extends('capture.layoutv6')

@section('style')
    <style>
        .fs-14 {
            font-size: 14px;
        }
    </style>
@endsection


@section('modal')
@endsection


@section('title-left')

@endsection

@include('capture.camera.obs.js_hotkey')

@section('content')
    @php
use App\Models\Mongo;
use App\Models\Equipment;


        $date_report = date('Y/m/d');
        $time_report = date('h : i : sa ');

        if (isset($admin->theme_fontsize)) {
            $theme_fontsize = $admin->theme_fontsize . 'px';

            if ($admin->theme_fontsize == '50') {
                $theme_fontsize = '10px';
            }
            if ($admin->theme_fontsize == '75') {
                $theme_fontsize = '12px';
            }
            if ($admin->theme_fontsize == '100') {
                $theme_fontsize = '14px';
            }
            if ($admin->theme_fontsize == '125') {
                $theme_fontsize = '16px';
            }
            if ($admin->theme_fontsize == '150') {
                $theme_fontsize = '18px';
            }
            if ($admin->theme_fontsize == '175') {
                $theme_fontsize = '20px';
            }
        } else {
            $theme_fontsize = '14px';
        }

        // dd($theme_fontsize);
        echo "<style>
    input   {font-size: $theme_fontsize!important;}
    .row    {font-size: $theme_fontsize !important;}
    button  {font-size: $theme_fontsize !important;}
    a       {font-size: $theme_fontsize !important;}
    select  {font-size: $theme_fontsize !important;}
</style>";

    @endphp

    <div class="row ps-2">

        {{-- @include('case.component.procedure_edit')
    @include('case.component.new.patient_detail')
    @include('case.component.admin_alert') --}}
        {{-- <div class="row m-0  justify-content-center fs-14" >
        <ul class="nav nav-pills arrow-navtabs nav-success bg-light mb-2" role="tablist">
            @if (@$feature->health_record)
                <li class="nav-item">
                    <a class="nav-link nav-size  " href="{{ url('note/health') }}/{{ $cid }}"><i
                            class="fas fa-user-md"></i> Health
                        Record</a>
                </li>
            @endif
            @if (@$feature->physician_record)
                <li class="nav-item ">
                    <a class="nav-link nav-size " href="{{ url('procedure') }}/{{ $cid }}">
                        <span class="d-block d-sm-none"><i class="mdi mdi-account"></i></span>
                        <span class="d-none d-sm-block">Physician Record</span>
                    </a>
                </li>
            @endif
            @if (@$feature->nurse_record)
                <li class="nav-item ">
                    <a class="nav-link nav-size" href="{{ url('note/note/') }}/{{ $cid }}">
                        <span class="d-block d-sm-none"><i class="mdi mdi-email"></i></span>
                        <span class="d-none d-sm-block">Nurse Record</span>
                    </a>
                </li>
            @endif
            @if (@$feature->billing_record)
                <li class="nav-item ">
                    <a class="nav-link nav-size" href="{{ url('note/billing') }}/{{ $cid }}">
                        <span class="d-block d-sm-none"><i class="mdi mdi-email"></i></span>
                        <span class="d-none d-sm-block">Billing Record</span>
                    </a>
                </li>

            @endif

            @if (@$feature->store_management)
            <li class="nav-item ">
                <a class="nav-link nav-size active" href="{{ url('store') }}/{{ $cid }}">
                    <span class="d-block d-sm-none"><i class="mdi mdi-email"></i></span>
                    <span class="d-none d-sm-block">Store Management</span>
                </a>
            </li>
        @endif
        </ul>
    </div> --}}
        <div class="card ps-2">
            <h4 class="mb-sm-0 m-4"><b>Store Management</b></h4>
            <div class="row col-12 m-2 pt-3 ps-1">
                <div class="col-3">

                    <div>
                        <input type="text" class="form-control" placeholder="Search for equipment " id="seacrh_filter">
                    </div>
                </div>

                <div class="col-2">
                    <select class="form-select mb-3" aria-label="Default select example" id="select_filter" onchange="filterStatus()">
                        <option value="">ทั้งหมด</option>
                        <option value="Active">ใช้งาน</option>
                        <option value="Inactive">ไม่ใช้งาน</option>
                    </select>
                </div>
                <script>
                function filterStatus() {
                    var status = document.getElementById("select_filter").value;
                    var table = document.getElementById("table_store");
                    var tr = table.getElementsByTagName("tr");

                    for (var i = 0; i < tr.length; i++) {
                        var td = tr[i].getElementsByTagName("td")[3];
                        if (td) {
                            var txtValue = td.textContent || td.innerText;
                            txtValue = txtValue.trim(); // ลบช่องว่างหน้าและหลัง
                            if (status === "") {
                                tr[i].style.display = "";
                            } else if (txtValue === status) {
                                tr[i].style.display = "";
                            } else {
                                tr[i].style.display = "none";
                            }
                        }
                    }
                }
                </script>
                {{-- <div class="col-auto">
                    <!-- Buttons with Label -->
                    <button type="button" class="btn btn-primary btn-label waves-effect w-md waves-light"
                        style="width: 128px;"><i class="ri-search-line label-icon align-middle fs-16 me-2"></i>
                        Search</button>
                </div> --}}
                <div class="col-5 text-end">
                    <a href="{{ url('storemanage/create') }}" class="btn btn-soft-success waves-effect w-lg waves-light"
                        style="width: 260px">Insert
                        Equipment</a>
                </div>
            </div>
            @php
                $i = count($tb_eq); // นับจำนวนรายการทั้งหมดก่อน
            @endphp
            <div class="row ps-4">
                <span>Summary Inventory : {{ $i }}</span>
            </div>
            <div class="table-responsive table-card m-3">


                <table class="table table-nowrap table-striped-columns text-center mb-0 " >
                    <thead class="table-light">
                        <tr>

                            <th scope="col">No.</th>
                            <th scope="col" class="text-start">Equipment</th>
                            <th scope="col">Total quantity</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody id="table_store">
                        @php
                            $count = 0; // เปลี่ยนจาก $i เป็น $count สำหรับการนับในตาราง
                        @endphp

                        @foreach ($tb_eq as $data)
                            <tr>
                                @php
                                    $data = (object) $data;
                                    $count++;
                                @endphp
                                <td>{{ $count }}</td>
                                <td class="text-start">{{ $data->name }}</td>

                                <td>
                                    @php
                                        $eq_store = Equipment::balance($data->eq_id);
                                    // dd($eq_store);
                                    @endphp
                                    {{ @$eq_store }}

                                </td>
                                <td>
                                    @if ($data->status == 'active')
                                        <span class="badge badge-soft-success">
                                            Active
                                        </span>
                                    @endif
                                    @if ($data->status == 'inactive')
                                        <span class="badge badge-soft-danger">
                                            Inactive
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url("storemanage/$data->eq_id/edit/") }}"
                                        class="btn btn-sm w-sm btn-success">Edit</a>
                                </td>
                            </tr>
                        @endforeach



                    </tbody>
                </table>
            </div>

        </div>
        <div class="card">
            <div class="row">

                <div class="col-auto m-4 pt-1">
                    <span class="fs-16"> Last Updated</span>
                </div>
                <div class="col-3 m-4">
                    <div>
                        <input type="text" class="form-control" id="disabledInput" value="2024-08-27" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
      $("#seacrh_filter").on("keyup", function() {
        var value = $(this).val().toLowerCase();

        $("#table_store tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
    </script>
@endsection
