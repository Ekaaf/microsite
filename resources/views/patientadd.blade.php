@extends('layout.master')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<!-- BEGIN: Subheader -->
	<div class="m-subheader ">
		<div class="d-flex align-items-center">
			<div class="mr-auto">
				<h3 class="m-subheader__title ">
					Add Patient
				</h3>
			</div>
		</div>
	</div>
	<!-- END: Subheader -->
	<div class="m-content">
		<div class="m-portlet">
			<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/bindings/inputmask.binding.js"></script>
			<form class="m-form" method="post" action="{{URL::to('admin/patient/patientsave')}}" enctype="multipart/form-data">
				@csrf
				<div class="m-portlet__body">
					<div class="m-form__section m-form__section--first">
						@if (Session::has('message'))
						<div class="alert alert-danger" role="alert" style="font-weight: bold;">
							{{Session::get('message')}}
						</div>
						@endif

						<div class="alert alert-danger" id="errordiv" role="alert" style="font-weight: bold;display: none;">
						</div>
						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
								Unique ID:
							</label>
							<div class="col-lg-6" id="uniqueIdDiv">
								<input type="text" class="form-control m-input" name="unique_id" placeholder="Enter Unique ID range" id="unique_id" required="" >
							</div>

						</div>

						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
								Assigned Chamber:
							</label>
							<div class="col-lg-6">
								<input type="text" class="form-control m-input" name="assigned_chamber" id="assigned_chamber" placeholder="Enter Chamber" required="" >
							</div>
						</div>

						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
								Name:
							</label>
							<div class="col-lg-6">
								<input type="text" class="form-control m-input" name="name" id="name" placeholder="Enter Name" required="" >
							</div>
						</div>

						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
								Age:
							</label>
							<div class="col-lg-6">
								<input type="text" class="form-control m-input" name="age" placeholder="Enter Age" required="" >
							</div>
						</div>

						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
								Gender:
							</label>
							<div class="col-lg-6">
								<select class="form-control m-input" name="gender" id="gender" required>
									<option value="">Select</option>
									<option value="Male">Male</option>
									<option value="Female">Female</option>
								</select>
							</div>
						</div>

						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
								Marrital Status:
							</label>
							<div class="col-lg-6">
								<select class="form-control m-input" name="marrital_status" id="marrital_status" required>
									<option value="">Select</option>
									<option value="Married">Married</option>
									<option value="Unmarried">Unmarried</option>
								</select>
							</div>
						</div>

						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
								Phone Number:
							</label>
							<div class="col-lg-6">
								<input type="number" class="form-control m-input" name="phone" placeholder="Enter Phone Number" required="" >
							</div>
						</div>

						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
								Address:
							</label>
							<div class="col-lg-6">
								<input type="text" class="form-control m-input" name="address" placeholder="Enter Address" required="" >
							</div>
						</div>

						
					</div>
				</div>
				<div class="m-portlet__foot m-portlet__foot--fit">
					<div class="m-form__actions m-form__actions">
						<div class="row">
							<div class="col-lg-3"></div>
							<div class="col-lg-6">
								<button type="submit" class="btn btn-success">
									Submit
								</button>
								<button type="reset" class="btn btn-secondary">
									Cancel
								</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@stop