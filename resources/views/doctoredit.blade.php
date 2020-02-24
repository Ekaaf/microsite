@extends('layout.master')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<!-- BEGIN: Subheader -->
	<div class="m-subheader ">
		<div class="d-flex align-items-center">
			<div class="mr-auto">
				<h3 class="m-subheader__title ">
					Add Doctor
				</h3>
			</div>
		</div>
	</div>
	<!-- END: Subheader -->
	<div class="m-content">
		<div class="m-portlet">
			<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/bindings/inputmask.binding.js"></script>
			<form class="m-form" method="post" action="{{URL::to('admin/doctor/updatedoctor')}}" enctype="multipart/form-data">
				@csrf
				<input type="hidden" name="id" value="{{$id}}">
				<div class="m-portlet__body">
					<div class="m-form__section m-form__section--first">
						@if (Session::has('message'))
						<div class="alert alert-danger" role="alert" style="font-weight: bold;">
							{{Session::get('message')}}
						</div>
						@endif
						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
								Unique ID:
							</label>
							<div class="col-lg-6" id="uniqueIdDiv">
								<?php
									$i = 1;
								?>
								@foreach($doctor as $doc)
								
								<input type="text" placeholder="Enter Start Range" class="form-control mb-1" name="uniqueid[start_range][]" id="start_range<?php echo $i; ?>" style="width: 40%!important;display: inline-block;" value="{{$doc->start_range}}" required>
                					<input type="text" placeholder="Enter End Range" class="form-control ml-1 mb-1" name="uniqueid[end_range][]" style="width: 40%!important;display: inline-block;" id="end_range<?php echo $i; ?>" value="{{$doc->end_range}}" required>

								<?php
									// if($i!=$length){
									// 	echo "<br>";
									// }
									$i++;
								?>
								@endforeach
								
							</div>
							<input type="hidden" name="i" id="i" value="{{$i}}">
							<div class="col-lg-2">
								<button type="button" class="btn btn-success" id="addUniqueID">
									Add UniqueID
								</button>
							</div>
						</div>

						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
								Name:
							</label>
							<div class="col-lg-6">
								<input type="text" class="form-control m-input" name="name" placeholder="Enter Doctor Name" required="" value="{{ old('name', $doctor[0]->name) }}">
							</div>
						</div>

						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
								BMDC Registrarion No:
							</label>
							<div class="col-lg-6">
								<input type="text" class="form-control m-input" name="bmdc" placeholder="Enter BMDC Registrarion No" required="" value="{{ old('name', $doctor[0]->bmdc) }}">
							</div>
						</div>

						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
								Gender:
							</label>
							<div class="col-lg-6">
								<select class="form-control m-input" name="gender" id="gender" required>
									<option value="">Select</option>
									<option value="Male" <?php if($doctor[0]->gender=="Male") echo "selected"; ?>>Male</option>
									<option value="Female" <?php if($doctor[0]->gender=="Female") echo "selected"; ?>>Female</option>
								</select>
							</div>
						</div>


						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
								Chamber Name:
							</label>
							<div class="col-lg-6">
								<input type="text" class="form-control m-input" name="chamber_name" placeholder="Enter Chamber Name" required="" value="{{ old('chamber_name', $doctor[0]->chamber_name) }}">
							</div>
						</div>

						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
								Phone Number:
							</label>
							<div class="col-lg-6">
								<input type="number" class="form-control m-input" name="phone" placeholder="Enter Phone Number" required="" value="{{ old('phone', $doctor[0]->phone) }}">
							</div>
						</div>

						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
								Chamber Address:
							</label>
							<div class="col-lg-6">
								<input type="text" class="form-control m-input" name="chamber_address" placeholder="Enter Chamber Address" required="" value="{{ old('chamber_address', $doctor[0]->chamber_address) }}">
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