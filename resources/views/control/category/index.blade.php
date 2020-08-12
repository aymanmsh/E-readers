@extends('control.base_layout._layout')
@section('style')
<style type="text/css">
	td.settings {
		text-align: center;
	}
	td a {
		border-radius: 0px !important;
	}
	#kt_card_1 {
		margin-bottom: 15px;
	}
</style>
@endsection
@section('content')
	<div class="container">
		<div class="card card-custom" id="kt_card_1">
			<div class="card-header">
				<div class="card-title">
					<h3 class="card-label">{{trans('categories.view.search_category')}}</h3>
				</div>
			</div>
			<div class="card-body">
				<form action="">
					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label>{{trans('categories.view.category_name')}}</label>
								<input type="text" class="form-control" name="name" value="{{app('request')->input('name')}}" placeholder="{{trans('categories.view.category_name')}}">
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label for="exampleSelect1">{{trans('categories.view.category_language')}}</label>
								<select class="form-control" name="lang">
									<option value="en"{{app('request')->input('lang') == 'en' ? 'selected' : ''}}>English</option>
									<option value="ar"{{app('request')->input('lang') == 'ar' ? 'selected' : ''}}>Arabic</option>
								</select>
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-primary mr-2">Search</button>
					<a href="{{route('category.index')}}" class="btn btn-secondary">Cancel</a>
				</form>
			</div>
		</div>









		<div class="card card-custom" id="kt_card_2">
			<div class="card-header">
				<div class="card-title">
					<h3 class="card-label">{{trans('categories.view.all_categories')}}</h3>
				</div>
				<div class="card-toolbar">
					<a href="#" class="btn btn-icon btn-sm btn-hover-light-primary mr-1" data-card-tool="toggle" data-toggle="tooltip" data-placement="top" title="Toggle Card">
						<i class="ki ki-arrow-down icon-nm"></i>
					</a>
					<a href="#" class="btn btn-icon btn-sm btn-hover-light-primary mr-1" data-card-tool="reload" data-toggle="tooltip" data-placement="top" title="Reload Card">
						<i class="ki ki-reload icon-nm"></i>
					</a>
					<a href="#" class="btn btn-icon btn-sm btn-hover-light-primary" data-card-tool="remove" data-toggle="tooltip" data-placement="top" title="Remove Card">
						<i class="ki ki-close icon-nm"></i>
					</a>
				</div>
			</div>
			<div class="card-body">
				<table class="table">
				    <thead class="thead-dark">
				        <tr>
						    <th scope="col">#</th>
						    <th scope="col">{{trans('categories.view.category_name')}}</th>
						    <th scope="col">{{trans('categories.view.category_language')}}</th>
						    <th scope="col">Settings</th>
						</tr>
				    </thead>
				    <tbody>
				    	<?php
                            $count = 1;
                            if(app('request')->input('page') == null || app('request')->input('page') == 1) {
                                $count = 1;
                            } else {
                                $count = ((app('request')->input('page') * 10)) - 9;
                            }
				    	?>
				        @foreach( $categories as $category )
				        	<tr>
				        		<td>{{$count++}}</td>
				        		<td>{{$category->name}}</td>
				        		<td>{{$category->lang}}</td>
				        		<td class="settings">
				        			<a class="btn btn-primary" href="{{route('category.edit', ['id' => $category->id])}}"><i class="fa fa-edit"></i></a>
				        			<a class="btn btn-danger remove-category" data-id="{{$category->id}}"><i class="fa fa-trash"></i></a>
				        		</td>
				        	</tr>
						@endforeach
				    </tbody>
				</table>
				<div class="com-md-12 text-right">
                    {{$categories->links()}}
                </div>
			</div>
		</div>
	</div>
@endsection
@section('script')
	<script src="{{asset('control/style/assets/js/pages/features/miscellaneous/sweetalert2.min.js')}}" type="text/javascript"></script>
	<script type="text/javascript">
		$('.remove-category').on('click', function(event) {
			event.preventDefault();
			var id = $(this).data('id');
			console.log(id);
			Swal.fire({
			title: '{{trans('categories.messages.delete_confirmation')}}',
			text: "{{trans('categories.messages.delete_alert')}}",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: '{{trans('categories.messages.continue_delete')}}'
		}).then((result) => {
		if (result.value) {
			window.location = '{{route("category.destroy")}}/' + id
			Swal.fire(
				'{{trans('categories.messages.delete_done')}}',
				'{{trans('categories.messages.delete_message')}}',
				'success'
			)
		}
		})
		});
	</script>
@endsection
