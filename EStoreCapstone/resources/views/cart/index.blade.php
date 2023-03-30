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
    <div class="col-md-9">
        <table class="table">
            <thead>
                <th>Title</th>
                <th>Quantity</th>
                <th>Price</th>
            </thead>
            <tbody>
                @foreach ($shoppingCart as $shoppingCart)
						<tr>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->price }}</td>
						</tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-center">
            {{-- {!! $shoppingCart->links() !!} --}}
        </div>
    </div>
</div>
@endsection