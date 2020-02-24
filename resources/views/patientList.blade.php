@extends('layout.master')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<!-- BEGIN: Subheader -->
	<div class="m-subheader ">
		<div class="d-flex align-items-center">
			<div class="mr-auto">
				<h3 class="m-subheader__title ">
					Patient List
				</h3>
			</div>
		</div>
	</div>
	<!-- END: Subheader -->
	<div class="m-content">
		<div class="m-portlet m-portlet--mobile">
			<div class="m-portlet__head"></div>
			<div class="m-portlet__body">

				<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
					
					<div class="row align-items-center">
						<div class="col-xl-8 order-2 order-xl-1">
							<div class="form-group m-form__group row align-items-center">
								<div class="col-md-4">
									<!-- Search Parameter -->
								</div>
							</div>
						</div>
					</div>
				</div>
				<table class="table table-bordered" id="patientTable">
					<thead style="background: #EEEEEE;">
						<tr>
							<th scope="col">#</th>
							<th scope="col">UniqueID</th>
							<th scope="col">Assigned Chamber</th>
							<th scope="col">Name</th>
							<th scope="col">Age</th>
							<th scope="col">Gender</th>
							<th scope="col">Marrital Status</th>
							<th scope="col">Mobile</th>
							<th scope="col">Address</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@stop