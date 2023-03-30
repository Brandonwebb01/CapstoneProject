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
    Shopping Cart
@endsection

@section('pagename')
    Laravel Project
@endsection

@section('content')
    <h1>Shopping Cart</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->product_id }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection