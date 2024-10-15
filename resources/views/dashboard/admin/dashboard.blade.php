@extends('Dashboard.layouts.master')
@section('css')
<!--  Owl-carousel css-->
<link href="{{URL::asset('dashboard/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('dashboard/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="left-content">
						<div>
						  <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">لوحة تحكم الادمن</h2>

						</div>
					</div>
					<div class="main-dashboard-header-right">

						<div>
							<label class="tx-13">عدد الخدمات المفردة</label>
							<h5>{{$single_service}}</h5>
						</div>
						<div>
							<label class="tx-13">عدد الخدمات المجمعة</label>
							<h5>{{$group_services}}</h5>
						</div>
					</div>
				</div>
				<!-- /breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-primary-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">عدد الاطباء</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$doctors}}</h4>

										</div>
										<span class="float-right my-auto mr-auto">
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
						</div>
					</div>
					<div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-danger-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">عدد المرضي</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$patients}}</h4>

										</div>
										<span class="float-right my-auto mr-auto">

										</span>
									</div>
								</div>
							</div>
							<span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
						</div>
					</div>
					<div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-success-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">عدد الاقسام</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$sections}}</h4>

										</div>
										<span class="float-right my-auto mr-auto">

										</span>
									</div>
								</div>
							</div>
							<span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
						</div>
					</div>


				</div>
				<!-- row closed -->

                <div class="row row-sm">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">قائمة المواعيد المحجوزة</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>

							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table mg-b-0 text-md-nowrap">
										<thead>
											<tr>
												<th>#</th>
												<th>اسم الدكتور</th>
												<th>القسم</th>
												<th>اسم المريض</th>
												<th>البريد الالكتروني</th>
												<th>رقم الهاتف</th>
												<th>حالة الحجز</th>
												<th>موعد الحجز</th>
											</tr>
										</thead>
										<tbody>
                                        @foreach($appointments as $appointment)
											<tr>
												<th>{{$loop->iteration}}</th>
												<td>{{$appointment->doctor->name}}</td>
												<td>{{$appointment->section->name}}</td>
												<td>{{$appointment->name}}</td>
												<td>{{$appointment->email}}</td>
												<td>{{$appointment->phone}}</td>
												<td>{{$appointment->type}}</td>
												<td>{{$appointment->appointment_patient}}</td>
											</tr>
                                            @endforeach

										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				<!-- row opened -->

			</div>
		<!-- Container closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('dashboard/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('dashboard/plugins/raphael/raphael.min.js')}}"></script>
<!--Internal  Flot js-->
<script src="{{URL::asset('dashboard/plugins/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
<script src="{{URL::asset('dashboard/js/dashboard.sampledata.js')}}"></script>
<script src="{{URL::asset('dashboard/js/chart.flot.sampledata.js')}}"></script>
<!--Internal Apexchart js-->
<script src="{{URL::asset('dashboard/js/apexcharts.js')}}"></script>
<!-- Internal Map -->
<script src="{{URL::asset('dashboard/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{URL::asset('dashboard/js/modal-popup.js')}}"></script>
<!--Internal  index js -->
<script src="{{URL::asset('dashboard/js/index.js')}}"></script>
<script src="{{URL::asset('dashboard/js/jquery.vmap.sampledata.js')}}"></script>
@endsection
