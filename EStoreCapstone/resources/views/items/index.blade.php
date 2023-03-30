@extends('common') 

@section('pagetitle')
Item List
@endsection

@section('pagename')
Laravel Project
@endsection

@section('content')
	<div class="row">
		<div class="col-md-3">
			<h2>Categories</h2>
			<table class="table">
				<thead>
					<th>Category</th>
				</thead>
				<tbody>
					@foreach ($categories as $category)
						<tr>
							<td><a href="#">{{ $category->name }}</a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-8">
					<h1>All Items</h1>
				</div>
				<div class="col-md-4 text-right">
					<a href="{{ route('items.create') }}" class="btn btn-primary">Create New Item</a>
				</div>
			</div>
			<hr>
			<table class="table">
				<thead>
					<th>#</th>
					<th>Title</th>
					<th>Created At</th>
					<th>Last Modified</th>
					<th></th>
				</thead>
				<tbody>
					@foreach ($items as $item)
						<tr>
							<th>{{ $item->id }}</th>
							<td>{{ $item->title }}</td>
							<td>{{ $item->created_at->format('M j, Y') }}</td>
							<td>{{ $item->updated_at->format('M j, Y') }}</td>
							<td>
								<div class="btn-group">
									<a href="{{ route('items.edit', $item->id) }}" class="btn btn-success btn-sm">Edit</a>
									{!! Form::open(['route' => ['items.destroy', $item->id], 'method' => 'DELETE', 'onsubmit' => 'return confirm("Are you sure?")']) !!}
										{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}
									{!! Form::close() !!}
								</div>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<div class="text-center">
				{!! $items->links(); !!}
			</div>
		</div>
	</div>
@endsection