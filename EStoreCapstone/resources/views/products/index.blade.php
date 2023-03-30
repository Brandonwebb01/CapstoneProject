<?php
session_start();

// If there is no session ID, create one and store it in the session variable
if (empty($_SESSION['sessionID'])) {
    $session_id = session_id();
    $_SESSION['sessionID'] = $session_id;
}

// If there is no IP address stored in the session variable, get it from the user and store it
if (empty($_SESSION['ipAddress'])) {
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $_SESSION['ipAddress'] = $ip_address;
}
?>
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

    <div class="col-md-9">
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