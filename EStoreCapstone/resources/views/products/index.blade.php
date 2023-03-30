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
		<table class="table">
			<thead>
				<th>Categories</th>
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

	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<th>#</th>
					<th>Image</th>
					<th>Title</th>
					<th>Price</th>
					<th>Action</th>
				</thead>
				<tbody>
					@foreach ($items as $item)
						<tr>
							<th>{{ $item->id }}</th>
							<td><a href="{{ route('products.order', $item->id) }}"><img
                                @if ($item->picture != "")
                                <p style='margin-top:20px'><br><img src="{{ Storage::url('images/items/'.$item->picture) }}" style='height:100px;' ></p>
                                @endif
							<td><a href="{{ route('products.order', $item->id) }}">{{ $item->title }}</a></td>
							<td>{{ $item->price }}</td>

							<td><a href="{{ route('products.order', $item->id) }}" class="btn btn-success btn-xs">BuyNow</a>
								<br>
								<a href="{{ route('cart.index', $item->id) }}" class="btn btn-primary btn-xs">Add to Cart</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<div class="text-center">
				{!! $items->links() !!}
			</div>
		</div>
	</div>
@endsection