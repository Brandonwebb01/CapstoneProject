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

$quantity = 1;
?>
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
                <td><img src="{{ asset('storage/images/items/lrg' . $item->picture) }}" alt="{{ $item->title }}" class="img-fluid"></td>
                <td>{{ $item->title }}</td>
                <div class="caption">
                    <h3>{{ $item->title }}</h3>
                    <p>{{strip_tags($item->description)}}</p>
                    <p><strong>Price: </strong>{{ $item->price }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h1>Order Now</h1>
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $item->title }}" disabled>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <input type="text" name="description" id="description" class="form-control" value="{{strip_tags($item->description)}}" disabled>
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

                <input type="hidden" name="session_id" value="{{ $_SESSION['sessionID'] }}">
                <input type="hidden" name="ip_address" value="{{ $_SESSION['ipAddress'] }}">
                <input type="hidden" name="quantity" value="{{ $item->quantity }}">
                <button type="submit" class="btn btn-lg btn-block btn-primary">Buy?</button>
            </form>
        </div>
    </div>
@endsection