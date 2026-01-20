@extends('capture.layoutv6')

@section('style')
<style>
    .page-title-box {
    padding: 15px 1.5rem;

}
</style>
@endsection


@section('modal')
@endsection

@section('title-left')

@endsection


@php
use App\Models\Mongo;

@endphp
@section('content')
{{-- @dd($tb_eq); --}}
<form action="{{url("storemanage")}}" method="POST">
    @csrf
    <input type="hidden" name="event" value="edit_store">
    <input type="hidden" name="eq_id" value="{{@$tb_eq[0]->equipment_id}}">
  <div class="card">
      <h4 class="mb-sm-0 m-4"><b>Store Management</b></h4>
        <div class="row " style="border-bottom: 1px #E9EBEC solid">
            <span class="gs-16 m-4">Edit Equipment</span>
        </div>
        <div class="row m-2 pt-3">
            <div class="col-3">
                <div>
                    <input type="text" class="form-control" placeholder="Search for equipment " value="{{$tb_eq[0]->name}}" name="edit_name">
                </div>
            </div>
            @php
            $sum_equitment = Mongo::table("tb_equipment_store")
            ->where("equipment_id" , $tb_eq[0]->equipment_id)
            ->where("display" , "show")
            ->sum("amount");
            $tb_equitment  = Mongo::table("tb_equipment")->where("eq_id" , $tb_eq[0]->equipment_id)->first();
        // dd($ck_equitment);
        @endphp
            <div class="col-auto pt-1">
                <span class="fs-17">Summary Equipment : {{@$balance}}</span>
            </div>

            <div class="col-auto ">

                <div class="form-check mb-2 pt-1">
                    <input class="form-check-input pt-1 " type="radio" name="check_status" id="flexRadioDefault1" value="active"
                    @checked($tb_equitment->status == "active")>
                    <label class="form-check-label fs-16" for="flexRadioDefault1">
                        Active
                    </label>
                </div>
            </div>
            <div class="col-auto pt-1">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="check_status" id="flexRadioDefault2" value="inactive"
                    @checked($tb_equitment->status == "inactive")>
                    <label class="form-check-label fs-16" for="flexRadioDefault2">
                        Inactive
                    </label>
                </div>
            </div>
        </div>

        <div class="table-responsive table-card m-3">
            <table class="table table-nowrap table-striped-columns mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="cardtableCheck">
                                <label class="form-check-label" for="cardtableCheck"></label>
                            </div>
                        </th>
                        <th scope="col">No.</th>
                        <th scope="col">Equipment</th>
                        <th scope="col">Date Add</th>
                        <th scope="col">Add by </th>

                    </tr>
                </thead>
                <tbody>

                    @php
                        $i = 0;
                    @endphp

                    @foreach ($tb_eq ?? [] as $data)

                    @php
                        $data = (object)$data;
                        $i++;
                        $user_by = Mongo::table("users")->where("uid" , $data->user_use)->first();
                        // dd($user_by);
                        @endphp
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{$data->equipment_id}}" name="ck_name[]">
                                <label class="form-check-label" for="cardtableCheck01"></label>
                            </div>
                        </td>
                        <td>{{ $i }}</td>
                        <td>{{@$data->name}}</td>
                        <td>{{@$data->datetime}}</td>

                        <td>{{fullname(@$user_by)}}</td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="row m-2">
            {{-- <div class="col-3 ps-3">
                <button type="button" class="btn btn-soft-danger btn-icon waves-effect waves-light"><i
                        class="ri-delete-bin-5-line"></i></button>
            </div>
            <div class="col-3 pt-2 text-status-today" >
                <span>Delete Selected</span>
            </div> --}}
            <div class="col-12  text-end" >
                <!-- Buttons with Label Right -->
                <a href="{{url("storemanage")}}" class="btn btn-danger  btn-label waves-effect right waves-light w-lg ">
                    <i class=" ri-arrow-go-back-line label-icon align-middle fs-16 ms-2"></i> Back</a>
                <button type="submit" class="btn btn-primary btn-label waves-effect right waves-light w-lg ms-4"><i
                        class=" ri-play-fill label-icon align-middle fs-16 ms-2"></i> Confirm</button>
            </div>
        </div>
    </div>
    {{-- <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-2 align-self-center text-center">
                    <span class="fs-16 fw-bold"> Edit Equipment by</span>
                </div>
                <div class="col-3 ">
                        <select class="form-select " aria-label="Default select example">
                            <option selected>Select Edit by</option>
                            <option value="1">Nurse1</option>
                            <option value="2">Nurse2</option>
                            <option value="3">Nurse3</option>
                        </select>
                    </div>


            </div>
            </div>
        </div> --}}
    </div>

</form>

@endsection

@section('script')
@endsection
