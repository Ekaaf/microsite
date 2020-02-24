@extends('layout.master')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<!-- BEGIN: Subheader -->
	<div class="m-subheader ">
		<div class="d-flex align-items-center">
			<div class="mr-auto">
				<h3 class="m-subheader__title ">
					Add User
				</h3>
			</div>
		</div>
	</div>
	<!-- END: Subheader -->
	<div class="m-content">
		<div class="m-portlet">
			
			<form class="m-form" method="post" action="{{URL::to('admin/user/usersave')}}" enctype="multipart/form-data">
				@csrf
				<div class="m-portlet__body">
					<div class="m-form__section m-form__section--first">
						@if (Session::has('password_mismatch'))
						<div class="alert alert-danger" role="alert" style="font-weight: bold;">
							{{Session::get('password_mismatch')}}
						</div>
						@endif
						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
								User Name:
							</label>
							<div class="col-lg-6">
								<input type="text" class="form-control m-input" name="name" placeholder="Enter Username" required="" value="{{ old('name') }}">
								<!-- <span class="m-form__help">
									Please enter your username
								</span> -->
							</div>
						</div>

						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
								Email:
							</label>
							<div class="col-lg-6">
								<input type="email" class="form-control m-input" name="email" placeholder="Enter your Email Address" value="{{ old('email') }}">
							</div>
						</div>
						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
								Password:
							</label>
							<div class="col-lg-6">
								<input type="password" class="form-control m-input" name="password" placeholder="Enter your Password" required="" value="{{ old('password') }}">
							</div>
						</div>
						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
								Confirm Password:
							</label>
							<div class="col-lg-6">
								<input type="password" class="form-control m-input" name="confirm_password" placeholder="Confirm your Password" required="" value="confirm_password">
							</div>
						</div>
						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
								Type:
							</label>
							<div class="col-lg-6">
								<select class="form-control m-input" name="type" id="type" onchange="showSelect();" required>
									<option value="">Select</option>
									<option value="1">Admin</option>
									<option value="2">Brand Promoter</option>
									<option value="3">Supervisor</option>
								</select>
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