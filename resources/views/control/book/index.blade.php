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
					<h3 class="card-label">Search Books</h3>
				</div>
			</div>
			<div class="card-body">				
				<form action="">
					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label>Book Title </label>
								<input type="text" class="form-control" name="title" value="{{app('request')->input('title')}}" placeholder="Enter Title">
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label>ISBN </label>
								<input type="text" class="form-control" name="isbn" value="{{app('request')->input('isbn')}}" placeholder="Enter ISBN">
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-primary mr-2">Search</button>
					<a href="{{route('book.index')}}" class="btn btn-secondary">Cancel</a>
				</form>
			</div>
		</div>









		<div class="card card-custom" id="kt_card_2">
			<div class="card-header">
				<div class="card-title">
					<h3 class="card-label">All Books</h3>
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
						    <th scope="col">Title</th>
						    <th scope="col">Author</th>
						    <th scope="col">Writer</th>
						    <th scope="col">Publisher</th>
						    <th scope="col">Category</th>
						    <th scope="col">Library</th>
						    <th scope="col">Settings</th>
						</tr>
				    </thead>
				    <tbody>
				    	<?php $count = 1 ?>
				        @foreach( $books as $book )
				        	<tr>
				        		<td>{{$count++}}</td>
				        		<td>{{$book->title}}</td>
				        		<td>{{$book->author}}</td>
				        		<td>{{$book->writer}}</td>
				        		<td>{{$book->publisher}}</td>
				        		<td>{{$book->category_id}}</td>
				        		<td>{{$book->library_id}}</td>
				        		<td class="settings">
				        			<a class="btn btn-primary" href="{{route('book.edit', ['id' => $book->id])}}"><i class="fa fa-edit"></i></a>
				        			<a class="btn btn-danger remove-book" data-id="{{$book->id}}"><i class="fa fa-trash"></i></a>
				        		</td>
				        	</tr>
						@endforeach				       				    	
				    </tbody>
				</table>
				<div class="com-md-12 text-right">
                    {{$books->links()}}
                </div>
			</div>
		</div>
	</div>
@endsection
@section('script')
	<script src="{{asset('control/style/assets/js/pages/features/miscellaneous/sweetalert2.min.js')}}" type="text/javascript"></script>
	<script type="text/javascript">
		$('.remove-book').on('click', function(event) {
			event.preventDefault();
			var id = $(this).data('id');
			console.log(id);
			Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
		if (result.value) {
			window.location = '{{route("book.destroy")}}/' + id
			Swal.fire(
				'Deleted!',
				'Your file has been deleted.',
				'success'
			)
		}
		})
		});
	</script>
@endsection