@extends('control.base_layout._layout')
@section('style')
<style type="text/css">
	.invalid-feedback {
		display: block;
	}
</style>
@endsection
@section('content')
	<div class="container">
		<div class="card card-custom">
			<div class="card-header">
				<div class="card-title">
					<h3 class="card-label">Library 
					<small>Create</small></h3>
				</div>
			</div>
			<div class="card-body">
				<form action="{{ route('library.store')}}" method="POST" enctype="multipart/form-data">
					@csrf
					{{-- Library Image --}}
					<div class="form-group row" style="text-align: center;">
						<label class="col-xl-12 col-lg-12 col-form-label text-center">Library Image</label>
						<div class="col-lg-12 col-xl-12">
							<div class="image-input image-input-outline" id="kt_image_1">
								<div class="image-input-wrapper"></div>
								<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change Image">
									<i class="fa fa-pen icon-sm text-muted"></i>
									<input type="file" name="image" accept=".png, .jpg, .jpeg">
								</label>
								<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel Image">
									<i class="ki ki-bold-close icon-xs text-muted"></i>
								</span>
							</div>
							<span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
						</div>
						<div class="invalid-feedback">{{$errors->first('image')}}</div>						
					</div>

					{{-- Library Name --}}
					<div class="form-group">
						<label>Name
						<span class="text-danger">*</span></label>
						<input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Library Name">
						<div class="invalid-feedback">{{$errors->first('name')}}</div>
					</div>

					{{-- Library Email --}}
					<div class="form-group">
						<label>Email
						<span class="text-danger">*</span></label>
						<input type="email" name="email" class="form-control" value="{{old('email')}}" placeholder="Email Address">
						<div class="invalid-feedback">{{$errors->first('email')}}</div>
					</div>

					{{-- Library Phone --}}
					<div class="form-group">
						<label>Phone
						<span class="text-danger">*</span></label>
						<input type="text" name="phone" class="form-control" value="{{old('phone')}}" placeholder="Phone Number">
						<div class="invalid-feedback">{{$errors->first('phone')}}</div>
					</div>

					{{-- Library Password --}}
					<div class="form-group">
						<label>Password
						<span class="text-danger">*</span></label>
						<input type="password" name="password" class="form-control" value="{{old('password')}}" placeholder="Password">
						<div class="invalid-feedback">{{$errors->first('password')}}</div>
					</div>


					

					{{-- Form Buttons --}}
					<div class="card-footer">
						<button type="submit" class="btn btn-primary mr-2">Submit</button>
						<button type="reset" class="btn btn-secondary">Cancel</button>
					</div>
				</form>
				
			</div>
		</div>

	</div>
@endsection
@section('script')
	<script src="{{asset('control/style/assets/js/pages/crud/file-upload/image-input.js?v=7.0.8')}}"></script>
@endsection