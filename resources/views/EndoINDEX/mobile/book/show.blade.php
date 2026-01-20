@extends('mobile/book_emptylayout')
@section('title', 'EndoBook')
@section('style')
    <style>
        *{
            color: #878a99;
            font-weight: normal !important;
        }
        .btn-addevent{

            font-size: 16px;
            border-radius: 50%
        }
        .btn-addevent i{
            color: #495057 !important;

        }
        .badge-soft-secondary{
            color: #245788 !important;
        }
    </style>
@endsection
@section('content')

    <div class="row p-0 align-self-center" style="border-bottom: 1px solid #e9ebec;">
        <div class="col-12 p-3">
            <a href="{{url("mobile/book")}}" class="">
                <i class="ri ri-arrow-go-back-fill ri-lg"></i>
            </a> &ensp;
          <span class="fs-16">Wednesday, 10 March</span>
        </div>
    </div>




<div class="row mb-2">
    <div class="col-4 align-self-center">
        Event Category
    </div>
    <div class="col-2 align-self-center">
        <span class="badge badge-soft-secondary">Case List</span>
    </div>
    <div class="col-6 text-end ">
        <button class="btn btn-addevent">
            <i class="ri-add-circle-fill"></i>
        </button>
    </div>
    <div class="col-4 align-self-center">
        Density Status
    </div>
    <div class="col-2 align-self-center">
        <span class="badge badge-soft-warning">Available</span>
    </div>
    <div class="col-12 mt-2">
        Cases: 5
    </div>
</div>




<table class="table table-borderless" style="border-left: 4px solid #245788; ">

@foreach ($tb_booking as $data)
<tr>

    <td>&ensp; 08:00</td>
    <td >{{@$data['hn']}}</td>
    <td>{{@$data['patient_name']}}</td>
    <td>{{@$data->procedure}}</td>
</tr>


@endforeach
</table>

<table class="table table-borderless" style="border-left: 4px solid #0ab39c;">
    <tr>
        <td> &ensp;09:00</td>
        <td>987654321</td>
        <td>แบงค์ ซ่ามากครับ</td>
        <td>EGD</td>

    </tr>
</table>

@endsection

