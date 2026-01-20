@extends('layouts.app')
@section('title', 'EndoINDEX')
@section('content')
	<style>
	canvas {
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
	</style>



<!-- Start content -->
<div class="row">
        <div class="cardcode col-12" style="padding: 0;display:none">
            <div class="card-box">
               <label id="discharge_toggle"><font size ='4'><b>Page Detail</b></font></label>
                <div class="row">
                  <div class="col-12">
                    Controller : <a href="autoit?run=visualcode_open\\endo.exe&path=DashboardController">DashboardController</a>
                  </div>
                  <div class="col-12">
                    View : <a href="autoit?run=visualcode_open\\endo.exe&path=dashboard">dashboard</a>
                  </div>
               </div>
            </div>
        </div>
	<div class="col-12">
		<div class="page-title-box">
			<h4 class="page-title float-left">Analysis Dashboard
				<?php
					if(isset($_GET['sdate'])){
						$sdate = substr(@$_GET['sdate'],0,10);
						$sdate = date("d-m-Y",$sdate);
					}else{
						$sdate = "";
					}

				?>

		</h4>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<!-- end row -->


<div class="clearfix"></div>

<div class="row">



	<div class="col-12">
		<div class="card-box">
			<div class="table-rep-plugin">




			</div>
		</div>
	</div>

@endsection

