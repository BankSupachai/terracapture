@extends('layouts.app')
@section('title', 'EndoINDEX')
@section('content')


<!-- Start content -->
<div class="row">
    <div class="cardcode col-12" style="padding: 0;display:none">
        <div class="card-box">
           <label id="discharge_toggle"><font size ='4'><b>Page Detail</b></font></label>
            <div class="row">
              <div class="col-12">
                Controller : <a href="autoit?run=visualcode_open\\endo.exe&path=ProcedureSearchController">ProcedureSearchController</a>
              </div>
              <div class="col-12">
                View : <a href="autoit?run=visualcode_open\\endo.exe&path=procedure_search">procedure_search</a>
              </div>
           </div>
        </div>
    </div>
	<div class="col-12">
		<div class="page-title-box">
			<h4 class="page-title float-left">Search
				<?php
					if(isset($_GET['sdate'])){
						$sdate = substr(@$_GET['sdate'],0,10);
						$sdate = date("d-m-Y",$sdate);
					}else{
						$sdate = "";
					}

				?>

		</h4>

			<ol class="breadcrumb float-right">
				<li class="breadcrumb-item"><a href="#">Search</a></li>
				<li class="breadcrumb-item"><a href="#">Information Search</a></li>
			</ol>

			<div class="clearfix"></div>
		</div>
	</div>
</div>
<!-- end row -->


<div class="clearfix"></div>

<div class="row">
	<div class="col-12">
		<div class="card-box">

			<form action="" method="get">
			<div class="row">

				<div class="col-10 form-group">
							<input type="search" name="search" class="form-control" style="width:100%">
				</div>
				<div class="col-2">
					<span class="form-group-btn" >
						<button type="submit" class="btn btn-primary" style="width:100%">ค้นหา</button>
					</span>
				</div>

			</div>
		</form>


			<div class="table-rep-plugin">

					@if(Session::has('message'))
						<div class="alert alert-info">
						{{ Session::get('message')}}
						</div>
					@endif
					<table id="tech-companies-1" class="table table-striped" data-add-focus-btn="">
						<thead>
						<tr>
							<th width="10">#</th>
							<th width="150">Procedure</th>
							<th width="150">Name</th>
							<th width="300" data-priority="3">ICD-9</th>
							<th width="300">ICD-10</th>
							<th width="80">Select</th>
						</tr>
						</thead>
						<tbody>
							@forelse($procedure as $l)
							<tr>
								<td>{{ $l->case_id }}</td>
								<td>{{ $l->procedure_name }}</td>
								<td>{{ $l->firstname }} {{ $l->lastname}}</td>
								<td>




								  @php
								  $acc = json_decode($l->icd9);
								  @endphp

								  @if($l->icd9!="")
								    @foreach ($acc as $a)
								          @if($a!="")
								          	{{ str_limit($a, $limit = 35, $end = '...') }}<br>
								          @endif
								    @endforeach
								  @endif


								</td>


								<td>


								  @php
								  $acc = json_decode($l->recommendation);
								  @endphp

								  @if($l->recommendation!="")
								    @foreach ($acc as $a)
								          @if($a!="")
								          	{{ str_limit($a, $limit = 35, $end = '...') }}<br>
								          @endif
								    @endforeach
								  @endif


								</td>




								<td><a href="procedure/{{$l->id}}/?case_id={{ $l->case_id }}" type="button" class="btn btn-icon waves-effect waves-light btn-success"> <i class="fa fa-save "></i> </a></td>
							</tr>
							@empty
							  <tr>
									<td colspan="9">No data!!! </td>
							  </tr>
							@endforelse
						</tbody>
					</table>
			</div>

					{{ $procedure->links() }}

		</div>
	</div>


@endsection
