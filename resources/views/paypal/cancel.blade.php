@extends('layouts.master')

@section('content')

<div class="container">
    <div class="status">
        <h1 class="error">Your PayPal Transaction has been Canceled</h1>
    </div>
    <a href="{{url('/')}}" class="btn-link">Back to Products</a>
</div>
@endsection