@extends('common')

@section('pagetitle')
    Order Item
@endsection

@section('pagename')
    Laravel Project
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="thumbnail">
                <img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->title }}">
                <div class="caption">
                    <h3>{{ $item->title }}</h3>
                    <p>{{ $item->description }}</p>
                    <p><strong>Price: </strong>{{ $item->price }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h1>Order Now</h1>
            <form action="{{ route('items.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $item->title }}" disabled>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <input type="text" name="description" id="description" class="form-control" value="{{ $item->description }}" disabled>
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="text" name="price" id="price" class="form-control" value="{{ $item->price }}" disabled>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity:</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $item->quantity }}" disabled>
                </div>
                <div class="form-group">
                    <label for="sku">SKU:</label>
                    <input type="text" name="sku" id="sku" class="form-control" value="{{ $item->sku }}" disabled>
                </div>
                <input type="hidden" name="item_id" value="{{ $item->id }}">
                <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                <button type="submit" class="btn btn-lg btn-block btn-primary">Buy?</button>
            </form>
        </div>
    </div>
@endsection