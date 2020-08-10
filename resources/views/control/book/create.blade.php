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
					<h3 class="card-label">Book 
					<small>Create</small></h3>
				</div>
			</div>
			<div class="card-body">
				<form action="{{ route('book.store')}}" method="POST" enctype="multipart/form-data">
					@csrf
					{{-- Library Image --}}
					<div class="form-group row" style="text-align: center;">
						<label class="col-xl-12 col-lg-12 col-form-label text-center">Book Image</label>
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

					{{-- Book Title --}}
					<div class="form-group">
						<label>Title
						<span class="text-danger">*</span></label>
						<input type="text" name="title" class="form-control" value="{{old('title')}}" placeholder="Book Title">
						<div class="invalid-feedback">{{$errors->first('title')}}</div>
					</div>

					{{-- Book Author --}}
					<div class="form-group">
						<label>Author
						<span class="text-danger">*</span></label>
						<input type="text" name="author" class="form-control" value="{{old('author')}}" placeholder="Author Name">
						<div class="invalid-feedback">{{$errors->first('author')}}</div>
					</div>

					{{-- Book Writer --}}
					<div class="form-group">
						<label>Writer
						<span class="text-danger">*</span></label>
						<input type="text" name="writer" class="form-control" value="{{old('writer')}}" placeholder="Writer Name">
						<div class="invalid-feedback">{{$errors->first('writer')}}</div>
					</div>

					{{-- Book Publisher --}}
					<div class="form-group">
						<label>Publisher
						<span class="text-danger">*</span></label>
						<input type="text" name="publisher" class="form-control" value="{{old('publisher')}}" placeholder="Publisher Name">
						<div class="invalid-feedback">{{$errors->first('publisher')}}</div>
					</div>

					{{-- Book ISBN --}}
					<div class="form-group">
						<label>ISBN
						<span class="text-danger">*</span></label>
						<input type="text" name="isbn" class="form-control" value="{{old('isbn')}}" placeholder="ISBN">
						<div class="invalid-feedback">{{$errors->first('isbn')}}</div>
					</div>

					{{-- Book Publish Date --}}
					<div class="form-group">
						<label>Publish Date
						<span class="text-danger">*</span></label>
						<input type="text" name="publish_date" class="form-control" value="{{old('publish_date')}}" placeholder="Publish Date">
						<div class="invalid-feedback">{{$errors->first('publish_date')}}</div>
					</div>

					{{-- Book Category --}}
					<div class="form-group">
						<label for="exampleSelect1">Category 
						<span class="text-danger">*</span></label>
						<select class="form-control" name="category_id">
				        	@foreach( $categories as $category )
				        		<option value="{{$category->id}}">{{$category->name}}</option>
				        	@endforeach
						</select>
						<div class="invalid-feedback">{{$errors->first('category_id')}}</div>			
					</div>

					{{-- Book Library --}}
					<div class="form-group">
						<label for="exampleSelect1">Library 
						<span class="text-danger">*</span></label>
						<select class="form-control" name="library_id">
				        	@foreach( $libraries as $library )
				        		<option value="{{$library->id}}">{{$library->name}}</option>
				        	@endforeach
						</select>
						<div class="invalid-feedback">{{$errors->first('library_id')}}</div>			
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